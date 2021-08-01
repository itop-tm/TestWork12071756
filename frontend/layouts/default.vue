<template>
<div id="main-wrapper"> 
  <AppHeader/>
    <Nuxt/>
  <AppFooter/>
</div>
</template>
<script>
import AppHeader from '@/components/layouts/AppHeader'
import AppFooter from '@/components/layouts/AppFooter'
export default {
  middleware: [],
  components: {
    AppHeader,
    AppFooter
  }
}
</script>
