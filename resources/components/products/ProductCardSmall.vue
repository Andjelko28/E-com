<template>
    <div class="product-card">
        <div class="product-details">
            <img :src="imageUrl" alt="Product image" class="product-image" />

            <div class="text-center m-3">
                <h3>{{ getBrandName(product.brand_id) }}</h3>
                <p>{{ product.name }}</p>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <h5>${{ product.price }}</h5>
                <button class="btn btn-primary" @click="addToCart(product)">
                    <i class="bi bi-cart m-1 primary"></i>Add to cart
                </button>
            </div>
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
    setup(props) {
        const getCategoryName = (categoryId) => {
            const category = props.categories.find(
                (cat) => cat.id === categoryId
            );
            return category ? category.name : "Unknown";
        };

        const getBrandName = (brandId) => {
            const brand = props.brands.find((brand) => brand.id === brandId);
            return brand ? brand.name : "Unknown";
        };

        const addToCart = async (product) => {
            try {
                const token = localStorage.getItem("AuthToken");

                if (!token) {
                    console.error(
                        "User is not authenticated or token is missing."
                    );
                    return;
                }

                const payload = JSON.parse(atob(token.split(".")[1]));
                const user_id = payload.sub;

                if (!product.id) {
                    console.error("Product ID is missing.");
                    return;
                }

                await axios.post(
                    "/api/cart",
                    {
                        user_id,
                        product_id: product.id,
                        quantity: 1, // Adjust quantity as needed
                    },
                    {
                        headers: {
                            Authorization: `Bearer ${token}`,
                        },
                    }
                );

                // Call the globally exposed function to update the cart count
                window.fetchCartItemCount();
            } catch (error) {
                console.error("Error adding product to cart:", error);
            }
        };

        return { getCategoryName, getBrandName, addToCart };
    },
    computed: {
        imageUrl() {
            return `${this.product.image_path}`;
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

.product-image {
    max-width: 100%;
    height: 15rem;
    border-radius: 8px;
    margin-bottom: 1rem;
}
.product-details p {
    margin-bottom: 0.5rem;
}

.product-details p:last-child {
    margin-bottom: 0;
}
</style>
