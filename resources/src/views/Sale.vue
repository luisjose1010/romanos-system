<template>
  <v-main>
    <v-container>
      <v-card
        class="mx-auto mt-1"
      >
        <v-list-item
          three-line
          class="mb-1"
        >
          <v-list-item-content>
            <div
              v-if="!sale.paid"
              class="d-block pa-2 red white--text"
            >
              NO CONFIRMADA
            </div>
            <div class="text-caption mb-3">
              Fecha: {{ (new Date(sale.updatedAt)).toString() }}
            </div>
            <v-row>
              <v-col>
                <v-list-item-title class="text-h5 mb-1 text-left">
                  Romano's Pizza
                </v-list-item-title>
                <v-list-item-subtitle class="text-left">
                  Dirección: Av.13 #57A-70
                </v-list-item-subtitle>
                <v-list-item-subtitle class="text-left">
                  Teléfono: +58 426 4561542
                </v-list-item-subtitle>
                <v-list-item-subtitle class="text-left">
                  Email: luis06jose@gmail.com
                </v-list-item-subtitle>
              </v-col>

              <v-col>
                <v-list-item-title class="text-h5 mb-1 text-right">
                  Cliente: {{ sale.client.name }}
                </v-list-item-title>
                <v-list-item-subtitle class="text-right">
                  Cédula: {{ sale.client.idCard }}
                </v-list-item-subtitle>
                <v-list-item-subtitle class="text-right">
                  Teléfono: {{ sale.client.phoneNumber }}
                </v-list-item-subtitle>
                <v-list-item-subtitle class="text-right">
                  Email: {{ sale.client.email }}
                </v-list-item-subtitle>
              </v-col>
            </v-row>

            <v-simple-table
              class="mt-3"
            >
              <template #default>
                <thead>
                  <tr>
                    <th class="text-left">
                      Código
                    </th>
                    <th class="text-left">
                      Producto
                    </th>
                    <th class="text-left">
                      Ingredientes
                    </th>
                    <th class="text-left">
                      Tamaño
                    </th>
                    <th class="text-left">
                      Cantidad
                    </th>
                    <th class="text-left">
                      Precio unidad
                    </th>
                    <th class="text-left">
                      Precio
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="item in sale.orders"
                    :key="item.id"
                  >
                    <td class="text-left">
                      {{ item.product.id }}
                    </td>

                    <td class="text-left">
                      {{ item.product.name }}<br>
                      {{ item.product.description }}
                    </td>

                    <td class="text-left">
                      <v-chip
                        v-for="(ingredient, index2) in item.ingredients"
                        :key="index2"
                        color="red"
                        text-color="white"
                      >
                        {{ ingredient.name }}
                      </v-chip>
                    </td>

                    <td class="text-left">
                      <span v-if="item.size && item.size.name ">
                        {{ item.size.name }}
                      </span>
                    </td>

                    <td class="text-left">
                      {{ item.quantity }}
                    </td>

                    <td class="text-left">
                      {{ item.unitPrice }}$
                    </td>

                    <td class="text-left">
                      {{ item.price }}$
                    </td>
                  </tr>
                </tbody>
              </template>
            </v-simple-table>

            <span class="mt-3 text-left">Total: {{ sale.totalPrice }}$</span>
          </v-list-item-content>
        </v-list-item>

        <v-divider />

        <v-card-actions>
          <v-btn
            text
            color="primary accent-4"
            :disabled="!sale.paid"
            @click="print()"
          >
            Imprimir
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-container>
  </v-main>
</template>

<script>
import api from '@/api';

export default {
  name: 'Sale',
  components: {

  },
  data() {
    return {
      sale: {
        paid: true,
        client: {
          name: '',
          idCard: '',
          email: '',
        },
      },
    };
  },
  mounted() {
    api
      .get(`/sales/${this.$route.params.id}/all`)
      .then((response) => {
        this.sale = response.data;
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
    parseNewLineToHtml(str) {
      return str.replace(/(?:\r\n|\r|\n)/g, '<br>');
    },
    print() {
      window.print();
    },
  },

};
</script>
