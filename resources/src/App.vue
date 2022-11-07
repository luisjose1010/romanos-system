<template>
  <v-app>
    <v-app-bar
      app
      color="primary"
      dark
    >
      <div class="d-flex align-center">
        <v-img
          alt="Vuetify Logo"
          class="shrink mr-2"
          contain
          src="@/assets/romanos-logo.jpg"
          transition="scale-transition"
          width="150"
        />
      </div>

      <v-spacer />

      <div class="d-none d-md-block">
        <v-btn
          to="/"
          text
        >
          <span class="mr-2">Inicio</span>
        </v-btn>

        <v-btn
          to="/clientes"
          text
        >
          <span class="mr-2">Clientes</span>
        </v-btn>

        <v-btn
          to="/vender"
          text
        >
          <span class="mr-2">Vender</span>
        </v-btn>

        <v-btn
          to="/ventas"
          text
        >
          <span class="mr-2">Ventas</span>
        </v-btn>
      </div>

      <v-app-bar-nav-icon
        class="d-md-none"
        @click.stop="drawer = !drawer"
      />
    </v-app-bar>

    <v-navigation-drawer
      v-model="drawer"
      app
      dark
    >
      <v-list dense>
        <v-list-item>
          <v-list-item-content>
            <v-btn
              to="/"
              text
            >
              <span class="mr-2">Inicio</span>
            </v-btn>

            <v-btn
              to="/vender"
              text
            >
              <span class="mr-2">Vender</span>
            </v-btn>

            <v-btn
              to="/ventas"
              text
            >
              <span class="mr-2">Ventas</span>
            </v-btn>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <router-view />
  </v-app>
</template>

<script>
export default {
  data() {
    return {
      drawer: false,
    };
  },
};
</script>

<style lang="scss">
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
</style>
