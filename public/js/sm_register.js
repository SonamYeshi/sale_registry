// This JS is for registering a sale.
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

        // Hydrate the smart contract with values from the blockchain
        App.vivoRegistry = await App.contracts.vivo.deployed()
    },

    registerSale: async () => {
        let cust_name = $('[name="cust_name"]').val();
        let cid_no = $('[name="cid_no"]').val();
        let mobile = $('[name="mobile"]').val();
        let cust_address = $('[name="cust_address"]').val();
        let model = $('[name="model"]').val();
        let imei_no = $('[name="imei_no"]').val();
        let price = $('[name="price"]').val();
        let purchase_date = $('[name="purchase_date"]').val();
        let entered_by = $('[name="entered_by"]').val();

        await App.vivoRegistry.registerPhone(cust_name, Number(cid_no), Number(mobile), cust_address
        , model,Number(imei_no), Number(price), purchase_date, entered_by);
        
        swal("Successfully registered the sale.")
        .then((value) => {
        window.location = '/dashboard';
        });
    }
}

$(() => {
    $(window).on('load', function() {
        App.load()
    });
})

