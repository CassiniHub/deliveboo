@extends('layouts.dashboard-layout')

@section('sidebar-content')
    <div>
        <a href="{{ route('users.show', Auth::user() ->id) }}">
            torna ai tuoi ristoranti
        </a>
    </div>
    <div>
        <a href="{{ route('restaurants.protectedOrders', $restaurant ->id) }}">
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

<div class="main-content-container">

    <div class="restaurant-delete-edit">

        <div class="protected-company-name">
            {{ $restaurant ->name }}
        </div>

        <div class="restaurant-actions">

            <form action="{{ route('restaurants.destroy', $restaurant ->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" type="submit">Elimina ristorante</button>
            </form>

            <form action=" {{ route('restaurants.edit', $restaurant ->id) }} " method="GET">
            @csrf
            @method('GET')
            <button class="btn btn-primary" type="submit">Modifica dati ristorante</button>
            </form>
        </div>

    </div>

    <div class="dishes-list">
        <h3>I tuoi piatti</h3>
        <form action="{{ route('dishes.createDish', $restaurant ->id) }}" method="GET">
            @csrf
            @method('GET')
            <button class="btn btn-success" type="submit">Aggiungi un piatto</button>
        </form>
        <ul>
            @foreach ($dishes as $dish)
                <li class="shadow-sm {{ $dish ->is_visible == 0 ? 'not-visible' : '' }}">
                    <div class="flex-container">
                        <div class="dish-name">
                            <h4>
                                {{ $dish ->name }}
                            </h4>
                        </div>
                        <div class="dish-actions">
                            <form action="{{ route('dishes.destroy', $dish) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Elimina piatto</button>
                            </form>

                            <form action="{{ route('dishes.edit', $dish) }}" method="GET">
                                @csrf
                                @method('GET')
                                <button class="btn btn-primary" type="submit">Modifica piatto</button>
                            </form>

                            <form action="{{ route('dishes.changeVisibility', $dish ->id) }}" method="post">
                                @csrf
                                @method('POST')
                                <button class="btn btn-warning" type="submit">

                                    @if ($dish ->is_visible)
                                        Nascondi
                                    @else
                                        Mostra
                                    @endif
                                        piatto
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="dish-info-img">

                        <div class="dish-info">

                            <div class="price">

                                <b>Prezzo: € {{ $dish ->price }}</b>

                            </div>

                            <div class="type">

                                <b>Tipo di piatto: {{ $dish ->type }}</b>

                            </div>

                            <div class="ingredients">
                                <div>
                                    <b>Ingredienti:</b>
                                </div>
                                <p>
                                    {{ $dish ->ingredients }}
                                </p>
                            </div>
                        </div>
                        <div class="dish-img-info">

                            <img src="{{ $dish ->img }}" alt="">

                        </div>
                    </div>

                </li>
            @endforeach
        </ul>
    </div>

</div>







@endsection
