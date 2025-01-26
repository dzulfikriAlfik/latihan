<template>
    <div class="row mx-0 justify-content-center">
        <div class="hero-static col-lg-6 col-xl-4">
            <div class="content content-full overflow-hidden">
                <!-- Header -->
                <div class="py-4 text-center">
                    <a class="link-fx fw-bold" href="index.html">
                        <i class="fa fa-fire"></i>
                        <span class="fs-4 text-body-color">code</span><span class="fs-4">base</span>
                    </a>
                    <h1 class="h3 fw-bold mt-4 mb-2">Welcome to Your Dashboard</h1>
                    <h2 class="h5 fw-medium text-muted mb-0">It’s a great day today!</h2>
                </div>
                <!-- END Header -->

                <!-- Sign In Form -->
                <form class="js-validation-signin" @submit.prevent="submitLogin">
                    <div class="block block-themed block-rounded block-fx-shadow">
                        <div class="block-header bg-gd-dusk">
                            <h3 class="block-title">Please Sign In</h3>
                        </div>
                        <div class="block-content">
                            <div class="form-floating mb-4">
                                <input v-model="loginForm.email" type="text" class="form-control" id="login-username" name="login-email" placeholder="Enter your email address">
                                <label class="form-label" for="login-username">Email</label>
                                <div class="text-danger">
                                    <div v-for="message in validationErrors?.email">
                                        {{ message }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-floating mb-4">
                                <input v-model="loginForm.password" type="password" class="form-control" id="login-password" name="login-password" placeholder="Enter your password">
                                <label class="form-label" for="login-password">Password</label>
                                <div class="text-danger">
                                    <div v-for="message in validationErrors?.password">
                                        {{ message }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 d-sm-flex align-items-center push">
                                    <div class="form-check">
                                        <input v-model="loginForm.remember" class="form-check-input" type="checkbox" value="" id="login-remember-me" name="login-remember-me">
                                        <label class="form-check-label" for="login-remember-me">Remember Me</label>
                                    </div>
                                </div>
                                <div class="col-sm-6 text-sm-end push">
                                    <button type="submit" class="btn btn-lg btn-alt-primary fw-medium" :disabled="processing">
                                        {{ processing ? 'Log you in...' : 'Sign In' }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="block-content block-content-full bg-body-light text-center d-flex justify-content-between">
                            <router-link class="fs-sm fw-medium link-fx text-muted me-2 mb-1 d-inline-block" :to="{ name: 'register' }">
                                <i class="fa fa-plus opacity-50 me-1"></i> Create Account
                            </router-link>
                            <router-link class="fs-sm fw-medium link-fx text-muted me-2 mb-1 d-inline-block" :to="{ name: 'forgot-password' }">
                                Forgot Password
                            </router-link>
                        </div>
                    </div>
                </form>
                <!-- END Sign In Form -->
            </div>
        </div>
    </div>
</template>

<script setup>
import useAuth from '@/composables/auth';

const { loginForm, validationErrors, processing, submitLogin } = useAuth();
</script>
