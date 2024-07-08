<template>
    <div class="popup-main" v-show="visibility">
        <div class="popup-lang">
            <div class="langs-div bg-white z-30 rounded p-2 m-4 box-border">
                <div class="flex p-2 mb-1">
                    <div class="flex-grow"></div>
                    <button @click="toggleVisibility" class="flex justify-center items-center rounded-full bg-gray-400 w-[26px] h-[26px]">
                        <img :src="crosSVG()" alt="" />
                    </button>
                </div>
                <div class="flex flex-col justify-center gap-2 mb-3 w-full h-full text-white">
                    <button v-for="(lang, index) in langs" :key="index" class="p-2 bg-gray-400" @click="changeLang(index)">
                        <p>{{ lang }}</p>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        visibility: Boolean,
        langs: Object,
    },
    methods: {
        toggleVisibility() {
            this.$parent.toggleVisibility();
        },
        changeLang(lang) {
            this.$emit("change-language", lang);
            this.toggleVisibility();
        },
        crosSVG() {
            return "/menu-icons/cros.svg";
        },
    },
};
</script>

<style scoped>
/* popup animation style start */
.popup-main {
    position: absolute;
    top: 0;
    left: 0;
    background-color: rgba(82, 92, 107, 0.274);
    width: 100%;
    height: 100%;
    overflow: hidden;
}
.popup-lang {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
    top: -550px;
    animation: drop 1.8s ease forwards;
}
/* popup animation style end */

@keyframes drop {
    0% {
    }
    30% {
        transform: translateY(600px);
    }
    100% {
        transform: translateY(590px);
    }
}

.langs-div {
    position: relative;
    width: 260px;
    height: auto;
    overflow: hidden;
    animation: widthOut 1.5s ease forwards;
}
@keyframes widthOut {
    0% {
        width: 0px;
    }
    80% {
        width: 320px;
    }
    100% {
        width: 280px;
    }
}
</style>
