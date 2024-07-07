<template>
    <div>
        <div>{{ message }} - asdsad</div>
        <router-view :language="language" @changeLanguage="changeLanguage"></router-view>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            message: "",
            language: "",
        };
    },
    created() {
        axios.get("/api/welcome-message").then((response) => {
            this.message = response.data.message;
        });
        this.getLocale();
    },
    // mounted() {},
    methods: {
        getLocale() {
            axios.get("/api/get-locale").then((response) => {
                this.language = response.data.lang;
            });
        },
        changeLanguage(lang) {
            axios.get(`/api/change-lang?lang=${lang}`).then((response) => {
                this.language = response.data.lang;
            });
        },
    },
};
</script>
