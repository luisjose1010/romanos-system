<template>
  <v-main>
    <v-container>
      <h2>Copia de seguridad</h2>

      <v-card
        class="mx-auto mt-3"
      >
        <v-row>
          <v-col>
            <v-btn
              color="green"
              outlined
              @click="createBackup"
            >
              Guardar copia de seguridad
            </v-btn>
          </v-col>

          <v-col>
            <v-btn
              color="blue"
              outlined
              @click="restoreBackup"
            >
              Restaurar ultima copia de seguridad
            </v-btn>
          </v-col>
        </v-row>

        <v-dialog
          v-model="showErrorDialog"
          width="500"
        >
          <v-card>
            <v-card-title>
              Información
            </v-card-title>

            <v-card-text>
              {{ errorDialogText }}
            </v-card-text>

            <v-card-actions>
              <v-spacer />
              <v-btn
                color="primary"
                text
                to="/logout"
              >
                Aceptar
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>

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
    </v-container>
  </v-main>
</template>

<script>
// import api from '../api';

export default {
  name: 'Sales',
  components: {

  },
  data() {
    return {
      showErrorDialog: false,
      errorDialogText: '',
      showAlert: false,
      alertText: '',
      alertType: 'success',
    };
  },
  methods: {
    createBackup() {
      this.alertText = 'Copia de seguridad guardada';
      this.showAlert = true;
      this.alertType = 'success';
    },
    restoreBackup() {
      this.alertText = 'Copia de seguridad restaurada';
      this.showAlert = true;
      this.alertType = 'info';
    },
  },
};
</script>
