<template>
  <v-main>
    <v-container>
      <h2>Usuarios</h2>

      <v-card class="mx-auto mt-3">
        <v-list>
          <v-list-item-group>
            <v-list-item
              v-for="(item, index) in users"
              :key="index"
              :to="`/usuarios/${item.id}`"
            >
              <v-list-item-icon>
                <v-icon>
                  mdi-account-outline
                </v-icon>
              </v-list-item-icon>
              <v-list-item-content>
                <v-list-item-title
                  class="text-left"
                  v-text="`${item.name} (${formatIdCard(item.idCard)}) - (${item.role.name})`"
                />
              </v-list-item-content>
            </v-list-item>
          </v-list-item-group>
        </v-list>
      </v-card>
    </v-container>
  </v-main>
</template>

<script>
import api from '../api';
import utilities from '../utilities';

export default {
  name: 'Users',
  data() {
    return {
      users: [],
    };
  },
  mounted() {
    api
      .get('/users/all')
      .then((response) => {
        this.users = response.data;
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
