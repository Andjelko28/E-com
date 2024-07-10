<template>
    <div class="layout">
        <nav class="d-flex justify-content-between align-items-center p-2">
            <router-link to="/" class="a-style-none"
                ><h1 class="h1-font">BBBuy</h1></router-link
            >
            <div>
                <router-link v-if="isLog" to="/admin" class="btn btn-light mx-2"
                    >Dashboard</router-link
                >
                <button v-if="isLog" class="btn btn-danger" @click="logout">
                    Log Out
                </button>

                <router-link
                    v-if="!isLog"
                    to="/login"
                    class="btn btn-light mx-2"
                    >Log In</router-link
                >
                <router-link v-if="!isLog" to="/register" class="btn btn-light"
                    >Sign Up</router-link
                >
            </div>
        </nav>
        <aside>
            <Categories></Categories>
        </aside>
        <main>
            <List></List>
        </main>
    </div>
</template>

<script>
import axios from "axios";
import Dropdown from "./helpers/Categories.vue";
import Categories from "./helpers/Categories.vue";
import List from "./helpers/ProductList.vue";

export default {
    components: {
        Dropdown,
        Categories,
        List,
    },
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
    },
};
</script>
