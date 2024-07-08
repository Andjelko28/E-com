<template>
    <div class="layout">
        <nav class="d-flex justify-content-between align-items-center p-2">
            <router-link to="/" class="a-style-none"
                ><h1 class="h1-font">BBBuy</h1></router-link
            >
            <div>
                <ul class="list-style-none d-flex gap-2 m-0">
                    <li class="btn btn-light fs-5">
                        <router-link
                            to="/"
                            class="a-style-none"
                            @click.prevent="logout"
                            >Log Out</router-link
                        >
                    </li>
                    <li class="btn btn-light fs-5">
                        <router-link to="/login" class="a-style-none"
                            >Log In</router-link
                        >
                    </li>
                    <li class="btn btn-light fs-5">
                        <router-link to="/register" class="a-style-none"
                            >Sign Up</router-link
                        >
                    </li>
                </ul>
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
                await axios.post("/api/logout");
                localStorage.removeItem("token");
                this.isLoggedIn = false;
            } catch (error) {
                console.error("Error during logout", error);
            }
        },
    },
};
</script>
