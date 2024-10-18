<template>
  <div>
    <v-form v-model="valid">
      <v-row>
        <v-col cols="12" sm="10" md="8">
          <v-text-field v-model="client.idCard" label="Cédula" name="idCard" :rules="rules.noEmpty" required />
        </v-col>

        <v-col cols="12" sm="2">
          <v-dialog v-model="showErrorDialog" width="500">
            <template #activator="{ attrs }">
              <v-btn color="primary" :disabled="clientSelected" v-bind="attrs" @click="searchClient">
                Buscar
              </v-btn>
            </template>

            <v-card>
              <v-card-title>
                Error
              </v-card-title>

              <v-card-text>
                {{ errorDialogText }}
              </v-card-text>

              <v-card-actions>
                <v-spacer />
                <v-btn color="primary" text @click="showErrorDialog = false">
                  Aceptar
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-col>
      </v-row>

      <v-row>
        <v-col cols="12" md="6">
          <v-text-field v-model="client.name" label="Nombre" name="name" :rules="rules.noEmpty" required />
        </v-col>
        <v-col cols="12" md="6">
          <v-text-field v-model="client.phoneNumber" label="Teléfono" name="phoneNumber" />
        </v-col>
      </v-row>

      <v-row>
        <v-col>
          <v-text-field v-model="client.email" label="Email" name="email" />
        </v-col>
      </v-row>

      <v-row>
        <v-col>
          <v-btn color="green" :disabled="clientSelected || !valid" @click="createClient">
            Nuevo cliente
          </v-btn>
        </v-col>
        <v-col>
          <v-btn color="blue" :disabled="!clientSelected || !valid" @click="updateClient">
            Actualizar cliente
          </v-btn>
        </v-col>
        <v-col>
          <v-btn color="primary" :disabled="!clientSelected" @click="reset()">
            Reestablecer
          </v-btn>
        </v-col>
      </v-row>
    </v-form>

    <v-alert v-model="showAlert" shaped outlined dismissible transition="scale-transition" type="success" class="mt-3">
      {{ alertText }}
    </v-alert>
  </div>
</template>

<script>
import api from '@/api';

/**
 * Componente de venta
 *
 * @event reset Nueva orden creada
 *
 */
export default {
  props: {

  },
  data: () => ({
    rules: {
      noEmpty: [(v) => !!v || 'Campo requerido'],
    },
    valid: false,
    showErrorDialog: false,
    errorDialogText: 'Ha ocurrido un error',
    showAlert: false,
    alertText: '',
    client: {
      id: '',
      name: '',
      idCard: '',
      email: '',
      phoneNumber: '',
    },
    clientSelected: false,
  }),
  mounted() {
    if (this.$route.params.id) {
      api
        .get(`/clients/${this.$route.params.id}`)
        .then((response) => {
          this.client = response.data;
          this.clientSelected = true;
        })
        .catch((error) => {
          // handle error
          console.log(error);
        })
        .then(() => {
          // always executed
        });
    }
  },
  methods: {
    createClient() {
      api
        .post('/clients', this.client)
        .then((response) => {
          // eslint-disable-next-line prefer-destructuring
          this.client = response.data;
          this.clientSelected = true;
          this.$emit('createClient', this.client);
        })
        .catch((error) => {
          // handle error
          console.log(error);
          this.errorDialogText = 'Cliente no encontrado';
          this.showErrorDialog = true;
        });
    },
    updateClient() {
      api
        .put(`/clients/${this.client.id}`, this.client)
        .then((response) => {
          // eslint-disable-next-line prefer-destructuring
          this.client = response.data;
          this.clientSelected = true;
          this.alertText = 'Cliente actualizado correctamente';
          this.showAlert = true;

          this.$emit('searchClient', this.client);
        })
        .catch((error) => {
          // handle error
          console.log(error);
          this.errorDialogText = 'Ha ocurrido un error inesperado';
          this.showErrorDialog = true;
        });
    },
    searchClient() {
      api
        .get(`/clients?idCard=${this.client.idCard}`)
        .then((response) => {
          // eslint-disable-next-line prefer-destructuring
          this.client = response.data;
          this.clientSelected = true;
          this.$emit('searchClient', this.client);
        })
        .catch((error) => {
          // handle error
          console.log(error);
          this.errorDialogText = 'Cliente no encontrado';
          this.showErrorDialog = true;
        });
    },
    reset() {
      this.client = {};
      this.clientSelected = false;
    },
  },
};
</script>
