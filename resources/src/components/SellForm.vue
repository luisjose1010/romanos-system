<template>
  <div>
    <h2>Venta: {{ sale.id }}</h2>

    <v-form>
      <v-row>
        <v-col sm="2">
          <v-text-field
            v-model="sale.ivaRate"
            label="Porcentaje IVA"
            suffix="%"
            readonly
          />
        </v-col>
      </v-row>

      <v-btn
        depressed
        color="primary"
        :disabled="!!sale.id"
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
      sale: {
        ivaRate: 4,
      },
    };
  },
  mounted() {
  },
  methods: {
    createSale() {
      api
        .post('/sales', this.sale)
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
      this.sale = {
        ivaRate: 4,
      };
    },
  },
};
</script>

<style scoped>

</style>
