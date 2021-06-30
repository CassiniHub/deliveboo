@extends('layouts.dashboard-layout')
 
@section('sidebar-content')
    <div>
        <a href="{{ route('users.show', Auth::user() ->id) }}">
            torna ai tuoi ristoranti
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
@endsection

@section('main-content')
<div id="chart">

    <div class="chart-btns">
        <div class="all-restaurants-link" v-on:click="getYearOrders()">
            <div>Mostra tutti gli anni</div>
        </div>
    
        <div class="year-restaurant">
            <select v-if="this.years.length>0" name="selYears" id="selYears" v-model="selYear" v-on:change="getMonthOrders">
                <option value="" disabled default>Scegli un anno</option>
                <option v-for="year in years" :value="year"> @{{year}} </option>
            </select>
        </div>
    </div>

    <div>
        <canvas id="myChart" width="600" height="400"></canvas>
    </div>

    {{-- <div v-if="selYear" v-on:click="getDishesOrders">
        See dishes preferences
    </div> --}}

    {{-- <div>
        <canvas id="myChart2" width="600" height="400"></canvas>
    </div> --}}
</div>

@endsection

@section('scripts')

    @parent

    <script>
        new Vue({
            el: '#chart',
            data: function() {
                return {
                    totOrdersYear: [],
                    totMoneyYear: [],
                    totOrdersMonth: [],
                    totMoneyMonth: [],
                    years: [],
                    selYear: null,
                    showingChart: null,
                }
            },
            mounted() {                    
                this.getYearOrders();
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
                            }
                        }
                    });

                    this.showingChart = myChart;
                },
                getDishesOrders: function() {
                    console.log('click');
                }
            },
    })
    </script>
@endsection