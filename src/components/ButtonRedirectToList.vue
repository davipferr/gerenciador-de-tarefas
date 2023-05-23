<template>
  <div>
    <v-btn
      :style="{ backgroundColor: backgroundColor, color: textColor }"
      @click="redirectToList"
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
      default: '#45BE14'
    },
    textColor: {
      type: String,
      default: 'black'
    },
    buttonTitle: {
      type: String,
      default: 'Ir para a página de Listar Tarefas',
    },
    buttonText: {
      type: String,
      default: 'Lista de Tarefas ',
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
    redirectToList() {
      this.$router.push('/list');
    },
  }
};
</script>

<style scoped>
.icon-spacing {
  margin-left: 8px;
}
</style>