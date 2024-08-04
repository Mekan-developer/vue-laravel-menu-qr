<template>
   <header id="header" ref="removeClass" :class="dinamicClass" class="border-b-gray-200 border-b-2 pb-[10px] bg-gray-200 shadow-bottom">
    <div class="row-one">
        <div class="restaurant-name-logo">
            <div class="restaurant-logo">
                <img src="menu-icons/star.png" alt="" />
            </div>
            <div class="restaurant-name">vue-menu</div>
        </div>
        <button @click="popup" class="flex items-center px-4 py-2 space-x-2 font-bold text-white bg-gray-800 rounded lang hover:bg-gray-800">
            <span>{{ lang }}</span>
            <i class="bx bx-globe"></i>
        </button>
    </div>
    <div class="row-two">
        <div class="categories">
            <carousel :items-to-show="6" class="w-full">
                <slide :class="this.activeCatId === category.id ? 'activeCat' : 'notActiveCat'" v-for="category in categories" :key="category.id" @click="filterSubCategories(category.id)" class="category">
                    <div class="rounded-sm category-img">
                        <img :src="category.image" alt="" />
                    </div>
                    <div class="category-name">
                        {{ category.name[currentLang] }}
                    </div>
                </slide>
                <template #addons >
                <navigation class="pb-4" />
                <pagination />
                </template>
            </carousel>
        </div>
        
            
    </div>

</header>

</template>

<script>
import 'vue3-carousel/dist/carousel.css'
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'

export default {
    props: {
        lang: String,
        categories: Array,
        currentLang: String,
        activeCatId: Number,
    },
    components: {
    Carousel,
    Slide,
    Pagination,
    Navigation,
  },
    data() {
        return {
            dinamicClass: {
                headerHideWhenScroll: false,
                headerShowWhenScroll: false,
            },
        };
    },
    methods: {
        popup() {
            this.$emit("toggleVisibility");
        },
        filterSubCategories(id) {
            this.$emit("filterSubCategories", id);
        },
        getImageSrc(image) {
            return `/menu-icons/${image}`;
        },
        addClass() {
            this.dinamicClass["headerHideWhenScroll"] = true;
            this.dinamicClass["headerShowWhenScroll"] = false;
        },
        removeClass() {
            this.dinamicClass["headerHideWhenScroll"] = false;
            this.dinamicClass["headerShowWhenScroll"] = true;
        },
    },
};
</script>

<style scoped>
.headerHideWhenScroll {
    margin-top: -55px;
    animation: hideHeader 0.8s ease forwards;
}

@keyframes hideHeader {
    0% {
        margin-top: 0px;
    }
    100% {
        margin-top: -55px;
    }
}

.headerShowWhenScroll {
    margin-top: -55px;
    animation: showHeader 1s ease forwards;
}
@keyframes showHeader {
    0% {
        margin-top: -55px;
    }
    100% {
        margin-top: 0px;
    }
}

.row-one {
    display: flex;
    align-items: center;
    padding: 5px 20px;
    @apply bg-gray-200;
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
    margin: 0;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.lang {
    width: fit-content;
}
.lang-button {
    @apply bg-gray-800;
    color: white;
    box-shadow: 1px 1px 3px #0000004d;
    padding: 4px 6px;
    border-radius: 99999px;
}

.row-two {
    @apply sticky top-0 overflow-x-auto bg-gray-200;
    scrollbar-width: none; /* Firefox */
    -ms-overflow-style: none; /* Internet Explorer and Edge */
}

.row-two::-webkit-scrollbar {
    width: 0px; /* WebKit browsers */
    background: transparent; /* Optional: Hide the background */
}
.categories {
    display: flex;
}
.activeCat {
    @apply border border-[#1F2937];
}
.notActiveCat{
    @apply border border-[#A08F8F3B];
}
.category {
    display: flex;
    flex-flow: column;
    justify-content: center;
    align-items: center;
    margin: 0 5px;
    padding: 10px;
    cursor: pointer;
    border-radius: 4px;
}
.category-img {
    width: 46px;
    height: 46px;
    overflow: hidden;
}
.category-img img{
    object-fit: cover;
    width: 100%;
    height: 100%;
}
.shadow-bottom {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Customize the shadow size and color */
}
.category-name{
    width: 80px; /* Set the width of the container */
    white-space: nowrap; /* Prevent text from wrapping */
    overflow: hidden; /* Hide text that overflows */
    text-overflow: ellipsis;
}
</style>
