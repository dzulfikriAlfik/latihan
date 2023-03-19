import { createRouter, createWebHistory } from "vue-router";

import Login from "../views/Login.vue";
import Dashboard from "../views/Dashboard.vue";
import ForgotPassword from "../views/ForgotPassword.vue";
import ResetPassword from "../views/ResetPassword.vue";

const routes = [
    {
        path: "/dashboard",
        name: "dashboard",
        component: Dashboard,
    },
    {
        path: "/login",
        name: "login",
        component: Login,
    },
    {
        path: "/forgot-password",
        name: "forgotPassword",
        component: ForgotPassword,
    },
    {
        path: "/reset-password",
        name: "resetPassword",
        component: ResetPassword,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
