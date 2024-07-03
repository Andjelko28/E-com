<template>
    <div class="layout">
        <nav class="d-flex justify-content-between align-items-center p-2">
            <router-link to="/" class="a-style-none"
                ><h1 class="h1-font">BBBuy</h1></router-link
            >
            <div>
                <ul class="list-style-none d-flex gap-2 m-0">
                    <li class="btn btn-light fs-5">
                        <router-link to="/login" class="a-style-none"
                            >Log In</router-link
                        >
                    </li>
                    <li class="btn btn-light fs-5">
                        <router-link to="/register" class="a-style-none"
                            >Sign Up</router-link
                        >
                    </li>
                </ul>
            </div>
        </nav>
        <aside>
            <div>
                <a class="btn btn-secondary m-2 dropdown-button">All Products</a>
                <Dropdown :fetchData="null">Categories</Dropdown>
                <Dropdown :fetchData="null">Brand</Dropdown>
            </div>
        </aside>
        <main></main>
    </div>
</template>

<script>
import Dropdown from "./helpers/Dropdown.vue";

export default {
    components:{
        Dropdown
    }
};
</script>
