<template>
  <!-- Add New Card Details Modal
          ================================== -->
  <div
    id="card-form-details"
    class="modal fade"
    role="dialog"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-400">{{ $t('add_card') }}</h5>
          <button
            type="button"
            class="close font-weight-400"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-4">
          <ValidationObserver ref="observer" v-slot="{ invalid }">
            <form id="addCard" method="post" @submit.prevent="submit">
              <ValidationProvider
                v-slot="{ errors }"
                :name="$t('v_issuer')"
                :rules="'required'"
                slim
              >
                <div class="form-group">
                  <label for="cardType">{{ $t('bank') }}</label>
                  <select
                    id="cardType"
                    class="custom-select"
                    :class="{ 'is-invalid': errors.length > 0 }"
                    required=""
                    v-model="card.issuer"
                  >
                    <option 
                      value="ABN AMRO bank"
                    >ABN AMRO bank</option>
                    <option 
                      value="Consorsbank"
                    >Consorsbank</option>
                  </select>
                  <AppErrors :errors="errors" />
                </div>
              </ValidationProvider>

              <ValidationProvider
                v-slot="{ errors }"
                :name="$t('number')"
                :rules="`required|card_number_is_valid:${card_number_is_valid}`"
                slim
              >
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <img class="ml-auto" src="/images/payment/visa.png" alt="visa" title="">
                    </span>
                  </div>
                  <input
                    type="text"
                    class="form-control"
                    :class="{ 'is-invalid': errors.length > 0 }"
                    id="cardNumber"
                    required
                    placeholder="Card Number"
                    autocomplete="off"
                    data-inputmask="'mask': '9999-9999-9999-9999', 'outputFormat': '9999999999999999', 'autoUnmask': true"
                    v-model="card.number"
                    @input="cardNumberIsValid($event.target.value)"
                  />
                  <AppErrors :errors="errors" />
                </div>
              </ValidationProvider>
              <div class="form-row pt-3">
                <div class="col-lg-6">
                  <ValidationProvider
                    v-slot="{ errors }"
                    :name="$t('v_expired_at')"
                    :rules="`required|expire_date_is_valid:${expire_date_is_valid}`"
                    slim
                  >
                    <div class="form-group">
                      <label for="expiryDate">{{ $t('expire_date') }}</label>
                      <input
                        id="expiryDate"
                        type="text"
                        class="form-control"
                        :class="{ 'is-invalid': errors.length > 0 }"
                        required
                        placeholder="MM/YY"
                        v-model="card.expires_at"
                        data-inputmask="'alias': 'datetime', 'inputFormat': 'mm/yy'"
                        @input="expireDateIsValid($event.target.value)"
                      />
                      <AppErrors :errors="errors" />
                    </div>
                  </ValidationProvider>
                </div>
              </div>
              <ValidationProvider
                v-slot="{ errors }"
                :name="$t('v_cardholder_name')"
                :rules="'required|min:2|max:100'"
                slim
              >
                <div class="form-group">
                  <label for="cardHolderName">{{ $t('cardholder_name') }}</label>
                  <input
                    type="text"
                    class="form-control"
                    :class="{ 'is-invalid': errors.length > 0 }"
                    data-bv-field="cardholdername"
                    id="cardHolderName"
                    required
                    v-model="card.cardholder_name"
                    placeholder="Card Holder Name"
                  />
                  <AppErrors :errors="errors" />
                </div>
              </ValidationProvider>

              <AppButton
                class="btn btn-primary btn-block"
                type="submit"
                :actionText="card_id ? $t('update_card') : $t('add_card')"
                :loading="loading"
                :status="invalid"
              ></AppButton>
            </form>
          </ValidationObserver>
        </div>
      </div>
    </div>
  </div>
  <!-- Credit or Debit Cards End -->
</template>
<i18n>
 {
    "ru": {
        "v_issuer": "Банк выпустивщий карту",
        "v_number": "Номер карты",
        "v_expired_at": "Срок действие",
        "v_cardholder_name": "Имя обладателя"
       
    },
    "en": {
        "v_issuer": "Bank",
        "v_number": "Card number",
        "v_expired_at": "Expired date",
        "v_cardholder_name": "Cardholder name"
    }
 }
</i18n>
<i18n>
 {
    "ru": {
        "add_card": "Добавить карту",
        "update_card": "Обновить карту",
        "bank": "Банк",
        "expire_date": "Действует до",
        "cardholder_name": "Имя обладателя"
       
    },
    "en": {
        "add_card": "Add card",
        "update_card": "Update card",
        "bank": "Bank",
        "expire_date": "Expires at",
        "cardholder_name": "Cardholder name"
    }
 }
</i18n>
<script>
import { mapActions } from "vuex";
import { extend, localize, setInteractionMode, validate } from "vee-validate";
// setInteractionMode('eager');
import { required, digits, numeric, min, max } from "vee-validate/dist/rules";
extend("required", required);
extend("numeric", numeric);
extend("digits", digits);
extend("min", min);
extend("max", max);
extend("card_number_is_valid", {
  validate(value, args) {
    return args.val === "true";
  },
  params: ["val"],
});
extend("expire_date_is_valid", {
  validate(value, args) {
    return args.val === "true";
  },
  params: ["val"],
});
localize({
  ru: {
    messages: {
      card_number_is_valid: "Не верный формат",
      expire_date_is_valid: "Не верный формат",
    },
  },
  en: {
    messages: {
      card_number_is_valid: "Invalid format",
      expire_date_is_valid: "Invalid format",
    },
  },
});

export default {
  props: ["card_id"],
  components: {
  },
  data() {
    return {
      modalId: '#card-form-details',
      card_number_is_valid: true,
      expire_date_is_valid: true,
      loading: 0,
      card: null,
      default_card: {
        issuer: null,
        expires_at: null,
        number: null,
        cardholder_name: null,
      },
    };
  },
  created() {
    this.card = JSON.clone(this.default_card);
  },
  mounted() {
    var m = $(this.modalId);

    m.on("show.bs.modal", () => {
      Inputmask().mask(document.querySelectorAll("input"));
      if (this.card_id) {
        this.getCard(this.card_id);
      }
    });

    m.on("hidden.bs.modal", () => {
      this.$refs.observer.reset();
      this.card = JSON.clone(this.default_card);
      this.$parent.$data.card_id = null;
    });
  },
  computed: {},
  methods: {
    ...mapActions("cards", {
      addNewCard: "ADD_BANK_CARD",
      updateCard: "UPDATE_BANK_CARD",
      loadCards: "GET_USER_CARDS",
      loadCard: "GET_USER_CARD",
    }),
    async getCard(id) {
      var r = await this.loadCard(id);
      var card = JSON.clone(r.data.data);
      card.expires_at = this.toMMYYFormat(card.expires_at);
      this.card = card;
    },
    submit() {

      var card = { ...this.card };
      card.expires_at = this.toYYYYMMFormat(card.expires_at);
      this.createOrUpdate(card);
    },
    async createOrUpdate(card) {
      try {
        this.loading = true;
        this.card_id ? await this.updateCard(card) : await this.addNewCard(card);
        this.loadCards();
        this.$nextTick(() => {
          $(this.modalId).modal('hide');
        });
      } catch (e) { 
        console.log(e) 
      } finally {
        this.loading = false;
      }
    },
    expireDateIsValid(v) {
      this.expire_date_is_valid = Inputmask.isValid(v, {
        alias: "datetime",
        inputFormat: "mm/yy",
      });
    },
    cardNumberIsValid(v) {
      this.card_number_is_valid = Inputmask.isValid(v, {
        mask: "9999999999999999",
      });
    },
    toYYYYMMFormat(dstring) {
      var dt = dstring.split("/");
      return `20${dt[1]}-${dt[0]}`;
    },
    toMMYYFormat(dstring) {
      return this.$dayjs(dstring).format("MM/YY")
    },
  },
};
</script>