@extends('layouts.dashboard-layout')

@section('sidebar-content')

    <div class="title">
        <h1 class="company-name">
            {{ Auth::user() ->company_name }}
        </h1>
    </div>

    <h4>
        Le tue attività
    </h4>

    <a href="{{ route('restaurants.create') }}">
        Aggiungi un'attività
    </a>

    <ul>
        @foreach ($restaurants as $restaurant)
        <li class="sidebar-restaurant-link">
            <a href="{{ route('restaurants.protectedShow', $restaurant ->id) }}">
                {{ $restaurant ->name }} 
            </a>
            @if ($restaurant ->is_visible == 0)
                CHIUSO
            @endif
        </li>
        @endforeach
    </ul>
@endsection

@section('main-content')

    <div class="protected-content-flex">

        Seleziona un ristorante per iniziare

    </div>

@endsection
