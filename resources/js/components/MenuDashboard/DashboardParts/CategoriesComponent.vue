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
                    <input v-if="this.$route.name == 'dashboard.categories.index'" class="form-control" type="text" placeholder="search category" />
                    <input v-else class="form-control" type="text" placeholder="search subcategory" />
                </div>
                <div>
                    <button v-if="this.$route.name == 'dashboard.categories.index'" @click="isVisibilityCreate" class="btn btn-success whitespace-nowrap">Add cat...</button>
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

<style>
.router-link-exact-active {
    @apply border-b-[3px] border-[#11101d] text-[#11101d];
}

/* CU-create update style for toggle switch start */
.switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 25px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: 0.4s;
    transition: 0.3s;
}

.slider:before {
    position: absolute;
    content: "";
    width: 23px;
    height: 23px;
    left: 1px;
    bottom: 1px;
    background-color: white;
    -webkit-transition: 0.4s;
    transition: 0.4s;
}

input:checked + .slider {
    background-color: #2196f3;
}

input:focus + .slider {
    box-shadow: 0 0 1px #2196f3;
}

input:checked + .slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
    border-radius: 34px;
}

.slider.round:before {
    border-radius: 50%;
}
/* CU-create update style for toggle switch end */
</style>
