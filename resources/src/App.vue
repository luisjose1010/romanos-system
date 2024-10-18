<template>
  <v-app>
    <v-navigation-drawer v-model="userDrawer" v-if="logged" location="right" dark
      src="https://cdn.vuetifyjs.com/images/backgrounds/bg-2.jpg" :rail="rail" @click="rail = false"
      class="d-print-none">
      <div class="d-flex justify-start">
        <v-btn @click.stop="rail = !rail" icon flat class="mt-2 mx-1">
          <v-icon color="red">
            mdi-menu
          </v-icon>
        </v-btn>
      </div>
      <v-list>
        <v-list-item :to="`/usuarios/${user.id}`" link>
          <template v-slot:prepend>
            <v-avatar size="30" color="red darken-4">
              <v-icon size="20" color="red">
                mdi-account-circle
              </v-icon>
            </v-avatar>
          </template>
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

      <v-list nav dense>
        <v-list-item v-if="user.role.name === 'Administrador' || user.role.name === 'Gerente'" link to="/usuarios">
          <template v-slot:prepend>
            <v-icon>mdi-account-edit-outline</v-icon>
          </template>
          <v-list-item-title>Administrar usuarios</v-list-item-title>
        </v-list-item>
        <v-list-item v-if="user.role.name === 'Administrador'" link to="/registrar-usuario">
          <template v-slot:prepend>
            <v-icon>mdi-account-plus-outline</v-icon>
          </template>
          <v-list-item-title>Registrar usuario</v-list-item-title>
        </v-list-item>
        <v-list-item v-if="user.role.name === 'Administrador' || user.role.name === 'Gerente'" link
          to="/copia-de-seguridad">
          <template v-slot:prepend>
            <v-icon>mdi-backup-restore</v-icon>
          </template>
          <v-list-item-title>Copia de seguridad</v-list-item-title>
        </v-list-item>
        <v-list-item link to="/logout">
          <template v-slot:prepend>
            <v-icon>mdi-logout</v-icon>
          </template>
          <v-list-item-title>Cerrar sesión</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar v-if="logged" app color="primary" dark class="d-print-none">
      <template v-slot:prepend>
        <v-img alt="Vuetify Logo" class="shrink mx-4" contain src="@/assets/romanos-logo.png"
          transition="scale-transition" width="150" />
      </template>

      <v-spacer />

      <div class="d-none d-lg-block">
        <v-btn to="/" class="mx-2" link>
          <span>Inicio</span>
        </v-btn>

        <v-btn to="/clientes" class="mx-2" link>
          <span>Clientes</span>
        </v-btn>

        <v-btn to="/vender" class="mx-2" link>
          <span>Vender</span>
        </v-btn>

        <v-btn to="/ventas" class="mx-2" link>
          <span>Ventas</span>
        </v-btn>
      </div>

      <v-app-bar-nav-icon class="d-lg-none" @click.stop="drawer = !drawer" />
    </v-app-bar>

    <v-navigation-drawer v-if="logged" v-model="drawer" app dark class="d-print-none">
      <v-list-item to="/" link>
        <span>Inicio</span>
      </v-list-item>
      <v-list-item to="/clientes" link>
        <span>Clientes</span>
      </v-list-item>
      <v-list-item to="/vender" link>
        <span>Vender</span>
      </v-list-item>
      <v-list-item to="/ventas" link>
        <span>Ventas</span>
      </v-list-item>
      <v-list-item @click.stop="userDrawer = !userDrawer" link>
        <v-icon class="mr-2">
          mdi-account-circle
        </v-icon>
        <span>Usuario</span>
      </v-list-item>
    </v-navigation-drawer>

    <router-view v-if="logged" />

    <Login v-else @login="login()" />
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
      userDrawer: true,
      rail: true,
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
