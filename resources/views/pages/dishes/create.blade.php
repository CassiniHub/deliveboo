@extends('layouts.dashboard-layout')

@section('sidebar-content')
    <div>
        <a href="{{ route('restaurants.protectedShow', $restaurant ->id) }}">
            Torna al ristorante
        </a>
    </div>
    <div>
        <a href="">
            Sotrico ordini
        </a>
    </div>
    <div>
        <a href="">
            Statistiche ristorante
        </a>
    </div>
@endsection

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">New Dish</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('dishes.storeDish', $restaurant ->id) }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control"  name="name"  required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ingredients" class="col-md-4 col-form-label text-md-right">Ingredients</label>

                            <div class="col-md-6">
                                <textarea id="ingredients" type="text" class="form-control"  name="ingredients" placeholder="Inserisci gli ingredienti separati da una virgola"  required></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">Price</label>

                            <div class="col-md-6">
                                <input id="price" type="number" value='0.00' step=".10" class="form-control"  name="price"  required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">Type</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control"  name="type"  required>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="img" class="col-md-4 col-form-label text-md-right">Img</label>

                            <div class="col-md-6">
                                <input id="img" type="file" class="form-control-file"  name="img" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="form-check" class="col-md-4 col-form-label text-md-right">Visible</label>

                            <div class="form-check my-2 mx-5">
                                <input class="form-check-input" type="radio" name="is_visible" id="is_visible" value="1" checked>
                                <label class="form-check-label">
                                  Yes
                                </label>
                            </div>
                            <div class="form-check my-2">
                                <input class="form-check-input" type="radio" name="is_visible" id="is_visible" value="0">
                                <label class="form-check-label">
                                  No
                                </label>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Add
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