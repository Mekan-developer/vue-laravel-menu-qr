<template>
    <div class="category-create flex flex-col justify-center items-center absolute left-0 top-0 z-[9999] w-full h-full bg-[#11101d63] px-4">
        <div class="bg-white rounded-md px-4 py-2 min-w-[740px] min-h-[460px] max-h-[calc(100%-10px)]">
            <div class="m-2 p-1 overflow-hidden overflow-y-auto no-scrollbar max-h-[calc(100%-56px)]">
                <div class="flex justify-end w-full mb-1">
                    <div class="flex-grow-1 text-center text-[#216ccf] text-[16px] font-bold">Category add</div>
                    <i @click="$emit('popupDeleteCreate')" class="bx bx-x text-[24px] p-2 cursor-pointer"></i>
                </div>
                <div class="flex justify-start gap-2 mb-2">
                    <div class="w-full">
                        <select class="form-select cursor-pointer" aria-label="Default select example" @change="childValNull" v-model="selectedParentCategory">
                            <option :value="null">Choose category</option>
                            <option v-for="parent in parentCategories" :key="parent.id" :value="parent.id">
                                {{ parent.name[language] }}
                            </option>
                        </select>
                    </div>
                    <div class="w-full" v-if="!(filteredChildCategories.length === 0)">
                        <select class="form-select cursor-pointer" aria-label="Default select example" v-model="selectedChildCategory">
                            <option :value="null">select sub category</option>
                            <option v-for="child in filteredChildCategories" :key="child.id" :value="child.id">
                                {{ child.name[language] }}
                            </option>
                        </select>
                    </div>
                </div>

                <div class="flex flex-wrap justify-center gap-4">
                    <div class="flex-grow-1 form-floating mb-1 overflow-hidden input-sm" v-for="(lang, code) in languages" :key="lang.index">
                        <input type="text" v-model="name[code]" class="form-control input-sm over" :id="'input-' + code" placeholder="name" />
                        <label :for="'input-' + code" class="leading-[32px] pl-3 text-gray-500">category name {{ code }}</label>
                    </div>
                </div>
                <div>
                    <div class="mb-3">
                        <label for="formFileMultiple" class="form-label p-0 m-0">Menu image</label>
                        <input class="form-control" type="file" id="formFileMultiple" multiple />
                    </div>
                </div>
                <div class="flex gap-1">
                    <div v-if="onePriceActive" class="mb-3">
                        <label for="price" class="form-label p-0 m-0 text-[#0d6efd]">price ( {{ foodSizes + 1 }} )</label>
                        <input class="form-control" v-model="price[0]" type="number" id="price" placeholder="price" />
                    </div>
                    <div class="flex gap-1 mb-3 w-auto flex-grow">
                        <div class="flex-grow">
                            <label for="discount" class="form-label p-0 m-0">discount</label>
                            <input class="form-control" type="number" id="discount" placeholder="discount" />
                        </div>
                        <div>
                            <div class="flex justify-between">
                                <label for="type" class="form-label p-0 m-0"></label>
                                <div class="flex">
                                    <div>( {{ foodSizes + 1 }} )</div>
                                    <div @click="addFoodSize" class="w-[24px] h-[24px] text-center bg-[#2e63f7] text-white rounded-sm cursor-pointer">+</div>
                                </div>
                            </div>

                            <select class="form-select mb-1 cursor-pointer" aria-label="Default select example" name="" id="type">
                                <option class="" value="">tmt</option>
                                <option value="">%</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div :class="{ multy_size_style: changeClass, food_size_height: onePriceActive }" class="bg-gray-400 rounded-md overflow-hidden">
                    <div class="flex justify-between relative -top-2 -left-2 z-50 bg-white w-[calc(100%_+_16px)]">
                        <span class="">multy size</span>
                    </div>
                    <div class="overflow-hidden overflow-y-auto h-[calc(100%_-_22px)] no-scrollbar pb-2 mb-4 rounded-md">
                        <div class="py-1 mb-2" v-for="(size, index) in foodSizes + 1" :key="size">
                            <div class="flex justify-end w-full mb-1">
                                <span v-if="index == 0" class="text-white mr-8">( {{ index + 1 }} )</span>
                                <span v-if="index != 0" class="text-white mr-1">( {{ index + 1 }} )</span>
                                <div @click="removeFoodSize" v-if="size != 1" class="w-[24px] h-[24px] leading-[24px] text-center bg-[#2e63f7] text-white rounded-sm cursor-pointer text-[20px]">-</div>
                            </div>

                            <div class="flex flex-wrap justify-center gap-4">
                                <div class="flex-grow-1 form-floating mb-1 overflow-hidden" v-for="(lang, code) in languages" :key="lang.index">
                                    <input type="text" :name="foodSizeName[code]" class="form-control bg-gray-200" :id="'input-' + code" placeholder="name@example.com" />
                                    <label :for="'input-' + code" class="leading-[32px] pl-3 text-gray-500">category name {{ code }}</label>
                                </div>
                            </div>

                            <div class="px-1">
                                <label for="price" class="form-label text-white m-0">price</label>
                                <input v-model="price[size]" class="form-control gb-gray-200 m-0" type="number" id="price" placeholder="price" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-between">
                    <div class="mb-4 flex gap-2 text-center items-center">
                        <label class="switch">
                            <input type="checkbox" v-model="isActive" />
                            <span class="slider round"></span>
                        </label>
                        <span>is active</span>
                    </div>

                    <div class="mb-4 flex gap-2 text-center items-center">
                        <label class="switch">
                            <input type="checkbox" v-model="descriptionActive" />
                            <span class="slider round"></span>
                        </label>
                        <span>description</span>
                    </div>
                </div>
                <div v-if="descriptionActive" class="flex justify-center items-center absolute z-50 top-0 left-0 w-full h-full bg-[#818181cc]">
                    <div class="flex flex-col gap-2 bg-gray-200 p-4 rounded-lg">
                        <div class="flex">
                            <div class="flex-grow-1 text-center">Add description</div>
                            <div class="flex-end pb-1">
                                <i @click="descriptionActive = false" class="bx bx-x text-[24px] p-2 cursor-pointer"></i>
                            </div>
                        </div>
                        <div v-for="(lang, code) in languages" :key="lang.index">
                            <textarea :name="description[code]" id="" class="min-w-[400px] pl-1"> </textarea>
                        </div>

                        <button class="btn btn-primary" type="button">save</button>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button class="btn btn-primary" type="button">Save</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    props: {
        language: String,
        languages: Object,
    },

    data() {
        const name = {};
        const description = {};

        return {
            name: name,
            description: description,
            foodSizeName: {},
            foodSizes: 0,

            price: {
                0: null,
            },
            isActive: true,
            // category
            selectedParentCategory: null,
            selectedChildCategory: null,
            parentCategories: [],
            childCategories: [],
            selectedParentCategory: null,
            selectedChildCategory: null,
            // category
            onePriceActive: true,
            descriptionActive: false,
            changeClass: false,
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
        input_names() {
            Object.keys(this.languages).forEach((code) => {
                this.description[code] = "";
            });
        },
        foodSizeAdd() {
            Object.keys(this.languages).forEach((code) => {
                if (foodSizes > 0) this.reqursiveFunc(this.foodSizes, code);
            });
        },
        reqursiveFunc(id, code) {
            let size_id = id;
            this.foodSizeName[size_id][code] = "";
            size_id--;
            if (size_id > 0) this.reqursiveFunc(size_id, code);
            else return;
        },
        getCategories() {
            axios.get("/api/food-create").then((res) => {
                console.log(res);
                this.childCategories = res.data.child;
                this.parentCategories = res.data.parent;
            });
        },
        storeFoods() {
            let formData = new FormData();
            formData.append();
            axios.post("/api/foods", formData);
        },
        childValNull() {
            this.selectedChildCategory = null;
        },
        addFoodSize() {
            this.onePriceActive = false;
            this.foodSizes++;
            this.changeClass = true;
        },
        removeFoodSize() {
            if (this.foodSizes > 0) {
                this.foodSizes--;
            }
            if (this.foodSizes === 0) {
                this.onePriceActive = true;
                this.changeClass = false;
            }
        },
    },
    computed: {
        filteredChildCategories() {
            return this.childCategories.filter((child) => child.parent_id === this.selectedParentCategory);
        },
    },
};
</script>

<style>
.category-create {
    color: #0d6efd;
}
.no-scrollbar::-webkit-scrollbar {
    display: none;
}

.multy_size_style {
    @apply p-2 mb-1;
    height: 300px;
    transition: all 1s ease;
}
.food_size_height {
    height: 0;
    transition: all 1s ease;
}
</style>
