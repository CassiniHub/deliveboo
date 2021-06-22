@extends('layouts.home-layout')

@section('content')

    @foreach ($restaurants as $restaurant)
        <restaurant-card-component
            :restaurant = "{{ $restaurant }}"
            :categories = "{{ $restaurant ->categories }}"
        ></restaurant-card-component>
    @endforeach

@endsection