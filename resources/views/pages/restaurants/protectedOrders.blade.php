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
<div id="orders-history">

    <h1>Storico ordini: {{$restaurant ->name }} </h1>

    @foreach ($orders as $order)
        @if ($order ->status == 1)
            <h2>
                Ordini in preparazione
            </h2>
            @break
        @endif
    @endforeach

    <ul>
        @foreach ($orders as $order)
            @if ($order ->status == 1)
                <li class=" order-card">
                    <div class="timestamp">
                        {{ $order ->order_datetime}}
                    </div>
                    <div class="dishes">
                        <div class="title">
                            Piatti ordinati:
                        </div>
                        @foreach ($order ->dishes as $dish)
                            {{ $dish ->name }} 
                            @if ($loop ->index < $loop ->count - 1)
                                -
                            @endif
                        @endforeach
                    </div>
                    <div class="notes">
                        <div class="title">
                            Note:
                        </div>
                        {{ $order ->notes }}
                    </div>

                    <div class="btn btn-warning">
                        <form action="{{ route('orders.changeStatus', $order ->id) }}" method="post">
                            @csrf
                            @method('POST')
                            <button class="btn btn-warning" type="submit">
                                Pronto!
                            </button>
                        </form>
                    </div>    
                </li>
            @endif
        @endforeach
    </ul>

    <h2>
        Oridini evacuati
    </h2>
    <ul>
        @foreach ($orders as $order)
            @if ($order ->status != 1)
                
                <li class=" order-card">
                    <div class="timestamp">
                        {{ $order ->order_datetime}}
                    </div>
                    <div class="price">
                        <div class="title">
                            Importo:
                        </div>
                        {{ $order ->tot_price }}
                    </div>
                    <div class="dishes">
                        <div class="title">
                            Piatti ordinati:
                        </div>
                        @foreach ($order ->dishes as $dish)
                                {{ $dish ->name }} 
                            @if ($loop ->index < $loop ->count - 1)
                                -
                            @endif
                        @endforeach
                    </div>
                    <div class="notes">
                        <div class="title">
                            Note:
                        </div>
                        {{ $order ->notes }}
                    </div>
                </li>
            @endif
        @endforeach
    </ul>
</div>
@endsection

@section('scripts')
    <script>
        new Vue({
            el: '#orders-history',
        })
    </script>
@endsection