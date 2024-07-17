<template>
    <div class="layout">
        <Navbar />
        <aside>
            <Categories></Categories>
        </aside>
        <main>
            <List></List>
        </main>
    </div>
</template>

<script>
import Dropdown from "./helpers/Categories.vue";
import Categories from "./helpers/Categories.vue";
import List from "./products/ProductList.vue";
import Navbar from "./helpers/Navbar.vue";

export default {
    components: {
        Dropdown,
        Categories,
        List,
        Navbar,
    },
};
</script>
