<template>
  <v-card class="card">
    <div class="text-center">
      <v-avatar
        size="90"
        color="red darken-4"
        class="mt-3"
      >
        <v-icon
          size="80"
          color="red"
        >
          mdi-account-circle
        </v-icon>
      </v-avatar>
      <h2 class="red--text">
        Iniciar sesión <br>
        Romano's System
      </h2>
    </div>
    <v-form>
      <v-card-text>
        <v-text-field
          v-model="formData.username"
          type="text"
          label="Usuario"
          placeholder="Username"
        />
        <v-text-field
          v-model="formData.password"
          type="password"
          label="Contraseña"
          placeholder="Password"
        />
      </v-card-text>
      <v-card-actions class="justify-center">
        <v-btn
          color="red"
          @click="getToken()"
        >
          <span class="white--text px-8">Enter</span>
        </v-btn>
      </v-card-actions>
      <a
        href="#"
        @click="$emit('recoveryPassword')"
      >
        ¿Ha olvidado su contraseña?
      </a>
    </v-form>

    <v-alert
      v-model="showAlert"
      outlined
      dismissible
      transition="scale-transition"
      :type="alertType"
      class="mt-3"
    >
      {{ alertText }}
    </v-alert>
  </v-card>
</template>

<script>
import api from '@/api';
// import utilities from '@/utilities';

export default {
  name: 'LoginForm',
  data: () => ({
    showAlert: false,
    alertText: '',
    alertType: 'success',
    formData: {
      username: null,
      password: null,
    },
    user: {
      username: null,
      name: null,
      password: null,
      role: null,
      token: null,
    },
  }),
  methods: {
    getToken() {
      api
        .get('/token', {
          auth: {
            username: this.formData.username,
            password: this.formData.password,
          },
        })
        .then((response) => {
          this.user = response.data;
          localStorage.setItem('user', JSON.stringify(this.user));
          this.$emit('login', this.user);
        })
        .catch((error) => {
          switch (error.response.status) {
            case 401:
              this.alertText = 'Usuario o contraseña incorrectos';
              this.alertType = 'error';
              this.showAlert = true;
              break;

            default:
              this.alertText = error.response.data.error;
              this.alertType = 'error';
              this.showAlert = true;
              break;
          }
        });
    },
  },
};
</script>
