<template>
    <Navbar></Navbar>
    <div class="container mt-4">
        <h2 class="mb-4">Shopping Cart</h2>
        <div v-if="cartItems.length === 0" class="alert alert-info">
            Your cart is empty.
        </div>
        <div v-else>
            <div class="row">
                <div class="col-md-8">
                    <div v-for="item in cartItems" :key="item.id" class="mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5 class="card-title">
                                            {{ item.product.name }}
                                        </h5>
                                        <p class="card-text">
                                            Price: ${{ item.product.price }}
                                        </p>
                                        <p class="card-text">
                                            Quantity: {{ item.quantity }}
                                        </p>
                                        <p class="card-text">
                                            Total: ${{
                                                item.product.price *
                                                item.quantity
                                            }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="summary p-3 border rounded">
                        <h2 class="mb-3">Order Summary</h2>
                        <div class="d-flex justify-content-between">
                            <span>Total Price:</span>
                            <span>${{ totalPrice }}</span>
                        </div>
                        <button class="btn btn-primary btn-block mt-3">
                            Go to payment
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Navbar from "../helpers/Navbar.vue";
export default {
    components: {
        Navbar,
    },
    data() {
        return {
            cartItems: [],
        };
    },
    computed: {
        totalPrice() {
            return this.cartItems.reduce((total, item) => {
                return total + item.product.price * item.quantity;
            }, 0);
        },
    },
    methods: {
        async fetchCartitems() {
            try {
                const token = localStorage.getItem("AuthToken");
                if (!token) {
                    console.error("User is not auth or token is missing");
                    return;
                }
                const response = await axios.get("/api/cart/items", {
                    headers: {
                        Authorization: `Bearer ${token}`,
                    },
                });
                this.cartItems = response.data;
            } catch (error) {
                console.error(
                    "There was an error fetching the cart items",
                    error
                );
            }
        },
    },
    created() {
        this.fetchCartitems();
    },
};
</script>
