<template>
    <header id="header" ref="removeClass" :class="dinamicClass" class="border-b-gray-200 border-b-2 pb-[10px]">
        <div class="row-one">
            <div class="restaurant-name-logo">
                <div class="restaurant-logo">
                    <img src="menu-icons/star.png" alt="" />
                </div>
                <div class="restaurant-name">wagamana</div>
            </div>
            <button @click="popup" class="lang flex items-center space-x-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <span>{{ lang }}</span>
                <i class="bx bx-globe"></i>
            </button>
        </div>
        <div class="row-two">
            <div class="categories">
                <div v-for="category in categories" :key="category.id" @click="filterSubCategories(category.id)" class="category">
                    <div :class="this.activeCatId === category.id ? 'activeCat' : ''" class="category-img rounded-lg p-1">
                        <img :src="getImageSrc(category.image)" alt="" />
                    </div>
                    <div class="category-name">
                        {{ category.name[currentLang] }}
                    </div>
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
        activeCatId: Number,
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
.activeCat {
    background-color: #a08f8f3b;
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
