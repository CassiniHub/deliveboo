@extends('layouts.dashboard-layout')

@section('sidebar-content')

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
    Seleziona un ristorante per inziare
@endsection