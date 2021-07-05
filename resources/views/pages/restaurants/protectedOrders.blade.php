@extends('layouts.dashboard-layout')

@section('sidebar-content')

    <div class="title">
        <h1 class="company-name">
            {{ $restaurant ->name }}
        </h1>
    </div>
    
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
@endsection

@section('main-content')
<div id="orders-history">

    <div class="history-page">

        <h1>Storico ordini ristorante {{$restaurant ->name }}: </h1>

        @foreach ($orders as $order)
            @if ($order ->status == 1)
                <h2>
                    Ordini in preparazione:
                </h2>
                @break
            @endif
        @endforeach

        <ul>
            @foreach ($orders as $order)
                @if ($order ->status == 1)
                    <li class=" order-card1">
                        <div class="timestamp">
                          <strong>{{ $order ->order_datetime}}</strong>
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

                        <div class="ready-button">
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
            Ordini evasi:
        </h2>
        <ul class="orders-gone">
            @foreach ($orders as $order)
                @if ($order ->status != 1)

                    <li class=" order-card2">
                        <div class="timestamp">
                          {{ $order ->order_datetime}}
                        </div>
                        <div class="price">
                            <div class="title">
                                Importo:
                            </div>
                            {{ $order ->tot_price }} €
                        </div>
                        <div class="dishes">
                            <div class="title">
                                Piatti ordinati:
                            </div>

                            <div class="dishes-order-name-list">

                                @foreach ($order ->dishes as $dish)
                                    {{ $dish ->name }}
                                @if ($loop ->index < $loop ->count - 1)
                                    -
                                @endif
                                @endforeach

                            </div>

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


</div>
@endsection

@section('scripts')
    <script>
        new Vue({
            el: '#orders-history',
        })
    </script>
@endsection
