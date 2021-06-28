<template>
<div>

    <div id="jumbotron">

        <div class="container">
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

            <div class="jumbotron-video">

                <video id="videoBG" autoplay muted loop>
                <source :src="`storage/video/video-jumbo.mp4`" type="video/mp4">
                </video>

            </div>
        </div>
    </div>

    <div class="spacer-precarousel">

       Scegli tra le catagorie più richieste

    </div>

    <div class="main-carousel color-gradient">
        <div class="section-carousel color-gradient">
            <div v-for="category in carouselCategories" @click="$event.target.classList.toggle('active')" class="categories">

                    <img :src="`storage/images/categories/${category.img_cover}`">
                    <div @click="getCategoryId(category)" class="carousel-layover">

                        <span class="carousel-string"><b>{{category.name}}</b></span>

                    </div>


            </div>
        </div>
    </div>

    <div class="restaurants-container">
        <div v-for="restaurant in restaurants" class="restaurant-card shadow-sm">
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

    <div class="test-prova">

        test-prova

    </div>

</div>
</template>

<style scoped>
#jumbotron{
    background-color: white;
    display: flex;
    height: 550px;
}


#jumbotron .container{

    height: 100%;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.searchbar-container{

    display: flex;
    justify-content: center;
    align-items: center;
    width: 50%;
    color: #007E8A;
}

.searchbar-container input{

    text-align: center;
    border: 3px solid #FABD12;

}

#jumbotron .container .jumbotron-video{

    height: 100%;
    width: 40%;

}

#videoBG{

    height: 100%;
    width: 100%;
}

.spacer-precarousel{

    width: 100%;
    height: 50px;
    margin: auto;
    text-align: center;
    line-height: 50px;
    font-size: 25px;

}

.color-gradient{

    background: radial-gradient(#FE8F50, #FFC065);

}

.main-carousel{

    height: 200px;
}

.test-prova{

    height: 100px;
    background-color: #FABD12;
}

</style>

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
                isActive: false,
                routeParam: null,
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
            },
            getRouteId: function(restaurant) {
                this.routeParam = restaurant.id;
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
            fullRoute() {
                return this.route + '/' + this.routeParam;
            }
        }
    }
</script>
