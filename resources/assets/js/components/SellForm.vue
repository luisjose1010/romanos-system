<template>
  <div>
    <v-container>
      <h2>Producto</h2>
      <v-row>
        <v-form v-model="valid" method="post" ref="form">
          <v-col sm="6" md="7">
            <v-overflow-btn
              v-model="product.name"
              name="name"
              :items="getProductsNames()"
              :rules="noEmpty"
              :counter="20"
              label="Nombre del producto"
              editable
              required
            ></v-overflow-btn>

            <v-select
              v-if="product.name"
              v-model="product.ingredients"
              name="ingredient"
              :items="getProductSelected().ingredients"
              :rules="noEmpty"
              label="Ingredientes"
              :multiple="getProductSelected().multipleIngredients"
              chips
              persistent-hint
              required
            ></v-select>

            <v-select
              v-if="product.name"
              v-model="product.size"
              name="size"
              :items="getProductSelected().sizes"
              :rules="noEmpty"
              label="Tamaños"
              required
            ></v-select>
          </v-col>

          <v-btn
            class="ma-5"
            :disabled="!valid"
            color="success"
            @click="addProductSold"
          >
            Agregar
          </v-btn>

          <v-btn class="ma-5" color="error" @click="reset"> Limpiar </v-btn>
        </v-form>

        <v-col sm="6" md="5">
          <h2>Total</h2>
          <v-simple-table>
            <thead>
              <tr>
                <th class="text-left">Nombre</th>
                <th class="text-left">Código</th>
                <th class="text-left">Ingredientes</th>
                <th class="text-left">Tamaño</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, index) in soldProducts" :key="index">
                <td>{{ item.name }}</td>
                <td>{{ item.id }}</td>
                <td v-if="Array.isArray(item.ingredients)">
                  <v-chip
                    v-for="(ingredient, index) in item.ingredients"
                    :key="index"
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

            <v-btn @click="resetProductSold" color="red" dark>
              <v-icon dark> mdi-trash-can-outline </v-icon>
            </v-btn>
          </v-simple-table>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      valid: false,
      noEmpty: [(v) => !!v || "Campo requerido"],

      products: [],
      product: {
        name: "",
        ingredients: "",
        size: "",
      },
      soldProducts: [],
    };
  },
  methods: {
    reset() {
      this.$refs.form.reset();
      this.valid = false;
    },
    addProductSold() {
      if (this.$refs.form.validate()) {
        var id = this.getProductSelected().id;
        var name = this.product.name;
        var ingredients = this.product.ingredients;
        var size = this.product.size;
        this.soldProducts.push({ id, name, ingredients, size });
        this.reset();
      }
    },
    resetProductSold() {
      this.soldProducts = [];
    },
    getProductsNames() {
      var productsNames = [];
      var products = this.products;

      products.forEach((item) => {
        productsNames.push(item.name);
      });
      return productsNames;
    },
    getProductSelected() {
      if (this.product !== undefined) {
        var found = this.products.find(
          (item) => item.name == this.product.name
        );
      }
      return found;
    },
  },
  mounted() {
    axios
      .get("/api/producto")
      .then(response => this.products = response.data)
      .catch(function (error) {
        // handle error
        console.log(error);
      })
      .then(function () {
        // always executed
      });
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
