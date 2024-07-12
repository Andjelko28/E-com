import { createRouter, createWebHistory } from 'vue-router';
import Home from '../components/Home.vue';
import Register from '../components/Register.vue';
import Login from '../components/Login.vue';
import ProductTable from '../components/ProductTable.vue';
import AdminDashboard from '../components/admin/AdminDashboard.vue';

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
        path: '/products', component: ProductTable
    },
    {
        path: '/admin',
        name: 'admin',
        component: AdminDashboard
    }
];

export default createRouter({
    history: createWebHistory(),
    routes
});
