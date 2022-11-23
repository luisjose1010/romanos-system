<template>
  <v-app>
    <div class="background">
      <v-main class="d-flex justify-centrer align-center">
        <v-col
          cols="10"
          lg="4"
          class="mx-auto"
        >
          <LoginForm
            v-if="!recoverPassword"
            @login="$emit('login')"
            @recoveryPassword="recoverPassword = true"
          />
          <RecoveryPassword
            v-else
            @submit="recoverPassword = false"
          />
        </v-col>
      </v-main>
    </div>
  </v-app>
</template>

<script>
import LoginForm from '@/components/login/LoginForm.vue';
import RecoveryPassword from '@/components/login/RecoveryForm.vue';

export default {
  name: 'Login',
  components: {
    LoginForm,
    RecoveryPassword,
  },

  data: () => ({
    recoverPassword: false,
  }),
};
</script>

<style>
.background{
  background-image: url(./../../assets/img/pizza.jpg) !important;
  width: 300px;
  width: 100%;
  display: block;
  position: absolute;
  height: 100%;
  top: 0;
  background-size: cover;
}
</style>
