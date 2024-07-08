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
    mounted() {
        this.getLocale();
    },
    // mounted() {},
    methods: {
        getLocale() {
            axios.get("/api/get-locale").then((response) => {
                this.language = response.data.lang;
            });
            this.getMessage(this.language);
        },
        getMessage(lang) {
            axios.get(`/api/welcome-message?lang=${lang}`).then((response) => {
                this.message = response.data.message;
                console.log(response.data.message);
            });
        },
        changeLanguage(lang) {
            axios
                .get(`/api/change-lang?lang=${lang}`)
                .then((response) => {
                    // Handle response if needed
                    console.log(response.data.success); // Assuming response is JSON with 'success' key
                })
                .catch((error) => {
                    console.error("Error changing lanuage:", error);
                });
            this.language = lang;
            this.getMessage(lang);
        },
    },
};
</script>
