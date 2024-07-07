<template>
    <div v-if="isActiveCreate" class="flex flex-col justify-center items-center absolute left-0 top-0 z-[9999] w-full h-full bg-[#11101d63] px-16">
        <div class="bg-white rounded-lg p-4">
            <div class="flex justify-end w-full mb-4">
                <div class="flex-grow-1 text-center text-[#216dcfbb] text-[16px]">Category add</div>
                <i @click="$emit('popupDeleteCreate')" class="bx bx-x text-[24px] p-2 cursor-pointer"></i>
            </div>
            <div class="flex flex-wrap justify-center gap-4">
                <div class="flex-grow-1 form-floating mb-3 overflow-hidden" v-for="lang in langs" :key="lang.index">
                    <input type="text" :name="`data_name_${lang}`" class="form-control over" id="floatingInput" placeholder="name@example.com" />
                    <label for="floatingInput">category name {{ lang }}</label>
                </div>
            </div>
            <div>
                <div class="mb-3">
                    <label for="formFileMultiple" class="form-label">Menu image</label>
                    <input class="form-control" type="file" id="formFileMultiple" multiple />
                </div>
            </div>
            <div class="mb-4">
                <h1 class="mb-2">Category is active?</h1>
                <ToggleSwitch v-model="isToggled" />
                <!-- <p>Switch is {{ isToggled ? "ON" : "OFF" }}</p> -->
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-primary" type="button">Save</button>
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from "vue";
import ToggleSwitch from "./components/ToggleSwitch.vue";

export default {
    props: {
        isActiveCreate: Boolean,
    },
    data() {
        return {
            langs: ["tm", "en", "ru", "tk"],
        };
    },

    methods: {},
    setup() {
        const isToggled = ref(true);

        return {
            isToggled,
        };
    },
    components: {
        ToggleSwitch,
    },
};
</script>

<style>
.toggle-switch {
    width: 50px;
    height: 25px;
    background-color: #ccc;
    border-radius: 25px;
    position: relative;
    cursor: pointer;
    transition: background-color 0.3s;
}
.toggle-switch.is-checked {
    background-color: #4caf50;
}
.switch-handle {
    width: 23px;
    height: 23px;
    background-color: #fff;
    border-radius: 50%;
    position: absolute;
    top: 1px;
    left: 1px;
    transition: left 0.3s;
}
.toggle-switch.is-checked .switch-handle {
    left: 26px;
}
</style>
