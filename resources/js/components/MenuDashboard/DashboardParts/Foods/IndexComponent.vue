<template>
    <div class="hide-scrollbar">
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
                    <th scope="row">{{ food.id }}</th>
                    <td>{{ food.name[language] }}</td>
                    <td class="w-24 px-4 py-3"><img :src="food.image[0].image" class="object-cover w-full h-auto rounded-md" alt="food's image" /></td>
                    <td>{{ food.category.name[language] }}</td>
                    <td v-if="food.description">{{ food.description[language] }}</td>
                    <td v-else>no description</td>
                    <td>@mdo</td>
                    <td class="px-4 py-3">{{ food.is_active ? "Active" : "Inactive" }}</td>
                    <td class="px-4 py-3">
                        <button @click="editFood(food.id)" class="px-4 py-2 mr-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                            <i class="bx bxs-edit"></i>
                        </button>
                        <button @click.prevent="deleteFood(food.id)" class="px-4 py-2 font-bold text-white bg-red-500 rounded hover:bg-red-700">
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
                this.Foods = res.data;
                this.Foods = res.data.data.map((item, idx) => ({ ...item, index: idx + 1 }));
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

<style>
.hide-scrollbar{
    @apply p-4 m-4 overflow-hidden overflow-x-scroll overflow-y-scroll bg-gray-200 rounded-md ;
    scrollbar-width: none; /* Firefox */
    -ms-overflow-style: none; /* Internet Explorer and Edge */     
}
.hide-scrollbar::-webkit-scrollbar {
    width: 0px; /* WebKit browsers */
    background: transparent; /* Optional: Hide the background */
}
</style>
