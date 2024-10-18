<template>
  <div>
    <v-form
      ref="form"
      v-model="valid"
    >
      <v-autocomplete
        v-model="productSelected"
        name="id"
        type="object"
        :items="products"
        :item-title="item => item.id ? `${item.id} - ${item.name}` : ''"
        :rules="noEmptyObject"
        label="Producto"
        spellcheck="false"
        editable
        persistent-hint
        return-object
        segmented
      >
        <template
          v-if="productSelected && productSelected.description"
          v-slot:append
        >
          <v-tooltip top>
            <template v-slot:activator="{ props }">
              <v-icon
                v-bind="props"
              >
                mdi-information-outline
              </v-icon>
            </template>
            <span>{{ productSelected.description }}</span>
          </v-tooltip>
        </template>
      </v-autocomplete>

      <v-select
        v-if="productSelected.ingredients && productSelected.ingredients.length > 0"
        v-model="order.ingredients"
        name="ingredients"
        :items="productSelected.ingredients"
        :item-title="item => `${item.name}`"
        :rules="checkIngredients"
        label="Ingredientes"
        multiple
        chips
        persistent-hint
        return-object
      >
        <template #selection="{ item }">
          <v-chip
            color="red"
            text-color="white"
            close
            @click:close="deleteIngredient(item)"
          >
            {{ item.name }}
          </v-chip>
        </template>
      </v-select>

      <v-select
        v-if="productSelected.sizes && productSelected.sizes.length > 0"
        v-model="order.size"
        name="size"
        :items="productSelected.sizes"
        :item-title="item => `${item.name}`"
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
        :disabled="!valid || !sale.id"
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
  </div>
</template>

<script>
import api from '../api';

/**
 * Componente de venta
 *
 * @event submit Nueva orden creada
 *
 */
export default {
  props: {
    sale: {
      type: Object,
      required: false,
      default() {
        return {};
      },
    },
  },
  data() {
    return {
      valid: false,
      noEmpty: [(v) => !!v || 'Campo requerido'],
      noEmptyObject: [(v) => Object.keys(v).length !== 0 || 'Campo requerido'],
      onlyQuantity: [(v) => (v > 0 && !(v % 1)) || 'Cantidad incorrecta'],
      checkIngredients: [
        (v) => !!v || 'Campo requerido',
        (v) => !(v.length < this.productSelected.minIngredients)
          || `El producto necesita al menos ${this.productSelected.minIngredients} ingredientes`,
        (v) => !(v.length > this.productSelected.maxIngredients)
          || `El producto tiene un máximo de ${this.productSelected.maxIngredients} ingredientes`,
      ],

      products: [],
      actualProduct: {},
      order: {
        quantity: 1,
        ingredients: [],
      },
      orders: [],
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
    deleteIngredient(ingredient) {
      this.order.ingredients = this.order.ingredients.filter((item) => item.id !== ingredient.id);
    },
    resetOrder() {
      this.order = {
        quantity: 1,
      };
      this.productSelected = {};
    },
    addOrder() {
      if (this.order.ingredients && !Array.isArray(this.order.ingredients)) {
        this.order.ingredients = [this.order.ingredients];
      }

      api
        .post('/orders/all', {
          sale: { id: this.sale.id },
          product: { id: this.productSelected.id },
          ...this.order,
        })
        .then((response) => {
          this.$emit('submit', response.data);
          this.resetOrder();
        })
        .catch((error) => {
        // handle error
          console.log(error);
        });
    },
  },
  computed: {
    /*
     * Se tiene que utilizar esta propiedad para gestionar las demás propiedades
     * del producto seleccionado
    */
    productSelected: {
      // getter
      get() {
        return this.actualProduct
      },
      // setter
      set(newValue) {
        this.actualProduct = newValue;
        this.order = {
          quantity: 1,
        }; // Reset order sin el producto actual, por eso no se puede con 'resetOrder()'
      }
    }
  }
};
</script>

<style scoped>

</style>
