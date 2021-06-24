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
            <div v-for="category in carouselCategories" class="categories">
                <span @click="getCategoryId(category)" >
                    <img :src="`storage/images/categories/${category.img_cover}`">
                </span>
            </div>
        </div>
    </div>

    <!-- Applied categories filter -->
    <!-- <div class="">
        <ul>
            <li v-for="category in category in selectedFilteredCategories" >
                <span>X</span>
                <span>{{ category.name }}</span>
            </li>
        </ul>
    </div> -->

    <div class="restaurants-container">
        <div v-for="restaurant in restaurants" class="restaurant-card shadow-sm">
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
                    <li v-for="">

                    </li>
                </ul>
            </div>
        </div>
    </div>
    
</div>
</template>

<script>
    export default {
        props: {
            categories: Array,
        },
        data: function() {

            // 
            return {
                
                carouselCategories: this.categories,
                selectedId: [],
                restaurants: null, 
                search: ''
            }
        },
        methods: {
            getCategoryId: function(category) {

                this.restaurants = null;

                if (!this.selectedId.includes(category.id)) {
                    
                    this.selectedId.push(category.id);
                } else {

                    for( var i = 0; i < this.selectedId.length; i++){ 
    
                        if (this.selectedId[i] === category.id) { 

                            this.selectedId.splice(i, 1); 
                        }
                    }
                }

                console.log(this.selectedId);

                this.search = '';
                if (this.selectedId.length > 0) {

                    let ids =JSON.stringify(this.selectedId);
                    
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

            // deselectId: function(category) {
            //     this.selectedId.splice(category.id, 1);
            // }
        },

        computed: {
            filteredCategories: function() {
                return this.carouselCategories.filter(category => {
                    return category.name.toLowerCase().includes(this.search.toLowerCase())
                });
            },

            // Returns dynamic array of categories in which id correspond to the selected array of ids
            // filteredSelectedCategories: function() {
            //     return this.carouselCategories.filter(category => {
            //         this.selecteId.forEach(index => {
            //             if(index == category.id) {
            //                 return true;
            //             }
            //         })
            //     });
            // }
        }
    }
</script>
