<template>
    <div class="section-carousel">
        <div class="categories">

            <span @click="getCategoryId" >
                <img :src="`storage/images/categories/${img_name}`">
            </span>
            
        </div>
    </div>
</template>

<restaurant-card-component
    :selectedId = "selectedId"
></restaurant-card-component>

<script>
    export default {
        props: {
            category: Object,
        },
        components: {
                'restaurant-component-name': require('./RestaurantCardComponent.vue'),
        },
        data: function() {

            return {
                
                img_name: this.category.img_cover,
                selectedId: null,
            }
        },
        mounted() {
        },
        methods: {
            getCategoryId: function() {
                this.selectedId = this.category.id;
                console.log(this.selectedId);
            },
        }
    }
</script>
