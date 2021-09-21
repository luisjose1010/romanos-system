import Vue from 'vue';
import Vuetify from 'vuetify';

// Importa los componentes de las vistas, encontradas en su carpeta respectiva
const files = require.context('./views/', true, /\.vue$/i);
files.keys().map((key) => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.use(Vuetify);

const app = new Vue({
  el: '#app',
  vuetify: new Vuetify(),
});

export default app;
