<template>
    <div class="flex justify-center items-center absolute z-50 top-0 left-0 w-full h-full bg-[#818181cc]">
        <div class="relative flex flex-col w-full max-w-md gap-4 px-6 py-4 bg-gray-800 rounded-lg shadow-lg">
            <div class="absolute top-2 right-2">
                <i @click="$emit('popupDeleteEdit')" class="p-2 text-2xl text-white cursor-pointer bx bx-x hover:text-red-500"></i>
            </div>
            <div class="mb-1 text-xl font-semibold text-center text-white">Category Edit</div>

            <div class="w-full max-h-[300px] overflow-hidden overflow-y-auto no-scrollbar box-shad relative">
                <div class="mt-6 mb-2 space-y-1">
                    <div class="flex flex-wrap justify-center gap-4 mt-2">
                        <div class="flex-grow mb-2" v-for="(lang, index) in languages" :key="index">
                            <label :for="'floatingInput' + lang" class="text-label-style form-label">Name {{ index }}</label>
                            <input type="text" v-model="name[index]" class="p-2 text-gray-800 bg-gray-200 border border-gray-400 rounded custom-input form-control focus:outline-none focus:border-blue-500" :id="'floatingInput' + lang" placeholder="Category name" />
                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <label for="formFileMultiple" class="block mb-2 text-white">Category image</label>
                <input type="file" @change="onChange" id="formFileMultiple" class="w-full p-2 text-gray-800 bg-gray-200 border border-gray-400 rounded focus:outline-none focus:border-blue-500" />
            </div>

            <div class="flex items-center gap-2">
                <label class="switch">
                    <input type="checkbox" v-model="isActive" />
                    <span class="slider round"></span>
                </label>
                <span class="text-white">Is Active</span>
            </div>

            <button @click.prevent="update(category.id)" class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-600" type="button">Save</button>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    props: {
        category: Object,
        languages: Object,
        name: Object,
        isToggled: Boolean,
    },
    data() {
        return {
            isActive: true,
            image: "",
            isLoading: false,
        };
    },
    mounted() {
        this.isActive = this.isToggled;
    },
    methods: {
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
            formData.append("image", this.image);
            formData.append("is_active", this.isActive);
            axios
                .post(`/api/category-update/${id}`, formData, {
                    headers: {
                        Accept: "application/json",
                    },
                })
                .then(() => {
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
