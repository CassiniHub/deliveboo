@extends('layouts.dashboard-layout')

@section('sidebar-content')
    <div>
        <a href="{{ route('users.show', Auth::user() ->id) }}">
            Torna alla tua dashboard
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

<div class="container" id="create-form">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Nuovo Ristorante <a class="btn btn-primary mx-3" v-on:click="populateForm">test data</a></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('restaurants.store') }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nome</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control"  name="name" minlength="2" maxlength="255" :value="testName" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Indirizzo</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control"  name="address" minlength="6" maxlength="255" :value="testAddress" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Indirizzo e-mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control"  name="email" maxlength="128" :value="testEmail" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telephone" class="col-md-4 col-form-label text-md-right">Numero di telefono</label>

                            <div class="col-md-6">
                                <input id="telephone" type="text" class="form-control"  name="telephone" maxlength="32" :value="testPhone" required>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="img_cover" class="col-md-4 col-form-label text-md-right">Immagine di copertina</label>

                            <div class="col-md-6">
                                <input id="img_cover" type="file" class="form-control-file"  name="img_cover" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="logo" class="col-md-4 col-form-label text-md-right">Logo</label>

                            <div class="col-md-6">
                                <input id="logo" type="file" class="form-control-file"  name="logo">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="form-check" class="col-md-4 col-form-label text-md-right">Pagamento in contanti</label>

                            <div class="form-check my-2 mx-5">
                                <input class="form-check-input" type="radio" name="allow_cash" id="allow_cash" value="1" checked>
                                <label class="form-check-label" for="exampleRadios1">
                                  Yes
                                </label>
                            </div>
                            <div class="form-check my-2">
                                <input class="form-check-input" type="radio" name="allow_cash" id="allow_cash" value="0">
                                <label class="form-check-label" for="exampleRadios2">
                                  No
                                </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="delivery_cost" class="col-md-4 col-form-label text-md-right">Costo aggiuntivo consegna</label>

                            <div class="col-md-6">
                                <input id="delivery_cost" type="number" value='' step=".01" min="0" class="form-control"  name="delivery_cost" :value="testCost" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Descrizione</label>

                            <div class="col-md-6">
                                <textarea name="description" id="description" cols="35" rows="5">@{{testDesc}}</textarea>
                            </div>
                        </div>

                        <div class="form-group d-flex col-md-8 offset-md-2">
                            <label for="category_id[]">Tipi di cucina</label>
                            <div class="d-flex mb-3">
                                <div class="checkbox-style">
                                    @foreach ($categories as $category)
                                        <input type="Checkbox" name="category_id[]" value="{{ $category -> id }}"> <span class="categorypad">{{ $category -> name }}</span><br>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Crea
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
        el: '#create-form',
        data: function() {
            return {
                testName: '',
                testAddress: '',
                testEmail: '',
                testPhone: '',
                testCost: 0.00,
                testDesc: '',
            }
        },
        methods: {
            populateForm: function() {
                this.testName = 'Pizzeria Arcimboldi';
                this.testAddress = 'via duca di cornovaglia 21';
                this.testEmail = 'arcimboldi@mail.com';
                this.testPhone = '3453322345';
                this.testCost = 4.50;
                this.testDesc = 'La pizza tradizionale italiana direttamente a casa tua.';
            }
        }
    })
</script>

@endsection
