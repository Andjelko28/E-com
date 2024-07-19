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
import AddProduct from "./AddProduct.vue";

export default {
    components: {
        Navbar,
        AddProduct,
    },
    data() {
        return {
            comp: "AddProduct",
        };
    },
};
</script>
