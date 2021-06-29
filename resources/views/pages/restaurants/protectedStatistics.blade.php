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

    {{-- <div v-if="this.years.length==0">
        <span v-on:click="getOrders">Show restaurant's orders stats</span>
    </div> --}}

    <div>
        <label for="selYears">Seleziona un anno per iniziare</label>
        <select v-if="this.years.length>0" name="selYears" id="selYears" v-model="selYear" v-on:change="getSelYearOrders">
            <option value="0" disabled>Seleziona un anno</option>
            <option v-for="year in years" :value="year"> @{{year}} </option>
        </select>
    </div>

    <div>
        <canvas id="myChart" width="600" height="400"></canvas>
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
                    totOrdersMonth: [],
                    years: [],
                    selYear: null,
                    showingChart: null,
                    totMoneyMonth: [],
                }
            },
            mounted() {                    
                axios.get('/api/chart/restaurant/' + {{ $restaurant ->id }})
                    .then(res => {
                        let orders = res.data;
                        let thisYears = [];

                        orders.forEach(order => {
                            let date = order.order_datetime;
                            let thisYear = new Date(date).getFullYear();

                            if (!thisYears.includes(thisYear)) {
                                thisYears.push(thisYear);
                            }
                        });

                        this.years = thisYears;
                        console.log(this.years);

                    }).catch(err => {console.log(err);})
            },
            methods: {
                getSelYearOrders: function() {
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

                            console.log(this.totMoneyMonth);

                            if(this.showingChart) {
                                this.showingChart.destroy();
                            }
                            this.createChart(); 

                        }).catch(err => console.log(err));
                },
                createChart: function() {

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
            },
    })
    </script>
@endsection