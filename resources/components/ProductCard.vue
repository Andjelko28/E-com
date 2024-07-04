<template>
    <div>
        <div>
            <h5>{{ product.name }}</h5>
            <p>{{ product.description }}</p>
            <p>{{ product.price }}</p>
            <p>{{ product.stock }}</p>
            <p v-if="showCategory">Category:{{ product.category }}</p>
            <p v-if="showBrand">Brand:{{ product.brand }}</p>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        type: Object,
        required: true,
    },
    showCategory: {
        type: Boolean,
        default: false,
    },
    showBrand: {
        type: Boolean,
        default: false,
    },
};
</script>
