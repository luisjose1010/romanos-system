<template>
  <v-app>
    <v-container fluid>
      <v-navigation-drawer
        v-model="drawer"
        app
        dark
      >
        <v-list dense>
          <v-list-item
            v-for="item in nav"
            :key="item.title"
            link
            :href="item.link"
            :title="item.title"
            text
          >
            <v-list-item-action>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>{{ item.text }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </v-navigation-drawer>

      <v-app-bar
        app
        color="cyan darken-4"
        dark
      >
        <img
          src="./../../img/romanos-logo.jpg"
          alt="Romano's Pizza"
        >

        <v-spacer />
        <v-toolbar-items class="d-none d-md-flex">
          <v-btn
            v-for="item in nav"
            :key="item.icon"
            :href="item.link"
            :title="item.title"
            text
          >
            {{ item.text }}
          </v-btn>
        </v-toolbar-items>

        <v-app-bar-nav-icon
          class="d-md-none"
          @click.stop="drawer = !drawer"
        />
      </v-app-bar>

      <v-main>
        <slot />
      </v-main>
    </v-container>
  </v-app>
</template>

<script>
export default {
  data() {
    return {
      dialog: false,
      nav: [
        {
          text: 'Inicio',
          title: 'Página de inicio',
          icon: 'mdi-home',
          link: '/',
        },
        {
          text: 'Productos',
          title: 'lleva a la pagina de productos',
          icon: 'mdi-cart',
          link: '/productos',
        },
        {
          text: 'Vender',
          title: 'lleva a la pagina para vender',
          icon: '',
          link: '/vender/agregar',
        },
      ],
      drawer: false,
    };
  },
};
</script>

<style scoped>
img {
  max-width: 15%;
  height: auto;
}
</style>
