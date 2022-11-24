<template>
  <v-main>
    <v-container>
      <h3 class="d-flex justify-start mt-3">
        Cliente
      </h3>

      <ClientForm />
    </v-container>
  </v-main>
</template>

<script>
import ClientForm from '@/components/ClientForm.vue';

export default {
  name: 'Cliente',
  components: {
    ClientForm,
  },
  methods: {
    parseNewLineToHtml(str) {
      return str.replace(/(?:\r\n|\r|\n)/g, '<br>');
    },
  },

};
</script>
