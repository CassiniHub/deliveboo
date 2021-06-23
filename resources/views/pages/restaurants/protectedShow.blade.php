@extends('layouts.dashboard-layout')
 
@section('sidebar-content')
    <div>
        <a href="{{ route('users.show', Auth::user() ->id) }}">
            torna ai tuoi ristoranti
        </a>
    </div>
    <div>
        <a href="">
            Sotrico ordini
        </a>
    </div>
    <div>
        <a href="">
            Statistiche ristorante
        </a>
    </div>
@endsection

@section('main-content')
    <h1>
        {{ $restaurant ->name }}
    </h1>

    <div class="restaurant-actions">
        <form action="{{ route('restaurants.destroy', $restaurant ->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" type="submit">Elimina ristorante</button>
        </form>
    
        <form action="" method="GET">
            @csrf
            @method('GET')
            <button class="btn btn-primary" type="submit">Modifica dati ristorante</button>
        </form>
    </div>



    <div class="dishes-list">
        <h3>I tuoi piatti</h3>
        <form action="" method="GET">
            @csrf
            @method('GET')
            <button class="btn btn-success" type="submit">Aggiungi un piatto</button>
        </form>
        <ul>
            @foreach ($dishes as $dish)
                <li class="shadow-sm">
                    <div class="flex-container">
                        <div class="dish-name">
                            <h4>
                                {{ $dish ->name }}
                            </h4>
                        </div>
                        <div class="dish-actions">
                            <form action="" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Elimina piatto</button>
                            </form>
                        
                            <form action="" method="GET">
                                @csrf
                                @method('GET')
                                <button class="btn btn-primary" type="submit">Modifica piatto</button>
                            </form>
                        </div>
                    </div>
                    <div class="ingredients">
                        <div>
                            <b>Ingredienti:</b>
                        </div>
                        <p>
                            {{ $dish ->ingredients }}
                        </p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection