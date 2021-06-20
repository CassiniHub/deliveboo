@extends('layouts.dashboard-layout')

@section('content')

    <ul>
        @foreach (Auth::user() ->restaurants as $restaurant)
            <li>
                <span>
                    <restaurant-component
                        :restaurant = "{{$restaurant}}"
                    ></restaurant-component>
                </span>
                <span>
                    <form action="{{ route('restaurants.destroy', $restaurant ->id) }}" method="POST">

                        @method('DELETE')
                        @csrf

                        <button class="btn btn-danger" type="submit">Cancella</button>
                    </form>
                </span>
            </li>
        @endforeach
    </ul>

@endsection