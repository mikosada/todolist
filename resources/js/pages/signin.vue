<template>
    <div>
        <h2>Sign In</h2>
        <form @submit.prevent="login">
            <input type="email" v-model="email" placeholder="Email" required />
            <input
                type="password"
                v-model="password"
                placeholder="Password"
                required
            />
            <button type="submit">Sign In</button>
        </form>
    </div>
</template>

<script>
import api from "../api.js";

export default {
    name: "login",
    data() {
        return {
            email: "",
            password: "",
        };
    },
    methods: {
        async login() {
            try {
                const response = await api.post("/login", {
                    email: this.email,
                    password: this.password,
                });
                localStorage.setItem("token", response.data.token);
                localStorage.setItem("userName", response.data.user.name);
                window.location.replace("#/");
            } catch (error) {
                console.log(error);
            }
        },
    },
};
</script>
