<template>
<div>

    <div id="jumbotron">

        <div class="container">
            <div class="searchbar-container">
                <label for="searchbar">Di cosa ha voglia oggi?</label>
                <input
                    v-model="search"      
                    type="text" name="searchbar">
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

    <div class="main-carousel">
        <div class="section-carousel">
            <div v-for="category in carouselCategories" @click="$event.target.classList.toggle('active')" class="categories">
                <span @click="getCategoryId(category)" >
                    <img :src="`storage/images/categories/${category.img_cover}`">
                </span>
            </div>
        </div>
    </div>

    <div class="restaurants-container">
        <div v-for="restaurant in restaurants" class="restaurant-card shadow-sm">
<<<<<<< HEAD
            <div class="name">
                <h3>
                    {{ restaurant.name }}
                </h3>
            </div>
            <div class="description">
                <p>
                    {{ restaurant.description }}
                </p>
            </div>
            <div class="info">
                <p> <span>Phone Number:</span> {{ restaurant.telephone }}</p>
                <p> <span>Address:</span> {{ restaurant.address }}</p>
            </div>
            <div>
                <ul>
                    <li v-for="category in restaurant.categories">
                        {{ category.name }}
                    </li>
                </ul>
            </div>
=======
            <a @click="getRouteId(restaurant)" :href="fullRoute">
                <div class="name">
                    <h3>
                        {{ restaurant.name }}
                    </h3>
                </div>
                <div class="description">
                    <p>
                        {{ restaurant.description }}
                    </p>
                </div>
                <div class="info">
                    <p> <span>Phone Number:</span> {{ restaurant.telephone }}</p>
                    <p> <span>Address:</span> {{ restaurant.address }}</p>
                </div>
            </a>
>>>>>>> FE_RESTAURANTS_SHOW
        </div>
    </div>
    
</div>
</template>

<script>
    export default {
        props: {
            categories: Array,
            route: String,
        },
        data: function() {

            // 
            return {
                
                carouselCategories: this.categories,
                selectedIds: [],
                restaurants: null, 
                search: '',
<<<<<<< HEAD
                isActive: false,
=======
                routeParam: null,
>>>>>>> FE_RESTAURANTS_SHOW
            }
        },
        methods: {

            // Get the clicked carousel category ids and push them into an array 
            // to make an API call which gives back restaurants of the selected categories
            // @param {object} category [clicked carousel category]
            
            getCategoryId: function(category) {
                // REVIEW]
                // Not sure of the visual effect given by this line of code
                this.restaurants = null;
<<<<<<< HEAD
                
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
                            console.log(res);
                            this.restaurants = res.data;
                        })
                        .catch(err => console.log(err));
                } else {
                    
                    this.restaurants = null;
                }
=======
                this.selectedId = category.id;       
                this.search = '';         
                axios.get('/api/filter/category/' + this.selectedId)
                    .then(res => {
                        this.restaurants = res.data;
                    })
                    .catch(err => console.log(err));
            },
            getRouteId: function(restaurant) {
                this.routeParam = restaurant.id;
>>>>>>> FE_RESTAURANTS_SHOW
            }
        },

        computed: {
            // Get filtered categories based on link between carouselCategories and search bar
            filteredCategories: function() {
                // create new array of filtered value
                return this.carouselCategories.filter(category => {
                    // Check for every category if there is a match with the user search
                    return category.name.toLowerCase().includes(this.search.toLowerCase())
                });
            },
<<<<<<< HEAD
=======
            fullRoute() {
                return this.route + '/' + this.routeParam;
            }
>>>>>>> FE_RESTAURANTS_SHOW
        }
    }
</script>
