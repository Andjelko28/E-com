import { createRouter, createWebHistory } from 'vue-router';
import Home from '../components/Home.vue';
import Register from '../components/Register.vue';
import Login from '../components/Login.vue';

const routes = [
    {
        path: '/', component: Home
    },
    {
        path: '/register', component: Register
    },
    {
        path: '/login', component: Login
    }
];

export default createRouter({
    history: createWebHistory(),
    routes
});
