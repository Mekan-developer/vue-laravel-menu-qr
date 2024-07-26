<template>
    <div class="flex justify-center items-center absolute z-50 top-0 left-0 w-full h-full bg-[#818181cc]">
        <div class="flex flex-col gap-4 bg-gray-800 px-6 py-4 rounded-lg relative shadow-lg">
            <div class="absolute top-2 right-2">
                <i @click="$emit('popupDeleteEdit')" class="bx bx-x text-2xl p-2 cursor-pointer text-white hover:text-red-500"></i>
            </div>
            <div class="text-center text-white text-xl font-semibold mb-1">Add Sub Category</div>

            <select v-model="selectedCategory" class="bg-gray-200 border border-gray-400 text-gray-800 rounded p-2 focus:outline-none focus:border-blue-500">
                <option v-for="category in categories" :key="category.id" :value="category.id">
                    {{ category.name[language] }}
                </option>
            </select>

            <div class="w-full max-h-[300px] overflow-hidden overflow-y-auto no-scrollbar box-shad relative">
                <div class="space-y-1 mt-6 mb-2">
                    <div class="flex flex-wrap justify-center gap-4 mt-2">
                        <div class="flex-grow form-floating mb-2" v-for="(lang, code) in languages" :key="code">
                            <input type="text" v-model="name[code]" class="form-control bg-gray-200 border border-gray-400 text-gray-800 rounded p-2 focus:outline-none focus:border-blue-500" :id="'input-' + code" placeholder="Category name" />
                            <label :for="'input-' + code" class="leading-[32px] pl-3 text-gray-500">Category name {{ code }}</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <label for="formFileMultiple" class="block mb-2 text-white">Menu image</label>
                <input type="file" @change="onChange" id="formFileMultiple" class="bg-gray-200 border border-gray-400 text-gray-800 rounded p-2 focus:outline-none focus:border-blue-500 w-full" />
            </div>

            <div class="flex items-center gap-2">
                <label class="switch">
                    <input type="checkbox" v-model="isActive" />
                    <span class="slider round"></span>
                </label>
                <span class="text-white">Is Active</span>
            </div>

            <button @click.prevent="update(category.id)" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded w-full" type="button">Save</button>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    props: {
        language: {
            type: String,
            default: "tm",
        },
        languages: Object,
        name: Object,
        isToggled: Boolean,
        category: Object,
    },
    data() {
        const name = {};

        return {
            isActive: true,
            categories: [],
            selectedCategory: null,
            parent_id: null,
            image: "",
            isLoading: false,
        };
    },
    created() {
        this.isActive = this.isToggled;
        this.getCategories();
        this.parent_id = this.category.id;
        this.selectedCategory = this.category.parent_id;
    },
    methods: {
        getCategories() {
            axios.get("/api/get-categories").then((res) => {
                this.categories = res.data.data;
            });
        },
        delayedRecall() {
            this.isLoading = true;
            setTimeout(() => {
                this.isLoading = false;
                this.delayedRecall();
            }, 3000);
        },

        update(id) {
            if (this.isLoading) {
                return;
            }
            let formData = new FormData();
            formData.append("name", JSON.stringify(this.name));
            formData.append("parent_id", this.selectedCategory);
            formData.append("image", this.image);
            formData.append("is_active", this.isActive);
            axios.post(`/api/category-update/${id}`, formData).then(() => {
                this.$emit("popupDeleteEdit");
                this.$emit("getCategories");
            });
            this.delayedRecall();
        },
        onChange(e) {
            this.image = e.target.files[0];
        },
    },
};
</script>

<style></style>
