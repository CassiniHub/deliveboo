<template>

    <div>
        <div v-if="!showCheckout" class="show-restaurant" >
            <div class="protected-restaurant-show-top-container">
                <div class="restaurant-show-info-container">
                    <div class="description-left">
                        <div class="restaurant-logo-name">
                            <div class="restaurant-logo">
                                <img :src="restaurant.logo" alt="">
                            </div>
                            <div class="restaurant-name">
                                <h1>{{ restaurant.name }}</h1>
                            </div>
                        </div>

                        <!-- why the score before the "address"? -->
                        <div class="-address">
                            <strong>Indirizzo:</strong> {{restaurant.address}}
                        </div>

                        <div class="restaurant-email">
                            <strong>E-mail:</strong> {{restaurant.email}}
                        </div>

                        <div class="restaurant-telephone">
                            <strong>Telefono:</strong> {{restaurant.telephone}}
                        </div>

                        <div class="restaurant-description">
                            <strong>Descrizione:</strong> <br>
                            <p>{{restaurant.description}}</p>
                        </div>
                    </div> <!-- description-left -->

                    <div class="description-right">
                        <div class="card-restaurant">
                            <div class="restaurant-img-cover">
                                <img :src="restaurant.img_cover" alt="">
                            </div>

                            <div class="tempo-consegna">
                                Consegna <br>
                                in <br> 
                                30 minuti
                            </div>

                            <div class="delivery-cost">
                                <strong>Costo consegna:</strong> {{restaurant.delivery_cost}} €
                            </div>

                            <div class="allow-cash">
                                <span v-if="restaurant.allow_cash == 1">
                                   <strong>Accetta Contanti</strong>
                                </span>
                                <span v-else>
                                    <strong>Non Accetta Contanti</strong>
                                </span>
                            </div>
                        </div> <!-- card-restaurant -->
                    </div> <!-- description-right -->
                </div> <!-- restaurant-show-info-container -->
            </div> <!-- protected-restaurant-show-top-container -->

            <div class="spacer-type">
                <h1>Menù</h1>
            </div>

            <div class="element-container">
                <div class="restaurant-menu-cointainer">
                    <div class="dishes-list">
                        <div v-if="dish.is_visible" v-for="dish in dishes" class="dish-card my-3" @click="getDish(dish)">

                            <div class="dish-card-container">
                                <div class="dish-name-price">
                                    <div class="dish-name">
                                        <b>{{ dish.name }}</b>
                                    </div>

                                    <div class="dish-ingr">
                                        {{ dish.ingredients }}
                                    </div>

                                    <div class="dish-price">
                                        {{ dish.price }} €
                                    </div>
                                </div>

                                <div class="dish-img">
                                    <img :src="dish.img" alt="">
                                </div>
                            </div>

                        </div> <!-- dish-card -->
                    </div>

                    <div class="container-cart">
                        <div class="container-cart-title">
                            <span>Anteprima Carrello</span>
                        </div>

                        <div class="cart">
                            <div class="cart-list" v-for="dish in dishesArray">

                                <div class="dish-details">
                                    <div class="cart-dish-img">
                                        <img :src="dish.dish.img" alt="">
                                    </div>

                                    <div class="cart-dish-name">
                                        <b>{{ dish.dish.name }}</b>
                                    </div>
                                </div>

                                <div class="cart-quantity">
                                    <span class="button-cart" @click="removeDish(dish)" >-</span>
                                        <b class="dish-quantity">{{ dish.quantity }}</b>
                                    <span class="button-cart" @click="addDish(dish)" >+</span>
                                </div>

                            </div>
                        </div>

                        <div class="cart-totprice">
                            <div class="total-string">
                                <strong>Totale:</strong>
                            </div>

                            <div class="totprice">
                                <b>{{ getTotPrice }} €</b>
                            </div>
                        </div>

                        <div v-if="dishesArray.length > 0" class="checkout-button-cart">
                            <div class="checkout-link" @click="changeView">
                                <span>Checkout carrello</span> 
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

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
                        <span  class="x" @click="changeView">&times;</span>
                    </div>
                </div>

                <div class="nav-text-subtitle">
                    <b>Conferma le tue scelte</b>
                </div>

                <div class="cart">
                    <div class="cart-list" v-for="dish in dishesArray">

                        <div class="cart-list-img">
                             <img :src="dish.dish.img" alt="">
                        </div>

                        <div class="cart-dish-name">
                            <b>{{ dish.dish.name }}</b>
                        </div>

                        <div class="cart-quantity">
                            <span class="button-cart" @click="removeDish(dish)" >-</span>
                                <b class="dish-quantity">{{ dish.quantity }}</b>
                            <span class="button-cart" @click="addDish(dish)" >+</span>
                        </div>

                    </div>
                </div> <!-- cart -->

                <div class="checkout-cart-totprice">
                    <div>
                        <b>Totale:</b>
                    </div>

                    <div class="checkout-totprice">
                        <b>{{ getTotPrice }} €</b>
                    </div>
                </div>

                <form action="stringifiedActionForm" method="POST">
                    <input type="hidden" name="_token" :value="csrf">
                    <input type="text" name="ids" :value="stringifiedDishesIds">
                    <button type="submit">
                        Procedi al pagamento
                    </button>
                </form>

                <div class="payment-link">

                    <a :href="fullRoute">Vai al Pagamento</a>

                </div>

            </div>
        </div>  <!-- cart-checkout-container -->
    </div> <!-- single root component -->
</template>

<script>
    export default {
        props:{
            dishes: Array,
            restaurant: Object,
            route: String,

        },
        data: function() {
            return {
                dishesArray: [],
                showCheckout: false,
                dishesIds: [],
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        },
        mounted() {
            console.log(this.csrf);
        },
        methods: {
            getDish: function(dish) {

                this.dishesIds.push(dish.id);

                sessionStorage.setItem('dishesIds', this.dishesIds);

                if (this.dishesArray.length == 0) {

                    this.dishesArray.push({'dish': dish, 'quantity': 1});
                }else{
                    let check = false;

                    for (let i=0; i<this.dishesArray.length; i++){
                        if (this.dishesArray[i].dish == dish) {
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
                this.dishesIds.push(dish.dish.id);
                console.log(this.dishesIds);

            },

            removeDish: function(dish) {
                this.dishesIds.pop(dish.dish.id);
                console.log(this.dishesIds);

                if (dish.quantity > 1){
                    dish.quantity --
                }else{
                    this.dishesArray.pop(dish);
                }
            },

            changeView: function() {
                this.showCheckout = !this.showCheckout;
            },

            sendDishesIds: function() {
                let ids =JSON.stringify(this.dishesIds);
                console.log(ids);
                axios.post('/checkouts/data/' + ids)
                    .then(res => {
                        console.log(res);
                    })
                    .catch(err => {
                        console.log(err);
                    });
                // console.log('working');
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

            fullRoute () {
                return this.route + '/' + JSON.stringify(this.dishesIds);
            },

            stringifiedDishesIds () {
                return JSON.stringify(this.dishesIds);
            },

            stringifiedActionForm () {
                return "/checkouts/" + JSON.stringify(this.dishesIds);
            }
        }
    }

</script>
