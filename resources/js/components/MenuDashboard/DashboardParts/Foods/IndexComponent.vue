<template>
    <div class="m-4 bg-gray-200 p-4 rounded-md">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">№</th>
                    <th scope="col">name</th>
                    <th scope="col">image</th>
                    <th scope="col">category</th>
                    <th scope="col">description</th>
                    <th scope="col">size</th>
                    <th scope="col">status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="food in Foods" :key="food.index">
                    <th scope="row">1</th>
                    <td>{{ food.name[language] }}</td>
                    <td class="py-3 px-4 w-24"><img :src="food.image[0].image" class="rounded-md w-full h-auto object-cover" alt="food's image" /></td>
                    <td>{{ food.category.name[language] }}</td>
                    <td v-if="food.description">{{ food.description[language] }}</td>
                    <td v-else>no description</td>
                    <td>@mdo</td>
                    <td class="py-3 px-4">{{ food.is_active ? "Active" : "Inactive" }}</td>
                    <td class="py-3 px-4">
                        <button @click="editFood(food.id)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                            <i class="bx bxs-edit"></i>
                        </button>
                        <button @click.prevent="deleteFood(food.id)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            <i class="bx bx-trash"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <create-component v-if="isActiveCreate" @popup-delete-create="myAction" :language="language" :languages="languages"></create-component>
    <edit-component @popup-delete-edit="isVisibilityEdit" :isActiveEdit="isActiveEdit"></edit-component>
</template>

<script>
import axios from "axios";
import CreateComponent from "./Components/CreateComponent.vue";
import EditComponent from "./Components/EditComponent.vue";

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
            Foods: {},
        };
    },
    mounted() {
        this.getFoods();
    },
    methods: {
        getFoods() {
            axios.get("/api/foods").then((res) => {
                console.log(res.data);
                this.Foods = res.data;
                // this.foods = res.data.data.map((item, idx) => ({ ...item, index: idx + 1 }));
            });
        },

        myAction() {
            this.$emit("popupDeleteCreate");
        },
        isVisibilityEdit() {
            this.isActiveEdit = !this.isActiveEdit;
        },

        deleteFood(id) {
            axios
                .delete(`/api/foods/${id}`)
                .then((res) => {
                    this.getFoods();
                })
                .catch((error) => {
                    console.error("Error deleting foods", error);
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
