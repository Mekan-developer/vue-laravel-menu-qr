<template>
    <div class="main-div-style">
        <div class="relative-div-style">
            <div class="absolute top-2 right-2">
                <i @click="$emit('popupDeleteCreate')" class="cross-icon bx bx-x"></i>
            </div>
            <div class="mb-1 text-xl font-semibold text-center ">Sub Category Add</div>

            <select v-model="selectedCategory" class="select-style">
                <option selected disabled hidden :value="false">Choose category</option>
                <option v-for="category in categories" :key="category.index" :value="category.id">
                    {{ category.name[language] }}
                </option>
            </select>

            <div class="category-name-container">
                    <div class="flex flex-wrap justify-center gap-4">
                        <div class="flex-grow" v-for="(lang, code) in languages" :key="code">
                            <label :for="'input-' + code" class="text-label-style form-label">Category name {{ code }}</label>
                            <input type="text" v-model="name[code]" :id="'input-'+code" placeholder="Category name" class="input-name form-control" />
                        </div>
                    </div>
            </div>

            <div >
                <label for="formFileMultiple">Sub category image</label>
                <input type="file" @change="onChange" id="formFileMultiple" class="input-file-style" />
            </div>

            <div class="flex items-center gap-2">
                <label class="switch">
                    <input type="checkbox" v-model="isActive" />
                    <span class="slider round"></span>
                </label>
                <span>Is Active</span>
            </div>

            <button @click.prevent="store" class="save-button" type="button">Save</button>
        </div>
    </div>
</template>

<script>
import api from "../../../../../api";

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
            api.get("/api/get-categories").then((res) => {
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
            api.post("/api/category-store", formData).then(() => {
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


<style scoped>
.main-div-style{
    @apply flex justify-center items-center absolute z-50 top-0 left-0 w-full h-full bg-[#818181cc] text-white;
}
.input-file-style{
    @apply w-full p-[5px] text-gray-800 bg-gray-200 border border-gray-400 rounded-sm focus:outline-none focus:border-blue-500;
}
.relative-div-style{
    @apply relative flex flex-col gap-3 px-6 py-4 bg-gray-800 rounded-md shadow-lg;
}
.cross-icon{
    @apply p-4 text-2xl cursor-pointer hover:text-red-500;
}
.select-style{
    @apply p-2 text-gray-800 bg-gray-200 border border-gray-400 rounded-sm focus:outline-none focus:border-blue-500;
}
.input-name{
    @apply p-2 text-gray-800 bg-gray-200 border border-gray-400 rounded-sm focus:outline-none focus:border-blue-500;
}
.category-name-container{
    @apply w-full max-h-[300px] overflow-hidden overflow-y-auto relative;
}
.save-button{
    @apply w-full px-4 py-2 font-bold bg-blue-500 rounded hover:bg-blue-600;
}
.text-label-style{
    @apply m-0 text-white;
}
</style>