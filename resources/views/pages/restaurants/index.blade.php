@extends('layouts.home-layout')

@section('content')

    <home-component
        :restaurants = "{{ $restaurants }}"
        :categories = "{{ $categories }}"
        :route="'{{ route('restaurants.show', [""]) }}'">
    </home-component>

    
@endsection