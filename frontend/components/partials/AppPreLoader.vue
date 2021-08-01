<template>
  <!-- Preloader -->
  <div id="preloader">
    <div data-loader="dual-ring"></div>
  </div>
  <!-- Preloader End --> 
</template>

<script>
export default {
  mounted() {
      $('[data-loader="circle-side"]').fadeOut(); // will first fade out the loading animation
      $('#preloader').delay(333).fadeOut('slow'); // will fade out the white DIV that covers the website.
      $('body').delay(333);
  }
}
</script>