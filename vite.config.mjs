// Plugins
import Components from 'unplugin-vue-components/vite'
import Vue from '@vitejs/plugin-vue'
import Vuetify, { transformAssetUrls } from 'vite-plugin-vuetify'
import ViteFonts from 'unplugin-fonts/vite'
import VueRouter from 'unplugin-vue-router/vite'
import { createHtmlPlugin } from 'vite-plugin-html'

// Utilities
import { defineConfig } from 'vite'
import { fileURLToPath, URL } from 'node:url'

// https://vitejs.dev/config/
export default defineConfig({
  envPrefix: 'VITE_',
  build: {
    outDir: './public_html',
    emptyOutDir: false,
  },
  plugins: [
    createHtmlPlugin({
      /**
       * Here is path to your html file.
       * You can replace with any path what you want.
       * 
       * This `app.html` stored in root of directory.
       */
      template: 'resources/src/app.html',
    }),
    VueRouter({
      routesFolder: 'resources/src/pages/',
    }),
    Vue({
      template: { transformAssetUrls }
    }),
    // https://github.com/vuetifyjs/vuetify-loader/tree/master/packages/vite-plugin#readme
    Vuetify({
      autoImport: true,
      styles: {
        configFile: 'resources/src/styles/settings.scss',
      },
    }),
    Components({ dirs: 'resources/src/components' }),
    ViteFonts({
      google: {
        families: [{
          name: 'Roboto',
          styles: 'wght@100;300;400;500;700;900',
        }],
      },
    }),
  ],
  define: { 'process.env': {} },
  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./resources/src', import.meta.url))
    },
    extensions: [
      '.js',
      '.json',
      '.jsx',
      '.mjs',
      '.ts',
      '.tsx',
      '.vue',
    ],
  },
  server: {
    port: 3000,
  },
})

