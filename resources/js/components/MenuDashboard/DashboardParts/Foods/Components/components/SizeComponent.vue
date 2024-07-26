<template>
    <div class="flex justify-center items-center absolute z-50 top-0 left-0 w-full h-full bg-[#818181cc]">
        <div class="flex flex-col gap-4 bg-gray-800 px-6 py-4 rounded-lg relative shadow-lg">
            <div class="absolute top-2 right-2">
                <i @click="cancel" class="bx bx-x text-2xl p-2 cursor-pointer text-white hover:text-red-500"></i>
            </div>
            <div class="text-center text-white text-xl font-semibold mb-1">Add food size</div>
            <div class="flex gap-2 justify-end -mb-2">
                <button @click="removeFoodSize" v-if="foodSizes > 2" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">- {{ foodSizes }} Remove</button>
                <button @click="addFoodSize" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">+ Add Size</button>
            </div>
            <div class="w-full max-h-[300px] overflow-hidden overflow-y-auto no-scrollbar box-shad relative">
                <div class="space-y-1 mt-6 mb-2" v-for="size in foodSizes" :key="size">
                    <div class="flex flex-wrap justify-center gap-4 mt-2">
                        <div class="flex-grow form-floating mb-2" v-for="(lang, code) in languages" :key="lang.index">
                            <input type="text" v-model="foodSizeName[size][code]" class="form-control bg-gray-200 border border-gray-400 text-gray-800 rounded p-2 focus:outline-none focus:border-blue-500" :id="'input-' + size + code" placeholder="Category name" />
                            <label :for="'input-' + size + code" class="leading-[32px] pl-3 text-gray-500">Category name {{ code }} </label>
                        </div>
                    </div>
                    <div>
                        <input v-model="prices[size]" class="form-control bg-gray-200 border border-gray-400 text-gray-800 rounded p-2 focus:outline-none focus:border-blue-500" type="number" :placeholder="'price ' + size" />
                    </div>
                </div>
                <div class="sticky bottom-0 w-full h-2" style="box-shadow: -8px 5px 20px rgba(255, 255, 125, 0.7)"></div>
            </div>

            <button @click.prevent="store" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded w-full" type="submit">Save</button>
        </div>
    </div>
</template>

<script>
import { toRaw } from "vue";

export default {
    props: {
        languages: Object,
        sizeData: Array,
    },
    emits: ["cancelSize", "sizeDataFun"],
    data() {
        return {
            foodSizes: 2,
            foodSizeName: [],
            prices: [],
        };
    },
    created() {
        this.initializeFoodSizeName();
        if (this.sizeData.length > this.foodSizes) {
            this.foodSizes = this.sizeData.length;
        }
    },
    methods: {
        initializeFoodSizeName() {
            if (this.sizeData.length > 0) {
                for (let i = 0; i < this.sizeData.length; i++) {
                    this.foodSizeName[i + 1] = {};
                    this.foodSizeName[i + 1] = this.sizeData[i].name;
                    this.prices[i + 1] = this.sizeData[i].price;
                }
            } else {
                for (let i = 1; i <= this.foodSizes; i++) {
                    this.foodSizeName[i] = {};
                    for (const lang in this.languages) {
                        if (this.languages.hasOwnProperty(lang)) {
                            this.foodSizeName[i][lang] = "";
                        }
                    }
                }
            }
        },
        addFoodSize() {
            this.foodSizes++;
            if (this.foodSizes > this.sizeData.length) {
                for (let i = this.sizeData.length + 1; i <= this.foodSizes; i++) {
                    this.foodSizeName[i] = Object.fromEntries(Object.keys(this.languages).map((lang) => [lang, ""]));
                }
            }
            this.initializeFoodSizeName();
        },
        cancel() {
            this.foodSizes = 0;
            this.$emit("cancelSize");
        },
        removeFoodSize() {
            if (this.foodSizes > 2) {
                this.sizeData.pop();
                this.foodSizes--;
                this.prices = [];
            }

            this.initializeFoodSizeName();
        },
        store() {
            let data = [];
            for (let i = 1; i < this.prices.length; i++) {
                let test = {
                    name: this.foodSizeName[i],
                    price: this.prices[i],
                };
                data.push(test);
            }
            this.$emit("sizeDataFun", data);
        },
    },
};
</script>

<style>
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
