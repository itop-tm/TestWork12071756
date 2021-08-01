<template>
    <div>
        <h3 class="font-weight-400 mb-4">{{ $t('login_title') }}</h3>

        <ValidationObserver ref="phone_form" v-slot="{ invalid }">
          <form 
              id="loginForm"
              @submit.prevent="submitPhone"
              v-if="!verification_code_sended"
          >
               <ValidationProvider
                  class="form-group"
                  v-slot="{ errors }"
                  :name="$t('v_phone')"
                  :rules="`digits:11|not_found:${user_not_found}`"
              >
                  <label for="phone">{{ $t('phone_number') }}</label>
                  <input 
                      type="number"
                      class="form-control" 
                      id="phone"
                      v-model="phone"
                      required 
                      placeholder="31xxxxxxxxx"
                      @input="resetValidation()"
                      :class="{'is-invalid': errors.length>0}"
                      autofocus 
                  >
                  <AppErrors :errors="errors"/>
              </ValidationProvider>

              <AppButton 
                  class="btn btn-primary btn-block my-4" 
                  type="submit"
                  :actionText="$t('sendсode')"
                  :loading="loading"
                  :status="invalid"
              ></AppButton>
          </form>
        </ValidationObserver>

        <ValidationObserver ref="login_form" v-slot="{ invalid }">
          <form 
              id="loginForm"
              @submit.prevent="submitCode"
              v-if="verification_code_sended"
          >
              <ValidationProvider
                  class="form-group"
                  v-slot="{ errors }"
                  :name="$t('v_otp')"
                  :rules="`digits:5|invalid_otp:${invalid_otp}`"
              >
                  <label for="code">{{ $t('code') }}</label>
                  <input 
                      type="number"
                      class="form-control" 
                      id="code"
                      v-model="otp"
                      required
                      :class="{'is-invalid': errors.length>0}"
                      autofocus
                  >
                 <AppErrors :errors="errors"/>
              </ValidationProvider>

              <div class="row pt-3">
                <div class="col-sm">
                  <div class="form-check custom-control custom-checkbox">
                      <input 
                          id="remember-me" 
                          name="remember"
                          class="custom-control-input" 
                          type="checkbox"
                          v-model="remember_me"
                      >
                      <label class="custom-control-label" for="remember-me">
                        {{ $t('remember_me') }}
                      </label>
                  </div>
                </div>
              </div>

             <AppButton 
                  class="btn btn-primary btn-block my-4" 
                  type="submit"
                  :actionText="$t('login_title')"
                  :loading="loading"
                  :status="invalid"
              ></AppButton>

          </form>
        </ValidationObserver>

        <p class="text-3 text-center text-muted">
          {{ $t('not_registered') }}
            <nuxt-link 
              class="btn-link" 
              :to="$lp('/auth/sign-up')"
            >{{$t('sign_up')}}</nuxt-link>
        </p>
    </div>
</template>
<i18n>
 {
    "ru": {
        "login_title": "Войти",
        "sign_up": "Регистрация",
        "sendсode": "Отправить код",
        "code": "Код",
        "not_registered": "Вы не зарегистрированы?",
        "phone_number": "Моб. номер",
        "remember_me": "Запомнить"
    },
    "en": {
        "login_title": "Sign in",
        "sign_up": "Sign up",
        "sendсode": "Send code",
        "code": "Code",
        "not_registered": "Already registered?",
        "phone_number": "Phone number",
        "remember_me": "Remember me"
    }
 }
</i18n>
<i18n>
 {
    "ru": {
        "v_phone": "Номер телефона",
        "v_otp": "смс-код",
        "not_found": "Пользователь не найден"
    },
    "en": {
        "v_phone": "Phone number",
        "v_otp": "One time password",
        "not_found": "User not found"
    }
 }
</i18n>
<script>
import { mapActions, mapState, mapMutations } from 'vuex'
//VALIDATION
import { extend, localize, setInteractionMode, validate } from "vee-validate";
// setInteractionMode('eager');
import { required, digits, numeric} from "vee-validate/dist/rules";
extend('required', required);
extend('numeric', numeric);
extend('digits', digits);
extend("not_found", {
  validate(value, args) {
    return args.val === 'false';
  },
  params: ['val']
});
extend("invalid_otp", {
  validate(value, args) {
    return args.val === 'false';
  },
  params: ['val']
});
localize({
  ru: {
    messages: {
      not_found: "пользователь не найден",
      invalid_otp: "не правильно введен код"
    },
  },
  en: {
    messages: {
      not_found: "User not found",
      invalid_otp: "Invalid otp"
    },
  },
});

export default {
  layout: 'auth',
  data() {
    return {
      loading: false,
      phone: this.$route.query.phone ?? null,
      otp: '12345',
      remember_me: false,
    }
  },

  computed: {
     ...mapState({
        verification_code_sended: state => state.auth.verification_code_sended,
        user_not_found: state => state.auth.user_not_found,
        invalid_otp: state => state.auth.invalid_otp
    }),
  },
 
  methods: {
    ...mapActions({
      sendVerificationCode: 'auth/SEND_VERIFICATION_CODE',
      login: 'auth/LOGIN'
    }),
    ...mapMutations({
      resetValidation: 'auth/RESET_STATE'
    }),
    async submitPhone() {
      this.loading = true
      this.sendVerificationCode({ phone_number: this.phone })
      .finally(() => {
          this.loading = false
        })
    },
    submitCode() {
      this.loading = true
      this.login({
        phone_number: this.phone,
        otp: this.otp,
        remember_me: this.remember_me,
      }).then(() => {
          window.location.href = this.localePath('/');
      }).finally(() => {
          this.loading = false
      })
    },
  },
}
</script>
