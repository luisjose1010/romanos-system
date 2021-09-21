<template>
  <app>
    <p>
      <v-row>
        <v-col>
          <v-alert type="error">
            No se ha encontrado la ruta especificada
          </v-alert>
        </v-col>
      </v-row>
    </p>
  </app>
</template>

<script>
import App from '../components/App.vue';

export default {
  components: {
    App,
  },
};
</script>
