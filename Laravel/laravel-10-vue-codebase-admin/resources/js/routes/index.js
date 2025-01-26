import { createRouter, createWebHistory } from 'vue-router';

import AuthenticatedLayout from '@/layouts/Authenticated.vue';
import GuestLayout from '@/layouts/Guest.vue';

import PostsIndex from '@/components/Posts/Index.vue'
import PostsCreate from '@/components/Posts/Create.vue'
import PostsEdit from '@/components/Posts/Edit.vue'
import Login from '@/components/Auth/Login.vue';
import Register from '@/components/Auth/Register.vue';
import ForgotPassword from '@/components/Auth/ForgotPassword.vue';

const routes = [
    {
        path: '/',
        redirect: { name: 'login' },
        component: GuestLayout,
        meta: {
            requiresAuth: false
        },
        children: [
            {
                path: '/login',
                name: 'login',
                component: Login
            },
            {
                path: '/register',
                name: 'register',
                component: Register
            },
            {
                path: '/forgot-password',
                name: 'forgot-password',
                component: ForgotPassword
            },
        ]
    },
    {
        component: AuthenticatedLayout,
        meta: {
            requiresAuth: true
        },
        children: [
            {
                path: '/posts',
                name: 'posts.index',
                component: PostsIndex,
                meta: { title: 'Posts' }
            },
            {
                path: '/posts/create',
                name: 'posts.create',
                component: PostsCreate,
                meta: { title: 'Add new post' }
            },
            {
                path: '/posts/edit/:id',
                name: 'posts.edit',
                component: PostsEdit,
                meta: { title: 'Edit post' }
            },
        ]
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
});

router.beforeEach((to, from, next) => {
    const isLoggedIn = JSON.parse(localStorage.getItem('loggedIn'));

    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (isLoggedIn) {
            next();
        } else {
            next({name: 'login'});
        }
    } else {
        if (isLoggedIn) {
            next({name: 'posts.index'});
        } else {
            next();
        }
    }
});

export default router;

