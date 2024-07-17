import { createRouter, createWebHistory } from 'vue-router';
import Home from '../components/Home.vue';
import Register from '../components/user/Register.vue';
import Login from '../components/user/Login.vue';
import AdminDashboard from '../components/admin/AdminDashboard.vue';
import Cart from '../components/cart/Cart.vue';

const routes = [
    {
        path: '/', component: Home
    },
    {
        path: '/register', component: Register
    },
    {
        path: '/login', component: Login
    },
    {
        path: '/admin',
        name: 'admin',
        component: AdminDashboard
    },
    {
        path: '/cart',
        component: Cart
    }
];

export default createRouter({
    history: createWebHistory(),
    routes
});
