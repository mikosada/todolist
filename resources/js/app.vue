<template>
    <nav class="navbar">
        <div class="logo">
            <a href="#/">To Do List</a>
        </div>
        <ul class="nav-links">
            <li v-if="!isLoggedIn"><a href="#/login">Login</a></li>
            <li v-if="!isLoggedIn"><a href="#/signup">Sign Up</a></li>
            <li v-if="isLoggedIn">
                <span class="username">Hello, {{ userName }}</span>
                <button @click="logout">Logout</button>
            </li>
        </ul>
    </nav>
    <component :is="currentView" />
</template>

<script setup>
import { ref, computed } from "vue";
import home from "./pages/home.vue";
import login from "./pages/signin.vue";
import signup from "./pages/signup.vue";

const routes = {
    "/": home,
    "/login": login,
    "/signup": signup,
};

const currentPath = ref(window.location.hash);

window.addEventListener("hashchange", () => {
    currentPath.value = window.location.hash;
});

const currentView = computed(() => {
    return routes[currentPath.value.slice(1) || "/"];
});
</script>

<script>
import api from "./api.js";

export default {
    data() {
        return {
            isLoggedIn: false,
            userName: "",
        };
    },
    mounted() {
        this.checkLoginStatus();
    },
    methods: {
        checkLoginStatus() {
            const token = localStorage.getItem("token");
            if (token) {
                this.isLoggedIn = true;
                this.userName = localStorage.getItem("userName"); // Retrieve the user's name from localStorage
            }
        },
        async logout() {
            try {
                await api.post(
                    "/logout",
                    {},
                    {
                        headers: {
                            Authorization: `Bearer ${localStorage.getItem(
                                "token"
                            )}`,
                        },
                    }
                );
                localStorage.removeItem("token");
                localStorage.removeItem("userName"); // Remove user's name from localStorage
                this.isLoggedIn = false;
                this.userName = ""; // Reset user's name
            } catch (error) {
                console.error(error.response.data.message);
            }
        },
    },
};
</script>

<style scoped>
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    background: #8600c5;
    color: white;
    margin-bottom: 20px;
}
.logo a {
    text-decoration: none;
    color: white;
    font-size: 1.5rem;
}
.nav-links {
    list-style: none;
    display: flex;
    gap: 1rem;
}
.nav-links a {
    text-decoration: none;
    color: white;
}
.nav-links button {
    background: none;
    border: none;
    color: white;
    cursor: pointer;
}

.username {
    margin-right: 12px;
    text-transform: capitalize;
}
</style>
