// This JS is for fetching dashboard items.
App = {
    contracts: {},
    load: async () => {
        await App.loadWeb3()
        await App.loadAccount()
        await App.loadContract()
        await App.statistics()
    },
    loadWeb3: async () => {
        if (typeof web3 !== 'undefined') {
            App.web3Provider = web3.currentProvider
            web3 = new Web3(web3.currentProvider)
        } else {
            Swal.fire({
                title: 'Metasmask Required!',
                text: 'Please install metamask Plug-in/Add-on/Extension and refresh the page.',
                imageUrl: 'img/metamask2.png',
                imageWidth: 400,
                imageHeight: 230,
                imageAlt: 'Custom image',
            })
            // alert('This page requires an Extension/Add-on "METAMASK" to be installed and enabled on your browser. Please install the extension and refresh the page.')
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
    },
    statistics: async () => {
        const total = await App.vivoRegistry.totalRegistered();
        var salesToday = 0, revenueToday = 0, sum = 0;
        let today = new Date().format('d/m/Y');
        const todaySales = $('#salesToday');
        const todayRevenue = $('#todayRevenue');
        const totalSales = $('#totalSales');
        const totalRevenue = $('#totalRevenue');
        // X-Axis Purchased Date Dataset
        var xAxis = [];
        // Y-Axis Price Dataset
        var yAxis = [];
        for (var i = 1; i <= total.toNumber(); i++) {
            const vivo = await App.vivoRegistry.vivophones(i);
            let date = await await vivo[8];
            let price = await vivo[7].toNumber();
            if(today == date) {
                salesToday++;
                revenueToday += price;
            }
            sum += price;
            if(xAxis.includes(date)) {
                var index = xAxis.findIndex(xAxis => xAxis === date);
                yAxis[index] = yAxis[index] + price;
            } else {
                xAxis.push(date);
                yAxis.push(price);
            }
            // Sort xAxis dataset with it's respective value from yAxis dataset
            let n = xAxis.length;
            for(var i = 0; i < n; i++) {
                let min = i;
                for(let j = i+1; j < n; j++){
                    if(xAxis[j] < xAxis[min]) { min=j; }
                }
                if (min != i) {
                    let tmp = xAxis[i];
                    let val = yAxis[i];
                    xAxis[i] = xAxis[min];
                    xAxis[min] = tmp;
                    yAxis[i] = yAxis[min];
                    yAxis[min] = val;
                }
            }
        }
        //Sales Today Number
        todaySales.append(salesToday);
        //Revenue Today Amount
        todayRevenue.append('Nu. ' + revenueToday);
        //Total Sales Number
        totalSales.append(total.toNumber());
        //Total Revenue Amount
        totalRevenue.append('Nu. ' + sum);
   
        // Line Chart
        var ctx = document.getElementById('linechart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: xAxis,
                datasets: [{
                    label: 'Number of Sales in Nu.',
                    data: yAxis,
                    borderColor: 'rgb(0,191,255)',
                    borderWidth: 1
                }]
            },
            options: { scales: { y: { beginAtZero: false } } }
        });
        // Bar Chart
        var cty = document.getElementById('piechart').getContext('2d');
        new Chart(cty, {
            type: 'bar',
            data: {
                labels: xAxis,
                datasets: [{
                    label: 'Number of Sales',
                    data: yAxis,
                    backgroundColor: getRandomColor,
                    borderColor: 'rgb(128,128,128)',
                    borderWidth: 1
                }]
            },
            options: { scales: { y: { beginAtZero: true } } }
        });
    }
}
function getRandomColor() {
    var letters = '0123456789ABCDEF'.split('');
    var color = '#';
    for (var i = 0; i < 6; i++ ) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}
$(() => {
    $(window).on('load', function() {
        alert('tellonym');
        App.load()
    });
}) 