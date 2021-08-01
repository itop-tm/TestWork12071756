<template>
  <li class="dropdown profile ml-2">
    <a class="px-0 dropdown-toggle" href="#"
      ><img 
        class="rounded-circle" 
        src="/images/profile-thumb.jpg" height="25px" alt="" />
        <i class="arrow"></i
    ></a>
    <ul class="dropdown-menu" style="margin-left: -190.016px">
      <li class="text-center text-3 py-2">{{ getName() }}</li>
      <li class="dropdown-divider mx-n3"></li>
      <li>
        <a class="dropdown-item" href="#"
          ><i class="fas fa-user"></i>{{ $t('my_cards') }}</a
        >
      </li>
      <li class="dropdown-divider mx-n3"></li>
      <li>
        <a class="dropdown-item" href="#"
          ><i class="fas fa-life-ring"></i>{{ $t('need_help') }}</a
        >
      </li>
      <li>
        <a 
          class="dropdown-item m-0"
          href="#"
          @click="logOut()"
        ><i class="fas fa-sign-out-alt"></i>{{ $t('logout') }}
        </a>
      </li>
    </ul>
  </li>
</template>
<i18n>
 {
    "ru": {
        "my_cards": "Мои карты",
        "need_help": "Нужна помошь?",
        "logout": "Выйти"
    },
    "en": {
        "my_cards": "My сards",
        "need_help": "Need help?",
        "logout": "Logout"
    }
 }
</i18n>
<script>
import { mapGetters } from "vuex";

export default {
  methods: {
    ...mapGetters("user", ["getName"]),
    logOut() {
      this.$cookie.removeAll();
      window.location.href = `${this.localePath("/")}`;
    },
  },
};
</script>