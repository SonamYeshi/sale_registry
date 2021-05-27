// This JS is for fetching user specific entry
const id = array.arrayID;
const emp = user.empID;

App = {
    contracts: {},
    load: async () => {
        await App.loadWeb3()
        await App.loadAccount()
        await App.loadContract()
        await App.render()
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
        const vivoRegistry = await $.getJSON('../contract/vivo.json')
        App.contracts.vivo = TruffleContract(vivoRegistry)
        App.contracts.vivo.setProvider(App.web3Provider)

        // Hydrate the smart contract with values from the blockchain
        App.vivoRegistry = await App.contracts.vivo.deployed()
    },

    render: async () => {
        await App.renderEntries();
    },

    renderEntries: async () => {
        const vivo = await App.vivoRegistry.vivophones(id);
        
        let entered_by = await vivo[9];
        if(entered_by != emp) {
            window.location = '/';
        } else {
            const nameField = $('#cust_name');
            const cidField = $('#cid_no');
            const phoneField = $('#mobile');
            const addressField = $('#cust_address');
            const modelField = $('#model');
            const imeiField = $('#imei_no');
            const priceField = $('#price');
            const dateField = $('#purchase_date');
            const entered_byField = $('#entered_by');
            const buttonField = $('#buttons');

            let cust_name = await vivo[1];
            let cid_no = await vivo[2].toNumber();
            let phone = await vivo[3].toNumber();
            let cust_address = await vivo[4];
            let model = await vivo[5];
            let imei_no = await vivo[6].toNumber();
            let price = await vivo[7].toNumber();
            let purchase_date = await vivo[8];
            // let entered_by = await vivo[8];

            nameField.append(`<input type='text' name='cust_name' class='form-control' placeholder='Customer Name' required value='` + cust_name + `'>`);
            cidField.append(`<input type='text' name='cid_no' class='form-control' placeholder='CID Number' required value='` + cid_no + `'>`);
            phoneField.append(`<input type='text' name='mobile' class='form-control' placeholder='Mobile Number' required value='` + phone + `'>`);
            addressField.append(`<textarea name="cust_address" class="form-control" rows="2" placeholder="Address">` + cust_address + `</textarea>`);
            modelField.append(`<input type='text' name='model' class='form-control' placeholder='Vivo Model' required value='` + model + `'>`);
            imeiField.append(`<input type='text' name='imei_no' class='form-control' placeholder='IMEI Number' required value='` + imei_no + `'>`);
            priceField.append(`<input type='text' name='price' class='form-control' placeholder='Price (in Nu.)' required value='` + price + `'>`);
            dateField.append(`<input type='text' name='purchase_date' id='datepicker' class='form-control datepicker' placeholder='Purchased Date' autocomplete='off' required value='` + purchase_date + `'>`);
            entered_byField.append(`<input type='hidden' name='entered_by' class='form-control' value='` + entered_by + `'>
            <input type='hidden' name='id' class='form-control' value='` + id + `'>`);
            buttonField.append(`<button class="btn btn-bt mt-4" type="submit">Update</button>
            <a href="/your-entries"><input type="button" class="btn btn-danger mt-4 ml-2" value="Cancel"></a>`);
        }
    },

    updateSale: async () => {
        let new_id = $('[name="id"]').val();
        let new_cust_name = $('[name="cust_name"]').val();
        let new_cid_no = $('[name="cid_no"]').val();
        let new_mobile = $('[name="mobile"]').val();
        let new_cust_address = $('[name="cust_address"]').val();
        let new_model = $('[name="model"]').val();
        let new_imei = $('[name="imei_no"]').val();
        let new_price = $('[name="price"]').val();
        let new_purchase_date = $('[name="purchase_date"]').val();
        let new_entered_by = $('[name="entered_by"]').val();

        await App.vivoRegistry.updateEntry(
            new_id,
            new_cust_name,
            Number(new_cid_no),
            Number(new_mobile),
            new_cust_address,
            new_model,
            new_imei,
            Number(new_price),
            new_purchase_date,
            new_entered_by);
        //alert('Successfully updated the entry.')
        swal("Successfully updated the entry.")
            .then((value) => {
            window.location = '/your-entries';
            });
    }
}

$(() => {
    $(window).on('load', function() {
        App.load()
    });
})