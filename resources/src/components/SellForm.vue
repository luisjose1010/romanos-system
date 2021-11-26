<template>
  <div>
    <h2>Venta: {{ sale.id }}</h2>

    <v-form
      v-model="valid"
      class="mt-3 mb-3"
    >
      <v-row class="d-flex justify-md-space-between mb-1">
        <v-col sm="2">
          <v-text-field
            v-model="sale.ivaRate"
            label="Porcentaje IVA"
            suffix="%"
            readonly
          />
        </v-col>

        <v-col sm="7">
          <h3 class="d-flex justify-start mt-3">
            Cliente
          </h3>
          <v-row>
            <v-col>
              <v-row>
                <v-col sm="7">
                  <v-text-field
                    v-model="sale.client.idCard"
                    label="Cédula"
                    name="idCard"
                    :rules="rules.noEmpty"
                    :readonly="clientSelected"
                    required
                  />
                </v-col>

                <v-col sm="5">
                  <v-dialog
                    v-model="showErrorDialog"
                    width="500"
                  >
                    <template #activator="{ attrs }">
                      <v-btn
                        color="primary"
                        :disabled="clientSelected"
                        v-bind="attrs"
                        @click="searchClient"
                      >
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
                        <v-btn
                          color="primary"
                          text
                          @click="showErrorDialog = false"
                        >
                          Aceptar
                        </v-btn>
                      </v-card-actions>
                    </v-card>
                  </v-dialog>
                </v-col>
              </v-row>
            </v-col>
            <v-col>
              <v-text-field
                v-model="sale.client.phoneNumber"
                label="Teléfono"
                name="phoneNumber"
                :readonly="clientSelected"
              />
            </v-col>
          </v-row>
          <v-row>
            <v-col>
              <v-text-field
                v-model="sale.client.name"
                label="Nombre"
                name="name"
                :rules="rules.noEmpty"
                :readonly="clientSelected"
                required
              />
            </v-col>
            <v-col>
              <v-text-field
                v-model="sale.client.email"
                label="Email"
                name="email"
                :readonly="clientSelected"
              />
            </v-col>
          </v-row>

          <v-btn
            color="primary"
            :disabled="clientSelected || !valid"
            @click="createClient"
          >
            Nuevo cliente
          </v-btn>
        </v-col>
      </v-row>

      <v-btn
        depressed
        color="primary"
        :disabled="!!sale.id || !clientSelected"
        @click="createSale"
      >
        Nueva venta
      </v-btn>
    </v-form>
  </div>
</template>

<script>
import api from '@/api';

/**
 * Componente de venta
 *
 * @event submit Nueva venta creada
 *
 */
export default {
  data() {
    return {
      rules: {
        noEmpty: [(v) => !!v || 'Campo requerido'],
      },
      showErrorDialog: false,
      errorDialogText: 'Ha ocurrido un error',
      valid: false,
      sale: {
        ivaRate: 0,
        client: {
          idCard: null,
        },
      },
      clientSelected: false,
    };
  },
  mounted() {
  },
  methods: {
    searchClient() {
      api
        .get(`/clients?idCard=${this.sale.client.idCard}`)
        .then((response) => {
          // eslint-disable-next-line prefer-destructuring
          this.sale.client = response.data;
          this.$emit('submit', this.sale);
          this.clientSelected = true;
        })
        .catch((error) => {
        // handle error
          console.log(error);
          this.errorDialogText = 'Cliente no encontrado';
          this.showErrorDialog = true;
        });
    },
    createClient() {
      api
        .post('/clients', this.sale.client)
        .then((response) => {
          // eslint-disable-next-line prefer-destructuring
          this.sale.client = response.data;
          this.$emit('submit', this.sale);
          this.clientSelected = true;
        })
        .catch((error) => {
        // handle error
          console.log(error);
          this.errorDialogText = 'Cliente no encontrado';
          this.showErrorDialog = true;
        });
    },
    createSale() {
      api
        .post('/sales/all', this.sale)
        .then((response) => {
          this.sale = response.data;
          this.$emit('submit', this.sale);
        })
        .catch((error) => {
        // handle error
          console.log(error);
        });
    },
    reset() {
      this.valid = false;
      this.sale = {
        ivaRate: 0,
        client: {
          idCard: null,
        },
      };
      this.clientSelected = false;
    },
  },
};
</script>

<style scoped>

</style>
