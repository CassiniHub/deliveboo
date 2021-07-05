@extends('layouts.dashboard-layout')

@section('sidebar-content')
    <div>
        <a href="{{ route('restaurants.protectedShow', Auth::user() -> id) }}">
            Torna al ristorante
        </a>
    </div>
@endsection

@section('main-content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $dish ->name }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('dishes.update', $dish) }}">
                            @method('PUT')
                            @csrf
                            
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Nome</label>

                                <div class="col-md-6">
                                    <input id="name" name="name" type="text" class="form-control" autofocus value="{{ $dish -> name }}" maxlength="255"  required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ingredients" class="col-md-4 col-form-label text-md-right">Ingredienti</label>

                                <div class="col-md-6">
                                    <textarea id="ingredients" name="ingredients" type="text" class="form-control" maxlength="255">{{ $dish -> ingredients }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="price" class="col-md-4 col-form-label text-md-right">Prezzo</label>

                                <div class="col-md-6">
                                    <input id="price"  value='{{ $dish -> price }}' step=".01" name="price" type="number" class="form-control" value="{{ $dish -> price}}" step=".10" min="0" max="999999" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="form-check" class="col-md-4 col-form-label text-md-right">Visibilità</label>

                                <div class="form-check my-2 mx-5">
                                    <input class="form-check-input" type="radio" name="is_visible" id="is_visible" value="1" {{ $dish -> is_visible == 1 ? 'checked' : ''}}>
                                    <label class="form-check-label">
                                    Si
                                    </label>
                                </div>
                                <div class="form-check my-2">
                                    <input class="form-check-input" type="radio" name="is_visible" id="is_visible" value="0" {{ $dish -> is_visible == 0 ? 'checked' : ''}}>
                                    <label class="form-check-label">
                                    No
                                    </label>
                                </div>
                            </div>

                            <div class="form-group d-flex col-md-8 offset-md-2">
                                <label for="type">Tipo di piatto</label>
                                <div class="d-flex mb-3 mx-3">
                                    <div>
                                        <input type="radio" name="type" value="Primi" 
                                        @if ($dish ->type == 'Primi')
                                            checked
                                        @endif>
                                         Primo <br>
                                        <input type="radio" name="type" value="Secondi"
                                        @if ($dish ->type == 'Secondi')
                                            checked
                                        @endif>
                                         Secondo <br>
                                         <input type="radio" name="type" value="Sushi" 
                                        @if ($dish ->type == 'Sushi')
                                            checked
                                        @endif>
                                         Sushi <br>
                                        <input type="radio" name="type" value="Contorni"
                                        @if ($dish ->type == 'Contorni')
                                            checked
                                        @endif>
                                         Contorno <br>
                                        <input type="radio" name="type" value="Dolci"
                                        @if ($dish ->type == 'Dolci')
                                            checked
                                        @endif>
                                         Dolce <br>
                                        <input type="radio" name="type" value="Panini"
                                        @if ($dish ->type == 'Panini')
                                            checked
                                        @endif>
                                        Panino <br>
                                        <input type="radio" name="type" value="Hamburger"
                                        @if ($dish ->type == 'Hamburger')
                                            checked
                                        @endif>
                                        Hamburger <br>
                                        <input type="radio" name="type" value="Pizze"
                                        @if ($dish ->type == 'Pizze')
                                            checked
                                        @endif>
                                         Pizza <br>
                                        <input type="radio" name="type" value="Insalate"
                                        @if ($dish ->type == 'Insalate')
                                            checked
                                        @endif>
                                         Insalata <br>
                                         <input type="radio" name="type" value="Poke"
                                         @if ($dish ->type == 'Poke')
                                             checked
                                         @endif>
                                          Poke <br>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Modifica piatto
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection