<template>
  <div>
    <v-btn
      :style="{ backgroundColor: backgroundColor, color: textColor }"
      @click="redirectToCreate"
      :disabled="loading"
      :title="buttonTitle"
    >
      {{ buttonText }}
      <v-icon
        :size="iconSize"
        class="icon-spacing"
      >
        {{ icon }}
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
    },
    backgroundColor: {
      type: String,
      default: '#2938D5'
    },
    textColor: {
      type: String,
      default: 'white'
    },
    buttonTitle: {
      type: String,
      default: 'Ir para página de Criação de Tarefas',
    },
    buttonText: {
      type: String,
      default: 'Criar uma Tarefa',
    },
    icon: {
      type: String,
      default: 'mdi-send',
    },
    iconSize: {
      type: String,
      default: 'small'
    },
  },
  methods: {
    redirectToCreate() {
      this.$router.push('/create');
    },
  }
};
</script>

<style scoped>
.icon-spacing {
  margin-left: 8px;
}
</style>