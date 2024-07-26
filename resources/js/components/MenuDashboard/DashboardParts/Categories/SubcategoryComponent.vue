<template>
    <div class="m-3 p-3 h-full bg-gray-100 rounded-lg shadow-lg overflow-hidden">
        <table class="min-w-full bg-white rounded-lg">
            <thead class="bg-gray-900 text-white">
                <tr>
                    <th scope="col" class="py-3 px-4">№</th>
                    <th scope="col" class="py-3 px-4">Name</th>
                    <th scope="col" class="py-3 px-4">Parent Name</th>
                    <th scope="col" class="py-3 px-4">Image</th>
                    <th scope="col" class="py-3 px-4">Status</th>
                    <th scope="col" class="py-3 px-4 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="category in categories" :key="category.id" class="border-b hover:bg-gray-200">
                    <th scope="row" class="py-3 px-4">{{ category.index }}</th>
                    <td class="py-3 px-4">{{ category.name[language] }}</td>
                    <td class="py-3 px-4">{{ category.parent.name[language] }}</td>
                    <td class="py-3 px-4 w-24">
                        <img :src="category.image" class="rounded-md w-full h-auto object-cover" alt="category image" />
                    </td>
                    <td class="py-3 px-4">{{ category.is_active ? "Active" : "Inactive" }}</td>
                    <td class="py-3 px-4 text-center">
                        <button @click="editCategory(category.id)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                            <i class="bx bxs-edit"></i>
                        </button>
                        <button @click.prevent="deleteCategory(category.id)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
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
import axios from "axios";
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
                const response = await axios.get("/api/get-categories", {
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
            axios.get(`/api/edit-category/${id}`).then((res) => {
                this.category = res.data.category;
                this.isVisibilityEdit();
                this.input_names();
                this.isToggled = res.data.category.is_active ? true : false;
            });
        },
        deleteCategory(id) {
            axios
                .delete(`/api/delete-category/${id}`)
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

<style></style>
