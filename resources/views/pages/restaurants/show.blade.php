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

                        --restaurant-address--

                    </div>

                    <div class="restaurant-email">

                        --restaurant-email--

                    </div>

                    <div class="restaurant-telephone">

                        --restaurant-telephone--

                    </div>

                    <div class="restaurant-description">

                        <p>--restaurant--description</p>

                    </div>


                </div>
                <div class="description-right">

                    <div class="card-restaurant">

                        <div class="restaurant-img-cover">

                            <img src="{{ $restaurant ->img_cover }}" alt="">

                        </div>
                    <div class="tempo-consegna">

                            Consegna in 30 minuti

                    </div>
                    <div class="delivery-cost">

                            --delivery-cost--

                    </div>
                    <div class="allow-cash">

                            --allowcash--

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
