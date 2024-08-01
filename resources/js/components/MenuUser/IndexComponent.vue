<template>
    <div id="menu-page">
        <header-component ref="childComponent" @filterSubCategories="filterSubCategories" :activeCatId="activeCatId" :categories="categories" @toggleVisibility="toggleVisibility" :lang="langs[language]" :currentLang="language"></header-component>
        <section ref="scrollArea" @wheel="onWheel" @touchstart="onTouchStart" @touchmove="onTouchMove" @touchend="onTouchEnd" id="main-section" class="pb-[10px]">
            <subcategory-component @filterFoods="filterFoods" :activeSubId="activeSubId" :subCategories="subCategories" :currentLang="language" ref="subCategory"></subcategory-component>
            <food-component v-bind:foods="foods" :currentLang="language"></food-component>
        </section>
        <langpopup-component :visibility="isVisible" :langs="langs" @change-language="changeLanguage"></langpopup-component>
    </div>
</template>

<script>
import HeaderComponent from "./MenuParts/HeaderComponent.vue";
import SubcategoryComponent from "./MenuParts/SubcategoryComponent.vue";
import FoodComponent from "./MenuParts/FoodComponent.vue";
import LangpopupComponent from "./MenuParts/LangpopupComponent.vue";
import axios from "axios";

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
            categories:[],
            subCategories: [],
            subCategoriesAll: [],
            foodsAll: [],
            foods: [],
        };
    },
    mounted() {
    },
    emits: ["changeLanguage"],
    created(){
        this.getCategories();        
        console.log('test1');
        console.log(this.categories);
    },
    methods: {
        getCategories(){
            axios.get('/api/category-foods').then(res => {
                this.categories = res.data.parent;
                this.subCategoriesAll = res.data.child;
                this.foodsAll = res.data.foods;
                this.filterSubCategories()
            });
        },
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
            var catId = this.categories.map(item => item.id);
            this.activeCatId = Math.min(...catId);
           if(categoryId)
                this.activeCatId = categoryId;
                this.subCategories = this.subCategoriesAll.filter((cat) => String(cat.parent_id) === String(this.activeCatId));
            
            if (this.subCategories.length !== 0) {
                this.activeSubId = this.subCategories[0].id;
                this.foods = this.foodsAll.filter((food) => food.category_id === this.activeSubId);
            }else{
                this.foods = this.foodsAll.filter((food) => food.category_id === this.activeCatId);
            }           
        },
        filterFoods(subCategoryId) {
            const subCategory = this.subCategoriesAll.find((subCat) => subCat.id === subCategoryId);
            this.activeSubId = subCategoryId;
            if (subCategory) {
                this.foods = this.foodsAll.filter((food) => food.category_id === this.activeSubId);
            } else {
                this.foods = [];
            }
        },
    },
    computed: {
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
