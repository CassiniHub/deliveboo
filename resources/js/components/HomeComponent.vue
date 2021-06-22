<template>
<div>

    <div class="jumbo">
        <form class="modulo-ricerca">
            <p>Dicci di cosa hai voglia</p>
            <input @keyup="getSearchText" v-model="searchText" id="search" type="text" required>
            <input id="submit" type="submit" value="CERCA">
        </form>
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
                searchText: '',
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
            getSearchText: function() {

                this.restaurants = null;
                let matchingCategories = [];
                
                for (let i=0; i<this.categories.length; i++){
                    if(this.categories[i].name.toLowerCase().includes(this.searchText.toLowerCase())){

                        matchingCategories.push(this.categories[i].id);
                    }
                }

                if (this.searchText != 0) {
                    console.log('chiamata');
                    let json=JSON.stringify(matchingCategories);
                    axios.get('/api/filter/categoryArr/' + json)
                        .then(res => {
                            let arr = [];
                            let resArr = res.data;
    
                            resArr.forEach(element => {
                                element.forEach(restaurant => {
                                    if (!arr.includes(restaurant)){
                                        arr.push(restaurant)
                                    }
                                });
                            });
                            console.log(arr);
                            this.restaurants = arr;
                        })
                        .catch(err => console.log(err));
                }
            }
        },
    }
</script>
