// This JS is for fetching dashboard items.
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
        const vivoRegistry = await $.getJSON('contract/vivo.json')
        App.contracts.vivo = TruffleContract(vivoRegistry)
        App.contracts.vivo.setProvider(App.web3Provider)

        // Hydrate the smart contract with values from the blockchain
        App.vivoRegistry = await App.contracts.vivo.deployed()
    },

    render: async () => {
        await App.statistics();
        await App.renderRecentEntries();
    },

    statistics: async () => {
        const total = await App.vivoRegistry.totalRegistered();
        var salesToday = 0, revenueToday = 0, sum = 0;
        let today = new Date().format('d/m/Y');

        const todaySales = $('#salesToday');
        const todayRevenue = $('#todayRevenue');
        const totalSales = $('#totalSales');
        const totalRevenue = $('#totalRevenue');

        for (var i = 1; i <= total.toNumber(); i++) {
            const vivo = await App.vivoRegistry.vivophones(i);
            let date = await await vivo[8];
            let price = await vivo[7].toNumber();
            if(today == date) {
                salesToday++;
                revenueToday += price;
            }
            sum += price;
        }

        //Sales Today Number
        todaySales.append(salesToday);

        //Revenue Today Amount
        todayRevenue.append('Nu. ' + revenueToday);

        //Total Sales Number
        totalSales.append(total.toNumber());

        //Total Revenue Amount
        totalRevenue.append('Nu. ' + sum);
    },

    renderRecentEntries: async () => {
        const count = await App.vivoRegistry.totalRegistered();
        const vivoTemplate = $('#recentEntries');

        for (var  i = count.toNumber(); i >= 1; i--) {
            // Fetch the task data from the blockchain
            const vivo = await App.vivoRegistry.vivophones(i);
            let cust_name = await vivo[1];
            let cid_no = await vivo[2].toNumber();
            let phone = await vivo[3].toNumber();
            let cust_address = await vivo[4];
            let model = await vivo[5];
            let imei_no = await vivo[6].toNumber();
            let price = await vivo[7].toNumber();
            let purchase_date = await vivo[8];
            let entered_by = await vivo[9];

            // Create the html for the task
            let vivoItem =
                `<div class="col-md-4">
                <div class="card mt-4">
                    <div class="card-body">
                        <h4 class="card-title"><strong><i class="fa fa-calendar text-muted" aria-hidden="true"></i> ` + model + `</strong></h4>
                        <h5 class="card-title">Price: `+ price +`</h5>
                        <h5 class="card-title">IMEI: `+ imei_no +`</h5>
                        <p>
                            <i class="fa fa-area-chart text-muted" aria-hidden="true"></i>Purchase Date: `+ purchase_date +`<br>
                            <i class="fa fa-map-marker text-muted" aria-hidden="true"></i>Entry Date: ` + purchase_date + `<br>
                            <i class="fa fa-map-marker text-muted" aria-hidden="true"></i>Entered By: ` + entered_by + `
                        </p>
                        <hr>
                        <h6 class="card-subtitle mb-2"><span class="text-muted">Customer:</span> `+ cust_name +`</h6>
                        <h6 class="card-subtitle mb-2"><span class="text-muted">CID:</span> `+ cid_no +`</h6>
                        <h6 class="card-subtitle mb-2"><span class="text-muted">Address:</span> `+ cust_address +`</h6>
                        <h6 class="card-subtitle mb-2"><span class="text-muted">Contact:</span> `+ phone +`</h6>
                    </div>
                </div>
            </div>`;

            // Show the task
            vivoTemplate.append(vivoItem)
        }
    }
}

$(() => {
    $(window).on('load', function() {
        App.load()
    });
})

