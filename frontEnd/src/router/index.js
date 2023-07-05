import { createRouter, createWebHistory } from 'vue-router'
import Login from '../views/Login.vue'
import Home from '../views/Home.vue'
import Register from "../views/Register.vue"
import ExpensesList from '../views/ExpensesList.vue'
import test from '../views/test.vue'
import { store } from '../store'

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home,

        meta: {
            requiresAuth: true
        },
    },

    {
        path: '/expensesList/:monthId?',
        name: 'expensesList',
        component: ExpensesList,

        meta: {
            requiresAuth: true
        },
    },

    {
        path: '/login',
        name: 'login',
        component: Login
    },


    {
        path: '/test',
        name: 'test',
        component: test
    },
    {
        path: '/register',
        name: 'register',
        component: Register
    },
];

const router = createRouter({
    history: createWebHistory(), // To remove the # from url
    routes
})

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !store.token) {
        next({ name: 'login' })
    } else {
        next();
    }

})


export default router