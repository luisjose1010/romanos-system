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
    </v-app-bar>

    <router-view />
  </v-app>
</template>

<style lang="scss">
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
</style>
