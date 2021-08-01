<template>
  <!-- Header
  ============================================= -->
  <header id="header" class="bg-primary header-text-light">
    <div class="container">
      <div class="header-row">
        <div class="header-column justify-content-start"> 
          <!-- Logo
          ============================= -->
          <div class="logo"> 
            <nuxt-link to="/" class="d-flex" title="Bank cards">
                <img src="/images/logo.png" height="40px" alt="Payyed" />
            </nuxt-link>
          </div>
          <!-- Logo end --> 
          <!-- Collapse Button
          ============================== -->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#header-nav"> 
            <span></span><span></span> <span></span>
          </button>
          <!-- Collapse Button end --> 
          
          <!-- Primary Navigation
          ============================== -->
          <nav class="primary-menu navbar navbar-expand-lg">
            <div id="header-nav" class="collapse navbar-collapse">
              <ul class="navbar-nav mr-auto">
                <li>
                  <nuxt-link 
                    :to="$lp('/cards')" 
                    class="d-flex" 
                    title="Tiz tölegler"
                  >{{ $t('cards') }}</nuxt-link>
                </li>
              </ul>
              <ul class="navbar-nav mr-auto">
                <li>
                  <a href="#">{{ $t('help') }}</a>
                </li>
              </ul>
            </div>
          </nav>
          <!-- Primary Navigation end --> 
        </div>
        <div class="header-column justify-content-end"> 
          <!-- My Profile
          ============================== -->
          <nav class="login-signup navbar navbar-expand">
            <ul class="navbar-nav">
              <li class="dropdown language"> <a class="dropdown-toggle" href="#">En</a>
                <ul class="dropdown-menu">
                  <li>
                      <nuxt-link 
                        class="dropdown-item" 
                        :to="switchLocalePath('en')"
                      >English</nuxt-link>
                  </li>
                  <li>
                      <nuxt-link 
                        class="dropdown-item" 
                        :to="switchLocalePath('ru')"
                      >Русский</nuxt-link>
                  </li>
                </ul>
              </li>
              <template v-if="!getToken()">
                <li>
                  <nuxt-link :to="$lp('/auth/sign-in')">
                    {{ $t('sign-in') }}
                  </nuxt-link>
                </li>
                <li class="align-items-center h-auto ml-sm-3">
                  <nuxt-link class="btn btn-light" :to="$lp('/auth/sign-up')">
                    {{ $t('sign-up') }}
                  </nuxt-link>
                </li>
              </template>
              <template v-else>
                  <AppDropdownProfile/>
              </template>
            </ul>
          </nav>
          <!-- My Profile end --> 
        </div>
      </div>
    </div>
  </header>
  <!-- Header End --> 
</template>
<i18n>
 {
    "ru": {
        "cards": "Карты",
        "sign-in": "Войти",
        "sign-up": "Регистрация"
    },
    "en": {
        "cards": "Bank cards",
        "sign-in": "Sign in",
        "sign-up": "Sign up"
    }
 }
</i18n>
<script>
import AppDropdownProfile from '~/components/partials/AppDropdownProfile'
import { mapGetters } from 'vuex';
export default {
  components: {
    AppDropdownProfile
  },
  methods: {
    ...mapGetters('user', [
      'getToken'
    ]),
  }

}
</script>
