<template>
  <v-card class="container"  max-width="700" dark>
    <v-card-title class="justify-content-center fw-bold">
      Bem-vindo(a) ao seu gerenciador de Tarefas!
    </v-card-title>
    <div class="my-5">
      <label>Começe sua lista de tarefas</label>
    </div>
    <v-card-actions class="justify-content-center">
      <ButtonRedirectToCreate 
        class="mx-4"
        backgroundColor="#45BE14"
        textColor="black"
      />
      <ButtonRedirectToList
        backgroundColor="#2938D5"
        textColor="white"
      />
    </v-card-actions>
  </v-card>
</template>

<script>
import ButtonRedirectToList from './ButtonRedirectToList.vue';
import ButtonRedirectToCreate from './ButtonRedirectToCreate.vue';

export default {
  components: {
    ButtonRedirectToList,
    ButtonRedirectToCreate,
  },
};
</script>
