<template>

    <div>

        <!-- RESTAURANT INFO -->
        <section v-if="!showCheckout" class="showRestaurant" >
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
                                Consegna in <br> 30 minuti
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
                <h1>I nostri piatti</h1>
            </div>

            <!-- why this div? -->
            <div>
                <div class="restaurant-menu-cointainer">
                    <div class="dishes-list">
                        <div v-for="dish in dishes" class="dish-card my-3" @click="getDish(dish)">

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
                        <h3>Anteprima Carrello</h3>

                        <div class="cart">
                            <div class="cart-list" v-for="dish in dishesArray">

                                <div class="cart-quantity">
                                    <span class="minus-cart" @click="removeDish(dish)" >-</span>
                                        <b>{{ dish.quantity }}</b>
                                    <span class="add-cart" @click="addDish(dish)" >+</span>
                                </div>

                                <div class="cart-dish-name">
                                    <b>{{ dish.dish.name }}</b>
                                </div>
                                
                            </div>
                        </div>

                        <div class="cart-totprice">
                            <!-- Div with no class? -->
                            <div>
                                <strong>Totale:</strong>
                            </div>

                            <div class="totprice">
                                <b>{{ getTotPrice }} €</b>
                            </div>
                        </div>

                        <div v-if="dishesArray.length > 0" class="buttoncart">
                            <div class="checkoutLink" @click="changeView">Checkout carrello</div>
                        </div>
                    </div> <!-- container-cart -->

                </div> <!-- restaurant-menu-cointainer -->
            </div> <!-- why this div? -->
        </section> <!-- showRestaurant -->

        <!-- - - - - - - - - - - - - - - - - - - - - - -->

        <section v-else class="cartCheckout">

            <!-- why this div? -->
            <div class="">
                <div @click="changeView">
                    X
                </div>

                <!-- why this div? No class with inside a block element-->
                <div>
                    <h3>Conferme le tue scelte</h3>
                </div>

                <div class="cart">
                    <div class="cart-list" v-for="dish in dishesArray">

                        <div class="cart-quantity">
                            <span class="minus-cart" @click="removeDish(dish)" >-</span>
                                <strong>{{ dish.quantity }}</strong>
                            <span class="add-cart" @click="addDish(dish)" >+</span>
                        </div>

                        <div class="cart-dish-name">
                            <strong>{{ dish.dish.name }}</strong>
                        </div>

                    </div>
                </div> <!-- cart -->

                <div class="cart-totprice">
                    <!-- div with no class? -->
                    <div>
                        <strong>Totale:</strong>
                    </div>

                    <div class="totprice">
                        <strong>{{ getTotPrice }} €</strong>
                    </div>
                </div>

                <div v-if="dishesArray.length > 0" class="buttoncart">
                    <a :href="route" class="checkoutLink" @click="changeView">Vai al Pagamento</a>
                </div>
            </div> <!-- why this div? -->
        </section> <!-- cartCheckout -->
    </div>

</template>

<style scoped>

    .spacer-type{

        height: 100px;
        width: 100%;
        margin: auto;
        border-bottom: 1px solid grey;
        display: flex;
        align-items: center;
        justify-content: center;

    }

    .type-list{

        height: 100%;
        width: 80%;
        padding: 35px;
        margin: auto;
        display: flex;
        align-items: center;


    }

    .type-list-item{

        /* border: 1px solid red; */
        padding-left: 30px;
    }


    .restaurant-menu-cointainer{

        min-height: 500px;
        width: 75%;
        margin: auto;
        background-color: #F4F5F5;
        display: flex;
        justify-content: space-between;
        position: relative;

    }

    .dishes-list{

        width: 50%;
        padding: 30px;
        display: flex;
        flex-wrap: wrap;
        margin-top: 20px;
    }

    .dish-card{

        height: 150px;
        width: 300px;
        transition: box-shadow 0.2s ease-in-out;
        margin-right: 20px;
        cursor: pointer;
        background-color: white;
        border-radius: 5px;
    }

    .dish-card:hover{

        box-shadow: 5px 10px 18px #888888;
    }

    .dish-card-container{

        height: 100%;
        padding: 10px;
        display: flex;
    }

    .dish-name-price{

        display: flex;
        flex-direction: column;
        height: 100%;
        width: 70%;
        /* border: 1px solid black; */
    }

    .dish-name, .dish-price, .dish-ingr{


        display: flex;
        align-items: center;

    }

    .dish-name, .dish-price{

        min-height: 25%;
    }

    .dish-ingr{

        min-height: 50%

    }


    .dish-img{

        width: 30%;
        height: 80px;
        border: 1px solid black;
        margin: auto;
    }

    .dish-img img{

        width: 100%;
        height: 100%;
        object-position: center;

    }

    .container-cart{
        margin-top: 55px;
        height: 50%;
        width: 30%;
        background: white;
        box-shadow: 5px 10px 18px #888888;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 15px 0;

    }

    .cart{

        width: 80%;

    }

    .cart-list{

        width: 100%;
        display: flex;
        padding-top: 15px;
        justify-content: space-between;
    }

    .cart-quantity b{

        margin: 0 10px;
    }

    .cart-dish-name{

        display: flex;
        text-align: center;
        align-items: center;
    }

    .container-cart span{
        cursor: pointer;
        padding: 0 10px;
        font-size: 24px;
    }

    .minus-cart{

        background-color: red;
        border-radius: 50%;
    }

    .add-cart{

        background-color: green;
        border-radius: 50%;
        margin-right:15px;
    }

    .cart-totprice{

        width: 80%;
        margin-top: 20px;
        display: flex;
        justify-content: space-between;

    }

    .cartCheckout{
        position: absolute;
        width: 100%;
        height: 100vh;
        background: white;
        box-shadow: 5px 10px 18px #888888;
    }

    .checkoutLink{
        color: blue;
        font-weight: 600;
        cursor: pointer;
    }


</style>

<script>
    export default {
        props:{
            dishes: Array,
            restaurant: Object,
            route: String
        },
        data: function() {
            return {
                dishesArray: [],
                showCheckout: false,
            }
        },
        mounted() {
            console.log(this.dishes);
        },
        methods: {
            getDish: function(dish) {


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
                console.log(dish);
            },
            removeDish: function(dish) {
                if (dish.quantity > 1){
                    dish.quantity --
                }else{
                    this.dishesArray.pop(dish);
                }
            },
            changeView: function() {
                this.showCheckout = !this.showCheckout;
            }
        },
        computed: {
            getTotPrice: function() {
                let sum = 0;
                for (let i=0; i<this.dishesArray.length; i++){
                    sum += (this.dishesArray[i].dish.price * this.dishesArray[i].quantity);
                }

                return sum.toFixed(2);
            },
        }
    }

</script>
