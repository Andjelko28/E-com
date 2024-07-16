<template>
    <div>
        <i class="bi bi-cart-fill icon-blue fs-2 mx-2" @click="redirect"></i>
        <span>{{ itemCount }}</span>
    </div>
</template>

<script>
export default {
    methods: {
        redirect() {
            this.$router.push("/cart");
        },
    },
};
</script>
