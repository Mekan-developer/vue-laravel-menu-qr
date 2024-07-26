<template>
    <div class="flex justify-center items-center absolute z-50 top-0 left-0 w-full h-full bg-[#818181cc]">
        <div class="flex flex-col gap-4 bg-gray-800 px-6 py-4 rounded-lg relative shadow-lg max-w-md w-full">
            <div class="absolute top-2 right-2">
                <i @click="$emit('popupDeleteCreate')" class="bx bx-x text-2xl p-2 cursor-pointer text-white hover:text-red-500"></i>
            </div>
            <div class="text-center text-white text-xl font-semibold mb-1">Sub Category Add</div>

            <select v-model="selectedCategory" class="bg-gray-200 border border-gray-400 text-gray-800 rounded p-2 focus:outline-none focus:border-blue-500">
                <option selected disabled hidden class="bg-gray-400 p-4 text-black" :value="false">Choose category for sub category</option>
                <option v-for="category in categories" :key="category.index" :value="category.id" class="py-2">
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

            <button @click.prevent="store" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded w-full" type="button">Save</button>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    props: {
        isActiveCreate: Boolean,
        language: String,
        languages: Object,
    },
    data() {
        const name = {};

        return {
            name: name,
            categories: [],
            image: "",
            selectedCategory: false,
            isActive: true,
            isLoading: false,
        };
    },
    emits: ["getCategories", "popupDeleteCreate"],
    created() {
        this.getCategories();
        this.input_names();
    },
    methods: {
        input_names() {
            Object.keys(this.languages).forEach((code) => {
                this.name[code] = "";
            });
        },
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

        store() {
            if (this.isLoading) {
                return;
            }
            let formData = new FormData();
            formData.append("name", JSON.stringify(this.name));
            formData.append("parent_id", this.selectedCategory);
            formData.append("image", this.image);
            formData.append("is_active", this.isActive);
            formData.append("image_require", true);
            axios.post("/api/category-store", formData).then(() => {
                this.$emit("popupDeleteCreate");
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
