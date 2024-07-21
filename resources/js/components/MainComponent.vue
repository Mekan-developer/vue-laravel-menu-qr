<template>
    <div>
        <!-- <div>{{ message }} - asdsad</div> -->
        <router-view :language="language" @changeLanguage="changeLanguage" :languages="languages"></router-view>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            message: "",
            language: "",
            languages: {},
        };
    },
    mounted() {
        this.getLocale();
        this.getSupportedLocales();
    },
    methods: {
        getLocale() {
            axios.get("/api/get-locale").then((response) => {
                this.language = response.data.lang;
            });
            this.getMessage(this.language);
        },
        getSupportedLocales() {
            axios
                .get("/api/languages")
                .then((response) => {
                    this.languages = response.data.languages;
                })
                .catch((error) => {
                    console.error("Error fetching languages:", error);
                });
        },

        changeLanguage(lang) {
            axios.get(`/api/change-lang?lang=${lang}`).then((response) => {});
            this.language = lang;
            this.getMessage(lang);
        },
        getMessage(lang) {
            axios.get(`/api/welcome-message?lang=${lang}`).then((response) => {
                this.message = response.data.message;
            });
        },
    },
};
</script>
