<template>
    <div id="menu-page">
        <header id="header">
            <div class="row-one">
                <div class="restaurant-name-logo">
                    <div class="restaurant-logo">
                        <img src="icons/star.png" alt="" />
                    </div>
                    <div class="restaurant-name">wagamana</div>
                </div>
                <button @click="toggleVisibility" class="lang">
                    <button class="lang-button btn">English</button>
                    <button class="lang-button btn">English</button>
                </button>
            </div>
            <div class="row-two">
                <div class="categories">
                    <div class="category">
                        <div class="category-img bg-yellow-600 rounded-lg p-1">
                            <img src="icons/popular.png" alt="" />
                        </div>
                        <div class="category-name">Popular</div>
                    </div>
                    <div class="category">
                        <div class="category-img p-1">
                            <img src="icons/popular.png" alt="" />
                        </div>
                        <div class="category-name">Popular</div>
                    </div>
                </div>
            </div>
        </header>
        <section id="main-section" class="py-[10px]">
            <div
                style="scroll-snap-align: center"
                class="subcategories w-full p-2 bg-[#EEEEEE] border-t-gray-200 border-b-gray-200 border-2"
            >
                <div class="buttons flex flex-wrap gap-2">
                    <a href="#">
                        <div
                            class="subActive rounded-full bg-[#252525ce] text-white px-[6px] py-[3px]"
                        >
                            All
                        </div>
                    </a>

                    <a href="#">
                        <div
                            style="box-shadow: 1px 1px 0px #0003"
                            class="rounded-[35px] bg-[#F5F5F5] text-black px-[6px] py-[3px] text-[.95rem]"
                        >
                            Chicken
                        </div>
                    </a>
                    <a href="#">
                        <div
                            style="box-shadow: 1px 1px 0px #0003"
                            class="rounded-[35px] bg-[#F5F5F5] text-black px-[6px] py-[3px] text-[.95rem]"
                        >
                            Chicken
                        </div>
                    </a>
                    <a href="#">
                        <div
                            style="box-shadow: 1px 1px 0px #0003"
                            class="rounded-[35px] bg-[#F5F5F5] text-black px-[6px] py-[3px] text-[.95rem]"
                        >
                            Chicken
                        </div>
                    </a>
                    <a href="#">
                        <div
                            style="box-shadow: 1px 1px 0px #0003"
                            class="rounded-[35px] bg-[#F5F5F5] text-black px-[6px] py-[3px] text-[.95rem]"
                        >
                            Chicken
                        </div> </a
                    ><a href="#">
                        <div
                            style="box-shadow: 1px 1px 0px #0003"
                            class="rounded-[35px] bg-[#F5F5F5] text-black px-[6px] py-[3px] text-[.95rem]"
                        >
                            Chicken
                        </div> </a
                    ><a href="#">
                        <div
                            style="box-shadow: 1px 1px 0px #0003"
                            class="rounded-[35px] bg-[#F5F5F5] text-black px-[6px] py-[3px] text-[.95rem]"
                        >
                            Chicken
                        </div> </a
                    ><a href="#">
                        <div
                            style="box-shadow: 1px 1px 0px #0003"
                            class="rounded-[35px] bg-[#F5F5F5] text-black px-[6px] py-[3px] text-[.95rem]"
                        >
                            Chicken
                        </div> </a
                    ><a href="#">
                        <div
                            style="box-shadow: 1px 1px 0px #0003"
                            class="rounded-[35px] bg-[#F5F5F5] text-black px-[6px] py-[3px] text-[.95rem]"
                        >
                            Chicken
                        </div> </a
                    ><a href="#">
                        <div
                            style="box-shadow: 1px 1px 0px #0003"
                            class="rounded-[35px] bg-[#F5F5F5] text-black px-[6px] py-[3px] text-[.95rem]"
                        >
                            Chicken
                        </div> </a
                    ><a href="#">
                        <div
                            style="box-shadow: 1px 1px 0px #0003"
                            class="rounded-[35px] bg-[#F5F5F5] text-black px-[6px] py-[3px] text-[.95rem]"
                        >
                            Chicken
                        </div>
                    </a>
                </div>
            </div>
            <div class="grid-container m-[10px]">
                <a href="#">
                    <div class="menu-product_item">
                        <div class="menu-product_item_toolbar">
                            <div style="flex-grow: 1"></div>
                            <button class="btn-like">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    stroke="#222222"
                                    stroke-width="1.2px"
                                    x="0px"
                                    y="0px"
                                    viewBox="-1 -2 14 13"
                                    xml:space="preserve"
                                >
                                    <path
                                        d="M11,1c-0.6-0.6-1.5-1-2.3-1C7.8,0,7,0.4,6.3,1L6,1.3L5.7,1C5,0.3,4.2,0,3.3,0S1.6,0.3,1,1C0.3,1.6,0,2.4,0,3.3S0.3,5,1,5.7
                                      l4.8,4.8C5.9,10.6,6,10.6,6,10.6c0.1,0,0.2,0,0.2-0.1L11,5.7c0.6-0.6,1-1.5,1-2.4S11.7,1.6,11,1z"
                                    ></path>
                                </svg>
                            </button>
                        </div>
                        <div class="menu-product_item_img">
                            <img
                                class="menu-product_item_img_full"
                                src="https://instalacarte.com/media/cache/mobile_image/product/23/131/f035a5b685caa0cb87b98d8a8babd57c.png"
                                alt="Item image"
                                decoding="async"
                            />
                        </div>
                        <div class="menu-product_item_name_price py-1 px-[6px]">
                            <div class="menu-product_item_name text-overflow">
                                {{ getTruncatedText(foodName) }}
                            </div>
                            <div class="menu-product_item_price no-wrap">
                                9.75 $
                            </div>
                        </div>
                    </div>
                </a>

                <!--  -->
                <a href="#">
                    <div class="menu-product">
                        <div class="menu-product_item">
                            <div class="menu-product_item_toolbar">
                                <div style="flex-grow: 1"></div>
                                <button class="btn-like btn-like-active">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        stroke="#222222"
                                        stroke-width="1.2px"
                                        x="0px"
                                        y="0px"
                                        viewBox="-1 -2 14 13"
                                        xml:space="preserve"
                                    >
                                        <path
                                            d="M11,1c-0.6-0.6-1.5-1-2.3-1C7.8,0,7,0.4,6.3,1L6,1.3L5.7,1C5,0.3,4.2,0,3.3,0S1.6,0.3,1,1C0.3,1.6,0,2.4,0,3.3S0.3,5,1,5.7
                                      l4.8,4.8C5.9,10.6,6,10.6,6,10.6c0.1,0,0.2,0,0.2-0.1L11,5.7c0.6-0.6,1-1.5,1-2.4S11.7,1.6,11,1z"
                                        ></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="menu-product_item_img">
                                <img
                                    class="menu-product_item_img_full"
                                    src="https://instalacarte.com/media/cache/mobile_image/product/23/131/f035a5b685caa0cb87b98d8a8babd57c.png"
                                    alt="Item image"
                                    decoding="async"
                                />
                            </div>
                            <div class="menu-product_item_name_price">
                                <div
                                    class="menu-product_item_name text-overflow"
                                >
                                    {{ getTruncatedText(foodName) }}
                                </div>
                                <div class="menu-product_item_price no-wrap">
                                    9.75 £
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#">
                    <div class="menu-product">
                        <div class="menu-product_item">
                            <div class="menu-product_item_toolbar">
                                <div style="flex-grow: 1"></div>
                                <button class="btn-like btn-like-active">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        stroke="#222222"
                                        stroke-width="1.2px"
                                        x="0px"
                                        y="0px"
                                        viewBox="-1 -2 14 13"
                                        xml:space="preserve"
                                    >
                                        <path
                                            d="M11,1c-0.6-0.6-1.5-1-2.3-1C7.8,0,7,0.4,6.3,1L6,1.3L5.7,1C5,0.3,4.2,0,3.3,0S1.6,0.3,1,1C0.3,1.6,0,2.4,0,3.3S0.3,5,1,5.7
                                      l4.8,4.8C5.9,10.6,6,10.6,6,10.6c0.1,0,0.2,0,0.2-0.1L11,5.7c0.6-0.6,1-1.5,1-2.4S11.7,1.6,11,1z"
                                        ></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="menu-product_item_img">
                                <img
                                    class="menu-product_item_img_full"
                                    src="https://instalacarte.com/media/cache/mobile_image/product/23/131/f035a5b685caa0cb87b98d8a8babd57c.png"
                                    alt="Item image"
                                    decoding="async"
                                />
                            </div>
                            <div class="menu-product_item_name_price">
                                <div
                                    class="menu-product_item_name text-overflow"
                                >
                                    hot chicken katsu curry
                                </div>
                                <div class="menu-product_item_price no-wrap">
                                    9.75 $
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </section>
        <footer></footer>
        <div v-if="isVisible">
            <div class="popup-lang w-full h-full absolute top-0 left-0 z-20">
                <div class="w-[300px] bg-white z-30 rounded p-2 m-4">
                    <div class="flex p-2 mb-1">
                        <div class="flex-grow"></div>
                        <button
                            @click="toggleVisibility"
                            class="flex justify-center items-center rounded-full bg-gray-400 w-[26px] h-[26px]"
                        >
                            <img src="/icons/cros.svg" alt="" />
                        </button>
                    </div>
                    <div
                        class="flex flex-col justify-center gap-2 mb-3 w-full h-full text-white"
                    >
                        <div class="p-2 bg-gray-400">
                            <p>English</p>
                        </div>
                        <div class="p-2 bg-gray-400">
                            <p>Turkmen</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
// import HeaderComponent from "./HeaderComponent.vue";

export default {
    data() {
        return {
            isVisible: false,
            foodName: "hot chicken katsu curry www",
            subCategories: null,
        };
    },

    methods: {
        getTruncatedText(foodName) {
            if (this.foodName.length > 25) {
                return this.foodName.substring(0, 23) + "...";
            }
            return this.foodName;
        },

        toggleVisibility() {
            this.isVisible = !this.isVisible;
        },
    },
};
</script>

<style>
.popup-lang {
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: rgba(82, 92, 107, 0.274);
}

#menu-page {
    display: flex;
    flex-flow: column;
    max-width: 450px;
    height: 100vh;
    margin: auto;
    box-shadow: 0 0 10px #0003;
}
.row-one {
    display: flex;
    align-items: center;
    padding: 5px 20px;
}
.restaurant-name-logo {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-basis: 100%;
}
.restaurant-name-logo > .restaurant-logo {
    width: 45px;
    height: 45px;
}

.restaurant-name {
    font-size: 1.3rem;
    color: black;
    font-size: 1.3rem;
    margin: 0;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.lang {
    width: fit-content;
}
.lang-button {
    background-color: #f5f5f5;
    color: #333333;
    box-shadow: 1px 1px 3px #0000004d;
    padding: 4px 6px;
    border-radius: 99999px;
}
/* row-two */
.row-two {
    overflow-x: auto;
    position: sticky;
    top: 0;
}
.categories {
    display: flex;
}
.category {
    display: flex;
    flex-flow: column;
    justify-content: center;
    align-items: center;
    margin: 0 5px;
    padding: 10px;
    cursor: pointer;
}
.category-img {
    width: 40px;
    height: auto;
}
#main-section {
    overflow-y: scroll;
    scroll-snap-type: y mandatory;
    padding-bottom: 55px;
}
.grid-container {
    display: grid;
    grid-template-columns: repeat(2, 50%);
    gap: 10px 5px;
    padding-right: 3px;
}
.menu-product_item {
    background-color: #fafafa;
    color: #222222;
    position: relative;
    cursor: pointer;
    -webkit-tap-highlight-color: transparent;
    border-radius: 10px;
    overflow: hidden;
    backdrop-filter: blur(20px);
    scroll-snap-align: center;
}
.menu-product_item_toolbar {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    display: flex;
    z-index: 1;
    padding: 10px;
}
.btn-like {
    background-color: #eeeeee;
    padding: 5px;
    width: 22px;
    height: 22px;
    border-radius: 100%;
}
.btn-like-active svg {
    fill: #be0707;
    stroke: none;
}
.menu-product_item_img {
    height: 130px;
    position: relative;
}
.menu-product_item_img img {
    object-fit: cover;
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
}
img {
    overflow: clip;
}
.menu-product_item_name_price {
    display: flex;
    justify-content: space-between;
}
</style>
