<template>
    <div class="layout">
        <nav class="d-flex justify-content-between align-items-center p-2">
            <router-link to="/" class="a-style-none"
                ><h1 class="h1-font">BBBuy</h1></router-link
            >
            <div>
                <button v-if="isLog" class="btn btn-danger" @click="logout">
                    Log Out
                </button>
                <router-link v-if="!isLog" to="/login" class="btn btn-light"
                    >Log In</router-link
                >
                <router-link v-if="!isLog" to="/register" class="btn btn-light"
                    >Sign Up</router-link
                >
            </div>
        </nav>
        <aside>
            <div class="p-1">
                <a
                    class="btn btn-secondary m-2 dropdown-button"
                    @click.prevent="showAllProducts"
                    >All Products</a
                >
                <Dropdown
                    label="Categories"
                    :fetchData="fetchCategory"
                ></Dropdown>
                <Dropdown label="Brand" :fetchData="fetchBrands"></Dropdown>
            </div>
        </aside>
        <main>
            <ProductTable v-if="showProducts"></ProductTable>
        </main>
    </div>
</template>

<script>
import axios from "axios";
import Dropdown from "./helpers/Dropdown.vue";
import ProductTable from "./ProductTable.vue";

export default {
    components: {
        Dropdown,
        ProductTable,
    },
    data() {
        return {
            selectedCategoryId: null,
            showProducts: false,
            isLog: localStorage.getItem("AuthToken"),
        };
    },
    methods: {
        async fetchCategory() {
            return await axios.get("/api/categories");
        },
        onCategorySelected(category) {
            this.selectedCategoryId = category.id;
        },
        async fetchBrands() {
            return await axios.get("/api/brands");
        },
        showAllProducts() {
            this.showProducts = true;
        },
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
                this.$router.push("/login"); // Redirect to login page using Vue Router
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
