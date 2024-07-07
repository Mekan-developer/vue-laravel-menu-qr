<template>
    <div class="grid-container m-[10px]" v-if="foods">
        <template v-for="food in foods" :key="food.id">
            <a href="#">
                <div class="menu-product_item">
                    <div class="menu-product_item_toolbar">
                        <div style="flex-grow: 1"></div>
                        <button class="btn-like">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#222222" stroke-width="1.2px" x="0px" y="0px" viewBox="-1 -2 14 13" xml:space="preserve">
                                <path
                                    d="M11,1c-0.6-0.6-1.5-1-2.3-1C7.8,0,7,0.4,6.3,1L6,1.3L5.7,1C5,0.3,4.2,0,3.3,0S1.6,0.3,1,1C0.3,1.6,0,2.4,0,3.3S0.3,5,1,5.7
                                      l4.8,4.8C5.9,10.6,6,10.6,6,10.6c0.1,0,0.2,0,0.2-0.1L11,5.7c0.6-0.6,1-1.5,1-2.4S11.7,1.6,11,1z"
                                ></path>
                            </svg>
                        </button>
                    </div>
                    <div class="menu-product_item_img">
                        <img class="menu-product_item_img_full" :src="getImageSrc(food.image)" alt="Item image" decoding="async" />
                    </div>
                    <div class="menu-product_item_name_price py-1 px-[6px]">
                        <div class="menu-product_item_name text-overflow">
                            {{ getTruncatedText(food.name[currentLang]) }}
                        </div>
                        <div class="menu-product_item_price no-wrap">{{ food.price }} $</div>
                    </div>
                </div>
            </a>
        </template>
    </div>
</template>

<script>
export default {
    data() {
        return {
            foodName: "hot chicken katsu curry www",
        };
    },
    props: {
        foods: Object,
        currentLang: String,
    },
    methods: {
        getImageSrc(image) {
            return `/menu-icons/${image}`;
        },
        getTruncatedText(foodName) {
            if (foodName.length > 25) {
                return foodName.substring(0, 23) + "...";
            } else {
                return foodName;
            }
        },
    },
};
</script>

<style scoped>
.grid-container {
    display: grid;
    grid-template-columns: repeat(2, 50%);
    gap: 10px 5px;
    padding-right: 3px;
}
.menu-product_item {
    background-color: #a08f8f3b;
    color: #222222;
    position: relative;
    cursor: pointer;
    -webkit-tap-highlight-color: transparent;
    border-radius: 10px;
    overflow: hidden;
    backdrop-filter: blur(20px);
    /* scroll-snap-align: center; */
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
    aspect-ratio: 1/1;
    margin: auto;
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
