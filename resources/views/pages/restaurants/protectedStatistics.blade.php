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

    <div style="width:50vw">
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
                    totMoneyMonth: 0,
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
                                backgroundColor: 'rgb(252, 106, 1)',
                                yAxisID: 'y1',
                                data: this.totOrdersMonth
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
                                        color: 'rgb(0, 194, 184)',
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