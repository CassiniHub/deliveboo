<template>

    <div>

        <div class="spacer-type">

            <div class="type-list">

                <ul>

                </ul>

            </div>

            </div>
                <div class="restaurant-menu-cointainer">

                    <div class="dishes-list">

                        <div v-for="dish in dishes" class="dish-card my-3" @click="getDish(dish)">

                            <div class="dish-card-container">

                                <div class="dish-name-price">

                                    <div class="dish-name">

                                        {{ dish.name }}

                                    </div>

                                    <div class="dish-price">

                                        {{ dish.price }}

                                    </div>

                                </div>
                                <div class="dish-img">

                                    image
                                    <img :src="dish.img" alt="">

                                </div>

                            </div>

                            <!-- !!!!! AGGIUNGERE INGREDIENTI -->

                        </div>
                    </div>

                    <div class="container-cart">
                        <ul>
                            <li v-for="dish in dishesArray">
                                {{ dish.dish.name }} - {{ dish.quantity }} <span @click="removeDish(dish)" >-</span> <span @click="addDish(dish)" >+</span>
                            </li>
                        </ul>
                        <div>
                            tot price: {{ getTotPrice }}
                        </div>
                        <div class="buttoncart">

                            <a href="">Checkout carrello</a>

                        </div>             
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<style scoped>

    .spacer-type{

        height: 80px;
        width: 100%;
        border-bottom: 1px solid grey;
    }

    .type-list{

        height: 100%;
        width: 80%;
        padding: 35px;
        margin: auto;
        display: flex;
        align-items: center;


    }

    .type-list ul{

        display: flex;
        list-style: none;
        height: 100%;


    }

    .type-list ul li{

        padding-right: 25px;
        opacity: 1;
        color: purple;


    }

    .type-list ul li:hover{

        opacity: 0.5;
    }

    /* .type-list ul li:focus{

        background: yellow;

    } */

    .restaurant-menu-cointainer{

        min-height: 500px;
        width: 70%;
        margin: auto;
        background-color: white;
        display: flex;
        justify-content: space-between;
        position: relative;

    }

    .dishes-list{

        width: 50%;
        padding: 35px;
        border: 2px solid red;
        display: flex;
        flex-wrap: wrap;
    }

    .dish-card{

        height: 130px;
        width: 300px;
        background-color: red;
        transition: box-shadow 0.2s ease-in-out;
        cursor: pointer;
    }

    .dish-card:hover{

        box-shadow: 5px 10px 18px #888888;
    }

    .dish-card-container{

        height: 100%;
        padding: 10px;
        border: 1px solid black;
        display: flex;
    }

    .dish-name-price{

        display: flex;
        flex-direction: column;
        height: 100%;
        width: 70%;
        /* border: 1px solid black; */
    }

    .dish-name, .dish-price{

        height: 50%;
        display: flex;
        align-items: center;
        border: 1px solid black;
    }

    .dish-img{

        width: 30%;
        height: 100px;
        border: 1px solid black;
    }

    .dish-img img{

        width: 100%;
        height: 100%;
    }

    .container-cart{
        width: 30%;
        background: white;
        box-shadow: 5px 10px 18px #888888;
        /* position: fixed; */
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 15px 0;

    }
    .container-cart span{
        cursor: pointer;
        padding: 0 10px;
        font-size: 24px;
    }



</style>

<script>
    export default {
        props:{
            dishes: Array,
        },
        data: function() {
            return {
                dishesArray: [],
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
            }
        },
        computed: {
            getTotPrice: function() {
                let sum = 0;
                for (let i=0; i<this.dishesArray.length; i++){
                    sum += (this.dishesArray[i].dish.price * this.dishesArray[i].quantity);
                }
                
                return sum;
            }
        }
    }

</script>
