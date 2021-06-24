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

                        <b>Indirizzo:</b> {{$restaurant->address}}

                    </div>

                    <div class="restaurant-email">

                        <b>E-mail:</b> {{$restaurant->email}}

                    </div>

                    <div class="restaurant-telephone">

                        <b>Telefono:</b> {{$restaurant ->telephone}}

                    </div>

                    <div class="restaurant-description">

                        <b>Descrizione:</b> <br>
                        <p>{{$restaurant-> description}}</p>

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

                            <b>Costo consegna:</b> {{$restaurant->delivery_cost}} €

                        </div>
                        <div class="allow-cash">

                            <span>

                                @if ($restaurant->allow_cash == 1)

                                    <b>Accetta Contanti</b>

                                @else

                                    <b>Non Accetta Contanti</b>

                                @endif

                            </span>

                        </div>

                    </div>



                </div>

            </div>



    </div>
    <showcart-component>

    </showcart-component>
@endsection
