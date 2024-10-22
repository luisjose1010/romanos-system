<template>
  <v-main>
    <v-container>
      <h3 class="d-flex justify-start">
        Cliente: {{ client?.name }}
      </h3>
      <v-expansion-panels v-model="panel" class="mt-2">
        <v-expansion-panel>
          <v-expansion-panel-title>
            <h3>
              Información del cliente
            </h3>
          </v-expansion-panel-title>
          <v-expansion-panel-text>
            <ClientForm :resetDisabled="disableReset" @searchClient="selectClient($event?.id)"
              @createClient="selectClient($event?.id)" class="my-3" />
          </v-expansion-panel-text>
        </v-expansion-panel>

        <v-expansion-panel v-if="!error && client?.sales?.length > 0">
          <v-expansion-panel-title>
            <h3>
              Compras del cliente
            </h3>
          </v-expansion-panel-title>
          <v-expansion-panel-text>
            <v-list>
              <v-list-item v-for="(item, index) in client.sales" :key="index" :to="`/ventas/${item.id}`"
                :subtitle="`Fecha: ${getDate(item.createdAt)}`" class="text-left">
                <template v-slot:prepend>
                  <v-icon v-if="item.paid">
                    mdi-cart
                  </v-icon>
                  <v-icon v-else>
                    mdi-cart-off
                  </v-icon>
                </template>
                <template v-slot:title>
                  {{ `Venta No.${item.id}${(!item.paid ? ' (No confirmado)' : '')}` }}
                </template>
              </v-list-item>
            </v-list>
          </v-expansion-panel-text>
        </v-expansion-panel>
      </v-expansion-panels>
    </v-container>
  </v-main>
</template>

<script>
import api from '@/api';
import ClientForm from '@/components/ClientForm.vue';

export default {
  name: 'Cliente',
  components: {
    ClientForm,
  },
  data() {
    return {
      panel: 1, // Abre el segundo panel por defecto
      disableReset: false, // Permite resetear los campos del formulario por defecto
      error: false,
      errorText: 'Ha ocurrido un error',
      client: {
        sales: [],
      },
    };
  },
  mounted() {
    if (this.$route.params.id) {
      this.selectClient(this.$route.params.id);
      this.disableReset = true; // Evita cambiar de cliente al haber uno ya seleccionado desde la ruta
    }
  },
  methods: {
    selectClient(id) {
      api
        .get(`/clients/${id}/all`)
        .then((response) => {
          this.client = response.data;
          // Para mostrar las ventas más recientes primero
          this.client.sales = this.sortSalesByDescendingDate(this.client.sales);
        })
        .catch((error) => {
          switch (error?.response?.status) {
            case 404:
              this.error = true;
              this.errorText = 'No se ha encontrado el cliente.';
              break;
            default:
              console.log(error);
              break;
          }
        })
    },
    sortSalesByDescendingDate(sales) {
      return sales.sort((item1, item2) => {
        if (item1.createdAt < item2.createdAt) {
          return 1;
        }
        if (item1.createdAt > item2.createdAt) {
          return -1;
        }
        return 0;
      });
    },
    getDate(str) {
      const date = new Date(str);
      return date.toString();
    },
  },
};
</script>
