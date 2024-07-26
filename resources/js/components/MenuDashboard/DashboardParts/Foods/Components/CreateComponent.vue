<template>
    <div class="category-create flex flex-col justify-center items-center absolute left-0 top-0 z-50 w-full h-full bg-gray-800 bg-opacity-75 px-4">
        <div class="bg-gray-900 rounded-lg px-6 py-4 shadow-lg">
            <div class="m-2 p-1">
                <div class="flex justify-between items-center mb-4">
                    <div class="text-center text-blue-500 text-xl font-semibold">Food Add</div>
                    <i @click="$emit('popupDeleteCreate')" class="bx bx-x text-2xl p-2 cursor-pointer text-white hover:text-red-500"></i>
                </div>
                <div class="flex justify-start gap-2 mb-4">
                    <div class="w-full">
                        <select class="form-select cursor-pointer bg-gray-200 border border-gray-400 text-gray-800 rounded p-2 focus:outline-none focus:border-blue-500" aria-label="Default select example" @change="childValNull" v-model="selectedParentCategory">
                            <option :value="null">Choose category</option>
                            <option v-for="parent in parentCategories" :key="parent.id" :value="parent.id">
                                {{ parent.name[language] }}
                            </option>
                        </select>
                    </div>
                    <div class="w-full" v-if="!(filteredChildCategories.length === 0)">
                        <select class="form-select cursor-pointer bg-gray-200 border border-gray-400 text-gray-800 rounded p-2 focus:outline-none focus:border-blue-500" aria-label="Default select example" v-model="selectedChildCategory">
                            <option :value="null">Select sub category</option>
                            <option v-for="child in filteredChildCategories" :key="child.id" :value="child.id">
                                {{ child.name[language] }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="flex flex-wrap justify-center gap-4 mb-4">
                    <div class="flex-grow form-floating mb-2 overflow-hidden" v-for="(lang, code) in languages" :key="lang.index">
                        <input type="text" v-model="name[code]" class="form-control bg-gray-200 border border-gray-400 text-gray-800 rounded p-2 focus:outline-none focus:border-blue-500" :id="'input-' + code" placeholder="name" />
                        <label :for="'input-' + code" class="leading-[20px] pl-1 text-gray-500">Name {{ code }}</label>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="formFileMultiple" class="form-label text-white">Menu Image</label>
                    <input class="form-control bg-gray-200 border border-gray-400 text-gray-800 rounded p-2 focus:outline-none focus:border-blue-500" type="file" id="formFileMultiple" @change="onChange" multiple />
                </div>
                <div class="flex gap-4 mb-4 text-blue-500">
                    <div v-if="this.isEmpty(sizeData)" class="w-full">
                        <label for="price" class="form-label">Price</label>
                        <input class="form-control bg-gray-200 border border-gray-400 text-gray-800 rounded p-2 focus:outline-none focus:border-blue-500" v-model="price" type="number" id="price" placeholder="Price" />
                    </div>
                    <div class="flex gap-4 w-full">
                        <div class="flex-grow">
                            <label for="discount" class="form-label">Discount</label>
                            <input class="form-control bg-gray-200 border border-gray-400 text-gray-800 rounded p-2 focus:outline-none focus:border-blue-500" v-model="discount" type="number" id="discount" placeholder="Discount" />
                        </div>

                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <label class="switch">
                                    <input type="checkbox" v-model="addFoodSizeActive" />
                                    <span class="slider round"></span>
                                </label>
                                <i v-if="this.isEmpty(sizeData)" class="bx bxs-x-circle text-red-500 text-[26px]"></i>
                                <i v-if="!this.isEmpty(sizeData)" class="bx bx-check-square text-green-500 text-[26px]"></i>
                                <div class="flex-nowrap">+Size</div>
                            </div>
                            <select class="form-select bg-gray-200 border border-gray-400 text-gray-800 rounded p-2 focus:outline-none focus:border-blue-500" v-model="discount_unit">
                                <option selected value="manat">TMT</option>
                                <option value="percent">%</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="flex justify-between items-center mb-4">
                    <div class="flex items-center gap-2">
                        <label class="switch">
                            <input type="checkbox" v-model="isActive" />
                            <span class="slider round"></span>
                        </label>

                        <span class="text-white">Is Active</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <label class="switch">
                            <input type="checkbox" v-model="descriptionActive" />
                            <span class="slider round"></span>
                        </label>
                        <i v-if="this.isEmpty(descriptionData)" class="bx bxs-x-circle text-red-500 text-[26px]"></i>
                        <i v-if="!this.isEmpty(descriptionData)" class="bx bx-check-square text-green-500 text-[26px]"></i>
                        <span class="text-white">Description</span>
                    </div>
                </div>
                <description-component v-if="descriptionActive" :languages="languages" @updateDescActVal="updateDescActVal" @descriptionDataFun="descriptionDataFun" :descriptionData="descriptionData"></description-component>
                <size-component v-if="addFoodSizeActive" :languages="languages" @cancelSize="cancelFoodSize" @removeSizeData="removeSizeData" @sizeDataFun="sizeDataFun" :sizeData="sizeData"></size-component>
                <div class="mt-4">
                    <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded w-full" type="button" @click.prevent="storeFoods">Save</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import DescriptionComponent from "./components/DescriptionComponent.vue";
import SizeComponent from "./components/SizeComponent.vue";

export default {
    components: { DescriptionComponent },
    props: {
        language: String,
        languages: Object,
    },

    data() {
        const name = {};

        return {
            name: name,
            image: [],
            price: null,
            discount: null,
            discount_unit: "manat",
            isActive: true,
            // category
            selectedParentCategory: null,
            selectedChildCategory: null,
            parentCategories: [],
            childCategories: [],
            // category
            onePriceActive: true,
            descriptionActive: false,
            addFoodSizeActive: false,

            descriptionData: {},
            sizeData: [],
        };
    },
    created() {
        this.getCategories();
    },
    methods: {
        input_names() {
            Object.keys(this.languages).forEach((code) => {
                this.name[code] = "";
            });
        },
        getCategories() {
            axios.get("/api/food-create").then((res) => {
                this.childCategories = res.data.child;
                this.parentCategories = res.data.parent;
            });
        },
        storeFoods() {
            let formData = new FormData();
            if (this.image.length > 0) Object.keys(this.image).forEach((key) => formData.append("image[]", this.image[key]));
            formData.append("name", JSON.stringify(this.name));
            formData.append("description", JSON.stringify(this.descriptionData));
            formData.append("category_id", this.selectedChildCategory ? this.selectedChildCategory : this.selectedParentCategory);
            formData.append("discount", this.discount);
            formData.append("discount_unit", this.discount_unit);
            formData.append("is_active", JSON.stringify(this.isActive));
            formData.append("food_sizes", JSON.stringify(this.sizeData));
            formData.append("price", this.price);

            axios.post("/api/foods", formData).then((res) => {
                console.log(res);
            });
        },
        childValNull() {
            this.selectedChildCategory = null;
        },
        onChange(e) {
            this.image = e.target.files;
        },
        cancelFoodSize() {
            this.addFoodSizeActive = false;
        },
        updateDescActVal() {
            this.descriptionActive = false;
        },

        descriptionDataFun(data) {
            this.descriptionData = {};
            if (!this.isEmpty(data)) {
                this.descriptionData = data;
            }
            this.descriptionActive = false;
        },

        sizeDataFun(data) {
            data.forEach((item, index) => {
                this.sizeData[index] = item;
            });
            this.cancelFoodSize();
        },
        removeSizeData() {
            this.sizeData.pop();
        },
        isEmpty(obj) {
            return Object.keys(obj).length === 0;
        },
    },
    computed: {
        filteredChildCategories() {
            return this.childCategories.filter((child) => child.parent_id === this.selectedParentCategory);
        },
    },
    components: {
        DescriptionComponent,
        SizeComponent,
    },
};
</script>

<style>
.category-create {
    color: #0d6efd;
}
</style>
