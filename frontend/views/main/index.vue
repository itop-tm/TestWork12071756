<template>
  <div>
      <div id="content">
        <section class="section pt-3 px-0 px-sm-4">
          <div class="col-xs-12 col-md-11 container d-flex justify-content-center">
            <!-- Create cards
              ============================================= -->
              <div class="col-md-6 mb-5">
                <div class="bg-white shadow-sm rounded p-5 text-center">
                  <div class="featured-box style-4">
                    <div class="featured-box-icon text-light border rounded-circle shadow-none"> 
                      <i class="fas fa-credit-card"></i> 
                    </div>
                    <h3 class="text-body text-7 mb-3">Send Money</h3>
                    <p class="text-4 line-height-4">You can easily make payments at excellent rates.</p>
                    <div class="text-primary text-10 pt-3 pb-4 mb-2">up to 1.0%</div>
                      <nuxt-link
                        :to="$lp('/cards')"
                        class="btn btn-success"
                      >Create card</nuxt-link>
                    </div>
                </div>
              </div>
              <!-- Create cards end --> 
          </div>
        </section>
      </div>
  </div>
</template>
<script>
export default {
  components: {},
  computed: {},
  async created() {},
  methods: {},
}
</script>