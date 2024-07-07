<template>
    <div class="toggle-switch" :class="{ 'is-checked': isChecked }" @click="toggle">
        <div class="switch-handle"></div>
    </div>
</template>

<script>
export default {
    name: "ToggleSwitch",
    props: {
        modelValue: {
            type: Boolean,
            required: true,
        },
    },
    computed: {
        isChecked() {
            return this.modelValue;
        },
    },
    methods: {
        toggle() {
            this.$emit("update:modelValue", !this.modelValue);
        },
    },
};
</script>

<style scoped>
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
