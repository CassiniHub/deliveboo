@extends('layouts.dashboard-layout')

@section('sidebar-content')

    <h4>
        Le tue attività
    </h4>

    <a href="{{ route('restaurants.create') }}">
        Aggiungi un'attività
    </a>

    <ul>
        @foreach ($restaurants as $restaurant)
        <li>
            <a href="{{ route('restaurants.protectedShow', $restaurant ->id) }}">
                {{ $restaurant ->name }}
            </a>
        </li>
        @endforeach
    </ul>
@endsection

@section('main-content')

    <div class="protected-content-flex">

        Seleziona un ristorante per iniziare

    </div>

@endsection
