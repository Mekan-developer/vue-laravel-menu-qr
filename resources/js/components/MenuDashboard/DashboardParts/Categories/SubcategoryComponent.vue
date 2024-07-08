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
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>
                        <button @click="isVisibilityEdit" class="btn btn-info mr-1">
                            <i class="bx bxs-edit"></i>
                        </button>
                        <button class="btn btn-danger">
                            <i class="bx bx-trash"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <create-component @popup-delete-create="myAction" :isActiveCreate="isActiveCreate" :language="language"></create-component>
    <edit-component @popup-delete-edit="isVisibilityEdit" :isActiveEdit="isActiveEdit"></edit-component>
</template>

<script>
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
        return {
            isActiveEdit: false,
        };
    },
    methods: {
        myAction() {
            this.$emit("popupDeleteCreate");
        },
        isVisibilityEdit() {
            this.isActiveEdit = !this.isActiveEdit;
        },
    },
    components: {
        CreateComponent,
        EditComponent,
    },
};
</script>

<style></style>
