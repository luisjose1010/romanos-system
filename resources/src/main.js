import Vue from 'vue';
import App from './App.vue';
import './registerServiceWorker';
import vuetify from '@/plugins/vuetify';
import router from './router';
import '@/main.scss';

Vue.config.productionTip = false;

new Vue({
  router,
  vuetify,
  render: (h) => h(App),
}).$mount('#app');
