<template>
  <v-main>
    <SellForm />
  </v-main>
</template>

<script>
import SellForm from '@/components/OrderForm.vue';

export default {
  name: 'Sell',
  components: {
    SellForm,
  },
};
</script>
