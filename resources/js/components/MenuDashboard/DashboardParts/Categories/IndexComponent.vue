<template>
    <div class="m-4 bg-gray-200 p-4 rounded-md">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">№</th>
                    <th scope="col">name</th>
                    <th scope="col">image</th>
                    <th scope="col">status</th>
                    <th scope="col">Edit/Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="category in categories" :key="category.id">
                    <th scope="row">{{ category.id }}</th>
                    <td>{{ category.name[language] }}</td>
                    <td><img :src="getImageUrl(category.image)" alt="category image" /></td>
                    <td>{{ category.is_active ? "active" : "is not" }}</td>
                    <td>
                        <button @click="isVisibilityEdit" class="btn btn-info mr-1">
                            <i class="bx bxs-edit"></i>
                        </button>
                        <button @click.prevent="deleteCategory(category.id)" class="btn btn-danger">
                            <i class="bx bx-trash"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <create-component @popup-delete-create="myAction" @get-categories="getCategories" :isActiveCreate="isActiveCreate" :languages="languages"></create-component>
    <edit-component @popup-delete-edit="isVisibilityEdit" :isActiveEdit="isActiveEdit"></edit-component>
</template>

<script>
import axios from "axios";
import CreateComponent from "./CategoryComponents/CreateComponent.vue";
import EditComponent from "./CategoryComponents/EditComponent.vue";

export default {
    props: {
        language: String,
        languages: Object,
        isActiveCreate: Boolean,
    },
    emits: ["popupDeleteCreate"],
    data() {
        return {
            isActiveEdit: false,
            categories: [],
        };
    },
    created() {
        this.getCategories();
    },
    methods: {
        myAction() {
            this.$emit("popupDeleteCreate");
        },
        isVisibilityEdit() {
            this.isActiveEdit = !this.isActiveEdit;
        },
        getCategories() {
            axios
                .get("/api/get-categories")
                .then((res) => {
                    this.categories = res.data;
                })
                .catch((error) => {
                    console.error("Error fetching categories", error);
                });
        },
        getImageUrl(filename) {
            return `/storage/web_images/categories/${filename}`;
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
    },
    components: {
        CreateComponent,
        EditComponent,
    },
};
</script>

<style></style>
