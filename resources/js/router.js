import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/", name: "menu.index",
        component: () => import("./components/MenuUser/IndexComponent.vue"),
    },
    {
        path: "/login", name: "user.login",
        component: () => import("./components/Auth/LoginComponent.vue"),
    },
    {
        path: "/register", name: "user.register",
        component: () => import("./components/Auth/RegisterComponent.vue"),
    },
    {
        path: "/dashboard", name: "dashboard.index",
        component: () => import("./components/MenuDashboard/IndexComponent.vue"),
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
                component: () => import("./components/MenuDashboard/DashboardParts/SettingsComponent.vue"),
                name: "dashboard.settings",
            },
            {
                path: "profile", component: () => import("./components/MenuDashboard/DashboardParts/ProfileComponent.vue"),
                name: "dashboard.profile",
            },

            
        ],
    },
    {
        path: '/:pathMatch(.*)*',
        name: '404',
        component: () => import("./components/notFoundPage/ErrorComponent.vue"),  
    },
];



const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to,from,next) =>{
    const access_token = localStorage.getItem('access_token')
    if(to.name === 'menu.index')
        return next()
    if(!access_token) {
        if(to.name === 'user.login' || to.name === 'user.register')
            return next()
        else
            return next({
                name:'user.login'
            })
    }else if((to.name === 'user.login' || to.name === 'user.register') && access_token){
        return next({
            name:'dashboard.parts.index'
        })
    }
    next()
})

export default router;
