const webpack = require('webpack');

export default {
  // Target: https://go.nuxtjs.dev/config-target
  target: 'static',
  ssr: false,
  generate: {
    crawler: false
  },

  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    title: 'Abelohost | Offshore Payments',
    htmlAttrs: {
      lang: 'en'
    },
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: '' },
      { name: 'format-detection', content: 'telephone=no' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' },
      { rel: 'stylesheet', type: 'text/css', href: 'https://fonts.googleapis.com/css?family=Rubik:300,300i,400,400i,500,500i,700,700i,900,900i' }
    ],
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: [
    '@/node_modules/bootstrap/dist/css/bootstrap.min.css',
    'assets/css/stylesheet.css',
    '@/node_modules/@fortawesome/fontawesome-free/css/all.min.css',
  ],

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
    { src: '~/plugins/ui/index.js' },
    { src: '~/plugins/bootstrap.js', mode: 'client' },
    { src: '~/plugins/axios.js' },
    { src: '~/plugins/validator.js' },
    { src: '~/plugins/dayjs.js' },
  ],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  router: {
    linkActiveClass: 'active',
    linkExactActiveClass: 'active',
    middleware: ['setUserPayload'],
  },

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
   
  ],

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    '@nuxtjs/axios',
    '@nuxtjs/dotenv',
    ['@nuxtjs/proxy', { systemvars: true }],
    'nuxt-i18n',
    ['cookie-universal-nuxt', { alias: 'cookie' }],
  ],

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
    plugins: [
      new webpack.ProvidePlugin({
        Vue: ['vue/dist/vue.esm.js', 'default'],
        jQuery: 'jquery',
        $: 'jquery',
        'window.jQuery': 'jquery',
      }),
    ],
  },

  i18n: {
    strategy: 'prefix',
    locales: [
      {
        code: 'ru',
        file: 'ru.json',
        name: 'Русский'
      },
      {
        code: 'en',
        file: 'en.json',
        name: 'English'
      }
    ],
    lazy: true,
    langDir: 'locales/',
    defaultLocale: 'en',
    vueI18nLoader: true,
    vueI18n: {
      fallbackLocale: 'en',
      silentFallbackWarn: true,
      silentTranslationWarn: true
    },
    detectBrowserLanguage: {
      useCookie: true,
      cookieKey: 'user_lang',
      alwaysRedirect: false,
      fallbackLocale: 'en'
    }
  },

  axios: {
    baseURL: process.env.API_URL,
    proxy: true,
    debug: true,
    prefix: '/api'
  },
  proxy: {
    '/api': {
        target: process.env.API_URL,
    },
  },
}
