<template>
    <div class="category-style">
        <table class="min-w-full bg-white rounded-lg">
            <thead class="sticky -top-3 ">
                <tr  class="w-full text-left text-white bg-gray-900">
                    <th scope="col" class="px-4 py-3">№</th>
                    <th scope="col" class="px-4 py-3">Name</th>
                    <th scope="col" class="px-4 py-3">Parent Name</th>
                    <th scope="col" class="px-4 py-3">Image</th>
                    <th scope="col" class="px-4 py-3">Status</th>
                    <th scope="col" class="px-4 py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="category in categories" :key="category.id" class="border-b hover:bg-gray-200">
                    <th scope="row" class="px-4 py-3">{{ category.index }}</th>
                    <td class="px-4 py-3">{{ category.name[language] }}</td>
                    <td class="px-4 py-3">{{ category.parent.name[language] }}</td>
                    <td class="w-24 px-4 py-3">
                        <img :src="category.image" class="object-cover w-full h-auto rounded-md" alt="category image" />
                    </td>
                    <td class="px-4 py-3">{{ category.is_active ? "Active" : "Inactive" }}</td>
                    <td class="px-4 py-3 text-center">
                        <button @click="editCategory(category.id)" class="px-4 py-2 mr-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                            <i class="bx bxs-edit"></i>
                        </button>
                        <button @click.prevent="deleteCategory(category.id)" class="px-4 py-2 font-bold text-white bg-red-500 rounded hover:bg-red-700">
                            <i class="bx bx-trash"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <create-component v-if="isActiveCreate" @popup-delete-create="myAction" @get-categories="getCategories" :language="language" :languages="languages"></create-component>
    <edit-component v-if="isActiveEdit" @popup-delete-edit="isVisibilityEdit" @get-categories="getCategories" :category="category" :name="name" :languages="languages" :language="language" :isToggled="isToggled"></edit-component>
</template>

<script>
import api from "../../../../api";
import CreateComponent from "./SubcategoryComponents/CreateComponent.vue";
import EditComponent from "./SubcategoryComponents/EditComponent.vue";

export default {
    props: {
        isActiveCreate: Boolean,
        language: String,
        languages: Object,
    },
    emits: ["popupDeleteCreate"],
    data() {
        const name = {};
        return {
            isActiveEdit: false,
            categories: [],
            name: name,
            isToggled: true,
            parent_id: null,
        };
    },
    created() {
        this.getCategories(true);
    },
    methods: {
        myAction() {
            this.$emit("popupDeleteCreate");
        },
        isVisibilityEdit() {
            this.isActiveEdit = !this.isActiveEdit;
        },
        async getCategories() {
            try {
                const response = await api.get("/api/get-categories", {
                    params: {
                        parent: parent,
                    },
                });
                this.categories = response.data.data.map((item, idx) => ({ ...item, index: idx + 1 }));
            } catch (error) {
                console.error("Error fetching categories:", error);
            }
        },
        editCategory(id) {
            api.get(`/api/edit-category/${id}`).then((res) => {
                this.category = res.data.category;
                this.isVisibilityEdit();
                this.input_names();
                this.isToggled = res.data.category.is_active ? true : false;
            });
        },
        deleteCategory(id) {
            api.delete(`/api/delete-category/${id}`)
                .then((res) => {
                    this.getCategories();
                })
                .catch((error) => {
                    console.error("Error deleting categories", error);
                });
        },
        input_names() {
            Object.keys(this.languages).forEach((code) => {
                this.name[code] = this.category.name[code];
            });
        },
    },
    components: {
        CreateComponent,
        EditComponent,
    },
};
</script>

<style scoped>
.category-style{
    @apply h-full p-3 m-3 overflow-hidden overflow-x-scroll overflow-y-scroll bg-gray-100 rounded-md shadow-lg;
    scrollbar-width: thin;
}
</style>
