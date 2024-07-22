<template>
    <div>
        <button
            class="btn btn-primary position-relative mx-3"
            @click="redirect"
        >
            <i class="bi bi-cart"></i>
            <span
                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
            >
                {{ itemCount }}
            </span>
        </button>
    </div>
</template>

<script>
import { ref } from "vue";
import axios from "axios";

export default {
    setup() {
        const itemCount = ref(0);

        const fetchCartItemCount = async () => {
            try {
                const token = localStorage.getItem("AuthToken");

                if (!token) {
                    console.error(
                        "User is not authenticated or token is missing."
                    );
                    return;
                }

                const response = await axios.get("/api/cart/items-count", {
                    headers: {
                        Authorization: `Bearer ${token}`,
                    },
                });
                itemCount.value = response.data.totalItems;
            } catch (error) {
                console.error(
                    "There was an error fetching the cart count",
                    error
                );
            }
        };

        window.fetchCartItemCount = fetchCartItemCount; // Expose function globally
        fetchCartItemCount(); // Fetch initial count

        return { itemCount };
    },
    methods: {
        redirect() {
            this.$router.push("/cart");
        },
    },
};
</script>
