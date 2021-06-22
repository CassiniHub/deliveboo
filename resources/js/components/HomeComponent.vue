<template>
<div>

    <div class="main-carousel">
        <div class="section-carousel">
            <div v-for="category in carouselCategories" class="categories">
    
                <span @click="getCategoryId(category)" >
                    <img :src="`storage/images/categories/${category.img_cover}`">
                </span>
                
            </div>
        </div>
    </div>

    <div>
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
            }
        },
        mounted() {
        },
        methods: {
            getCategoryId: function(category) {

                this.selectedId = category.id;                
                axios.get('/api/filter/category/' + this.selectedId)
                    .then(res => {
                        this.restaurants = res.data;
                        console.log(this.restaurants);
                    })
                    .catch(err => console.log(err));
            },
        },
    }
</script>
