<template>
  <v-card class="container" max-width="1200" dark>
    <v-card-title>
      Detalhes da Tarefa - ID: {{ taskDetails.id }}
      <v-progress-circular 
        class="loader-spacing"
        v-if="loading"
        :size="20"
        :width="2"
        indeterminate
      >
      </v-progress-circular>
      <v-spacer></v-spacer>
      <ButtonRedirectToList
        backgroundColor="#2938D5"
        textColor="white"
        :loading="loading"
      />
    </v-card-title>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="form-group row">
          <label for="title" class="col-sm-3 text-right">Título:</label>
          <div class="col-sm-9">
            <input 
              class="form-control"
              v-model="taskDetails.title"
              disabled
            >
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="form-group row">
          <label for="description" class="col-sm-3 text-right">Descrição:</label>
          <div class="col-sm-9">
            <textarea 
              class="form-control"
              v-model="taskDetails.description"
              :maxlength="1000"
              disabled
              style="height: 270px; max-height: 270px; resize: none;"
            >
            </textarea>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="form-group row">
          <label for="title" class="col-sm-3 text-right">Concluído:</label>
          <div class="col-sm-1">
          <v-chip
            :color="getColor(taskDetails.completed)"
          > 
            {{ getMessage(taskDetails.completed) }} 
          </v-chip>
          </div>
        </div>
      </div>
    </div>
  </v-card>
</template>

<script>
import axios from 'axios';
import TASK_STATUS from '../Enums/TaskStatus.js'
import ButtonRedirectToList from './ButtonRedirectToList.vue';

export default {
  components: {
    ButtonRedirectToList,
  },
  data() {
    return {
      loading: false,
      taskDetails: [],
      fields: {
        title: '',
        description: '',
      },
    };
  },
  mounted() {
    this.getTaskDetails();
  },
  methods: {
    async getTaskDetails() {
      this.loading = true;
      const taskId = this.$route.params.id;
      axios.get(`/api/task/details/${taskId}`)
        .then(response => {
          this.taskDetails = response.data;
          console.log('response', response.data);
          this.loading = false;
        })
        .catch(error => {
          console.log(error);
          this.loading = false;
        });
    },
    getColor(completed) {
      return completed === TASK_STATUS.PENDING ? '#F39C12' : '#27AE60 ';
    },
    getMessage(completed) {
      return completed === TASK_STATUS.PENDING ? 'Não' : 'Sim';
    },
  }
};
</script>

<style scoped>
.loader-spacing {
  margin-left: 8px;
}
</style>
