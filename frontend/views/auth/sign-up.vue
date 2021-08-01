<template>
    <div class="row no-gutters" style="min-height: 100vh;"> 
        <div class="col-md-6"> 
        <!-- Get Verified! Text
        ============================================= -->
        <div class="hero-wrap d-flex align-items-center h-100">
          <div class="hero-mask opacity-8 bg-primary"></div>
          <div 
            class="hero-bg hero-bg-scroll" 
            style="background-image:url('/images/bg/image-3.jpg');"
          ></div>
          <div class="hero-content mx-auto w-100 h-100 d-flex flex-column">
            <div class="row  no-gutters">
              <div class="col-10 col-lg-9 mx-auto">
                <div class="logo mt-5 mb-5 mb-md-0">
                    <a class="d-flex" href="index.html" title="Offshore payments">
                      <img src="/images/logo.png" alt="Payyed"></a>
                  </div>
              </div>
            </div>
            <div class="row my-auto">
              <div class="col-10 col-lg-9 mx-auto">
                <h1 class="text-11 text-white mb-4">Get Verified!</h1>
                <p class="text-4 text-white line-height-4 mb-5">Every day, Payyed makes thousands of customers happy.</p>
              </div>
            </div>
          </div>
        </div>
        <!-- Get Verified! Text End --> 
      </div>
      <div class="col-md-6 d-flex align-items-center"> 
        <!-- SignUp Form
        ============================================= -->
        <div class="container my-4">
          <div class="row">
            <div class="col-11 col-lg-9 col-xl-8 mx-auto">
              <AppSignUpForm/>
            </div>
          </div>
        </div>
        <!-- SignUp Form End --> 
      </div>
    </div>
</template>

<script>
import AppSignUpForm from '~/components/auth/AppSignUpForm';
export default {
    components: {
        AppSignUpForm
    }
}
</script>
