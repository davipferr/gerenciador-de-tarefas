import Vue from 'vue'
import App from './App.vue'
import { router } from './routes';
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap/dist/js/bootstrap.js'
import '../main.css';

Vue.config.productionTip = false

Vue.use(Vuetify)

const vuetify = new Vuetify()

new Vue({
  router,
  vuetify,
  render: h => h(App),
}).$mount('#app')
