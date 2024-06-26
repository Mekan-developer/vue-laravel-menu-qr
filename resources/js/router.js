import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        component: () => import("./components/MenuUser/MenuComponent.vue"),
        name: "menu.all",
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
