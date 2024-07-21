<template>
    <div class="m-3 p-3 h-full bg-gray-200 rounded-sm overflow-hidden">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">№</th>
                    <th scope="col">name</th>
                    <th scope="col">image</th>
                    <th scope="col">status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="category in categories" :key="category.id">
                    <th scope="row">{{ category.index }}</th>
                    <td>{{ category.name[language] }}</td>
                    <td class="w-[100px] aspect-square"><img :src="category.image" class="rounded-md" alt="category image" /></td>
                    <td>{{ category.is_active ? "active" : "is not" }}</td>
                    <td>
                        <button @click="editCategory(category.id)" class="btn btn-info mr-1">
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
    <create-component v-if="isActiveCreate" @popup-delete-create="myAction" @get-categories="getCategories" :languages="languages"></create-component>

    <edit-component v-if="isActiveEdit" @popup-delete-edit="isVisibilityEdit" @get-categories="getCategories" :isActiveEdit="isActiveEdit" :category="category" :name="name" :languages="languages" :isToggled="isToggled"></edit-component>
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
        const name = {};
        return {
            isActiveEdit: false,
            categories: [],
            category: {},
            name: name,
            isToggled: false,
            currentComponent: null,
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
            axios.get("/api/get-categories").then((res) => {
                this.categories = res.data.data.map((item, idx) => ({ ...item, index: idx + 1 }));
            });
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
