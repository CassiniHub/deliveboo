@extends('layouts.main-layout')

@section('content')
    <showcart-component
    :dishes = "{{ $restaurant ->dishes }}"
    :restaurant = "{{ $restaurant }}"
    :route="'{{ route('checkouts.index', [""]) }}'">
    ></showcart-component>
@endsection
