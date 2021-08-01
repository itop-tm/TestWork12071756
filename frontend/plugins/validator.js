import Vue from 'vue'
import { ValidationProvider, ValidationObserver, localize} from 'vee-validate';
import ru from '~/locales/validator/ru.json';
import en from 'vee-validate/dist/locale/en.json';
localize('ru', ru);
localize('en', en);
Vue.component('ValidationProvider', ValidationProvider);
Vue.component("ValidationObserver", ValidationObserver);