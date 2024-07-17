<template>
    <div class="flex flex-col justify-center items-center absolute left-0 top-0 z-[9999] w-full h-full bg-[#11101d63] px-16">
        <div class="bg-white rounded-lg p-4">
            <div class="flex justify-end w-full mb-4">
                <div class="flex-grow-1 text-center font-bold text-[#216ccf] text-[16px]">Category edit</div>
                <i @click="$emit('popupDeleteEdit')" class="bx bx-x text-[24px] p-2 cursor-pointer"></i>
            </div>
            <div class="flex flex-wrap justify-center gap-4">
                <div class="flex-grow-1 form-floating mb-3 overflow-hidden" v-for="(lang, index) in languages" :key="index">
                    <input type="text" v-model="name[index]" class="form-control" :id="'floatingInput' + lang" placeholder="name@example.com" />
                    <label :for="'floatingInput' + lang">category {{ index }}</label>
                </div>
            </div>
            <div>
                <div class="mb-3">
                    <label for="formFileMultiple" class="form-label">Menu image</label>
                    <input class="form-control" type="file" @change="onChange" id="formFileMultiple" />
                </div>
            </div>
            <div class="mb-4 flex gap-2 text-center items-center">
                <label class="switch">
                    <input type="checkbox" v-model="isActive" />
                    <span class="slider round"></span>
                </label>
                <span>is active</span>
            </div>

            <div class="d-grid gap-2">
                <button v-on:click.prevent="update(category.id)" class="btn btn-primary" type="submit">Save</button>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    props: {
        category: Object,
        languages: Object,
        name: Object,
        isToggled: Boolean,
    },
    data() {
        return {
            isActive: true,
            image: "",
        };
    },
    mounted() {
        this.isActive = this.isToggled;
    },
    methods: {
        update(id) {
            let formData = new FormData();

            formData.append("name", JSON.stringify(this.name));
            formData.append("image", this.image);
            formData.append("is_active", this.isActive);
            axios
                .post(`/api/category-update/${id}`, formData, {
                    headers: {
                        Accept: "application/json",
                    },
                })
                .then(() => {
                    this.$emit("popupDeleteEdit");
                    this.$emit("getCategories");
                });
        },
        onChange(e) {
            this.image = e.target.files[0];
        },
    },
};
</script>

<style>
.switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
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
    transition: 0.4s;
}

.slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
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
</style>
