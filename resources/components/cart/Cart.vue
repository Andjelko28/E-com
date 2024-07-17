<template>
    <Navbar></Navbar>
    <div class="d-flex w-75 justify-content-between m-auto">
        <div>
            <h2>Cart</h2>
        </div>
        <div>
            <h2>Summary</h2>
        </div>
    </div>
</template>
<script>
import Navbar from "../helpers/Navbar.vue";
export default {
    components: {
        Navbar,
    },
};
</script>
