<template>
    <div>

        <div class="spacer-type">

            <div class="type-list">

                <ul>

                    <li v-for="type in items" :key="index">

                    </li>
                    


                </ul>

            </div>

        </div>
            <div class="restaurant-menu-cointainer">

                <div class="dishes-list">

                    <div class="dish-card">

                        <div class="dish-card-container">

                            <div class="dish-name-price">

                                <div class="dish-name">

                                    dish name

                                </div>

                                <div class="dish-price">

                                    dish price

                                </div>

                            </div>
                            <div class="dish-img">

                                image
                                <!-- <img src="" alt=""> -->

                            </div>

                        </div>

                    </div>

                </div>

                <div class="container-cart">

                    <div class="buttoncart">

                        <a href="">Vai alla cassa</a>

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
        height: 100px;
        width: 30%;
        background: white;
        box-shadow: 5px 10px 18px #888888;
        /* position: fixed; */
        display: flex;
        justify-content: center;

       
    }



</style>

<script>
    export default {
    //     props:{

    //         selectedRestaurantDishes: Array


    //     },

    //     data:{
    //         selectedRestaurantDishes: [],

    //     },

    //     methods: {
    //         getRestDish: function(){
    //             axios.get('')
    //         }
    //     },


    //   mounted() {
    //         console.log('Component mounted.')
    //     }

    }

</script>
