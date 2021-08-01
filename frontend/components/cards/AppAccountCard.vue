<template>
  <div
    class="
      account-card account-card-primary
      text-white
      rounded
      p-3
      mb-4 mb-lg-0
    "
  >
    <p class="text-4"> {{ card.number }}</p>
    <p class="d-flex align-items-center">
      <span
        class="account-card-expire text-uppercase d-inline-block opacity-7 mr-2"
        >Valid<br />
        thru<br />
      </span>
      <span class="text-4 opacity-9">{{ card.expires_at }}</span>
    </p>
    <p class="d-flex align-items-center m-0">
      <span class="text-uppercase font-weight-500">{{ card.cardholder_name }}</span>
      <img class="ml-auto" src="/images/payment/visa.png" alt="visa" title="" />
    </p>
    <div class="account-card-overlay rounded">
      <a
        style="cursor: pointer"
        @click="editFunc(card.id)"
        class="text-light btn-link mx-2"
      >
        <span class="mr-1">
          <i class="fas fa-edit"></i>
        </span>{{$t('edit')}}
      </a>
      <a 
        style="cursor: pointer"
        @click="deleteFunc(card.id)"
        class="text-light btn-link mx-2">
        <span class="mr-1">
          <i class="fas fa-minus-circle"></i>
        </span>{{$t('delete')}}
      </a>
    </div>
  </div>
</template>
<i18n>
 {
    "ru": {
        "edit": "Изменить",
        "delete": "Удалить"
    },
    "en": {
        "edit": "Edit",
        "delete": "Delete"
    }
 }
</i18n>
<script>
export default {
  props:['card', 'editFunc', 'deleteFunc']
}
</script>