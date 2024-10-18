<template>
  <v-main>
    <v-container>
      <h2>
        Clients
        <v-btn to="/buscar-cliente" class="mx-2" icon>
          <v-icon>
            mdi-magnify
          </v-icon>
        </v-btn>
      </h2>

      <v-card
        class="mx-auto mt-3"
      >
        <v-list>
            <v-list-item
              v-for="(item, index) in clients"
              :key="index"
              :to="`clientes/${item.id}`"
              class="text-left"
            >
              <template v-slot:prepend>
                <v-icon>
                  mdi-account-outline
                </v-icon>
              </template>
              {{ `${item.name} (${formatIdCard(item.idCard)})` }}
            </v-list-item>
        </v-list>
      </v-card>
    </v-container>
  </v-main>
</template>

<script>
import api from '../api';
import utilities from '../utilities';

export default {
  name: 'Clients',
  components: {

  },
  data() {
    return {
      clients: [],
      icons: {
        cart: 'mdi-account-outline',
      },
    };
  },
  mounted() {
    api
      .get('/clients')
      .then((response) => {
        this.clients = response.data;
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
    getDate(str) {
      const date = new Date(str);
      return date.toString();
    },
    formatIdCard(idCard) {
      return utilities.formatIdCard(idCard);
    },
  },

};
</script>
