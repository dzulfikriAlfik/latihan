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
                    <h1 class="h3 fw-bold mt-4 mb-2">Don’t worry, we’ve got your back</h1>
                    <h2 class="h5 fw-medium text-muted mb-0">Please enter your username or email</h2>
                </div>
                <!-- END Header -->

                <!-- Reminder Form -->
                <form class="js-validation-reminder" action="be_pages_auth_all.html" method="POST">
                    <div class="block block-themed block-rounded block-fx-shadow">
                        <div class="block-header bg-gd-primary">
                            <h3 class="block-title">Password Reminder</h3>
                        </div>
                        <div class="block-content">
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" id="reminder-credential" name="reminder-credential" placeholder="Enter your email or username">
                                <label class="form-label" for="reminder-credential">Username or Email</label>
                            </div>
                            <div class="text-center mb-4">
                                <button type="submit" class="btn btn-lg btn-alt-primary fw-semibold">
                                    Reset Password
                                </button>
                            </div>
                        </div>
                        <div class="block-content block-content-full bg-body-light mb-4 text-center">
                            <router-link class="fs-sm fw-medium link-fx text-muted me-2 mb-1 d-inline-block" :to="{ name: 'login' }">
                                <i class="fa fa-arrow-left opacity-50 me-1"></i> Sign In
                            </router-link>
                        </div>
                    </div>
                </form>
                <!-- END Reminder Form -->
            </div>
        </div>
    </div>
</template>
