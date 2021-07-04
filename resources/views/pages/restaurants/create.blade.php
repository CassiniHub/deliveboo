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

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">New Restaurant</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('restaurants.store') }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control"  name="name" minlength="2" maxlength="255" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control"  name="address" minlength="6" maxlength="255" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control"  name="email" maxlength="128" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telephone" class="col-md-4 col-form-label text-md-right">Phone number</label>

                            <div class="col-md-6">
                                <input id="telephone" type="text" class="form-control"  name="telephone" maxlength="32" required>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="img_cover" class="col-md-4 col-form-label text-md-right">Cover image</label>

                            <div class="col-md-6">
                                <input id="img_cover" type="file" class="form-control-file"  name="img_cover" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="logo" class="col-md-4 col-form-label text-md-right">Restaurant logo</label>

                            <div class="col-md-6">
                                <input id="logo" type="file" class="form-control-file"  name="logo">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="form-check" class="col-md-4 col-form-label text-md-right">Allow cash</label>

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
                            <label for="delivery_cost" class="col-md-4 col-form-label text-md-right">Delivery cost</label>

                            <div class="col-md-6">
                                <input id="delivery_cost" type="number" value='' step=".01" min="0" class="form-control"  name="delivery_cost"  required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                            <div class="col-md-6">
                                <textarea name="description" id="description" cols="35" rows="5"></textarea>
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
