<template>
  <div>
    <h2>Venta: {{ sale.id }}</h2>

    <v-form
      v-model="valid"
      class="mt-3 mb-3"
    >
      <v-row class="d-flex justify-md-space-between mb-1">
        <v-col>
          <ClientForm
            @searchClient="selectClient($event)"
            @createClient="selectClient($event)"
          />
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
import ClientForm from '@/components/ClientForm.vue';

/**
 * Componente de venta
 *
 * @event submit Nueva venta creada
 *
 */
export default {
  components: {
    ClientForm,
  },
  data() {
    return {
      rules: {
        noEmpty: [(v) => !!v || 'Campo requerido'],
      },
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
    selectClient(client) {
      this.sale.client = client;
      this.clientSelected = true;
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
