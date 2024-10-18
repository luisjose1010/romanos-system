<template>
  <div>
    <h2>Total</h2>
    <v-table>
      <thead>
        <tr>
          <th class="text-left">
            Nombre
          </th>
          <th class="text-left">
            Código
          </th>
          <th class="text-left">
            Ingredientes
          </th>
          <th class="text-left">
            Tamaño
          </th>
          <th class="text-left">
            cantidad
          </th>
          <th class="text-left">
            Precio unidad
          </th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="(item, index) in orders"
          :key="index"
        >
          <td>{{ item.product.name }}</td>
          <td>{{ item.product.id }}</td>
          <td>
            <v-chip
              v-for="(ingredient, index2) in item.ingredients"
              :key="index2"
              color="red"
              text-color="white"
            >
              {{ ingredient.name }}
            </v-chip>
          </td>
          <td>
            <span v-if="item.size && item.size.name ">
              {{ item.size.name }}
            </span>
          </td>
          <td>
            <span>
              {{ item.quantity }}
            </span>
          </td>
          <td>
            <span>
              {{ item.unitPrice }}$
            </span>
          </td>
        </tr>
      </tbody>
    </v-table>

    <v-row class="mt-2">
      <v-col md="2">
        <v-btn
          color="red"
          dark
          @click="deleteSale"
        >
          <v-icon dark>
            mdi-trash-can-outline
          </v-icon>
        </v-btn>
      </v-col>
      <v-col md="2">
        <v-btn
          color="green"
          dark
          @click="commitSale"
        >
          <v-icon dark>
            mdi-send
          </v-icon>
        </v-btn>
      </v-col>
    </v-row>
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
    orders: {
      type: Array,
      required: true,
      default() {
        return [];
      },
    },
    sale: {
      type: Object,
      required: true,
      default() {
        return {};
      },
    },
  },
  data() {
    return {

    };
  },
  methods: {
    deleteSale() {
      this.$emit('reset');
    },
    commitSale() {
      api
        .put(`/sales/${this.sale.id}`, { paid: true })
        .then((response) => {
          this.products = response.data;
        })
        .catch((error) => {
        // handle error
          console.log(error);
        })
        .then(() => {
          this.$emit('reset');
        });
    },
  },
};
</script>
