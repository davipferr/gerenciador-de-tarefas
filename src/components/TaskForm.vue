<template>
  <v-card class="container" max-width="1200" dark>
    Crie sua Tarefa
    <v-spacer></v-spacer>
    <v-card-title class="justify-content-end d-flex">
      <ButtonRedirectToList
        :loading="loading"
      />
    </v-card-title>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="form-group">
          <label for="title" class="col-form-label">Título:</label>
          <input 
            type="text"
            v-model="fields.title"
            class="form-control"
            required
            :maxlength="60"
          >
          <div class="character-count">
            {{ 60 - fields.title.length }} caracteres restantes
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="form-group">
          <label for="description" class="col-form-label">Descrição:</label>
          <textarea 
            class="form-control"
            v-model="fields.description"
            :maxlength="1000"
            style="height: 270px; max-height: 270px; resize: none;"
          >
          </textarea>
          <div class="character-count">
            {{ 1000 - fields.description.length }} caracteres restantes
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <v-btn 
          style="background-color: #45BE14; color: black;"
          @click="createTask" 
          :disabled="loading"
        >
          Criar Tarefa
          <v-icon
            v-if="!loading"
            class="icon-spacing"
          >
            mdi-plus
          </v-icon>
          <v-progress-circular 
            class="loader-spacing"
            v-if="loading"
            :size="20"
            :width="2"
            indeterminate
          >
          </v-progress-circular>
        </v-btn>
      </div>
    </div>
  </v-card>
</template>

<script>
import axios from 'axios';
import ButtonRedirectToList from './ButtonRedirectToList.vue';

export default {
  components: {
    ButtonRedirectToList,
  },
  data() {
    return {
      loading: false,
      fields: {
        title: '',
        description: '',
      }
    };
  },
  methods: {
    createTask() {
      this.loading = true;
      axios.post('/api/task/create', this.fields)
        .then(() => {
          console.log('Tarefa criada com sucesso!');
          this.clearFields();
          this.loading = false;
        })
        .catch(error => {
          console.error('Houve um erro ao criar a Tarefa:', error);
          this.loading = false;
        });
    },
   clearFields() {
      Object.keys(this.fields).forEach((field) => { 
        this.fields[field] = '';
      });
    },
  }
};
</script>

<style scoped>
.form-group {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  margin-bottom: 1rem;
}
.col-form-label {
  align-self: flex-start;
  margin-bottom: 0.5rem;
}

.icon-spacing {
  margin-left: 8px;
}

.loader-spacing {
  margin-left: 8px;
}
</style>
