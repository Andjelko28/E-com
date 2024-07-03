<template>
    <div class="layout">
        <nav class="d-flex justify-content-between align-items-center p-2">
            <router-link to="/" class="a-style-none"><h1 class="h1-font">BBBuy</h1></router-link>
            <div>
                <ul class="list-style-none d-flex gap-2 m-0">
                    <li class="btn btn-light fs-5">Log In</li>
                    <li class="btn btn-light fs-5"><router-link to="/register" class="a-style-none">Sign Up</router-link></li>
                </ul>
            </div>
        </nav>
        <aside>
            <ul class="list-style-none">
                <li>Products</li>
                <li>Categories</li>
                <li>Brands</li>
            </ul>
        </aside>
        <main>

        </main>
    </div>
</template>

<script>
export default {};
</script>
