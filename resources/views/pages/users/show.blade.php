@extends('layouts.dashboard-layout')

@section('content')
    <ul>
        @foreach ($restaurants as $restaurant)
        <li>
            <a href="">
                {{ $restaurant ->name }}
            </a>    
        </li>
        @endforeach
    </ul>
@endsection