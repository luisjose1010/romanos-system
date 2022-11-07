<template>
  <v-main>
    <v-container>
      <v-card
        class="mx-auto mt-1"
      >
        <v-list-item-group>
          <v-list-item-content>
            <v-simple-table
              class="mt-3"
            >
              <template #default>
                <form>
                  <thead>
                    <tr>
                      <th>
                        <h1>Cliente</h1> <br>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-left">
                        Nombre:
                      </td>
                      <td class="text-left">
                        <input :value="client.name">
                      </td>
                    </tr>
                    <tr>
                      <td class="text-left">
                        Cédula:
                      </td>
                      <td class="text-left">
                        {{ client.idCard }}
                      </td>
                    </tr>
                    <tr>
                      <td class="text-left">
                        Email:
                      </td>
                      <td class="text-left">
                        {{ client.email }}
                      </td>
                    </tr>
                    <tr>
                      <td class="text-left">
                        Número de teléfono
                      </td>
                      <td class="text-left">
                        {{ client.phoneNumber }}
                      </td>
                    </tr>
                  </tbody>
                </form>
              </template>
            </v-simple-table>
          </v-list-item-content>
        </v-list-item-group>
      </v-card>
    </v-container>
  </v-main>
</template>

<script>
import api from '@/api';

export default {
  name: 'Cliente',
  components: {

  },
  data() {
    return {
      client: {
        name: '',
        idCard: '',
        email: '',
        phoneNumber: '',
      },
    };
  },
  mounted() {
    api
      .get(`/clients/${this.$route.params.id}`)
      .then((response) => {
        this.client = response.data;
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
  },

};
</script>
