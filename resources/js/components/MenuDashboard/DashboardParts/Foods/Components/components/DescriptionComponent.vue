<template>
    <div class="absolute top-0 left-0 z-50 flex items-center justify-center w-full h-full bg-gray-800 bg-opacity-75">
        <div class="relative flex flex-col gap-4 p-6 bg-gray-900 rounded-lg shadow-lg">
            <div class="flex items-center justify-between">
                <div class="text-xl font-semibold text-center text-white">Add description</div>
                <div class="pb-1">
                    <i @click="$emit('updateDescActVal')" class="p-2 text-2xl text-white cursor-pointer bx bx-x hover:text-red-500"></i>
                </div>
            </div>
            <slot name="langs" ></slot>
            <div class="space-y-4" v-for="(lang, code) in languages" :key="lang.index">
                <textarea v-model="description[code]" class="min-w-[400px] h-[80px] p-2 bg-gray-200 border border-gray-400 text-gray-800 rounded focus:outline-none focus:border-blue-500" :placeholder="`Enter description ` + code"></textarea><br />
                <span class="text-red-600" v-if="errors.description[code]">{{ errors.description[code] }}</span>
            </div>
            <button @click.prevent="store" class="w-full px-4 py-2 mt-4 font-bold text-white bg-blue-500 rounded hover:bg-blue-600" type="button">Save</button>
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
            errors: {
                description: {},
            },
        };
    },
    created() {
        if (!this.isEmpty(this.descriptionData)) {
            this.description = this.descriptionData;
        }
    },
    methods: {
        validation() {
            Object.keys(this.languages).forEach((key) => {
                if (!this.description[key]) this.errors.description[key] = `Description ${key} is required.`;
                else delete this.errors.description[key];
            });
        },
        store() {
            const description = {};
            var a = 0,
                b = 0;
            Object.keys(this.languages).forEach((key, index) => {
                if (this.description[key]) {
                    a++;
                    description[key] = this.description[key];
                } else b++;
            });
            if (a > 0 && b > 0) this.validation();
            else
                Object.keys(this.languages).forEach((key) => {
                    delete this.errors.description[key];
                });

            if (this.isEmpty(this.errors.description)) {
                this.$emit("descriptionDataFun", description);
            }
        },
        isEmpty(obj) {
            return Object.keys(obj).length === 0;
        },
    },
};
</script>

<style></style>
