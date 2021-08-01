<template>
  <button :disabled="loading || status">
    <span
      class="spinner-border spinner-border-sm"
      role="status"
      aria-hidden="true"
      v-if="loading"
    >
    </span>
    <span v-else>
      {{ actionText }}
    </span>
  </button>
</template>
<script>
export default {
  props: ['actionText', 'loading', 'status'],
}
</script>
