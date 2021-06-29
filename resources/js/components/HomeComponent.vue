<template>
<div>

    <div id="jumbotron">

        <div class="container-jumbotron">


            <div v-for ="i in [sliderIndex]" class="slider-jumbotron">

                <div class="prev" @click="prev">
                  <i class="fas fa-angle-left"></i>
                </div>

                <img :src="currentImg" alt="">

                <div class="next" @click = "next">
                  <i class="fas fa-angle-right"></i>
                </div>

                <div class="searchbar-container">
                <label for="searchbar">Dimmi... cosa desideri?</label>
                <input
                    v-model="search"
                    type="text" name="searchbar" placeholder="Inserisci qui la categoria">
            </div>

            <div class="search-dropdown shadow-sm">
                <ul v-if="search">
                    <li v-for="category in filteredCategories"
                        @click="getCategoryId(category)"
                        >
                        {{ category.name }}
                    </li>
                    <li class="not-found" v-if="filteredCategories.length == 0">
                        Tipologia non trovata
                    </li>
                </ul>
            </div>

            </div>

        </div>
    </div>

    <div class="spacer-precarousel">

       Scegli tra le catagorie più richieste

    </div>

    <div class="main-carousel">
        <div class="section-carousel">
            <div v-for="category in carouselCategories" class="categories" :class="selectedIds.includes(category.id) ? 'active' : ''">
                <img :src="`storage/images/categories/${category.img_cover}`">
                <div @click="getCategoryId(category)" class="carousel-layover">

                    <span class="carousel-string"><b>{{category.name}}</b></span>

                </div>
            </div>
        </div>
    </div>

    <div v-if="showedRestaurants && showedRestaurants.length > 0" class="restaurants-container">
        <div v-for="restaurant in showedRestaurants" class="restaurant-card shadow-sm">
            <a @click="getRouteId(restaurant)" :href="fullRoute">

                <div class="image-cover">

                    <img :src="restaurant.img_cover" alt="">

                </div>
                <div class="name">
                    <h3>
                        {{ restaurant.name }}
                    </h3>
                </div>

                <div class="categories-type-list">

                    <div v-for="category in restaurant.categories">
                           <b> {{ category.name }} </b>
                    </div>

                </div>
            </a>
        </div>
    </div>

    <div v-else class="no-restaurants">
        <h3>
            Nessun ristorante corrispondente
        </h3>
    </div>

</div>
</template>

<script>
    export default {
        props: {
            categories: Array,
            route: String,
            restaurants: Array
        },
        data: function() {

            //
            return {

                carouselCategories: this.categories,
                selectedIds: [],
                search: '',
                isActive: false,
                routeParam: null,
                showedRestaurants: this.restaurants,
                images:[

                    "storage/images/categories/barca-sushi.jpg",
                    "storage/images/categories/dunkindonuts.jpg",
                    "storage/images/categories/grom.png",
                    "storage/images/categories/hamburger-patate.jpg",
                    "storage/images/categories/healthy.jpeg",
                    "storage/images/categories/italiano.jpeg",
                    "storage/images/categories/kebab.jpeg",
                    "storage/images/categories/pizza.jpeg",
                    "storage/images/categories/poke.jpg",
                    "storage/images/categories/roadhouse.jpg",
                    "storage/images/categories/sandwich.jpeg"

                ],
                sliderTimer: null,
                sliderIndex: 0,
            }
        },
        mounted() {

            console.log(this.restaurants);
            this.startSlide();
        },
        methods: {

            startSlide: function(){

                this.sliderTimer = setInterval(this.next,5000)

            },
            next: function(){

                this.sliderIndex += 1
            },
            prev: function(){

                this.sliderIndex -= 1
            },

            // Get the clicked carousel category ids and push them into an array
            // to make an API call which gives back restaurants of the selected categories
            // @param {object} category [clicked carousel category]

            getCategoryId: function(category) {
                // REVIEW]
                // Not sure of the visual effect given by this line of code
                this.restaurants = this.restaurants;

                // If the category's id is not in the array yet, push it
                if (!this.selectedIds.includes(category.id)) {

                    this.selectedIds.push(category.id);
                } else {

                    // if it is in the array, find the position and remove from the array
                    for( var i = 0; i < this.selectedIds.length; i++){

                        if (this.selectedIds[i] === category.id) {

                            this.selectedIds.splice(i, 1);
                        }
                    }
                }

                // console.log(this.selectedIds);
                // Make the search bar empty
                this.search = '';

                // Make API call only if the array has at least 1 element
                if (this.selectedIds.length > 0) {

                    let ids =JSON.stringify(this.selectedIds);

                    axios.get('/api/filter/category/' + ids)
                        .then(res => {
                            this.showedRestaurants = res.data;
                        })
                        .catch(err => console.log(err));
                } else {

                    this.showedRestaurants = null;
                }

                console.log(this.showedRestaurants);
            },
            getRouteId: function(restaurant) {
                this.routeParam = restaurant.id;
            }
        },

        computed: {

            currentImg: function(){

                return this.images[Math.abs(this.sliderIndex) % this.images.length];
            },

            // Get filtered categories based on link between carouselCategories and search bar
            filteredCategories: function() {
                // create new array of filtered value
                return this.carouselCategories.filter(category => {
                    // Check for every category if there is a match with the user search
                    return category.name.toLowerCase().includes(this.search.toLowerCase())
                });
            },
            fullRoute() {
                return this.route + '/' + this.routeParam;
            },
        }
    }
</script>
