@extends('layouts.main-layout')

@section('content')

    <div class="success-container">

        <div class="success-disclaimer">

            <h1>Transazione effettuata con successo, Grazie! </h1>

            <h4>La conferma sarà inviata alla tua e-mail: {{ $order ->email }}</h4>


        </div>
        <div class="order-recap">

            <h4>Riepilogo ordine n°: {{ $order ->id }}</h4>

            <h4>Totale: {{ $order ->tot_price }} euro</h4>

            <h4>{{ $order ->delivery_address }}, campanello {{ $order ->doorbell_name }} </h4>

            @if ($order ->notes)

                <h4> Note: </h4>
                <p>{{ $order ->notes }}</p>

            @endif

            <h4>Saremo da te in circa 30 minuti!</h4>

{{--             <div class="scooter-animation">



            </div>
 --}}
        </div>
        <div class="success-action">

            <a class="success-home-button" href=" {{ url('/') }} ">Torna alla Home</a>

        </div>



    </div>


@endsection
