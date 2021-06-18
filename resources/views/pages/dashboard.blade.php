@extends('layouts.dashboard-layout')

@section('content')

    <div id="dashboard-title">
        <h1>
            Questa è la dashboard del nostro sito.
        </h1>
    </div>

    
    <form action="{{route('users.destroy', Auth::user()->id)}}" method="POST">
        @method('DELETE')
        @csrf
        <input type="submit" class="btn btn-danger" value="Delete your account"/>
     </form>

@endsection