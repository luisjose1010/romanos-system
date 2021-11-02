<template>
  <div>
    <v-container>
      <v-row
        class="justify-md-space-between"
      >
        <v-col
          sm="12"
          md="5"
        >
          <v-form
            ref="form"
            v-model="valid"
          >
            <v-overflow-btn
              v-model="productSelected"
              name="name"
              :items="products"
              :item-text="item => `${item.id} - ${item.name}`"
              :rules="noEmptyObject"
              :readonly="!productEditable"
              label="Producto"
              editable
              persistent-hint
              return-object
              @change="productEditable = false"
            />

            <v-select
              v-if="productSelected.ingredients && productSelected.ingredients.length > 0"
              v-model="order.ingredients"
              name="ingredients"
              :items="productSelected.ingredients"
              :item-text="item => `${item.name}`"
              :rules="noEmpty"
              label="Ingredientes"
              :multiple="productSelected.multipleIngredients"
              chips
              persistent-hint
              return-object
            />

            <v-select
              v-if="productSelected.sizes && productSelected.sizes.length > 0"
              v-model="order.size"
              name="size"
              :items="productSelected.sizes"
              :item-text="item => `${item.name}`"
              :rules="noEmpty"
              label="Tamaño"
              chips
              persistent-hint
              return-object
            />

            <v-text-field
              v-model="order.quantity"
              :rules="onlyQuantity"
              hide-details
              single-line
              type="number"
            />

            <v-btn
              class="ma-5"
              :disabled="!valid"
              color="success"
              @click="addOrder"
            >
              Agregar
            </v-btn>

            <v-btn
              class="ma-5"
              color="error"
              @click="resetOrder"
            >
              Limpiar
            </v-btn>
          </v-form>
        </v-col>

        <v-col
          sm="12"
          md="5"
        >
          <h2>Total</h2>
          <v-simple-table>
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
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="(item, index) in soldProducts"
                :key="index"
              >
                <td>{{ item.name }}</td>
                <td>{{ item.id }}</td>
                <td v-if="Array.isArray(item.ingredients)">
                  <v-chip
                    v-for="(ingredient, index2) in item.ingredients"
                    :key="index2"
                    color="red"
                    text-color="white"
                  >
                    {{ ingredient }}
                  </v-chip>
                </td>
                <td v-else>
                  <v-chip>
                    {{ item.ingredients }}
                  </v-chip>
                </td>
                <td>{{ item.size }}</td>
              </tr>
            </tbody>
          </v-simple-table>
          <v-row>
            <v-col md="2">
              <v-btn
                color="red"
                dark
                @click="resetOrders"
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
                @click="createSale"
              >
                <v-icon dark>
                  mdi-send
                </v-icon>
              </v-btn>
            </v-col>
          </v-row>
        </v-col>
      </v-row>

      <v-row>
        <pre>{{ orders }}</pre>
      </v-row>
    </v-container>
  </div>
</template>

<script>
import api from '../api';

export default {
  data() {
    return {
      valid: false,
      noEmpty: [(v) => !!v || 'Campo requerido'],
      noEmptyObject: [(v) => Object.keys(v).length !== 0 || 'Campo requerido'],
      onlyQuantity: [(v) => (v > 0 && !(v % 1)) || 'Cantidad incorrecta'],

      products: [],
      productSelected: {},
      order: {
        quantity: 1,
      },
      orders: [],
      productEditable: true,
      dataSoldProducts: [],
    };
  },
  mounted() {
    api
      .get('/products/all')
      .then((response) => {
        this.products = response.data;
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
    resetOrder() {
      this.order = {
        quantity: 1,
      };
      this.productSelected = {};
      this.productEditable = true;
    },
    addOrder() {
      this.orders.push({ product: { id: this.productSelected.id }, ...this.order });
      this.resetOrder();
    },
    resetOrders() {
      this.orders = [];
      this.resetOrder();
    },
    createSale() {
      console.log(this.productSelected);
    },
  },
};
</script>

<style scoped>

</style>
