<template>
    <div id="menu-page">
        <header-component ref="childComponent" @filterSubCategories="filterSubCategories" :activeCatId="activeCatId" :categories="categories" @toggleVisibility="toggleVisibility" :lang="langs[language]" :currentLang="language"></header-component>
        <section ref="scrollArea" @wheel="onWheel" @touchstart="onTouchStart" @touchmove="onTouchMove" @touchend="onTouchEnd" id="main-section" class="pb-[10px]">
            <subcategory-component @filterFoods="filterFoods" :activeSubId="activeSubId" :subCategories="filteredSubCategories" :currentLang="language" ref="subCategory"></subcategory-component>
            <food-component v-bind:foods="filteredFoods" :currentLang="language"></food-component>
        </section>
        <langpopup-component :visibility="isVisible" :langs="langs" @change-language="changeLanguage"></langpopup-component>
    </div>
</template>

<script>
import HeaderComponent from "./MenuParts/HeaderComponent.vue";
import SubcategoryComponent from "./MenuParts/SubcategoryComponent.vue";
import FoodComponent from "./MenuParts/FoodComponent.vue";
import LangpopupComponent from "./MenuParts/LangpopupComponent.vue";

export default {
    props: { language: String },
    data() {
        return {
            isVisible: false,

            activeCatId: null,
            activeSubId: null,
            langs: {
                en: "english",
                tm: "turkmen",
            },
            categories: [
                {
                    id: 1,
                    name: {
                        en: "breakfast",
                        tm: "ertirlik",
                    },
                    image: "img1.png",
                    subCategories: [],
                    foods: [
                        {
                            id: 1,
                            name: {
                                en: "eggs",
                                tm: "yumurtga",
                            },
                            image: "foodIMG.png",
                            price: 25,
                        },
                        {
                            id: 2,
                            name: {
                                en: "eggs",
                                tm: "yumurtga",
                            },
                            image: "foodIMG.png",
                            price: 52,
                        },
                    ],
                },
                {
                    id: 2,
                    name: {
                        en: "Popular",
                        tm: "meshur naharlar",
                    },
                    image: "img1.png",
                    subCategories: [
                        {
                            id: 5,
                            name: {
                                en: "subCategory 2.1",
                                tm: "subCategory 2.1",
                            },
                            image: "img.png",
                            foods: [
                                {
                                    id: 13,
                                    name: {
                                        en: "food in sub",
                                        tm: "food in sub tm",
                                    },
                                    image: "img2.png",
                                    price: 250,
                                },
                            ],
                        },
                        {
                            id: 6,
                            name: {
                                en: "subCategory 2.1",
                                tm: "subCategory 2.1",
                            },
                            image: "img.png",
                            foods: [
                                {
                                    id: 13,
                                    name: {
                                        en: "food in sub",
                                        tm: "food in sub tm",
                                    },
                                    image: "img2.png",
                                    price: 250,
                                },
                                {
                                    id: 13,
                                    name: {
                                        en: "food in sub",
                                        tm: "food in sub tm",
                                    },
                                    image: "img2.png",
                                    price: 250,
                                },
                                {
                                    id: 13,
                                    name: {
                                        en: "food in sub",
                                        tm: "food in sub tm",
                                    },
                                    image: "img2.png",
                                    price: 250,
                                },
                                {
                                    id: 13,
                                    name: {
                                        en: "food in sub",
                                        tm: "food in sub tm",
                                    },
                                    image: "img2.png",
                                    price: 250,
                                },
                                {
                                    id: 13,
                                    name: {
                                        en: "food in sub",
                                        tm: "food in sub tm",
                                    },
                                    image: "img2.png",
                                    price: 250,
                                },
                                {
                                    id: 13,
                                    name: {
                                        en: "food in sub",
                                        tm: "food in sub tm",
                                    },
                                    image: "img2.png",
                                    price: 88,
                                },
                                {
                                    id: 13,
                                    name: {
                                        en: "food in sub",
                                        tm: "food in sub tm",
                                    },
                                    image: "img2.png",
                                    price: 88,
                                },
                                {
                                    id: 13,
                                    name: {
                                        en: "food in sub",
                                        tm: "food in sub tm",
                                    },
                                    image: "img2.png",
                                    price: 88,
                                },
                                {
                                    id: 13,
                                    name: {
                                        en: "food in sub",
                                        tm: "food in sub tm",
                                    },
                                    image: "img2.png",
                                    price: 88,
                                },
                            ],
                        },
                    ],
                    foods: [],
                },
            ],
            filteredSubCategories: [],
            filteredFoods: [],
        };
    },
    mounted() {
        this.filterSubCategories(this.minCategoryId);
    },
    emits: ["changeLanguage"],
    methods: {
        toggleVisibility() {
            this.isVisible = !this.isVisible;
        },
        changeLanguage(lang) {
            this.$emit("changeLanguage", lang);
        },
        // mouse scroll yada phone-de finger bilen scrol edeninde ishleyan funcsiya start
        onWheel(event) {
            if (event.deltaY < 0) {
                this.$refs.childComponent.removeClass();
            } else if (event.deltaY > 0) {
                this.$refs.childComponent.addClass();
            }
        },
        onTouchStart(event) {
            this.touchStartY = event.touches[0].clientY;
        },
        onTouchMove(event) {
            this.touchEndY = event.touches[0].clientY;
        },
        onTouchEnd() {
            if (this.touchStartY > this.touchEndY) {
                this.$refs.childComponent.addClass();
            } else if (this.touchStartY < this.touchEndY) {
                this.$refs.childComponent.removeClass();
            }
            this.removeEventListeners();
        },
        removeEventListeners() {
            this.$refs.scrollArea.removeEventListener("wheel", this.onWheel);
            this.$refs.scrollArea.removeEventListener("touchstart", this.onTouchStart);
            this.$refs.scrollArea.removeEventListener("touchmove", this.onTouchMove);
            this.$refs.scrollArea.removeEventListener("touchend", this.onTouchEnd);
        },
        // mouse scroll yada phone-de finger bilen scrol edeninde ishleyan funcsiya end
        filterSubCategories(categoryId = null) {
            const category = this.categories.find((cat) => cat.id === categoryId);
            this.activeCatId = categoryId;
            if (category) {
                this.filteredSubCategories = category.subCategories;
                this.filteredFoods = [];
                if (this.filteredSubCategories.length === 0) {
                    this.filteredFoods = category.foods;
                } else {
                    this.filteredFoods = this.filteredSubCategories[0].foods;
                    this.activeSubId = this.filteredSubCategories[0].id;
                }
            }
        },

        filterFoods(subCategoryId) {
            const subCategory = this.filteredSubCategories.find((subCat) => subCat.id === subCategoryId);
            this.activeSubId = subCategoryId;
            if (subCategory) {
                this.filteredFoods = subCategory.foods;
            } else {
                this.filteredFoods = [];
            }
        },
    },
    computed: {
        minCategoryId() {
            return Math.min(...this.categories.map((category) => category.id));
        },
    },
    components: {
        HeaderComponent,
        SubcategoryComponent,
        FoodComponent,
        LangpopupComponent,
    },
};
</script>
<style scoped>
#menu-page {
    display: flex;
    flex-flow: column;
    max-width: 450px;
    height: 100vh;
    margin: auto;
    box-shadow: 0 0 10px #0003;
}

#main-section {
    overflow-y: scroll;
    padding-bottom: 55px;
}
</style>
