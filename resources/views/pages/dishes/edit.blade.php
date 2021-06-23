@extends('layouts.dashboard-layout')

@section('sidebar-content')
    <div>
        <a href="{{ route('restaurants.protectedShow', Auth::user() -> id) }}">
            Torna alla tua dashboard
        </a>
    </div>
@endsection

@section('main-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Modifica piatto</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('dishes.update', $dish) }}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                                <div class="col-md-6">
                                    <input id="name" name="name" type="text" class="form-control" autofocus value="{{ $dish -> name }}" maxlength="255"  required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ingredients" class="col-md-4 col-form-label text-md-right">Ingredients</label>

                                <div class="col-md-6">
                                    <textarea id="ingredients" name="ingredients" type="text" class="form-control" maxlength="255" required>{{ $dish -> ingredients }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="price" class="col-md-4 col-form-label text-md-right">Price</label>

                                <div class="col-md-6">
                                    <input id="price" name="price" type="number" class="form-control" value="{{ $dish -> price}}" step=".10" min="0" max="999999" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="type" class="col-md-4 col-form-label text-md-right">Type</label>

                                <div class="col-md-6">
                                    <select name="type" id="type">
                                        <option value="antipasto"
                                            @if ({{ $dish -> type === 'antipasto' }})
                                                selected
                                            @endif
                                        >Antipasto</option>
                                        <option value="primo"
                                            @if ({{ $dish -> type === 'primo' }})
                                                selected
                                            @endif
                                        >Primo</option>
                                        <option value="secondo"
                                            @if ({{ $dish -> type === 'secondo' }})
                                                selected
                                            @endif
                                        >Secondo</option>
                                        <option value="dolci"
                                            @if ({{ $dish -> type === 'dolci' }})
                                                selected
                                            @endif
                                        >Dolci</option>
                                    </select>
                                    {{-- <input type="text" class="form-control" value="{{ $dish -> type }}" required> --}}
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="img" class="col-md-4 col-form-label text-md-right">Img</label>

                                <div class="col-md-6">
                                    <input id="img" type="file" class="form-control-file"  name="img" accept=".png, .jpg, .jpeg">
                                    <img src="/storage/images/dishes/{{ $dish -> img }}" alt="" style="width:100px;">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="form-check" class="col-md-4 col-form-label text-md-right"></label>

                                <div class="form-check my-2 mx-5">
                                    <input class="form-check-input" type="radio" name="is_visible" id="is_visible" value="1" {{ $dish -> is_visible == 1 ? 'checked' : ''}}>
                                    <label class="form-check-label">
                                    Yes
                                    </label>
                                </div>
                                <div class="form-check my-2">
                                    <input class="form-check-input" type="radio" name="is_visible" id="is_visible" value="0" {{ $dish -> is_visible == 0 ? 'checked' : ''}}>
                                    <label class="form-check-label">
                                    No
                                    </label>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Edit
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