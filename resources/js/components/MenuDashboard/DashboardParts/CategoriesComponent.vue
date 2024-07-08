<template>
    <div class="flex flex-col h-full">
        <div class="flex justify-between bg-white border-b-2 border-gray-300">
            <ul class="flex list-none px-1 py-0 m-0 uppercase text-[12px] font-bold">
                <router-link @click="statusChangeCat" :to="{ name: 'dashboard.categories.index' }">
                    <li class="p-3">Categories</li>
                </router-link>
                <router-link @click="statusChangeSubCat" :to="{ name: 'dashboard.categories.sub' }">
                    <li class="p-3">SubCategories</li>
                </router-link>
            </ul>
            <div class="flex gap-4 h-full items-center mr-2 p-2">
                <div>
                    <input v-if="activeLinkCat" class="form-control" type="text" placeholder="search category" />
                    <input v-else class="form-control" type="text" placeholder="search subcategory" />
                </div>
                <div>
                    <button v-if="activeLinkCat" @click="isVisibilityCreate" class="btn btn-success whitespace-nowrap">Add cat...</button>
                    <button v-else @click="isVisibilityCreate" class="btn btn-success whitespace-nowrap">Add sub...</button>
                </div>
            </div>
        </div>
        <router-view @popup-delete-create="isVisibilityCreate" :isActiveCreate="isActiveCreate" :language="language" :languages="languages"></router-view>
    </div>
</template>

<script>
export default {
    props: {
        language: String,
        languages: Object,
    },
    data() {
        return {
            isActiveCreate: false,
            activeLinkCat: true,
        };
    },
    mounted() {},

    methods: {
        statusChangeCat() {
            this.activeLinkCat = true;
        },
        statusChangeSubCat() {
            this.activeLinkCat = false;
        },
        isVisibilityCreate() {
            this.isActiveCreate = !this.isActiveCreate;
        },
    },
};
</script>

<style scoped>
.router-link-exact-active {
    @apply border-b-[3px] border-[#11101d] text-[#11101d];
}
</style>
