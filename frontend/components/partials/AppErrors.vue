<template>
  <span v-show="errors.length>0" class="invalid-feedback">{{ errors[0] }}</span>
</template>
<script>
export default {
  props: ['errors'],
}
</script>
