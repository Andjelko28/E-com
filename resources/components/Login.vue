<template>
    <div class="form-container">
        <form @submit.prevent="login">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input
                                type="email"
                                class="form-control"
                                id="email"
                                v-model="form.email"
                                placeholder="johndoe@gmail.com"
                            />
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input
                                type="password"
                                class="form-control"
                                id="password"
                                v-model="form.password"
                                placeholder="Password"
                            />
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center mt-2">
                    <div class="col-md-12 d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary btn-block">
                            Submit
                        </button>
                        <button class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
import axios from "axios";
export default {
    data() {
        return {
            form: {
                email: "",
                password: "",
            },
            formErrors: {},
            isLoggedIn: false,
        };
    },
    methods: {
        async login() {
            try {
                const response = await axios.post("/api/login", this.form);
                const token = response.data.token;
                localStorage.setItem("AuthToken", token);
                axios.defaults.headers.common[
                    "Authorization"
                ] = `Bearer ${token}`;

                window.location = "/";
                return this.$router.push("/");
            } catch (error) {
                if (error.response && error.response.status === 422) {
                    this.loginError = "Your email or password are incorrect!";
                } else {
                    this.loginError = "Logging in failed, please try again!";
                }
            }
        },
    },
};
</script>
