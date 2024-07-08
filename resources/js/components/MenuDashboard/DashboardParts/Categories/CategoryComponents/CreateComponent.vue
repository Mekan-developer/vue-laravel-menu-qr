<template>
    <div v-if="isActiveCreate" class="manual-style flex flex-col justify-center items-center absolute left-0 top-0 z-[9999] w-full h-full bg-[#11101d63] px-16">
        <div class="bg-white rounded-lg p-4">
            <div class="flex justify-end w-full mb-4">
                <div class="flex-grow-1 text-center text-[#216dcfbb] text-[16px]">Category add</div>
                <i @click="$emit('popupDeleteCreate')" class="bx bx-x text-[24px] p-2 cursor-pointer"></i>
            </div>
            <div class="flex flex-wrap justify-center gap-4">
                <div v-for="(lang, code) in langs" :key="code" class="flex-grow-1 form-floating mb-3 overflow-hidden">
                    <input type="text" v-model="name[code]" class="form-control over" id="input-{{ code }}" placeholder="name@example.com" />
                    <label :for="'input-' + code">name of category {{ code }}</label>
                </div>
            </div>
            <div>
                <div class="mb-3">
                    <label for="formFileMultiple" class="form-label">Menu image</label>
                    <input class="form-control" type="file" @change="onChange" id="formFileMultiple" multiple />
                </div>
            </div>
            <div class="mb-4">
                <h1 class="mb-2">Category is active?</h1>
                <ToggleSwitch v-model="isToggled" />
                <!-- <p>Switch is {{ isToggled ? "ON" : "OFF" }}</p> -->
            </div>
            <div class="d-grid gap-2">
                <button v-on:click.prevent="store" class="btn btn-primary" type="submit">Save</button>
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from "vue";
import ToggleSwitch from "./components/ToggleSwitch.vue";
import axios from "axios";

export default {
    props: {
        isActiveCreate: Boolean,
        languages: Object,
    },
    data() {
        const name = {};
        Object.keys(this.languages).forEach((code) => {
            name[code] = "";
        });
        return {
            langs: this.languages,
            name: name,
            image: "",
            isToggled: true,
        };
    },
    methods: {
        store() {
            let formData = new FormData();

            formData.append("name", JSON.stringify(this.name));
            formData.append("image", this.image);
            formData.append("is_active", this.isToggled);

            axios
                .post("/api/category-store", formData)
                .then((res) => {
                    console.log(res);
                })
                .catch((error) => {
                    console.error(error);
                });
            this.$emit("popupDeleteCreate");
            // this.$router.push({ name: "dashboard.categories.index" });
        },
        onChange(e) {
            this.image = e.target.files[0];
        },
    },

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
.manual-style {
    transition: all 0.5s easy;
}

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
