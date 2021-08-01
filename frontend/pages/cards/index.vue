<template>
  <component :is="'PageView'" />
</template>
<script>
import PageView from '@/views/cards/index'
export default {
  middleware: ['authUser'],
  components: {
    PageView
  },
}
</script>