<template>
    <div>
        <div class="flex justify-end bg-white border-b-2 border-gray-300">
            <div class="flex gap-4 h-full items-center mr-2 p-2">
                <div>
                    <input class="form-control" type="text" placeholder="search food" />
                </div>
                <div>
                    <button @click="isVisibilityCreate" class="btn btn-success whitespace-nowrap">Add Food</button>
                </div>
            </div>
        </div>
        <index-component @popup-delete-create="isVisibilityCreate" :isActiveCreate="isActiveCreate" :language="language"></index-component>
    </div>
</template>

<script>
import IndexComponent from "./Foods/IndexComponent.vue";

export default {
    props: {
        language: String,
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
    components: {
        IndexComponent,
    },
};
</script>

<style></style>
