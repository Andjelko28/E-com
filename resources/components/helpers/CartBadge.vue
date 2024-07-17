<template>
    <div>
        <button
            class="btn btn-primary position-relative mx-3"
            @click="redirect"
        >
            <i class="bi bi-cart"></i>
            <span
                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                >{{ itemCount }}</span
            >
        </button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            itemCount: 0,
        };
    },
    methods: {
        redirect() {
            this.$router.push("/cart");
        },
        async fetchCartItemCount() {
            try {
                const token = localStorage.getItem("AuthToken");

                if (!token) {
                    console.error("User is not auth or token is missing");
                    return;
                }

                const response = await axios.get("/api/cart/items-count", {
                    headers: {
                        Authorization: `Bearer ${token}`,
                    },
                });
                this.itemCount = response.data.totalItems;
            } catch (error) {
                console.error(
                    "There was an error fetching the cart count",
                    error
                );
            }
        },
    },
    created() {
        this.fetchCartItemCount();
    },
    mounted() {
        this.$root.$emit("cart-updated", this.fetchCartItemCount);
    },
};
</script>
