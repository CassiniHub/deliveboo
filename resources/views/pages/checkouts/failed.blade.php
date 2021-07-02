@extends('layouts.main-layout')

@section('content')

    <div class="failed-container">
        <div class="failed-disclaimer">
            <h1>Transazione fallita, riprova o torna alla home.</h1>
        </div>

        <div class="order-recap">
            <h4>Riepilogo ordine n°: {{ $order ->id }}</h4>

            <h4>Totale: {{ $order ->tot_price }} €</h4>
        </div>

        <div class="failed-action">
            <a class="failed-home-button" href="{{ url('/') }}">Torna alla Home</a>
            <a class="failed-ctb-button" href="{{ URL::previous() }}">Torna al carrello</a>
        </div>
    </div>
    
@endsection
