<template>
  <v-main>
    <v-container>
      <h2>Ventas</h2>

      <v-card
        class="mx-auto mt-3"
      >
        <v-list>
          <v-list-item-group>
            <v-list-item
              v-for="(item, index) in sales"
              :key="index"
              :to="`ventas/${item.id}`"
            >
              <v-list-item-icon>
                <v-icon v-if="item.paid">
                  mdi-cart
                </v-icon>
                <v-icon v-else>
                  mdi-cart-off
                </v-icon>
              </v-list-item-icon>
              <v-list-item-content>
                <v-list-item-title
                  class="text-left"
                  v-text="`Venta No.${item.id} ${(!item.paid ? '(No confirmado)' : '')}`"
                />
                Fecha: {{ getDate(item.createdAt) }}
              </v-list-item-content>
            </v-list-item>
          </v-list-item-group>
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
