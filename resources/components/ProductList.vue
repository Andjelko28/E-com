<template>
    <div>
        <h2>{{ title }}</h2>
        <div class="product-list">
            <ProductCard
                v-for="product in products"
                :key="product.id"
                :product="product"
                :showCategory="showCategory"
                :showBrand="showBrand"
            />
        </div>
    </div>
</template>

<script>
import axios from "axios";
import ProductCard from "./ProductCard.vue";

export default {
    components: {
        ProductCard,
    },
    props: {
        title: {
            type: String,
            required: true,
        },
        showCategory: {
            type: Boolean,
            default: false,
        },
        showBrand: {
            type: Boolean,
            default: false,
        },
    },
    data() {
        return {
            products: [],
        };
    },
    mounted() {
        this.fetchProducts();
    },
    methods: {
        async fetchProducts() {
            try {
                let url = "/api/products";
                if (this.categoryId) {
                    url = `/api/products/category/${this.categoryId}`;
                } else if (this.brandId) {
                    url = `/api/products/brand/${this.brandId}`;
                }
                const response = await axios.get(url);
                this.products = response.data;
            } catch (error) {
                console.error("Error fetching products:", error);
            }
        },
    },
    watch: {
        categoryId(newValue) {
            if (newValue) {
                this.fetchProducts();
            }
        },
        brandId(newValue) {
            if (newValue) {
                this.fetchProducts();
            }
        },
    },
};
</script>
