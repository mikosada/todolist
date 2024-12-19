<template>
    <div>
        <h2>Sign Up</h2>
        <form @submit.prevent="register">
            <input type="text" v-model="name" placeholder="Name" required />
            <input type="email" v-model="email" placeholder="Email" required />
            <input
                type="password"
                v-model="password"
                placeholder="Password"
                required
            />
            <button type="submit">Sign Up</button>
        </form>
    </div>
</template>

<script>
import api from "../api.js";
export default {
    name: "signup",

    data() {
        return {
            name: "",
            email: "",
            password: "",
        };
    },
    methods: {
        async register() {
            try {
                const response = await api.post("/register", {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                });
                window.location.replace("#/");
            } catch (error) {
                console.log(error);
            }
        },
    },
};
</script>
