<template>
    <div>
        <h2>Your Cart</h2>
        <ul>
            <li v-for="item in cartItems" :key="item.id">
                {{ item.product.name }} - {{ item.quantity }}
                <button @click="removeFromCart(item.id)">Remove</button>
            </li>
        </ul>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            cartItems: [],
        };
    },
    methods: {
        fetchCartItems() {
            axios.get("/api/cart").then((response) => {
                this.cartItems = response.data.items;
            });
        },
        removeFromCart(id) {
            axios.delete(`/api/cart/${id}`).then(() => {
                this.fetchCartItems();
            });
        },
    },
    created() {
        this.fetchCartItems();
    },
};
</script>
