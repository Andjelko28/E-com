import { createRouter, createWebHistory } from 'vue-router';
import Home from '../components/Home.vue';
import Register from '../components/Register.vue';

const routes = [
    {
        path: '/', component: Home
    },
    {
        path:'/register',component: Register
    }
];

export default createRouter({
    history: createWebHistory(),
    routes
});
