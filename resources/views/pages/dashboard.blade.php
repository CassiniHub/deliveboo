@extends('layouts.dashboard-layout')

@section('content')

    @foreach (Auth::user() ->restaurants as $restaurant)
        <restaurant-component
            :restaurant = "{{$restaurant}}"
        ></restaurant-component>
    @endforeach

@endsection