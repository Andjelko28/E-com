<template>
    <div class="layout">
        <Navbar />
        <aside>
            <ul>
                <button @click="comp = 'AddProduct'">Add Product</button>
            </ul>
        </aside>
        <main>
            <component :is="comp"></component>
        </main>
    </div>
</template>

<script>
import Navbar from "../helpers/Navbar.vue";
import AddProduct from "../admin/AddProduct.vue";
import Cart from "../cart/Cart.vue";

export default {
    components: {
        Navbar,
        AddProduct,
        Cart,
    },
    data() {
        return {
            comp: "AddProduct",
            comp: "Cart",
        };
    },
};
</script>
