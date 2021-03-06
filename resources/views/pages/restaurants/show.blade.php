@extends('layouts.main-layout')

@section('content')
    {{-- <showcart-component
    :dishes = "{{ $restaurant ->dishes }}"
    :restaurant = "{{ $restaurant }}"
    :route="'{{ route('checkouts.index', [""]) }}'">
    ></showcart-component> --}}

    <div id="showCartComponent">
        <div v-if="!showCheckout" class="show-restaurant" >
            <div class="protected-restaurant-show-top-container">
                <div class="restaurant-show-info-container">
                    <div class="description-left">
                        <div class="restaurant-logo-name">
                            <div class="restaurant-logo">
                                <img src="{{asset('storage/images/restaurants/logo/'.$restaurant->logo) }}" alt="">
                            </div>
                            <div class="restaurant-name">
                                <h1>{{ $restaurant -> name }}</h1>
                            </div>
                        </div>

                        <!-- why the score before the "address"? -->
                        <div class="restaurant-address">
                            <strong>Indirizzo:</strong> {{ $restaurant -> address}}
                        </div>

                        <div class="restaurant-email">
                            <strong>E-mail:</strong> {{ $restaurant -> email}}
                        </div>

                        <div class="restaurant-telephone">
                            <strong>Telefono:</strong> {{ $restaurant -> telephone}}
                        </div>

                        <div class="restaurant-description">
                            <strong>Descrizione:</strong> <br>
                            <p>{{ $restaurant -> description}}</p>
                        </div>
                    </div> <!-- description-left -->

                    <div class="description-right">
                        <div class="card-restaurant">
                            <div class="restaurant-img-cover">
                                <img src="{{asset('storage/images/restaurants/cover/'.$restaurant->img_cover) }}" alt="">
                            </div>

                            {{-- <div class="tempo-consegna">
                                <span>CONSEGNA: <br> 30 MIN</span>
                            </div> --}}

                            <div class="delivery-cost">
                                <strong>Costo consegna:</strong> {{ $restaurant -> delivery_cost}} ???
                            </div>

                            <div class="allow-cash">
                                @if ($restaurant -> allow_cash == 1)
                                    <span>
                                        <strong>Accetta Contanti</strong>
                                    </span>
                                @else
                                    <span>
                                        <strong>Non Accetta Contanti</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="delivery-logo">

                                <img src="{{asset('storage/images/header/logo.png')}}" alt="">

                            </div>
                        </div> <!-- card-restaurant -->
                    </div> <!-- description-right -->
                </div> <!-- restaurant-show-info-container -->
            </div> <!-- protected-restaurant-show-top-container -->

            <div class="spacer-type">
                <h1>Men??</h1>
            </div>

            {{-- - - - - - - - - - - - - - - - - - - - TRY TO WORK ON - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}

            <div class="element-container">
                <div class="restaurant-menu-cointainer">

                    <ul class="restaurant-ul-container">
                        @foreach ($types as $type)
                            <li class="menu-type">
                                <span class="type-span">{{ $type }}</span>
                                <div class="dishes-list">
                                    @foreach ($dishes as $dish)
                                        @if ($dish ->type == $type && $dish ->is_visible)
                                            <div class="dish-card my-3">
                                                <div class="dish-card-container" v-on:click="getDish({{ $dish }})">
                                                    <div class="dish-name-price">
                                                        <div class="dish-name">
                                                            <b>{{ $dish -> name }}</b>
                                                        </div>

                                                        <div class="dish-ingr">
                                                            {{ $dish -> ingredients }}
                                                        </div>

                                                        <div class="dish-price">
                                                            {{ $dish -> price }} ???
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    {{-- <div class="dishes-list">
                        @foreach ($dishes as $dish)
                            @if ($dish -> is_visible)
                            <div class="dish-card my-3">
                                <div class="dish-card-container" v-on:click="getDish({{ $dish }})">
                                    <div class="dish-name-price">
                                        <div class="dish-name">
                                            <b>{{ $dish -> name }}</b>
                                        </div>

                                        <div class="dish-ingr">
                                            {{ $dish -> ingredients }}
                                        </div>

                                        <div class="dish-price">
                                            {{ $dish -> price }} ???
                                        </div>
                                    </div>

                                    <div class="dish-img">
                                        <img src="{{ $dish -> img }}" alt="">
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div> --}}

                    <div class="container-cart">
                        <h3> &#128722; Anteprima Carrello</h3>

                        <div class="cart">
                            <div class="cart-list" v-for="dish in dishesArray">

                                <div class="dish-details">
                                    {{-- <div class="cart-dish-img">
                                        <img :src="dish.dish.img" alt="">
                                    </div> --}}

                                    <div class="cart-dish-name">
                                        <b>@{{dish.dish.name}}</b>
                                    </div>
                                </div>

                                <div class="cart-quantity">
                                    <span class="button-cart" v-on:click="removeDish(dish)" >-</span>
                                        <b class="dish-quantity">@{{ dish.quantity }}</b>
                                    <span class="button-cart" v-on:click="addDish(dish)" >+</span>
                                </div>

                            </div>
                        </div>

                        <div class="cart-subtotprice">
                            <div>
                                Subtotale:
                            </div>
                            <div class="totprice">

                                {{-- subtotale --}}

                                @{{ getTotPrice }} ???
                            </div>
                        </div>

                        <div v-if="deliveryCostFixed > 0" class="cart-subtotprice">
                            <div>
                                Spese di consegna:
                            </div>
                            <div class="totprice">
                                <b>@{{ deliveryCostFixed }} ???</b>
                            </div>
                        </div>
                        <div v-else>
                            <p>
                                Consegna gratuita
                            </p>
                        </div>

                        <div class="cart-totprice">
                            <div>
                                <strong>Totale:</strong>
                            </div>
                            <div class="totprice">
                                <b>@{{ getFinalPrice }} ???</b>
                            </div>
                        </div>

                        <div v-if="dishesArray.length > 0" class="checkout-button-cart">
                            <div v-on:click="changeView"><span class="checkout-link"><strong>Checkout carrello</strong></span></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}

        <div v-else class="cart-checkout-container">
            <div class="cart-checkout">

                <div class="nav-conferma">
                    <div class="nav-text">
                        <div class="nav-text-icon">
                            <h3>&#128722;</h3>
                        </div>

                        <div class="nav-text-title">
                            <h3>Carrello</h3>
                        </div>
                    </div>

                    <div class="quadrato">
                        <span  class="x" v-on:click="changeView">&times;</span>
                    </div>
                </div>

                <div class="nav-text-subtitle">
                    <b>Conferma le tue scelte</b>
                </div>

                <div class="cart">
                    <div class="cart-list" v-for="dish in dishesArray">

                        {{-- <div class="cart-list-img">
                             <img :src="dish.dish.img" alt="">
                        </div> --}}

                        <div class="cart-dish-name">
                            <b>@{{ dish.dish.name }}</b>
                        </div>

                        <div class="cart-quantity">
                            <span class="button-cart" v-on:click="removeDish(dish)" >-</span>
                                <b class="dish-quantity">@{{ dish.quantity }}</b>
                            <span class="button-cart" v-on:click="addDish(dish)" >+</span>
                        </div>

                    </div>
                </div> <!-- cart -->

                <div class="cart-subtotprice">
                    <div>
                        <strong>Subtotale:</strong>
                    </div>
                    <div class="">
                        <b>@{{ getTotPrice }} ???</b>
                    </div>
                </div>
                <div class="cart-subtotprice">
                    <div>
                        <strong>Costo consegna:</strong>
                    </div>
                    <div>
                        <b>@{{ deliveryCostFixed }} ???</b>
                    </div>
                </div>
                <div class="cart-totprice">
                    <div class="totalspace">
                        <strong>Totale:</strong>
                    </div>
                    <div class="totprice">
                        <strong>@{{ getFinalPrice }} ???</strong>
                    </div>
                </div>

                <div v-if="dishesArray.length > 0" class="payment-link">

                    <form action="{{ route('checkouts.session') }}" method="POST">
                        @csrf
                        @method('POST')
                        <input id="ids" name="ids" :value="stringifiedDishesIds" type="text">
                        <input id="r_id" name="r_id" value="{{ $restaurant -> id }}" type="text">
                        <button v-on:click="setLocalStorage" type="submit">
                            Vai al pagamento
                        </button>
                    </form>
                </div>

            </div>
        </div>  <!-- cart-checkout-container -->
    </div> <!-- single root component -->

    <script>
        new Vue({
            el: '#showCartComponent',

            data: function() {
                return {
                    dishesArray: [],
                    showCheckout: false,
                    dishesIds: [],
                    deliveryCost: {{$restaurant -> delivery_cost}},
                }
            },

            mounted() {

            },

            methods: {
                getDish: function(dish) {

                    if (this.dishesArray.length == 0) {

                        this.dishesArray.push({'dish': dish, 'quantity': 1});
                        console.log(this.dishesArray);
                    }else{
                        let check = false;


                        for (let i=0; i < this.dishesArray.length; i++){

                            if (this.dishesArray[i].dish.name == dish.name) {
                                this.dishesArray[i].quantity += 1
                                check = true;
                            }
                        }

                        if (check == false){
                            this.dishesArray.push({'dish': dish, 'quantity': 1});
                        }
                    }
                },

                addDish: function(dish) {
                    dish.quantity ++
                },

                removeDish: function(dish) {

                    if (dish.quantity > 1){
                        dish.quantity --
                    }else{

                        for (let i=0; i<this.dishesArray.length; i++){
                            if (this.dishesArray[i].dish.name == dish.dish.name) {
                                this.dishesArray = this.dishesArray.filter(function(value, index, arr){ 
                                    return value.dish.name != dish.dish.name;
                                });
                                console.log(this.dishesIds);
                            }
                        }
                    }
                },

                changeView: function() {
                    this.showCheckout = !this.showCheckout;
                },

                setLocalStorage: function() {
                    this.dishesIds = [];
                    this.dishesArray.forEach(element => {
                        let i = 0;
                        while (i < element.quantity) {
                            this.dishesIds.push(element.dish.id)
                            i++
                        }
                    });

                    localStorage.setItem('totSessionPrice', this.getFinalPrice);
                },
            },

            computed: {
                getTotPrice: function() {
                    let sum = 0;
                    for (let i=0; i<this.dishesArray.length; i++){
                        sum += (this.dishesArray[i].dish.price * this.dishesArray[i].quantity);
                    }

                    return sum.toFixed(2);
                },

                deliveryCostFixed: function() {
                    return this.deliveryCost.toFixed(2);
                },

                getFinalPrice: function() {
                    let deliveryCostParse = parseFloat(this.deliveryCost);
                    let subTotal          = parseFloat(this.getTotPrice);
                    let finalPrice = deliveryCostParse + subTotal;

                    return finalPrice.toFixed(2);
                },

                stringifiedDishesIds ()??{
                    return JSON.stringify(this.dishesIds);
                },

                fullRoute () {
                    return this.route + '/' + JSON.stringify(this.dishesIds);
                },
            },
        });
    </script>
@endsection
