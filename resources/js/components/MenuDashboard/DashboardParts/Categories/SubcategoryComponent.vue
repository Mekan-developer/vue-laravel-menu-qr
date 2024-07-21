<template>
    <div class="m-3 p-3 h-full bg-gray-200 rounded-sm overflow-hidden">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">№</th>
                    <th scope="col">name</th>
                    <th scope="col">parent name</th>
                    <th scope="col">image</th>
                    <th scope="col">status</th>
                    <th scope="col" class="text-center items-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="category in categories" :key="category.id">
                    <th scope="row">{{ category.index }}</th>
                    <td>{{ category.name[language] }}</td>
                    <td>{{ category.parent.name[language] }}</td>
                    <td class="w-[100px] aspect-square"><img :src="category.image" class="rounded-md" alt="category image" /></td>
                    <td>{{ category.is_active ? "active" : "not active" }}</td>
                    <td class="text-center items-center">
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
