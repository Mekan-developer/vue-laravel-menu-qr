<template>
    <div class="w-full h-full dashboard-body">
        <div :class="{ activeClass: isActive }" class="z-50 sidebar">
            <div class="logo_content">
                <div class="logo">
                    <i class="bx bxl-bitcoin"></i>
                    <div class="logo_name">Logo name</div>
                </div>
                <i class="bx bx-menu" id="btn" @click="sidebarActive()"></i>
            </div>
            <ul class="nav_list">
                <li>
                    <i class="bx bx-search" v-if="!isActive" @click="sidebarActive()"></i>
                    <i class="cursor-default bx bx-search" v-else></i>
                    <input type="text" placeholder="Search..." />
                    <span class="tooltip">Search</span>
                    <div class="arrowToolTip"></div>
                </li>

                <li>
                    <router-link :to="{ name: 'dashboard.categories.index' }" exact>
                        <i class="bx bxs-dashboard"></i>
                        <span class="links_name">Categories</span>
                    </router-link>
                    <span class="tooltip">Categories</span>
                    <div class="arrowToolTip"></div>
                </li>

                <li>
                    <router-link :to="{ name: 'dashboard.foods' }">
                        <i class="bx bxs-food-menu"></i>
                        <span class="links_name">Foods</span>
                    </router-link>

                    <span class="tooltip">Foods</span>
                    <div class="arrowToolTip"></div>
                </li>

                <li>
                    <router-link :to="{ name: 'dashboard.likedFoods' }">
                        <i class="bx bx-heart"></i>
                        <span class="links_name">Liked</span>
                    </router-link>
                    <span class="tooltip">Liked</span>
                    <div class="arrowToolTip"></div>
                </li>

                <li>
                    <router-link :to="{ name: 'dashboard.deviceSettings' }">
                        <i class="bx bx-devices"></i>
                        <span class="links_name">Restaurant settins</span>
                    </router-link>
                    <span class="pl-4 tooltip">main settings</span>
                    <div class="arrowToolTip"></div>
                </li>
                <li>
                    <router-link :to="{ name: 'dashboard.settings' }">
                        <i class="bx bx-cog"></i>
                        <span class="links_name">Settings</span>
                    </router-link>
                    <span class="tooltip">Settings</span>
                    <div class="arrowToolTip"></div>
                </li>
            </ul>
            <div class="profile_content">
                <div class="profile">
                    <div class="profile_details">
                        <router-link :to="{ name: 'dashboard.profile' }">
                            <img src="/menu-icons/owner2.webp" alt="" />
                        </router-link>
                        <div class="name_job">
                            <router-link :to="{ name: 'dashboard.profile' }">
                                <div class="name">Mekan Agamyradov</div>
                                <div class="job">Manager</div>
                            </router-link>
                        </div>
                    </div>

                    <i @click="logOut" class="cursor-pointer bx bx-log-out" id="log_out"></i>
                </div>
            </div>
        </div>
        <div class="home_content">
            <router-view :language="language" :languages="languages"></router-view>
        </div>
    </div>
</template>

<script>
import api from "../../api"

export default {
    props: {
        language: String,
        languages: Object,
    },

    data() {
        return {
            isActive: false,
        };
    },
    methods: {
        sidebarActive() {
            this.isActive = !this.isActive;
        },
        logOut(){
            api.post('/api/auth/logout').then(res => {
                localStorage.removeItem('access_token');
                this.$router.push({ name: 'user.login' });
            }).catch(err => {
                console.log('error')
                console.log(err)
            })
        }
    },
};
</script>

<style>
@import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
}

.router-link-active {
    background: #fff;
}

.router-link-active > .links_name,
.router-link-active > i {
    color: #11101d;
}

.dashboard-body {
    position: relative;
    min-height: 100vh;
    width: 100%;
    overflow: hidden;
}

.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    width: 78px;
    background: #11101d;
    padding: 6px 14px;
    transition: all 0.5s ease;
}
.sidebar.activeClass {
    width: 260px;
}
.sidebar > .logo_content > .logo {
    color: #fff;
    display: flex;
    height: 50px;
    width: 100%;
    align-items: center;
    opacity: 0;
    pointer-events: none;
    transition: all 0.5s ease;
}

.sidebar.activeClass .logo_content > .logo {
    opacity: 1;
    pointer-events: none;
}

.logo_content .logo i {
    font-size: 28px;
    margin-right: 5px;
}

.logo_name {
    font-size: 20px;
    font-weight: 400;
    white-space: nowrap;
}

.sidebar #btn {
    position: absolute;
    color: #fff;
    left: 50%;
    top: 6px;
    font-size: 20px;
    height: 50px;
    width: 50px;
    text-align: center;
    line-height: 50px;
    transform: translateX(-50%);
    transition: all 0.5s ease;
}
.sidebar.activeClass #btn {
    left: 90%;
}

.sidebar ul {
    margin-top: 20px;
}
.sidebar ul li {
    position: relative;
    height: 50px;
    width: 100%;
    margin: 0 5px;
    list-style: none;
    line-height: 50px;
    margin-top: 4px;
}

.sidebar ul li .tooltip {
    position: absolute;
    left: 122px;
    top: 0;
    transform: translate(-50%, -50%);
    border-radius: 6px;
    height: 35px;
    width: 122px;
    text-align: center;
    line-height: 35px;
    background: #fff;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    transition: 0;
    opacity: 0;
    pointer-events: none;
    z-index: 9999;
}
.sidebar.activeClass ul li .tooltip {
    display: none;
}
.sidebar ul li:hover .tooltip {
    transition: all 0.5s ease;
    opacity: 1;
    top: 50%;
}
.sidebar.activeClass .arrowToolTip {
    display: none;
}

.arrowToolTip {
    position: absolute;
    left: 122px;
    top: -50%;
    text-align: center;
    line-height: 35px;
    width: 20px;
    aspect-ratio: 1;
    background: rgb(255, 255, 255);
    z-index: 100;
    transform: translate(-320%, 80%) rotate(45deg);
    opacity: 0;
}
.sidebar ul li:hover .arrowToolTip {
    transition: all 0.5s ease;
    opacity: 1;
    top: 0;
}
.sidebar ul li input {
    position: absolute;
    height: 100%;
    width: 100%;
    left: 0;
    top: 0;
    border-radius: 12px;
    outline: none;
    border: none;
    background: #1d1b31;
    padding-left: 50px;
    font-size: 18px;
    color: #fff;
}
.sidebar ul li .bx-search {
    position: absolute;
    z-index: 99;
    color: #fff;
    font-size: 22px;
}

.sidebar ul li .bx-search:hover {
    color: #11101d;
    background: #fff;
    cursor: pointer;
}
.sidebar.activeClass ul li .bx-search {
    background: #1d1b31;
    color: white;
}
.sidebar ul li a {
    color: #fff;
    display: flex;
    align-items: center;
    text-decoration: none;
    transition: all 0.4s ease;
    border-radius: 12px;
    overflow: hidden;
}
.sidebar ul li a:hover {
    color: #11101d;
    background: #fff;
}
.sidebar ul li i {
    height: 50px;
    min-width: 50px;
    border-radius: 12px;
    line-height: 50px;
    text-align: center;
}
.sidebar .links_name {
    opacity: 0;
    pointer-events: none;
    white-space: nowrap;
    transition: all 0.5s ease;
}
.sidebar.activeClass .links_name {
    opacity: 1;
    pointer-events: none;
}

.sidebar .profile_content {
    position: absolute;
    color: #fff;
    bottom: 0;
    left: 0;
    width: 100%;
}

.sidebar .profile_content .profile {
    position: relative;
    padding: 10px 6px;
    height: 60px;
    background: none;
}

.sidebar.sidebar.activeClass .profile_content .profile {
    background: #1d1b31;
}
.profile_content .profile .profile_details {
    display: flex;
    align-items: center;
    opacity: 0;
    pointer-events: none; /* i can not understand*/
    white-space: nowrap;
    transition: all 0.5s ease;
}

.sidebar.activeClass .profile .profile_details {
    opacity: 1;
    pointer-events: auto;
}

.profile .profile_details img {
    width: 45px;
    height: 45px;
    object-fit: cover;
    border-radius: 12px;
}

.profile .profile_details .name_job {
    margin-left: 10px;
}

.profile .profile_details .name {
    font-size: 15px;
    font-weight: 400;
}

.profile .profile_details .job {
    font-size: 12px;
}

.profile #log_out {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    bottom: 10px;
    min-width: 50px;
    line-height: 50px;
    font-size: 20px;
    border-radius: 12px;
    text-align: center;
    transition: all 0.5s ease;
    background: #1a1b31;
}

.sidebar.activeClass .profile #log_out {
    left: 88%;
    background: none;
}

.home_content {
    position: absolute;
    height: 100%;
    width: calc(100% - 78px);
    left: 78px;
    transition: all 0.5s ease;
}
.home_content .text {
    font-size: 25px;
    font-weight: 500;
    color: #1d1b31;
    margin: 14px;
}

.sidebar.activeClass ~ .home_content {
    width: calc(100% - 260px);
    left: 260px;
}
</style>
