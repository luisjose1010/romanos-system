/**
 * plugins/vuetify.js
 *
 * Framework documentation: https://vuetifyjs.com`
 */

// Styles
import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/styles'
import es from 'vuetify/lib/locale/es';

// Composables
import { createVuetify } from 'vuetify'

// https://vuetifyjs.com/en/introduction/why-vuetify/#feature-guides
export default createVuetify({
  theme: {
    options: {
      customProperties: true,
    },
    defaultTheme: 'mainTheme',
    themes: {
      mainTheme: {
        colors: {
          primary: '#E60026',
          secondary: '#424242',
          accent: '#82B1FF',
          error: '#FF5252',
          info: '#2196F3',
          success: '#4CAF50',
          warning: '#FFC107',
        }
      },
    }
  },
  icons: {
    iconfont: 'mdiSvg',
  },
  lang: {
    locales: { es },
    current: 'es',
  },
})
