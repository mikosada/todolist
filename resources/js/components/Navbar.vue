<template>
    <nav class="navbar">
        <div class="logo">
            <router-link to="/">To Do List</router-link>
        </div>
        <ul class="nav-links">
            <li><router-link to="/login">Login</router-link></li>
            <li><router-link to="/signup">Sign Up</router-link></li>
            <li v-if="isLoggedIn">
                <button @click="logout">Logout</button>
            </li>
        </ul>
    </nav>
</template>

<script>
import api from "../api.js";

export default {
    data() {
        return {
            isLoggedIn: false,
        };
    },
    mounted() {
        this.checkLoginStatus();
    },
    methods: {
        checkLoginStatus() {
            const token = localStorage.getItem("token");
            this.isLoggedIn = !!token;
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
                this.isLoggedIn = false;
                this.$router.push("/login");
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
    background: #333;
    color: white;
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
</style>
