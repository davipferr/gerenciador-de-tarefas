<template>
  <div class="container" max-width="1200">
    <ButtonRedirectToList
      :loading="loading"
    />
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="form-group">
          <label for="title" class="col-form-label">Título:</label>
          <input 
            type="text"
            id="title"
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
            id="description"
            v-model="fields.description"
            class="form-control"
            required
            :maxlength="1000"
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
          @click="createTask" 
          style="background-color: #45BE14; color: black;"
        >
          Criar Tarefa 
          <v-icon
            v-if="!loading"
            class="ml-3 justify-content-center"
          >
            mdi-plus
          </v-icon>
            <v-progress-circular 
              class="ml-3 justify-content-center"
              v-if="loading"
              :size="20"
              :width="2"
              indeterminate
            >
            </v-progress-circular>
        </v-btn>
      </div>
    </div>
  </div>
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
        .then(response => {
          // Handle success
          console.log('Task created successfully!', response.data);
          this.clearFields();
          this.loading = false;
        })
        .catch(error => {
          // Handle error
          console.error('Failed to create task:', error);
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
</style>
