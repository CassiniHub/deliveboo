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
                        <h3>Anteprima Carrello</h3>

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
                            <!-- Div with no class? -->
                            <div>
                                <strong>Totale:</strong>
                            </div>

                            <div class="totprice">
                                <b>{{ getTotPrice }} €</b>
                            </div>
                        </div>

                        <div v-if="dishesArray.length > 0" class="button-cart">
                            <div @click="changeView"><span class="checkout-link">Checkout carrello</span></div>
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
                    <h5>Conferma le tue scelte</h5>
                </div>

                <div class="cart">
                    <div class="cart-list" v-for="dish in dishesArray">

                        
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
                
                <a :href="fulLRoute" class="payment-link">Vai al Pagamento</a>
            
            </div>
        </div>  <!-- cart-checkout-container -->
    </div> <!-- single root component -->
</template>

<style scoped>

    .spacer-type{
        background-color: white;
        height: 100px;
        width: 80%;
        margin: auto;
        border-bottom: 1px solid grey;
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgb(2, 150, 241);

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

    .element-container{
        background-color: lightskyblue;
    }

    .restaurant-menu-cointainer{

        min-height: 500px;
        width: 80%;
        margin: auto;
        background-color: rgb(2, 150, 241);
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
        border-radius: 5px;

    }

    .cart{

        width: 80%;
        margin: auto;

    }

    .cart-list{
        width: 100%;
        padding-top: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .cart-quantity b{
        margin: 0 10px;
    }

    .dish-details{
        width: 150px;
        border: 1px solid black;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        flex-direction: column;
    }

    .cart-dish-img{
        width: 50%;
        height: 80px;
        border: 1px solid black;
        margin: auto;
        display: flex;
        justify-content: flex-end;
    }
    
    .cart-dish-img img{

        width: 100%;
        height: 100%;
        object-position: center;

    }

    .cart-dish-name{
        display: flex;
        justify-content: flex-end;
    }

    .button-cart{
        cursor: pointer;
        background-color: rgb(2, 150, 241);
        color: white;
        padding: 0 20px;
        border-radius: 5px;
        box-shadow: 2px 5px 5px #888888;
        font-size: 25px;
        font-weight: 600;
    }

    .dish-quantity{
        font-size: 25px;
    }

    .cart-totprice{

        width: 80%;
        display: flex;
        margin: 20px 0;
        justify-content: flex-end;
        font-size: 25px;
        font-weight: 600;

    }

    .totprice{
        margin-left: 20px;
    }

    

    .cart-checkout-container{
        position: absolute;
        width: 100%;
        height: 100vh;
        background: rgb(99 168 195);
        box-shadow: 5px 10px 18px #888888;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .cart-checkout{
        width: 80%;
        margin: auto;
        background-color: white;
        border-radius: 10px;
    }


    .nav-conferma{
        width: 100%;
        background-color: black;
        color: white;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-radius: 10px 10px 0 0;
    }

    .nav-text{
        width: 20%;
        margin: 0px 15px;
        display: flex;
        align-items: center;

    }

    .nav-text-subtitle{
        width: 80%;
        margin: 30px auto;
    }

    .nav-text-subtitle h5{
        font-weight: 600;
    }

    .quadrato{
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }

    .x{
        color: white;
        padding: 0 20px;
        cursor: pointer;
        font-size: 20px;
        font-weight: 600;
        margin-right: 10px;
        transition: all 1s ease 0s;
    }

    .x:hover{
        background-color: red;
    }

    .checkout-cart-totprice{

        width: 100%;
        display: flex;
        margin: 20px 0;
        justify-content: flex-end;
        font-size: 25px;
        font-weight: 600;

    }

    .checkout-totprice{
        margin-left: 20px;
    }

    .payment-link{
        width: 100%;
        padding: 5px;
        border-radius: 5px;
        color: white;
        font-weight: 600;
        cursor: pointer;
        background-color: rgb(2, 150, 241);
        padding: 0 20px;
        box-shadow: 2px 5px 5px #888888;
        font-size: 25px;
        text-align: center;
        margin: 30px 0px 30px 0px;
    }

</style>

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
