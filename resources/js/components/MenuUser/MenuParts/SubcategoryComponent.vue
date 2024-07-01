<template>
    <div v-if="subCategories.length" class="subcategories w-full p-2 bg-[#EEEEEE] border-t-gray-200 border-b-gray-200 border-2">
        <div class="buttons flex flex-wrap gap-2">
            <div v-for="subCategory in subCategories" :key="subCategory.id" @click="filterFoods(subCategory.id)">
                <a href="#">
                    <div :class="activeSubId === subCategory.id ? 'activeSubCat' : 'notActiveSubCat'" class="rounded-full px-[6px] py-[3px]">{{ subCategory.name[currentLang] }}</div>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {};
    },
    props: {
        currentLang: String,
        subCategories: Array,
        activeSubId: Number,
    },
    methods: {
        filterFoods(id) {
            this.$emit("filterFoods", id);
        },
    },
};
</script>

<style scoped>
.activeSubCat {
    background-color: #5a5858ce;
    color: white;
}
.notActiveSubCat {
    background-color: white;
    color: #252525ce;
}
</style>
