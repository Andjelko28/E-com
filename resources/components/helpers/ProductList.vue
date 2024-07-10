<template>
    <div>
        <h2>Products</h2>
        <div class="product-list">
            <product-card
                v-for="product in products"
                :key="product.id"
                :product="product"
                :categories="categories"
                :brands="brands"
            />
            <div v-if="products.length === 0">No products found.</div>
        </div>
    </div>
</template>

<script>
import ProductCard from "./ProductCard.vue";
import axios from "axios";

export default {
    components: {
        ProductCard,
    },
    data() {
        return {
            products: [],
            categories: [],
            brands: [],
        };
    },
    created() {
        this.fetchProducts();
        this.fetchCategories();
        this.fetchBrands();
    },
    methods: {
        async fetchProducts() {
            try {
                const response = await axios.get("/api/products");
                this.products = response.data;
            } catch (error) {
                console.error("Error fetching products:", error);
            }
        },
        async fetchCategories() {
            try {
                const response = await axios.get("/api/categories");
                this.categories = response.data;
            } catch (error) {
                console.error("Error fetching categories:", error);
            }
        },
        async fetchBrands() {
            try {
                const response = await axios.get("/api/brands");
                this.brands = response.data;
            } catch (error) {
                console.error("Error fetching brands:", error);
            }
        },
    },
};
</script>

<style scoped>
.product-list {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
}
</style>
