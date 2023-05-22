<template>
  <div class="justify-content-end d-flex">
    <v-btn
      style="background-color: #45BE14; color: black;"
      @click="redirectToList"
      :disabled="loading"
      title="Ir para a página de Listar Tarefas"
    >
      Lista de Tarefas 
      <v-icon class="ml-3 justify-content-center">
        mdi-format-list-bulleted
      </v-icon>
    </v-btn>
</div>
</template>

<script>
export default {
  props: {
    loading: {
      type: Boolean,
      default: false
    }
  },
  methods: {
    redirectToList() {
      this.$router.push('/list');
    },
  }
};
</script>