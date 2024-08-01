<template>
<div v-if="subCategories.length" class="subcategories w-full p-2 text-[#1F2937] bg-[#a08f8f3b] border-t-gray-200 border-b-gray-200 border-2">
    <div class="flex flex-wrap gap-2 buttons">
        <div v-for="subCategory in subCategories" :key="subCategory.id" @click="filterFoods(subCategory.id)">
            <a href="#">
                <div :class="activeSubId === subCategory.id ? 'activeSubCat' : 'notActiveSubCat'" class="custom-subcategory">
                    {{ subCategory.name[currentLang] }}
                </div>
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
.subcategories {
    background-color: #a08f8f3b;
}
.custom-subcategory {
    border-radius: 6px; /* Customize the rounded corners */
    padding: 8px 12px; /* Customize the size */
    font-size: 14px; /* Customize the font size */
    color: #333; /* Customize the text color */
    transition: background-color 0.3s ease; /* Smooth transition for background color */
}
.activeSubCat {
    background-color: #1F2937;
    color: white;
}
.notActiveSubCat {
    background-color: #ffffff;
    color: #252525ce;
}
</style>
