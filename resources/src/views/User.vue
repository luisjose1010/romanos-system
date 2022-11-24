<template>
  <v-main>
    <v-container>
      <h2>Editar usuario</h2>

      <UserForm class="mt-2" />
    </v-container>
  </v-main>
</template>

<script>
import UserForm from '@/components/UserForm.vue';

export default {
  name: 'User',
  components: {
    UserForm,
  },
  data() {
    return {
      user: {
        id: '',
        username: '',
        password: '',
        name: '',
        idCard: '',
        email: '',
        phoneNumber: '',
        createAt: null,
        updateAt: null,
      },
      verifyPassword: '',
    };
  },
};
</script>
