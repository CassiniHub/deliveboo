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
    <ul>
        @foreach ($ordersArr as $order)
            <li>
                {{ $order ->id }}
            </li>
        @endforeach
    </ul>
@endsection