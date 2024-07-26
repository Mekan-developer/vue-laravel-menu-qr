<template>
    <div class="flex justify-center items-center absolute z-50 top-0 left-0 w-full h-full bg-gray-800 bg-opacity-75">
        <div class="flex flex-col gap-4 bg-gray-900 p-6 rounded-lg shadow-lg relative">
            <div class="flex justify-between items-center">
                <div class="text-center text-white text-xl font-semibold">Add description</div>
                <div class="pb-1">
                    <i @click="$emit('updateDescActVal')" class="bx bx-x text-2xl p-2 cursor-pointer text-white hover:text-red-500"></i>
                </div>
            </div>
            <div class="space-y-4" v-for="(lang, code) in languages" :key="lang.index">
                <textarea v-model="description[code]" class="min-w-[400px] h-[80px] p-2 bg-gray-200 border border-gray-400 text-gray-800 rounded focus:outline-none focus:border-blue-500" :placeholder="`Enter description ` + code"></textarea>
            </div>
            <button @click.prevent="store" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded w-full mt-4" type="button">Save</button>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        languages: Object,
        descriptionData: Object,
    },
    emits: ["updateDescActVal", "descriptionDataFun"],

    data() {
        return {
            description: {},
        };
    },
    created() {
        if (!this.isEmpty(this.descriptionData)) {
            this.description = this.descriptionData;
        }
    },
    methods: {
        store() {
            const description = {};
            Object.keys(this.description).forEach((key) => {
                if (this.description[key]) {
                    description[key] = this.description[key];
                }
            });
            this.$emit("descriptionDataFun", description);
        },
        isEmpty(obj) {
            return Object.keys(obj).length === 0;
        },
    },
};
</script>

<style></style>
