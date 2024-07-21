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
        <index-component @popup-delete-create="isVisibilityCreate" :isActiveCreate="isActiveCreate" :language="language" :languages="languages"></index-component>
    </div>
</template>

<script>
import IndexComponent from "./Foods/IndexComponent.vue";

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
    components: {
        IndexComponent,
    },
};
</script>

<style>
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
