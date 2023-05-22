<template>
  <div class="justify-content-start d-flex">
    <v-btn
      style="background-color: #2938D5; color: white;"
      @click="redirectToCreate"
      :disabled="loading"
      title="Ir para págian de Criação de Tarefas"
    >
      Criar Tarefa 
      <v-icon>
        mdi-plus
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
    redirectToCreate() {
      this.$router.push('/create');
    },
  }
};
</script>