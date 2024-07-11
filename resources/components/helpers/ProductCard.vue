<template>
    <div class="product-card">
        <div class="product-details">
            <div class="product-image" v-if="product.image">
                <img :src="getImageUrl(product.image)" alt="Product Image" />
            </div>
            <h3>{{ product.name }}</h3>
            <p>{{ product.description }}</p>
            <p>Price: ${{ product.price }}</p>
            <p>Quantity: {{ product.quantity }}</p>
            <p>Category: {{ getCategoryName(product.category_id) }}</p>
            <p>Brand: {{ getBrandName(product.brand_id) }}</p>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        product: Object,
        categories: Array,
        brands: Array,
    },
    methods: {
        getCategoryName(categoryId) {
            const category = this.categories.find(
                (cat) => cat.id === categoryId
            );
            return category ? category.name : "Unknown";
        },
        getBrandName(brandId) {
            const brand = this.brands.find((brand) => brand.id === brandId);
            return brand ? brand.name : "Unknown";
        },
        getImageUrl(imagePath) {
            return `/images/products/${imagePath}`;
        },
    },
};
</script>

<style scoped>
.product-card {
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 1rem;
    margin: 1rem;
    width: 300px;
    display: inline-block;
    vertical-align: top;
}

.product-image img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin-bottom: 1rem;
}

.product-details h3 {
    margin-top: 0;
}

.product-details p {
    margin-bottom: 0.5rem;
}

.product-details p:last-child {
    margin-bottom: 0;
}
</style>
