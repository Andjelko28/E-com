<template>
    <div v-if="product">
        <h1>{{ product.name }}</h1>
        <img :src="imageUrl" alt="Product image" />
        <p>{{ product.description }}</p>
        <p>Price: ${{ product.price }}</p>
        <p>Stock: {{ product.stock }}</p>
        <p>Category: {{ getCategoryName(product.category_id) }}</p>
        <p>Brand: {{ getBrandName(product.brand_id) }}</p>
    </div>
</template>

<script>
import axios from "axios";
export default {
    props: ["id"],
    data() {
        return {
            product: null,
        };
    },
    methods: {
        async getProductbyId(id) {
            try {
                const response = await axios.get(`/api/products/${id}`);
                this.product = response.data;
            } catch (error) {
                console.error("Error fetching product", error);
            }
        },
    },
    computed: {
        imageUrl() {
            return `${this.product.image_path}`;
        },
        destinationId() {
            return parseInt(this.$route.params.id);
        },
    },
    watch: {
        id() {
            this.fetchProduct();
        },
    },
};
</script>
