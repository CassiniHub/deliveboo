@extends('layouts.home-layout')

@section('content')

    <home-component
        :categories = "{{ $categories }}"
        :route="'{{ route('restaurants.show', [""]) }}'"
    ></home-component>

@endsection