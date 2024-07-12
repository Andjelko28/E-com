<template>
    <nav class="d-flex justify-content-between align-items-center p-2">
        <router-link to="/" class="a-style-none"
            ><h1 class="h1-font">BBBuy</h1></router-link
        >
        <div class="dropdown">
            <button
                data-mdb-button-init
                data-mdb-ripple-init
                data-mdb-dropdown-init
                class="btn btn-primary dropdown-toggle hidden-arrow"
                type="button"
                id="dropdownMenuButton1"
                data-mdb-toggle="dropdown"
                aria-expanded="false"
            >
                <i class="bi bi-person-circle"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li>
                    <router-link
                        v-if="isLog && !isActive"
                        to="/admin"
                        class="dropdown-item"
                        >Dashboard</router-link
                    >
                </li>
                <li>
                    <button v-if="isLog" class="dropdown-item" @click="logout">
                        Log Out
                    </button>
                </li>
                <li>
                    <router-link v-if="!isLog" to="/login" class="dropdown-item"
                        >Log In</router-link
                    >
                </li>
                <li>
                    <router-link
                        v-if="!isLog"
                        to="/register"
                        class="dropdown-item"
                        >Sign Up</router-link
                    >
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            isLog: localStorage.getItem("AuthToken"),
        };
    },
    methods: {
        async logout() {
            try {
                const token = localStorage.getItem("AuthToken");
                await axios.post("/api/logout", {
                    headers: {
                        Authorization: `Bearer ${token}`,
                    },
                });
                localStorage.removeItem("AuthToken");
                this.isLog = false;
                this.$router.push("/");
            } catch (error) {
                if (error.response && error.response.status === 401) {
                    console.error("Unauthorized access. Please log in again.");
                } else {
                    console.error("Error logging out:", error);
                }
            }
        },
        toggleDropdown() {
            this.dropdownVisible = !this.dropdownVisible;
        },
        closeDropdown(event) {
            if (!this.$el.contains(event.target)) {
                this.dropdownVisible = false;
            }
        },
    },
};
</script>
