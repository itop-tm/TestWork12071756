<template>
  <component :is="'PageView'" />
</template>
<script>
import PageView from '@/views/auth/sign-in'
export default {
  name: 'index',
  layout: 'auth',
  components: {
    PageView
  },
}
</script>