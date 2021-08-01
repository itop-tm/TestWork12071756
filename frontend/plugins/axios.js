import authAPI from '~/api/auth'
import cardsAPI from '~/api/cards'

export default function ({app, $axios}, inject) {

   $axios.onRequest(config => {
      $axios.setHeader('Accept-Language', app.i18n.locale)
      $axios.setHeader('Accept', 'application/json')
   });

   try {
      const token = app.$cookie.get('tp_user');
      if (token) {
         $axios.setHeader('Authorization', 'Bearer ' + token.token)
      }
     
   } catch (error) {}

   const api = {
      auth: authAPI($axios),
      cards: cardsAPI($axios)
    }

   inject('api', api);
}
