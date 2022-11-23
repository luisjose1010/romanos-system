<template>
  <v-card class="card">
    <div class="text-center">
      <v-avatar
        size="90"
        color="red darken-4"
        class="mt-3"
      >
        <v-icon
          size="80"
          color="red"
        >
          mdi-account-circle
        </v-icon>
      </v-avatar>
      <h2 class="red--text">
        Recuperar contraseña
      </h2>
    </div>
    <v-form v-model="valid">
      <v-card-text>
        <v-text-field
          type="text"
          label="Usuario"
          placeholder="Usuario"
          :rules="noEmpty"
        />
      </v-card-text>
      <v-card-actions class="justify-center">
        <v-dialog
          transition="dialog-bottom-transition"
          max-width="600"
        >
          <template #activator="{ on, attrs }">
            <v-btn
              color="red"
              :disabled="!valid"
              v-bind="attrs"
              v-on="on"
            >
              <span class="white--text px-8">Aceptar</span>
            </v-btn>
          </template>
          <template #default>
            <v-card>
              <v-toolbar
                color="primary"
                dark
              >
                Correo de recuperación
              </v-toolbar>
              <v-card-text>
                <div class="text-body-1 pa-12">
                  Se enviará un correo con la nueva contraseña asignada
                </div>
              </v-card-text>
              <v-card-actions class="justify-end">
                <v-btn
                  text
                  @click="$emit('submit')"
                >
                  Enviar
                </v-btn>
              </v-card-actions>
            </v-card>
          </template>
        </v-dialog>
      </v-card-actions>
    </v-form>
  </v-card>
</template>

<script>
export default {
  data: () => ({
    // Validaciones
    valid: false,
    noEmpty: [(v) => !!v || 'Campo requerido'],

    username: '',
  }),

  methods: {
  },
};
</script>
