@extends('layouts.main-layout')

@section('content')
    <showcart-component
    :dishes = "{{ $restaurant ->dishes }}"
    :restaurant = "{{ $restaurant }}"
    ></showcart-component>
@endsection
