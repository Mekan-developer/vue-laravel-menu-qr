<template>
    <div v-if="isActiveEdit" class="edit-food">
        <div class="bg-white rounded-lg p-4">
            <div class="flex justify-end w-full mb-4">
                <div class="flex-grow-1 text-center text-[#216dcfbb] text-[16px]">Category edit</div>
                <i @click="$emit('popupDeleteEdit')" class="bx bx-x text-[24px] p-2 cursor-pointer"></i>
            </div>
            <div class="flex flex-wrap justify-center gap-4">
                <div class="flex-grow-1 form-floating mb-3 overflow-hidden" v-for="lang in langs" :key="lang.index">
                    <input type="text" v-model="names['data_name_' + lang]" class="form-control" id="floatingInput" placeholder="name@example.com" />
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
    },
    data() {
        return {
            names: {
                data_name_en: "english",
                data_name_tm: "turkmen",
                data_name_ru: "russian",
            },
            langs: ["tm", "en", "ru"],
        };
    },
};
</script>

<style>
.edit-food{
    @apply flex flex-col justify-center items-center absolute left-0 top-0 z-[9999] w-full h-full bg-[#11101d63] px-16;
}
</style>
