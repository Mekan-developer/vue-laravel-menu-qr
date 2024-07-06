<template>
    <div v-if="isActiveEdit" class="flex flex-col justify-center items-center absolute left-0 top-0 z-[9999] w-full h-full bg-[#11101d63] px-16">
        <div class="bg-white rounded-lg p-4">
            <div class="flex justify-end w-full mb-4">
                <div class="flex-grow-1 text-center text-[#216dcfbb] text-[16px]">Sub Category edit</div>
                <i @click="$emit('popupDeleteEdit')" class="bx bx-x text-[24px] p-2 cursor-pointer"></i>
            </div>

            <select class="form-select mb-4" aria-label="Default select example">
                <!-- <option selected default :v-model="category.id">{{ category.name[language] }}</option> -->

                <option v-for="category in categories" :key="category.id">{{ category.name }}</option>
            </select>

            <div class="flex flex-wrap justify-center gap-4">
                <div class="flex-grow-1 form-floating mb-3 overflow-hidden" v-for="lang in langs" :key="lang.id">
                    <input type="text" v-model="category.subCategory.name[lang]" class="form-control" id="floatingInput" placeholder="name@example.com" />
                    <label for="floatingInput">category name {{ lang }}</label>
                </div>
            </div>
            <div>
                <div class="mb-3">
                    <label for="formFileMultiple" class="form-label">Menu image</label>
                    <input class="form-control" type="file" id="formFileMultiple" multiple />
                </div>
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-primary" type="button">Save</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        isActiveEdit: Boolean,
        language: String,
    },
    data() {
        return {
            langs: ["tm", "en", "ru"],
            categories: {
                id: 1,
                name: {
                    tm: "catTm",
                    en: "catEn",
                    ru: "catRU",
                },
                id: 4,
                name: {
                    tm: "catTTM",
                    en: "catEnn",
                    ru: "CatRUU",
                },
            },
            category: {
                id: 1,
                name: {
                    tm: "catTm",
                    en: "catEn",
                    ru: "catRU",
                },
                subCategory: {
                    id: 2,
                    name: {
                        tm: "SubCatTM",
                        ru: "SubCatRU",
                        en: "SubCatEN",
                    },
                },
            },
        };
    },
    mounted() {},
};
</script>

<style></style>
