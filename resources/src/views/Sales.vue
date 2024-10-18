<template>
  <v-main>
    <v-container>
      <h2>Ventas</h2>

      <v-card
        class="mx-auto mt-3"
      >
        <v-list>
            <v-list-item
              v-for="(item, index) in sales"
              :key="index"
              :to="`ventas/${item.id}`"
              :subtitle="`Fecha: ${getDate(item.createdAt)}`"
              class="text-left"
            >
              <template v-slot:prepend>
                <v-icon v-if="item.paid">
                  mdi-cart
                </v-icon>
                <v-icon v-else>
                  mdi-cart-off
                </v-icon>
              </template>
              <template v-slot:title>
                {{ `Venta No.${item.id}${(!item.paid ? ' (No confirmado)' : '')}:
                   ${item.client.name}` }}
              </template>
            </v-list-item>
        </v-list>
      </v-card>
    </v-container>
  </v-main>
</template>

<script>
import api from '../api';

export default {
  name: 'Sales',
  components: {

  },
  data() {
    return {
      sales: [],
      icons: {
        cart: 'mdi-cart',
        disabledCart: 'mdi-cart-off',
      },
    };
  },
  mounted() {
    api
      .get('/sales/all')
      .then((response) => {
        this.sales = response.data;
      })
      .catch((error) => {
        // handle error
        console.log(error);
      })
      .then(() => {
        // always executed
      });
  },
  methods: {
    getDate(str) {
      const date = new Date(str);
      return date.toString();
    },
  },

};
</script>
