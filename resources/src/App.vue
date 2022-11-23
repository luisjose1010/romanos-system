<template>
  <v-app>
    <v-navigation-drawer
      v-if="logged"
      app
      permanent
      expand-on-hover
      right
      dark
      src="https://cdn.vuetifyjs.com/images/backgrounds/bg-2.jpg"
    >
      <v-list>
        <v-list-item link>
          <v-avatar
            size="30"
            color="red darken-4"
          >
            <v-icon
              size="20"
              color="red"
            >
              mdi-account-circle
            </v-icon>
          </v-avatar>
          <v-list-item-content>
            <v-list-item-title class="text-h6">
              Name Lastname
            </v-list-item-title>
            <v-list-item-subtitle>email@mail.com</v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
      </v-list>

      <v-divider />

      <v-list
        nav
        dense
      >
        <v-list-item
          link
          to="/logout"
        >
          <v-list-item-icon>
            <v-icon>mdi-close-circle-outline</v-icon>
          </v-list-item-icon>
          <v-list-item-title>Cerrar sesión</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar
      v-if="logged"
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
      v-if="logged"
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

    <router-view v-if="logged" />

    <Login
      v-else
      @login="login()"
    />
  </v-app>
</template>

<script>
import Login from '@/components/login/Login.vue';

export default {
  components: {
    Login,
  },
  data() {
    return {
      drawer: false,
      logged: false,
    };
  },
  mounted() {
    this.login();
  },
  methods: {
    login() {
      console.log(localStorage.getItem('user'));
      if (localStorage.getItem('user')) {
        this.logged = true;
      }
    },
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
