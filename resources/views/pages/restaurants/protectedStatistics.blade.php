@extends('layouts.dashboard-layout')

@section('sidebar-content')

    <div class="title">
        <h1 class="company-name">
            {{ $restaurant ->name }}
        </h1>
    </div>

    <div class="sidebar-navigation-link">

        <div>
            <a href="{{ route('users.show', Auth::user() ->id) }}">
                torna ai tuoi ristoranti
            </a>
        </div>
        <div>
            <a href="{{ route('restaurants.protectedShow', $restaurant ->id) }}">
                Lista piatti
            </a>
        </div>
        <div>
            <a href=" {{ route('restaurants.protectedOrders', $restaurant ->id) }} ">
                Storico ordini
            </a>
        </div>
        <div>
            <a href=" {{ route('restaurants.protectedStatistics', $restaurant ->id) }} ">
                Statistiche ristorante
            </a>
        </div>

    </div>
    
@endsection

@section('main-content')
<div id="chart">

    <div class="statistic-page">

        <h1>
            Statistiche ristorante {{$restaurant ->name}}:
        </h1>

        <div class="chart-btns">

            <div class="main-link" v-on:click="getYearOrders()">
                <div>Mostra tutti gli anni</div>
            </div>

            <div class="year-restaurant">

                <select v-if="this.years.length>0" name="selYears" id="selYears" v-model="selYear" v-on:change="getMonthOrders">
                    <option value="" disabled default>Scegli un anno</option>
                    <option v-for="year in years" :value="year"> @{{year}} </option>
                </select>

            </div>

        </div>

        <div class="istogram">
            <canvas id="myChart" width="600" height="400" color="gold"></canvas>
        </div>

        <h1>
            Statistiche piatti:
        </h1>
        <div class="chart-btns">

                <div class="main-link" v-on:click="showDishesOrdersCharts">
                    <div>
                    I più venduti
                    </div>
                </div>

            <div class="second-link" v-on:click="showDishesMoneyCharts">
                <div>
                    Entrate
                </div>
            </div>

        </div>

        <div class="cake">
            <canvas id="myChart2" width="600" height="600"></canvas>
        </div>

    </div>

</div>

@endsection

@section('scripts')

    @parent

    <script>
        new Vue({
            el: '#chart',
            data: function() {
                return {
                    totOrdersYear: [], //numero totale ordini per anno
                    totMoneyYear: [], //numero totale entrate per anno
                    totOrdersMonth: [], //numero totale ordini per mese all'anno
                    totMoneyMonth: [],  // numero totale entrate per mese all'anno
                    dishesNamesForMoney: [], //nomi piatti ordinato per entrate
                    dishesNamesForQuantity: [], //nomi piatti ordinati per numero ordini
                    dishesQuantity: [], //quantita ordini per singolo piatto
                    dishesMoney: [], //entrate per singolo piatto
                    years: [], //array dinamico anni attivita ristorante
                    selYear: null, // anno selezionato
                    showingChart: null,
                    showingChart2: null,
                }
            },
            mounted() {
                this.getYearOrders();
                this.getDishesOrders();
            },
            methods: {
                getYearOrders: function() {

                    this.selYear = '';

                    axios.get('/api/chart/restaurant/' + {{ $restaurant ->id }})
                    .then(res => {
                        let orders = res.data;
                        let thisYears = [];
                        let ordersYear = [];

                        orders.forEach(order => {
                            let date = order.order_datetime;
                            let thisYear = new Date(date).getFullYear();

                            if (!thisYears.includes(thisYear)) {
                                thisYears.push(thisYear);
                            }

                            if (ordersYear.length == 0){
                                ordersYear.push({'year': thisYear, 'nof_orders': 1, 'money': parseFloat(order.tot_price)});
                            }else{
                                let foundYear = false;
                                ordersYear.forEach(element => {
                                    if (element['year'] == thisYear) {
                                        element['nof_orders'] ++;
                                        element['money'] = parseFloat(element['money']) + parseFloat(order.tot_price);
                                        foundYear = true;
                                    }
                                });
                                if (foundYear == false){
                                    ordersYear.push({'year': thisYear, 'nof_orders': 1, 'money': parseFloat(order.tot_price)});
                                }
                            }
                        });

                        let totalOrdersPerYear = [];
                        let totalMoneyPerYear = [];

                        ordersYear.forEach(element => {
                            totalOrdersPerYear.push(element['nof_orders']);
                            totalMoneyPerYear.push(element['money']);
                        });

                        this.years = thisYears;
                        this.totMoneyYear = totalMoneyPerYear;
                        this.totOrdersYear = totalOrdersPerYear;

                        if(this.showingChart) {
                            this.showingChart.destroy();
                        }
                        this.createYearChart();

                    }).catch(err => {console.log(err);})
                },
                getMonthOrders: function() {
                    axios.get('/api/chart/restaurant/year/' + {{ $restaurant ->id }} + '/' + this.selYear)
                        .then(res => {
                            let orders = res.data;
                            theseMonths = [];
                            split12orders = [];
                            split12money = [];

                            orders.forEach(order => {
                                let date = order.order_datetime;
                                let month = new Date(date).getMonth();

                                if (theseMonths.length == 0){
                                    theseMonths.push({'month': month, 'nof_orders': 1, 'money': parseFloat(order.tot_price)});
                                }else{
                                    let found = false;
                                    theseMonths.forEach(element => {
                                        if (element['month'] == month){
                                            element['nof_orders'] ++;
                                            element['money'] = parseFloat(element['money']) + parseFloat(order.tot_price);
                                            found = true;
                                        }
                                    });

                                    if (found == false) {
                                        theseMonths.push({'month': month, 'nof_orders': 1, 'money':parseFloat(order.tot_price)});
                                    }
                                }
                            });

                            for (let x=0; x<12; x++){
                                let check = false;
                                theseMonths.forEach(element => {
                                    if(element['month'] == x) {
                                        split12orders.push(element['nof_orders']);
                                        split12money.push(element['money']);
                                        check = true;
                                    }
                                });
                                if (check == false) {
                                    split12orders.push(0);
                                    split12money.push(0);
                                }
                            }

                            this.totOrdersMonth = split12orders;
                            this.totMoneyMonth = split12money;

                            if(this.showingChart) {
                                this.showingChart.destroy();
                            }
                            this.createMonthChart();

                        }).catch(err => console.log(err));
                },
                createMonthChart: function() {

                    const ctx = document.getElementById('myChart');
                    let myChart = new Chart(ctx, {
                        data:{
                            labels: ['Gennaio', 'Febbraio','Marzo', 'Aprile', 'Maggio','Giugno','Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre'],
                            datasets: [{
                                type: 'bar',
                                label: 'Tot ordini',
                                backgroundColor: 'rgba(54, 162, 235, 0.3)',
                                borderColor: 'rgb(54, 162, 235)',
                                borderWidth: 1,
                                yAxisID: 'y1',
                                data: this.totOrdersMonth
                            },
                            {
                                type: 'bar',
                                label: 'Entrate totali',
                                backgroundColor: 'rgba(255, 205, 86, 0.2)',
                                borderColor: 'rgb(255, 205, 86)',
                                borderWidth: 1,
                                yAxisID: 'y2',
                                data: this.totMoneyMonth
                            }],
                        },
                        options:{
                            maintainAspectRatio: false,
                            scales: {
                                'y1':{
                                    type: 'linear',
                                    position:'left',
                                    title: {
                                        display: true,
                                        text: 'Numero ordini',
                                        font: {
                                            size: 24,
                                        },
                                        color: 'rgb(54, 162, 235)',
                                    },
                                },
                                'y2':{
                                    type: 'linear',
                                    position:'right',
                                    title: {
                                        display: true,
                                        text: 'Entrate totali',
                                        font: {
                                            size: 24,
                                        },
                                        color: 'rgb(255, 205, 86)',
                                    },
                                },
                            },
                            plugins: {
                                title: {
                                    display: true,
                                    text: 'Ordini/Entrate - ' +  this.selYear,
                                    font: {size: 24}
                                }
                            }
                        }
                    });

                    this.showingChart = myChart;
                },
                createYearChart: function() {
                    const ctx = document.getElementById('myChart');
                    let myChart = new Chart(ctx, {
                        data:{
                            labels: this.years,
                            datasets: [{
                                type: 'bar',
                                label: 'Tot ordini',
                                backgroundColor: 'rgba(54, 162, 235, 0.3)',
                                borderColor: 'rgb(54, 162, 235)',
                                borderWidth: 1,
                                yAxisID: 'y1',
                                data: this.totOrdersYear
                            },
                            {
                                type: 'bar',
                                label: 'Entrate totali',
                                backgroundColor: 'rgba(255, 205, 86, 0.2)',
                                borderColor: 'rgb(255, 205, 86)',
                                borderWidth: 1,
                                yAxisID: 'y2',
                                data: this.totMoneyYear
                            }],
                        },
                        options:{
                            maintainAspectRatio: false,
                            scales: {
                                'y1':{
                                    type: 'linear',
                                    position:'left',
                                    title: {
                                        display: true,
                                        text: 'Numero ordini',
                                        font: {
                                            size: 24,
                                        },
                                        color: 'rgb(54, 162, 235)',
                                    },
                                },
                                'y2':{
                                    type: 'linear',
                                    position:'right',
                                    title: {
                                        display: true,
                                        text: 'Entrate totali',
                                        font: {
                                            size: 24,
                                        },
                                        color: 'rgb(255, 205, 86)',
                                    },
                                }
                            },
                            plugins: {
                                title: {
                                    display: true,
                                    text: 'Ordini/Entrate per anno',
                                    font: {size: 24}
                                }
                            }
                        }
                    });

                    this.showingChart = myChart;
                },
                getDishesOrders: function() {

                    this.showDishes = !this.showDishes;

                    axios.get('/api/chart/dishes/' + {{ $restaurant ->id }})
                        .then(res => {

                            let dishes = res.data;
                            let joinDishes = [];

                            dishes.forEach(dish => {
                                if(joinDishes.length == 0) {
                                    joinDishes.push({'dish': dish, 'nof_dishes': 1, 'money': parseFloat(dish.price)})
                                }else{
                                    let found = false;
                                    joinDishes.forEach(element => {

                                        if(dish.id == element.dish.id) {
                                            element.nof_dishes ++;
                                            element.money = parseFloat(element.money) + parseFloat(dish.price);
                                            found = true;
                                        }
                                    });
                                    if (found == false) {
                                        joinDishes.push({'dish': dish, 'nof_dishes': 1, 'money': parseFloat(dish.price)})
                                    }
                                }
                            });


                            let money = [];
                            let namesForMoney = [];
                            this.sortArrayByMoney(joinDishes);
                            joinDishes.forEach(dish => {
                                namesForMoney.push(dish.dish.name);
                                money.push(dish.money);
                            });

                            let quantities = [];
                            let namesForQuantities = [];
                            this.sortArrayByQuantity(joinDishes)
                            joinDishes.forEach(dish => {
                                namesForQuantities.push(dish.dish.name);
                                quantities.push(dish.nof_dishes);
                            });

                            let limit = 6;
                            this.dishesNamesForMoney = this.cutArray(namesForMoney, limit);
                            this.dishesNamesForQuantity = this.cutArray(namesForQuantities, limit);
                            this.dishesQuantity = this.cutArray(quantities, limit);
                            this.dishesMoney =  this.cutArray(money, limit);

                            this.showDishesOrdersCharts()

                        }).catch(err => console.log(err));
                },
                cutArray: function(array, limit) {

                    if (array.length > limit){
                        return array.slice(0, limit);
                    }else{
                        return array;
                    }
                },
                sortArrayByMoney: function(arr) {
                    arr.sort(function(a,b) {
                        let keyA = a.money;
                        let keyB = b.money;

                        if (keyA < keyB) return 1;
                        if (keyA > keyB) return -1;
                        return 0;
                    })
                },
                sortArrayByQuantity: function(arr) {
                    arr.sort(function(a,b) {
                        let keyA = a.nof_dishes;
                        let keyB = b.nof_dishes;

                        if (keyA < keyB) return 1;
                        if (keyA > keyB) return -1;
                        return 0;
                    })
                },
                createDishesOrdersChart: function() {
                    const ctx = document.getElementById('myChart2');
                    let myChart2 = new Chart(ctx, {
                            type: 'polarArea',
                        data: {
                            labels: this.dishesNamesForQuantity,
                            datasets: [{
                                label: 'Piatti',
                                data: this.dishesQuantity,
                                backgroundColor: [
                                    'rgb(255, 99, 132)',
                                    'rgb(75, 192, 192)',
                                    'rgb(255, 205, 86)',
                                    'rgb(201, 203, 207)',
                                    'rgb(54, 162, 235)',
                                    'rgb(224, 231, 34)',
                                    // 'rgb(44, 95, 45)',
                                    // 'rgb(242, 170, 76)',
                                    // 'rgb(50, 205, 50)',
                                    // 'rgb(238, 0, 0)',
                                    // 'rgb(0, 0, 238)',
                                    // 'rgb(67, 205, 128)',
                                ],
                            }],
                        },
                        options: {
                            maintainAspectRatio: false,
                            plugins: {
                                title: {
                                    display: true,
                                    text: 'Numero singoli piatti venduti',
                                    font: {size: 24}
                                }
                            }
                        }
                    });

                    this.showingChart2 = myChart2;
                },
                createDishesMoneyChart: function() {
                    const ctx = document.getElementById('myChart2');
                    let myChart2 = new Chart(ctx, {
                            type: 'polarArea',
                        data: {
                            labels: this.dishesNamesForMoney,
                            datasets: [{
                                label: 'Piatti',
                                data: this.dishesMoney,
                                backgroundColor: [
                                    'rgb(255, 99, 132)',
                                    'rgb(75, 192, 192)',
                                    'rgb(255, 205, 86)',
                                    'rgb(201, 203, 207)',
                                    'rgb(54, 162, 235)',
                                    'rgb(224, 231, 34)',
                                    // 'rgb(44, 95, 45)',
                                    // 'rgb(242, 170, 76)',
                                    // 'rgb(50, 205, 50)',
                                    // 'rgb(238, 0, 0)',
                                    // 'rgb(0, 0, 238)',
                                    // 'rgb(67, 205, 128)',
                                ],
                            }],
                        },
                        options: {
                            maintainAspectRatio: false,
                            plugins: {
                                title: {
                                    display: true,
                                    text: 'Entrate singolo piatto',
                                    font: {size: 24}
                                }
                            }
                        }
                    });

                    this.showingChart2 = myChart2;
                },
                showDishesOrdersCharts: function() {
                    if(this.showingChart2) {
                        this.showingChart2.destroy();
                    }
                    this.createDishesOrdersChart();
                },
                showDishesMoneyCharts: function() {
                    if(this.showingChart2) {
                        this.showingChart2.destroy();
                    }
                    this.createDishesMoneyChart();
                },
            },
        })
    </script>
@endsection
