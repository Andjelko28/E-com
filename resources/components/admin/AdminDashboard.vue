<template>
    <div class="container mt-4">
        <h1>Admin Dashboard</h1>
        <button
            type="button"
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#addProductModal"
        >
            Add Product
        </button>

        <AddProduct />
    </div>
</template>

<script>
import AddProduct from "../admin/AddProduct.vue";

export default {
    components: {
        AddProduct,
    },
};
</script>
