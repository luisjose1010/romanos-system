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
      class="d-print-none"
    >
      <v-list>
        <v-list-item
          :to="`/usuarios/${user.id}`"
          link
        >
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
              {{ user.name }}
            </v-list-item-title>
            <v-list-item-subtitle>Usuario: {{ user.username }}</v-list-item-subtitle>
            <v-list-item-subtitle v-if="user.idCard">
              Cédula: {{ user.idCard }}
            </v-list-item-subtitle>
            <v-list-item-subtitle v-if="user.role">
              ({{ user.role.name }})
            </v-list-item-subtitle>
            <v-list-item-subtitle v-if="user.email">
              {{ user.email }}
            </v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
      </v-list>

      <v-divider />

      <v-list
        nav
        dense
      >
        <v-list-item
          v-if="user.role.name === 'Administrador' || user.role.name === 'Gerente'"
          link
          to="/usuarios"
        >
          <v-list-item-icon>
            <v-icon>mdi-account-edit-outline</v-icon>
          </v-list-item-icon>
          <v-list-item-title>Administrar usuarios</v-list-item-title>
        </v-list-item>
        <v-list-item
          v-if="user.role.name === 'Administrador'"
          link
          to="/registrar-usuario"
        >
          <v-list-item-icon>
            <v-icon>mdi-account-plus-outline</v-icon>
          </v-list-item-icon>
          <v-list-item-title>Registrar usuario</v-list-item-title>
        </v-list-item>
        <v-list-item
          v-if="user.role.name === 'Administrador' || user.role.name === 'Gerente'"
          link
          to="/copia-de-seguridad"
        >
          <v-list-item-icon>
            <v-icon>mdi-backup-restore</v-icon>
          </v-list-item-icon>
          <v-list-item-title>Copia de seguridad</v-list-item-title>
        </v-list-item>
        <v-list-item
          link
          to="/logout"
        >
          <v-list-item-icon>
            <v-icon>mdi-logout</v-icon>
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
      class="d-print-none"
    >
      <div class="d-flex align-center">
        <v-img
          alt="Vuetify Logo"
          class="shrink mr-2"
          contain
          src="@/assets/romanos-logo.png"
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
      class="d-print-none"
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
      user: {
        id: '',
        username: '',
        name: '',
        idCard: '',
        email: '',
        role: {
          id: null,
          name: '',
        },
      },
      drawer: false,
      logged: false,
    };
  },
  mounted() {
    this.login();
  },
  methods: {
    login() {
      if (localStorage.getItem('user')) {
        this.user = JSON.parse(localStorage.getItem('user'));
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
