<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ restaurant.name }}</div>

                    <div v-for="category in categories" class="card-body">
                        {{ category.name }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            restaurant: Object,
            categories: Array,
        },
        mounted() {
        }
    }
</script>
