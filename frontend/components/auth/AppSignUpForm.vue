<template>
  <div>
    <h3 class="font-weight-400 mb-4">{{ $t('sign_up_title') }}</h3>

    <ValidationObserver ref="signup_form" v-slot="{ invalid }">

      <form id="loginForm" @submit.prevent="submit">

        <ValidationProvider
          class="form-group"
          v-slot="{ errors }"
          :name="$t('v_firstname')"
          :rules="'alpha|min:1|max:100'"
        >
          <label for="firstname">{{ $t('firstname') }}</label>
          <input
            type="text"
            class="form-control"
            id="firstname"
            v-model="firstname"
            :placeholder="$t('v_firstname')"
            required
            :class="{ 'is-invalid': errors.length > 0 }"
          />
          <AppErrors :errors="errors"/>
        </ValidationProvider>

        <div class="pt-3"></div>

        <ValidationProvider
          class="form-group"
          v-slot="{ errors }"
          :name="$t('v_lastname')"
          :rules="'alpha|min:1|max:100'"
        >
          <label for="lastname">{{ $t('lastname') }}</label>
          <input
            type="text"
            class="form-control"
            id="lastname"
            v-model="lastname"
            required
            :placeholder="$t('v_lastname')"
            :class="{ 'is-invalid': errors.length > 0 }"
          />
          <AppErrors :errors="errors" />
        </ValidationProvider>

        <div class="pt-3"></div>

        <ValidationProvider
          class="form-group"
          v-slot="{ errors }"
          :name="$t('v_phone')"
          :rules="`digits:11|already_exists:${user_already_exists}`"
        >
          <label for="phone_number">{{ $t('phone_number') }}</label>
          <input
            type="number"
            class="form-control"
            id="phone_number"
            v-model="phone_number"
            required
            placeholder="31xxxxxxxxx"
            :class="{ 'is-invalid': errors.length > 0 }"
            @input="resetValidation()"
          />
          <AppErrors :errors="errors" />
        </ValidationProvider>

        <AppButton
          class="btn btn-primary btn-block my-4"
          type="submit"
          :actionText="$t('sign_up')"
          :loading="loading"
          :status="invalid"
        ></AppButton>
      </form>
    </ValidationObserver>

    <p class="text-3 text-center text-muted">
      {{ $t('already_registered') }}
      <nuxt-link 
        class="btn-link" 
        :to="$lp('/auth/sign-in')"
      >{{ $t('sign-in') }}
      </nuxt-link>
    </p>
  </div>
</template>
<i18n>
 {
    "ru": {
        "sign_up_title": "Регистрация",
        "sign_up": "Регистрация",
        "already_registered": "Уже зарегистрированы?",
        "firstname": "Имя",
        "lastname": "Фамилия",
        "phone_number": "Моб. номер",
        "sign-in": "Войти"
    },
    "en": {
        "sign_up_title": "Sign up",
        "sign_up": "Sign up",
        "already_registered": "Already registered?",
        "firstname": "Firstname",
        "lastname": "Lastname",
        "phone_number": "Phone number",
        "sign-in": "Sign in"
    }
 }
</i18n>
<i18n>
 {
    "ru": {
        "v_firstname": "Имя",
        "v_lastname": "Фамилия",
        "v_phone": "Моб. номер"
    },
    "en": {
        "v_firstname": "Firstname",
        "v_lastname": "Lastname",
        "v_phone": "Phone number"
    }
 }
</i18n>
<script>
import { mapActions, mapState, mapMutations } from "vuex";
import { extend, localize } from "vee-validate";
// setInteractionMode('eager');
import { alpha, required, digits, min, max, numeric } from "vee-validate/dist/rules";
extend("required", required);
extend("numeric", numeric);
extend("digits", digits);
extend("min", min);
extend("max", max);
extend("alpha", alpha);
extend("already_exists", {
  validate(value, args) {
    return args.val === "false";
  },
  params: ["val"],
});
localize({
  ru: {
    messages: {
      already_exists: "Пользователь c таким номером уже зарегистрирован"
    },
  },
  en: {
    messages: {
      already_exists: "Phone number already taken"
    },
  },
});

export default {
  layout: "auth",
  data() {
    return {
      loading: false,
      firstname: "",
      lastname: "",
      phone_number: "",
    };
  },

  computed: {
    ...mapState({
      user_already_exists: (state) => state.auth.user_already_exists,
    }),
  },

  methods: {
    ...mapActions({
      register: "auth/REGISTER_USER",
    }),
    ...mapMutations({
      resetValidation: "auth/RESET_STATE",
    }),
    submit() {
      this.loading = true;
      this.register({
        phone_number: this.phone_number,
        firstname: this.firstname,
        lastname: this.lastname,
      }).then((r) => {
        this.$router.push(this.localePath(`/auth/sign-in?phone=${this.phone_number}`))
      }).catch((e) => {
        console.log(e)
      }).finally(() => {
        this.loading = false;
      });
    },
  },
};
</script>
