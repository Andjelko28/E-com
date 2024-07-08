<template>
    <div class="form-container">
        <form>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1"
                                >Email address</label
                            >
                            <input
                                type="email"
                                class="form-control"
                                id="email"
                                aria-describedby="emailHelp"
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
                                placeholder="Password"
                            />
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="password_confirmation"
                                >Confirm Password</label
                            >
                            <input
                                type="password"
                                class="form-control"
                                id="password_confirmation"
                                placeholder="Confirm Password"
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
                password_confirmation: "",
            },
            formErrors: {},
        };
    },
    methods: {
        async registerUser() {
            try {
                const response = await axios.post("/api/register", this.form);
                console.log("Registration successful!");
                return response.data;
            } catch (error) {
                this.formErrors = error.response.data.errors;
                console.error("Error on registration", error);
            }
        },
    },
};
</script>
