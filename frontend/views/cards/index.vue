<template>
  <div class="container" style="min-height: 500px">
    <div class="d-flex justify-content-center pt-4">
      <div class="col-lg-12">
        <h2 class="font-weight-400 mb-3">{{ $t("cards") }}</h2>

        <div class="bg-white shadow-sm rounded p-4 mb-4">
          <h3 class="text-5 font-weight-400 mb-4">
              {{ $t('bank_cards') }}
            <span class="text-muted text-4"></span>
          </h3>
          <hr class="mb-4 mx-n4" />
          <div class="">
              <div 
                v-if="loadStatus == 1" 
                class="d-flex justify-content-center"
              >
                <AppLoading class="m-4"/>
              </div>
              <div 
                v-if="loadStatus == 0" 
                class="d-flex flex-wrap justify-content-center justify-content-md-start align-items-center"
              >
                <div 
                    class="px-2 py-2"
                    v-for="card in cards" 
                    v-bind:key="card.id"
                    style="width:250px"
                  >
                    <AppAccountCard 
                      :card="card" 
                      v-if="card"
                      :editFunc="showCardFormModal"
                      :deleteFunc="showConfirmDeleteModal"
                    />
                </div>
                <div class="px-2 py-2" style="width:250px;">
                  <a
                    style="cursor: pointer"
                    @click="showCardFormModal()"
                    class="
                      d-flex
                      align-items-center
                      rounded
                      h-100
                      p-3
                      mb-4 mb-lg-0
                    "
                  >
                    <p class="w-100 text-center line-height-4 m-0">
                      <span class="text-3">
                        <i class="fas fa-plus-circle"></i>
                      </span>
                      <span class="d-block text-body text-3">{{ $t('add_new_card') }}</span>
                    </p>
                  </a>
                </div>
              </div>
          </div>
        </div>

        <AppCardFormModal :card_id="card_id" />

        <AppConfirmActionModal 
          id="confirm-action-modal"
          :title="$t('delete_title')"
          :confirmAction="deleteCard"
          :cancelAction="hideConfirmDeleteModal"
        />

      </div>
    </div>
  </div>
</template>
<i18n>
 {
    "ru": {
        "delete_title": "Вы дейтвительно хотите удалить карту?",

        "cards": "Мои карты",
        "bank_cards": "Банковские карты",
        "add_new_card": "Добавить новую карту"
       
    },
    "en": {
       "delete_title": "Do you really want to delete the bank card?",

        "cards": "My bank cards",
        "bank_cards": "Bank cards",
        "add_new_card": "Add new bank card"
    }
 }
</i18n>

<script>
import { mapState, mapActions } from "vuex";

import AppAccountCard from "~/components/cards/AppAccountCard.vue";
import AppCardFormModal from "~/components/cards/AppCardFormModal.vue";
import AppConfirmActionModal from "~/components/partials/AppConfirmActionModal.vue";

export default {
  components: {
    AppAccountCard,
    AppCardFormModal,
    AppConfirmActionModal
  },
  data() {
    return {
      delete_card_id: null,
      card_id: null
    };
  },
  created() {
    this.loadCards();
  },
  computed: {
    ...mapState({
      loadStatus: (state) => state.cards.loadStatus,
      cards: (state) => state.cards.cards,
      card: (state) => state.cards.card
    }),
  },
  methods: {
    ...mapActions("cards", {
      getUserCards: "GET_USER_CARDS",
      getUserCard: "GET_USER_CARD",
      deleteBankCard: "DELETE_BANK_CARD"
    }),
    async loadCards() {
      await this.getUserCards();
    },
    async loadCard(id) {
      await this.getUserCard(id);
    },
    async deleteCard() {
      await this.deleteBankCard(this.delete_card_id);
      this.loadCards();
      this.hideConfirmDeleteModal();
    },
    showCardFormModal(cardId = null) {
      this.card_id = cardId
      this.$nextTick(() => {
          $('#card-form-details').modal('show');
      })
    },
    showConfirmDeleteModal(cardId = null) {
      this.delete_card_id = cardId
      this.$nextTick(() => {
          $('#confirm-action-modal').modal('show');
      })
    },
    hideConfirmDeleteModal() {
      this.delete_card_id = null
      this.$nextTick(() => {
          $('#confirm-action-modal').modal('hide');
      })
    },
  },
};
</script>