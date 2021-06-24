@extends('layouts.main-layout')

@section('content')

    <div class="protected-restaurant-show-top-container">

            <div class="restaurant-show-info-container">

                <div class="description-left">

                    <div class="restaurant-logo-name">

                        <div class="restaurant-logo">

                            <img src="{{ $restaurant ->logo }}" alt="">


                        </div>
                        <div class="restaurant-name">

                            <h1>{{ $restaurant ->name }}</h1>

                        </div>



                    </div>

                    <div class="restaurant-address">

<<<<<<< Updated upstream
                        <b>Indirizzo:</b> {{$restaurant->address}}
=======
                        <b>Indirizzo:</b> {{$restaurant ->address}}
>>>>>>> Stashed changes

                    </div>

                    <div class="restaurant-email">

<<<<<<< Updated upstream
                        <b>E-mail:</b> {{$restaurant->email}}
=======
                        <b>E-mail:</b> {{$restaurant ->email}}
>>>>>>> Stashed changes

                    </div>

                    <div class="restaurant-telephone">

                        <b>Telefono:</b> {{$restaurant ->telephone}}

                    </div>

                    <div class="restaurant-description">

                        <b>Descrizione:</b> <br>
                        <p>{{$restaurant ->description}}</p>

                    </div>


                </div>
                <div class="description-right">

                    <div class="card-restaurant">

                        <div class="restaurant-img-cover">

                            <img src="{{ $restaurant ->img_cover }}" alt="">

                        </div>
                        <div class="tempo-consegna">

                            Consegna in <br>   30 minuti

                        </div>
                        <div class="delivery-cost">

<<<<<<< Updated upstream
                            <b>Costo consegna:</b> {{$restaurant->delivery_cost}} €
=======
                            <b>Costo consegna:</b> {{$restaurant ->delivery_cost}} €
>>>>>>> Stashed changes

                        </div>
                        <div class="allow-cash">

                            <span>

                                @if ($restaurant->allow_cash == 1)

<<<<<<< Updated upstream
                                    <b>Accetta Contanti</b>

                                @else
=======
                            <input type="radio" class="input-radio-margin" id="sceltaSi" name="" value=""
                            @if ($restaurant ->allow_cash == 1)

                                checked

                            @endif>
                            <label for="sceltaSi"><b>Sì</b></label>

                            <br>

                            <input type="radio" id="sceltaNo" name="" value=""
                            @if ($restaurant ->allow_cash == 0)

                                checked

                            @endif>
                            <label for="sceltaNo"><b>No</b></label>
>>>>>>> Stashed changes

                                    <b>Non Accetta Contanti</b>

                                @endif

                            </span>

                        </div>

                    </div>



                </div>

            </div>

        </div>
        <div class="categories-spacer">

            --categories?--

        </div>

        <div class="dishes-container">

            @foreach ($restaurant ->dishes as $dish)
                {{ $dish ->name }}
            @endforeach

        </div>




@endsection
