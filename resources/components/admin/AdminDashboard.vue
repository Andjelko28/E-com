<template>
    <div class="layout">
        <Navbar />
        <aside>
            <ul class="list-style-none">
                <li @click="comp = 'AddProduct'" class="category-li px-5 fs-5">
                    Add Product
                </li>
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
