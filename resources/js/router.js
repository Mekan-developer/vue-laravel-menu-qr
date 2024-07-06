import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        component: () => import("./components/MenuUser/IndexComponent.vue"),
        name: "menu.index",
    },
    {
        path: "/dashboard",
        component: () =>
            import("./components/MenuDashboard/IndexComponent.vue"),
        name: "dashboard.index",
        children: [
            {
                path: "",
                component: () =>
                    import(
                        "./components/MenuDashboard/DashboardParts/IndexComponent.vue"
                    ),
                name: "dashboard.parts.index",
            },
            {
                path: "categories",
                component: () =>
                    import(
                        "./components/MenuDashboard/DashboardParts/CategoriesComponent.vue"
                    ),
                name: "dashboard.categories",
                children: [
                    {
                        path: "",
                        component: () =>
                            import(
                                "./components/MenuDashboard/DashboardParts/Categories/IndexComponent.vue"
                            ),
                        name: "dashboard.categories.index",
                    },
                    {
                        path: "sub",
                        component: () =>
                            import(
                                "./components/MenuDashboard/DashboardParts/Categories/SubcategoryComponent.vue"
                            ),
                        name: "dashboard.categories.sub",
                    },
                ],
            },
            {
                path: "foods",
                component: () =>
                    import(
                        "./components/MenuDashboard/DashboardParts/FoodsComponent.vue"
                    ),
                name: "dashboard.foods",
            },
            {
                path: "device-settings",
                component: () =>
                    import(
                        "./components/MenuDashboard/DashboardParts/DevicesettingsComponent.vue"
                    ),
                name: "dashboard.deviceSettings",
            },
            {
                path: "liked-foods",
                component: () =>
                    import(
                        "./components/MenuDashboard/DashboardParts/LikedfoodsComponent.vue"
                    ),
                name: "dashboard.likedFoods",
            },
            {
                path: "settings",
                component: () =>
                    import(
                        "./components/MenuDashboard/DashboardParts/SettingsComponent.vue"
                    ),
                name: "dashboard.settings",
            },
            {
                path: "profile",
                component: () =>
                    import(
                        "./components/MenuDashboard/DashboardParts/ProfileComponent.vue"
                    ),
                name: "dashboard.profile",
            },
        ],
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
