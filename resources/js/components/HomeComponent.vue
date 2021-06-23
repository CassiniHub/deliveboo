<template>
<div>

    <div class="">
        <input
            v-model="search"      
            type="text" placeholder="Search">
        
        <ul v-if="search">
            <li v-for="category in filteredCategories"
                @click="getCategoryId(category)"
                >
                {{ category.name }}
            </li>
        </ul>
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

    <div class="text-center py-4">
        <div v-for="restaurant in restaurants">
            {{ restaurant.name }}
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

            return {
                
                carouselCategories: this.categories,
                selectedId: null,
                restaurants: null, 
                search: ''
            }
        },
        methods: {
            getCategoryId: function(category) {

                this.restaurants = null;
                this.selectedId = category.id;                
                axios.get('/api/filter/category/' + this.selectedId)
                    .then(res => {
                        this.restaurants = res.data;
                    })
                    .catch(err => console.log(err));
            },
        },

        computed: {
            filteredCategories: function() {
                return this.carouselCategories.filter(category => {
                    return category.name.toLowerCase().includes(this.search.toLowerCase())
                });
            }
        }
    }
</script>
