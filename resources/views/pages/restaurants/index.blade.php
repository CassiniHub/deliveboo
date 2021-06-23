@extends('layouts.home-layout')

@section('content')

    <home-component
        :categories = "{{ $categories }}"
    ></home-component>

@endsection