<template>
  <div
    :id="id"
    class="modal fade"
    role="dialog"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-400">
            {{ title }}
          </h5>
          <button
            type="button"
            class="close font-weight-400"
            @click="cancelAction"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-4">
            <div class="d-flex justify-content-between">
              <button 
                class="btn btn-sm btn-danger"
                @click="cancelAction"
              >{{ $t('no') }}</button>
              <button 
                class="btn btn-sm btn-success"
                @click="confirmAction"
              >{{ $t('yes') }}</button>
            </div>
        </div>
      </div>
    </div>
  </div>
</template>
<i18n>
 {
    "ru": {
        "yes": "Да",
        "no": "Нет"
    },
    "en": {
        "yes": "Yes",
        "no": "Cancell"
    }
 }
</i18n>
<script>

export default {
  props: ["id", "title", "confirmAction", "cancelAction"],
  components: {},
  data() {
    return {
    };
  },
  computed: {},
  created() {
  },
  mounted() {
  },
  methods: {
  },
};
</script>