<template>
  <component :is="'PageView'" />
</template>
<script>
import PageView from '@/views/auth/sign-up'
export default {
  name: 'index',
  layout: 'auth',
  components: {
    PageView
  },
}
</script>