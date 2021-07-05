@extends('layouts.dashboard-layout')

@section('sidebar-content')
    <div>
        <a href="{{ route('restaurants.protectedShow', $restaurant ->id) }}">
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
<div class="container" id="create-form-dish">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Crea nuovo piatto
                    <a class="btn btn-primary mx-3" v-on:click="populateForm1">Piatto 1</a>
                    <a class="btn btn-primary mx-3" v-on:click="populateForm2">Piatto 2</a>
                    <a class="btn btn-primary mx-3" v-on:click="populateForm3">Piatto 3</a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('dishes.storeDish', $restaurant ->id) }}">
                        @method('POST')
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nome</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control"  name="name" minlength="2" maxlength="255" :value="testName" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ingredients" class="col-md-4 col-form-label text-md-right">Ingredienti</label>

                            <div class="col-md-6">
                                <textarea id="ingredients" type="text" class="form-control" minlength="2" name="ingredients" placeholder="Inserisci gli ingredienti separati da una virgola">@{{testDesc}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">Prezzo</label>

                            <div class="col-md-6">
                                <input id="price" type="number" value='0.00' step=".01" min="0.01" class="form-control"  name="price" :value="testPrice" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="form-check" class="col-md-4 col-form-label text-md-right">Visibilità</label>

                            <div class="form-check my-2 mx-5">
                                <input class="form-check-input" type="radio" name="is_visible" id="is_visible" value="1" checked>
                                <label class="form-check-label">
                                  Si
                                </label>
                            </div>
                            <div class="form-check my-2">
                                <input class="form-check-input" type="radio" name="is_visible" id="is_visible" value="0">
                                <label class="form-check-label">
                                  No
                                </label>
                            </div>
                        </div>

                        <div class="form-group d-flex col-md-8 offset-md-2">
                            <label for="type">Tipo di piatto</label>
                            <div class="d-flex mb-3 mx-3">
                                <div class="input-radio-dish">
                                    <input type="radio" name="type" value="Primi"> Primo <br>
                                    <input type="radio" name="type" value="Secondi"> Secondo <br>
                                    <input type="radio" name="type" value="Sushi"> Sushi <br>
                                    <input type="radio" name="type" value="Contorni"> Contorno <br>
                                    <input type="radio" name="type" value="Dolci"> Dolce <br>
                                    <input type="radio" name="type" value="Panini"> Panino <br>
                                    <input type="radio" name="type" value="Hamburger"> Hamburger <br>
                                    <input type="radio" name="type" value="Pizze"> Pizza <br>
                                    <input type="radio" name="type" value="Insalate"> Insalata <br>
                                    <input type="radio" name="type" value="Poke"> Poke <br>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Aggiungi piatto
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    new Vue({
        el: '#create-form-dish',
        data: function() {
            return {
                testName: '',
                testPrice: 0.00,
                testDesc: '',
            }
        },
        methods: {
            populateForm1: function() {
                this.testName = 'Piatto 1';
                this.testPrice = 5.50;
                this.testDesc = 'Breve descrizione di prova piatto 1';
            },
            populateForm2: function() {
                this.testName = 'Piatto 2';
                this.testPrice = 4.50;
                this.testDesc = 'Breve descrizione di prova piatto 2';
            },
            populateForm3: function() {
                this.testName = 'Piatto 3';
                this.testPrice = 1.50;
                this.testDesc = 'Breve descrizione di prova piatto 3';
            },
        }
    })
</script>
@endsection
