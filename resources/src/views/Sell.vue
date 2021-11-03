<template>
  <v-main>
    <v-container>
      <SellForm
        ref="sellForm"
        @submit="sale = $event"
      />

      <v-row class="mt-2 justify-md-space-between">
        <v-col
          sm="12"
          md="5"
        >
          <OrderForm
            ref="orderForm"
            :sale="sale"
            @submit="orders.push($event)"
          />
        </v-col>

        <v-col
          sm="12"
          md="5"
        >
          <OrdersForm
            :orders="orders"
            :sale="sale"
            @reset="resetSaleForm"
          />
        </v-col>
      </v-row>
    </v-container>
  </v-main>
</template>

<script>
import SellForm from '@/components/SellForm.vue';
import OrderForm from '@/components/OrderForm.vue';
import OrdersForm from '@/components/OrdersForm.vue';

export default {
  name: 'Sell',
  components: {
    SellForm,
    OrderForm,
    OrdersForm,
  },
  data() {
    return {
      sale: {},
      orders: [],
    };
  },
  methods: {
    resetSaleForm() {
      this.sale = {};
      this.orders = [];
      this.$refs.sellForm.reset();
      this.$refs.orderForm.resetOrder();
    },
  },

};
</script>
