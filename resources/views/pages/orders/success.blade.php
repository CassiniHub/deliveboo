@extends('layouts.main-layout')

@section('content')

    <div class="success-container">

        <div class="success-disclaimer">

            <h1>Transazione effettuata con successo, Grazie! </h1>

            <h4>La conferma sarà inviata alla tua e-mail: --E-mail--</h4>


        </div>
        <div class="order-recap">

            <h4>Riepilogo ordine n°: --idordine--</h4>

            <ul>

                <li>hfaòkjfhòalfhaòsjkf</li>

            </ul>

            <h4>Totale: €</h4>

            <h4>Spedizione a --nomeguest--, --indirizzoguest--</h4>

            <h4>Saremo da te in circa 30 minuti!</h4>

        </div>
        <div class="success-action">

            <a class="success-home-button" href="">Torna alla Home</a>

            <a class="success-ctb-button" href="">Continua con gli acquisti</a>

        </div>



    </div>


@endsection
