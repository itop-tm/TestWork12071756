<template>
    <div class="row no-gutters" style="min-height: 100vh;"> 
        <!-- Welcome Text
        ============================================= -->
        <div class="col-md-6">
            <div class="hero-wrap d-flex align-items-center h-100">
                <div class="hero-mask opacity-8 bg-primary"></div>
                <div 
                    class="hero-bg hero-bg-scroll" 
                    style="background-image:url('/images/bg/image-3.jpg');"
                >
                </div>
                <div class="hero-content mx-auto w-100 h-100 d-flex flex-column">
                <div class="row no-gutters">
                    <div class="col-10 col-lg-9 mx-auto">
                        <div class="logo mt-5 mb-5 mb-md-0"> 
                            <nuxt-link class="d-flex" to="/" title="Offshore payments">
                                <img src="/images/logo.png" alt="Payyed">
                            </nuxt-link> 
                        </div>
                    </div>
                </div>
                <div class="row no-gutters my-auto">
                    <div class="col-10 col-lg-9 mx-auto">
                    <h1 class="text-11 text-white mb-4">Welcome back!</h1>
                    <p class="text-4 text-white line-height-4 mb-5">We are glad to see you again! Instant deposits, withdrawals & payouts trusted by millions worldwide.</p>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <!-- Welcome Text End --> 
        
        <!-- Login Form
        ============================================= -->
        <div class="col-md-6 d-flex align-items-center">
            <div class="container my-4">
                <div class="row">
                    <div class="col-11 col-lg-9 col-xl-8 mx-auto">
                        <AppLoginForm/>
                    </div>
                </div>
            </div>
        </div>
        <!-- Login Form End --> 
    </div>
</template>

<script>
import AppLoginForm from '~/components/auth/AppLoginForm';
export default {
    components: {
        AppLoginForm
    }
}
</script>
