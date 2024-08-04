<template>
    <div class="flex justify-center items-center absolute z-50 top-0 left-0 w-full h-full bg-[#818181cc]">
        <div class="relative flex flex-col gap-4 px-6 py-4 bg-gray-800 rounded-lg shadow-lg">
            <div class="absolute top-2 right-2">
                <i @click="cancel" class="p-2 text-2xl text-white cursor-pointer bx bx-x hover:text-red-500"></i>
            </div>
            <div class="mb-1 text-xl font-semibold text-center text-white">Add food size</div>
            <div class="flex justify-end gap-2 -mb-2">
                <button @click="removeFoodSize" v-if="foodSizes > 1" class="px-4 py-2 font-bold text-white bg-red-500 rounded hover:bg-red-600">- {{ foodSizes }} Remove</button>
                <button @click="addFoodSize" class="px-4 py-2 font-bold text-white bg-green-500 rounded hover:bg-green-600">+ Add Size</button>
            </div>
            <div class="w-full max-h-[300px] overflow-hidden overflow-y-auto no-scrollbar relative px-1">
                <div class="mt-6 mb-2 " v-for="size in foodSizes" :key="size">
                    <div class="p-4 bg-gray-300 border border-gray-300 rounded-md shadow-md">
                        <div class="m-0">
                            <p class="pl-4 text-[18px]">Food's size {{ size }}</p>
                        </div>
                        <div class="flex flex-wrap justify-center gap-4">
                            <div class="flex-grow mb-2 " v-for="(lang, code) in languages" :key="lang.index"> 
                                <label :for="'input-' + size + code" class="leading-[32px] pl-3 text-gray-500 form-label">Category name {{ code }} </label>
                                <input type="text" v-model="foodSizeName[size][code]" class="inputStyle custom-input form-control" :id="'input-' + size + code" placeholder="Category name" />
                                <div v-if="errors[size] && errors[size][code]" class="text-red-500">{{ errors[size][code] }}</div>
                            </div>
                        </div>
                        <div>
                            <input v-model="prices[size]" class="inputStyle form-control" type="number" :placeholder="'price ' + size" />
                            <div v-if="priceErrors[size]" class="text-red-500">{{ priceErrors[size] }}</div>
                        </div>
                    </div>
                </div>

                <div class="sticky bottom-0 flex items-center justify-center w-full h-5 bg-gradient-to-t from-gray-600 to-transparent">
                    <div class="w-full h-full" style="box-shadow: 0 -4px 5px rgba(0, 0, 0, 0.01)"></div>
                </div>
            </div>

            <button @click.prevent="store" class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-600" type="submit">Save</button>
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
    emits: ["cancelSize", "sizeDataFun", "removeSizeData"],
    data() {
        return {
            foodSizes: 2,
            foodSizeName: [],
            prices: [],
            errors: {},
            priceErrors: {},
        };
    },
    created() {
        this.initializeFoodSizeName();
        if (this.sizeData.length > this.foodSizes) {
            this.foodSizes = this.sizeData.length;
        }
    },
    methods: {
        validateForm() {
            this.errors = {};
            this.priceErrors = {};
            for (let i = 1; i <= this.foodSizes; i++) {
                for (const code in this.languages) {
                    if (!this.foodSizeName[i][code]) {
                        if (!this.errors[i]) this.errors[i] = {};
                        this.errors[i][code] = `Food size name ${code} is required.`;
                    }
                }
                if (!this.prices[i]) this.priceErrors[i] = "Food's price is required.";
            }
        },
        initializeFoodSizeName() {
            if (this.sizeData.length > 0) {
                for (let i = 0; i < this.sizeData.length; i++) {
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
            } else if ((this.foodSizes = 2)) {
                this.$emit("removeSizeData");
            }

            this.initializeFoodSizeName();
        },
        store() {
            this.validateForm();
            if (Object.keys(this.errors).length === 0 && Object.keys(this.priceErrors).length === 0) {
                let data = [];
                for (let i = 1; i < this.prices.length; i++) {
                    let test = {
                        name: this.foodSizeName[i],
                        price: this.prices[i],
                    };
                    data.push(test);
                }
                this.$emit("sizeDataFun", data);
            }
        },
    },
};
</script>

<style>
.inputStyle {
    @apply border border-gray-400 text-gray-800 rounded p-2 focus:outline-none focus:border-blue-500;
}
.no-scrollbar::-webkit-scrollbar {
    scrollbar-width: thin;
}
.no-scrollbar {
    scrollbar-width: thin;
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
