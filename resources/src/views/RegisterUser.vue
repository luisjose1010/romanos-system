<template>
  <v-main>
    <v-container>
      <h2>Registrar usuario</h2>

      <v-form
        v-model="valid"
      >
        <v-row>
          <v-col>
            <v-row>
              <v-col>
                <v-text-field
                  v-model="user.idCard"
                  label="Cédula"
                  name="idCard"
                  :rules="rules.noEmpty"

                  required
                />
              </v-col>
            </v-row>
          </v-col>
          <v-col>
            <v-text-field
              v-model="user.username"
              label="Nombre de usuario"
              name="username"
              :rules="rules.noEmpty"

              required
            />
          </v-col>
        </v-row>
        <v-row>
          <v-col>
            <v-text-field
              v-model="user.name"
              label="Nombre"
              name="name"
              :rules="rules.noEmpty"

              required
            />
          </v-col>
          <v-col>
            <v-text-field
              v-model="user.email"
              label="Email"
              name="email"
              :rules="rules.noEmpty"

              required
            />
          </v-col>
        </v-row>
        <v-row>
          <v-col>
            <v-text-field
              v-model="user.password"
              label="Contraseña"
              name="password"
              type="password"
              autocomplete="off"
            />
          </v-col>
          <v-col>
            <v-select
              v-model="user.role"
              :items="roles"
              :rules="[(v) => Object.keys(v).length !== 0 || 'Campo requerido']"
              item-text="name"
              filled
              label="Rol"
              return-object
              required
            />
          </v-col>
        </v-row>

        <v-row>
          <v-col>
            <v-btn
              color="green"
              :disabled="!valid"
              @click="createUser"
            >
              Registrar usuario
            </v-btn>
          </v-col>
        </v-row>
      </v-form>

      <v-alert
        v-model="showAlert"
        shaped
        outlined
        dismissible
        transition="scale-transition"
        type="success"
        class="mt-3"
      >
        {{ alertText }}
      </v-alert>

      <v-dialog
        v-model="showErrorDialog"
        width="500"
      >
        <v-card>
          <v-card-title>
            Error
          </v-card-title>

          <v-card-text>
            {{ errorDialogText }}
          </v-card-text>

          <v-card-actions>
            <v-spacer />
            <v-btn
              color="primary"
              text
              @click="showErrorDialog = false"
            >
              Aceptar
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>

      <v-dialog
        v-model="showSessionDialog"
        width="500"
      >
        <v-card>
          <v-card-title>
            Información
          </v-card-title>

          <v-card-text>
            {{ dialogSessionText }}
          </v-card-text>

          <v-card-actions>
            <v-spacer />
            <v-btn
              color="primary"
              text
              to="/logout"
            >
              Aceptar
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-container>
  </v-main>
</template>

<script>
import api from '@/api';

/**
 * Componente de venta
 *
 * @event reset Nueva orden creada
 *
 */
export default {
  props: {

  },
  data: () => ({
    rules: {
      noEmpty: [(v) => !!v || 'Campo requerido'],
    },
    valid: false,
    showErrorDialog: false,
    errorDialogText: 'Ha ocurrido un error',
    showSessionDialog: false,
    dialogSessionText: 'Se reiniciará la sesión para visualizar correctamente los cambios',
    showAlert: false,
    alertText: '',
    roles: [],
    user: {
      id: '',
      name: '',
      username: '',
      password: '',
      idCard: '',
      email: '',
      phoneNumber: '',
      role: {},
      token: '',
    },
  }),
  mounted() {
    if (this.$route.params.id) {
      api
        .get(`/users/${this.$route.params.id}`)
        .then((response) => {
          this.user = response.data;
        })
        .catch((error) => {
        // handle error
          console.log(error);
        })
        .then(() => {
        // always executed
        });
    }

    api
      .get('/roles')
      .then((response) => {
        this.roles = response.data;
      })
      .catch((error) => {
        // handle error
        console.log(error);
      });
  },
  methods: {
    createUser() {
      api
        .post('/users/all', this.user)
        .then(() => {
          this.alertText = 'Usuario registrado correctamente';
          this.showAlert = true;
          this.showSessionDialog = true;
        })
        .catch((error) => {
        // handle error
          console.log(error);
          this.errorDialogText = 'Ha ocurrido un error inesperado';
          this.showErrorDialog = true;
        });
    },
    parseNewLineToHtml(str) {
      return str.replace(/(?:\r\n|\r|\n)/g, '<br>');
    },
  },
};
</script>
