<template>
    <div class="product-card">
        <div class="product-details">
            <h3>{{ product.name }}</h3>
            <p>{{ product.description }}</p>
            <p>Price: ${{ product.price }}</p>
            <p>Stock: {{ product.stock }}</p>
            <p>Category: {{ getCategoryName(product.category_id) }}</p>
            <p>Brand: {{ getBrandName(product.brand_id) }}</p>
            <button class="btn btn-primary" @click="addToCart(product)">
                <i class="bi bi-cart m-1 primary"></i>Add to cart
            </button>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    props: {
        product: {
            type: Object,
            required: true,
        },
        categories: {
            type: Array,
            required: true,
        },
        brands: {
            type: Array,
            required: true,
        },
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
        async addToCart(product) {
            try {
                const token = localStorage.getItem("AuthToken");

                // Check if the token is available
                if (!token) {
                    console.error(
                        "User is not authenticated or token is missing."
                    );
                    return; // Exit the function if token is missing
                }

                // Decode the JWT token to get the user ID
                const payload = JSON.parse(atob(token.split(".")[1]));
                const user_id = payload.sub;

                // Ensure the product ID is available
                if (!product.id) {
                    console.error("Product ID is missing.");
                    return; // Exit the function if product ID is missing
                }

                const quantity = 1; // Adjust quantity as needed

                // Send the request to add the product to the cart
                const response = await axios.post(
                    "/api/cart",
                    {
                        user_id,
                        product_id: product.id,
                        quantity,
                    },
                    {
                        headers: {
                            Authorization: `Bearer ${token}`,
                        },
                    }
                );
                // Emit an event indicating that the cart has been updated
                this.$emit("cart-updated");
                console.log("Product added to cart:", response.data);
            } catch (error) {
                // Log any errors that occur during the request
                console.error("Error adding product to cart:", error);
            }
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
