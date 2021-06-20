<template>
    <ul>
        <li>
            <a href="">
                {{ restaurant.name }}
            </a>
        </li>
    </ul>
</template>

<script>
    export default {
        props: {

            restaurant: Object
        },
        mounted() {
            console.log(this.restaurant)
        }
    }
</script>
