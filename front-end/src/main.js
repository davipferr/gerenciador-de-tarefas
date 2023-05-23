import Vue from 'vue'
import App from './App.vue'
import { router } from './routes';
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap/dist/js/bootstrap.js'
import '../main.css';
import '@mdi/font/css/materialdesignicons.css';
import axios from 'axios';

axios.defaults.baseURL = 'http://127.0.0.1:8000';

Vue.config.productionTip = false

Vue.use(Vuetify)

const vuetify = new Vuetify()

new Vue({
  router,
  vuetify,
  render: h => h(App),
}).$mount('#app')
