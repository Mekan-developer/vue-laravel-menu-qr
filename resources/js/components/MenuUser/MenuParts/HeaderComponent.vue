<template>
    <header id="header">
        <div class="row-one">
            <div class="restaurant-name-logo">
                <div class="restaurant-logo">
                    <img src="menu-icons/star.png" alt="" />
                </div>
                <div class="restaurant-name">wagamana</div>
            </div>
            <button @click="popup" class="lang">
                <button class="lang-button btn">{{ lang }}</button>
            </button>
        </div>
        <div class="row-two">
            <div class="categories">
                <div v-for="(category, index) in categories" :key="index" class="category">
                    <div class="category-img bg-yellow-600 rounded-lg p-1">
                        <img :src="getImageSrc(category.image)" alt="" />
                    </div>
                    <div class="category-name">
                        {{ category.name[currentLang] }}
                    </div>
                </div>
                <div class="category">
                    <div class="category-img p-1">
                        <img src="icons/popular.png" alt="" />
                    </div>
                    <div class="category-name">Popular</div>
                </div>
            </div>
        </div>
    </header>
</template>

<script>
export default {
    props: {
        lang: String,
        categories: Array,
        currentLang: String,
    },
    methods: {
        popup() {
            this.$emit("toggleVisibility");
        },
        getImageSrc(image) {
            return `/menu-icons/${image}`;
        },
    },
};
</script>

<style>
.row-one {
    display: flex;
    align-items: center;
    padding: 5px 20px;
}
.restaurant-name-logo {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-basis: 100%;
}
.restaurant-name-logo > .restaurant-logo {
    width: 45px;
    height: 45px;
}
.restaurant-name {
    font-size: 1.3rem;
    color: black;
    font-size: 1.3rem;
    margin: 0;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.lang {
    width: fit-content;
}
.lang-button {
    background-color: #f5f5f5;
    color: #333333;
    box-shadow: 1px 1px 3px #0000004d;
    padding: 4px 6px;
    border-radius: 99999px;
}

.row-two {
    overflow-x: auto;
    position: sticky;
    top: 0;
}
.categories {
    display: flex;
}
.category {
    display: flex;
    flex-flow: column;
    justify-content: center;
    align-items: center;
    margin: 0 5px;
    padding: 10px;
    cursor: pointer;
}
.category-img {
    width: 40px;
    height: auto;
}
</style>

<!-- [

{
    productid: "",
    category: ["favorite", 'popular', 'surry']
}
]

[
    "favoruiyr":[
        product: {

        },
        product: {
            
        }
        product: {
            
        }

    ],
    "popular"
] -->
