<template>
    <div id="menu-page">
        <header-component @toggleVisibility="toggleVisibility" :categories="categories" :lang="langs[language]" :currentLang="language"></header-component>
        <section id="main-section" class="py-[10px]">
            <subcategory-component ref="subCategory"></subcategory-component>
            <food-component ref="food"></food-component>
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
    data() {
        return {
            isVisible: false,
            language: "tm",
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
                            foods: [],
                        },
                        {
                            id: 6,
                            name: {
                                en: "subCategory 2.1",
                                tm: "subCategory 2.1",
                            },
                            foods: [
                                {
                                    id: 13,
                                    name: {
                                        en: "food in sub",
                                        tm: "food in sub tm",
                                    },
                                },
                            ],
                        },
                    ],
                },
            ],
        };
    },

    methods: {
        toggleVisibility() {
            this.isVisible = !this.isVisible;
        },
        changeLanguage(lang) {
            this.language = lang;
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
<style>
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
    scroll-snap-type: y mandatory;
    padding-bottom: 55px;
}
</style>
