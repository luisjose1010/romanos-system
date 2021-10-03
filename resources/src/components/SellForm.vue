<template>
  <div>
    <v-container>
      <h2>Producto</h2>
      <v-row>
        <v-form
          ref="form"
          v-model="valid"
          method="post"
        >
          <v-col
            sm="6"
            md="7"
          >
            <v-overflow-btn
              v-model="product.name"
              name="name"
              :items="getProductsNames()"
              :rules="noEmpty"
              :counter="20"
              label="Nombre del producto"
              editable
              required
            />

            <v-select
              v-if="product.name"
              v-model="product.ingredients"
              name="ingredient"
              :items="getIngredients().map(ingredient => ingredient.name)"
              :rules="noEmpty"
              label="Ingredientes"
              :multiple="getProductSelected().multipleIngredients"
              chips
              persistent-hint
              required
              return-object
            />

            <v-select
              v-if="product.name"
              v-model="product.size"
              name="size"
              :items="getSizes().map(size => size.name)"
              :rules="noEmpty"
              label="Tamaños"
              required
              return-object
            />
          </v-col>

          <v-btn
            class="ma-5"
            :disabled="!valid"
            color="success"
            @click="addProductSold"
          >
            Agregar
          </v-btn>

          <v-btn
            class="ma-5"
            color="error"
            @click="reset"
          >
            Limpiar
          </v-btn>
        </v-form>

        <v-col
          sm="6"
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
                @click="resetProductsSold"
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
                @click="sendProductsSold"
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
        <pre>{{ dataSoldProducts }}</pre>
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

      products: [],
      product: {
        name: '',
        ingredients: '',
        size: '',
      },
      soldProducts: [],
      dataSoldProducts: [],
    };
  },
  mounted() {
    api
      .get('/producto')
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
    reset() {
      this.$refs.form.reset();
      this.valid = false;
    },
    addProductSold() {
      if (this.$refs.form.validate()) {
        // Introduce en los productos vendidos
        const { id } = this.getProductSelected();
        const { name } = this.product;
        const { ingredients } = this.product;
        const { size } = this.product;
        this.soldProducts.push({
          id,
          name,
          ingredients,
          size,
        });

        // Introduce en los productos que se enviarán a la api
        const dataIngredients = [];
        const dataSize = [];

        this.getIngredients().forEach((mappedIngredient) => {
          if (Array.isArray(ingredients)) {
            ingredients.forEach((ingredient) => {
              if (String(ingredient) === String(mappedIngredient.name)) {
                dataIngredients.push(mappedIngredient);
              }
            });
          } else if (ingredients === mappedIngredient.name) {
            dataIngredients.push(mappedIngredient);
          }
        });

        this.getSizes().forEach((mappedSize) => {
          if (String(size) === String(mappedSize.name)) {
            dataSize.push(mappedSize);
          }
        });

        this.dataSoldProducts.push({
          id,
          name,
          dataIngredients,
          dataSize,
        });

        this.reset();
      }
    },
    resetProductsSold() {
      this.soldProducts = [];
      this.dataSoldProducts = [];
    },
    sendProductsSold() {},

    getProductsNames() {
      const { products } = this;

      const productsNames = products.map((product) => product.name);
      return productsNames;
    },
    getIngredients() {
      const ingredients = [...this.getProductSelected().ingredients];
      return ingredients;
    },
    getSizes() {
      const sizes = [...this.getProductSelected().sizes];
      return sizes;
    },
    getProductSelected() {
      let found = null;

      if (this.product !== undefined) {
        found = this.products.find((item) => item.name === this.product.name);
      }
      return found;
    },
  },
};
</script>

<style scoped>
img {
  border: 1px solid rgb(0, 0, 0);
  background-color: rgb(55, 177, 85);
  border-radius: 4px;
  padding: 3px;
  width: 150px;
}
</style>
