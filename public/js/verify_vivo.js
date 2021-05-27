// This JS is for verification of a sale

App = {
    contracts: {},
    load: async () => {
        await App.loadWeb3()
        await App.loadAccount()
        await App.loadContract()
    },

    loadWeb3: async () => {
        if (typeof web3 !== 'undefined') {
            App.web3Provider = web3.currentProvider
            web3 = new Web3(web3.currentProvider)
        } else {
            alert('This page requires an Extension/Add-on "METAMASK" to be installed and enabled on your browser. Please install the extension and refresh the page.')
        }
        // Modern dapp browsers...
        if (window.ethereum) {
            window.web3 = new Web3(ethereum);
            try {
                // Request account access if needed
                await ethereum.enable();
                // Acccounts now exposed
                web3.eth.sendTransaction({/* ... */})
            } catch (error) {
                // User denied account access...
            }
        }
        // Legacy dapp browsers...
        else if (window.web3) {
            App.web3Provider = web3.currentProvider
            window.web3 = new Web3(web3.currentProvider)
            // Acccounts always exposed
            web3.eth.sendTransaction({/* ... */})
        }
        // Non-dapp browsers...
        else {
            console.log('Non-Ethereum browser detected. You should consider trying MetaMask!')
        }
    },

    loadAccount: async () => {
        // Set the current blockchain account
        web3.eth.defaultAccount = web3.eth.accounts[0];
    },

    loadContract: async () => {
        // Create a JavaScript version of the smart contract
        const vivoRegistry = await $.getJSON('contract/vivo.json')
        App.contracts.vivo = TruffleContract(vivoRegistry)
        App.contracts.vivo.setProvider(App.web3Provider)

        // Get a copy of the smart contract with values from the blockchain
        App.vivoRegistry = await App.contracts.vivo.deployed()
    },

    verifyData: async () => {
        const count = await App.vivoRegistry.totalRegistered();
        //const vivoTemplate = $('#yourEntries');
        let isVerified = false;
        for (var i = count.toNumber(); i >= 1; i--) {
            // Fetch the task data from the blockchain
            const vivo = await App.vivoRegistry.vivophones(i);
            
            let cid_no = await vivo[2].toNumber();
            let imei_no = await vivo[6].toNumber();
            
            if(!isVerified){
                if($('[name="cust_cid"]').val() == cid_no && $('[name="phone_iemi"]').val() == imei_no) {
                    isVerified = true;
                }
            }       
        }
        if(isVerified) {
            //$('#verifiedSign').html('&#10004;').append(' Verified');
            swal("", "Your are verified", "success");
        } else{ 
            //$('#verifiedSign').html('&#10060;').append(' You are not Verified');
            swal("", "Your are not verified", "error");
        }
    }
}

$(() => {
    $(window).on('load', function() {
        App.load()
    });
})