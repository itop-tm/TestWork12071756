<template>
  <component :is="'PageView'" />
</template>
<script>
import PageView from '@/views/main/index'
export default {
  name: 'index',
  components: {
    PageView
  },
}
</script>