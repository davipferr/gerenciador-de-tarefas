<template>
  <v-card class="container" max-width="1200">
    <v-card-title>
      Lista de tarefas
      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Pesquisar pelo Título"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>

    <v-data-table
      :headers="headers"
      :items="tasks"
      :search="search"
      :loading="loading"
    >
      <template v-slot:loading>
        <div class="text-center">
          <v-progress-circular 
            :size="20"
            :width="2"
            indeterminate
          >
          </v-progress-circular>
        </div>
      </template>
      <template v-slot:[`item.completed`]="{ item }">
        <v-chip
          :color="getColor(item.completed)"
        >
          {{ item.completed ? 'sim' : 'não'}}
        </v-chip>
      </template>
      <template v-slot:[`item.actions`]="{ item }">
        <div v-if="!loading" class="d-flex">
          <v-icon
            class="mr-3"
            @click="changeTaskStatus(item.id, item.completed)"
            :title="getStatusMessage(item.completed)"
          >
            mdi-pencil
          </v-icon>
          <v-icon
            @click="deleteTask(item.id)"
            title="Excluir"
          >
            mdi-delete
          </v-icon>
        </div>
        <div v-else>
          <v-progress-circular 
            :size="20"
            :width="2"
            indeterminate
          >
          </v-progress-circular>
        </div>
      </template>
    </v-data-table>
    <ButtonRedirectToCreate
      :loading="loading"
    />
  </v-card>
</template>

<script>
import axios from 'axios';
import TASK_STATUS from '../Enums/TaskStatus.js'
import ButtonRedirectToCreate from './ButtonRedirectToCreate.vue';

export default {
  components: {
    ButtonRedirectToCreate,
  },
  data() {
    return {
      search: '',
      tasks: [],
      newStatus: '',
      loading: false, // Add loading state
      headers: [
        { text: 'Título', value: 'title' },
        { text: 'Descrição', value: 'description' },
        { text: 'Concluído', value: 'completed' },
        { text: 'Ações', value: 'actions', sortable: false }
      ]
    };
  },
  mounted() {
    this.fetchTasks();
  },
  methods: {
    async fetchTasks() {
      this.loading = true;
      axios.get('/api/task/list')
        .then(response => {
          this.tasks = response.data;
          this.loading = false;
        })
        .catch(error => {
          console.log(error);
          this.loading = false;
        });
    },
    changeTaskStatus(id, completed) {
      this.loading = true;
      const newStatus = completed === TASK_STATUS.PENDING ? TASK_STATUS.CONCLUDED : TASK_STATUS.PENDING;

      axios.put(`/api/task/update/${id}`, {newStatus})
        .then(response => {
          console.log('response', response);
          this.fetchTasks();
        })
        .catch(error => {
          console.log('error', error);
          this.loading = false;
        });
    },
    deleteTask(id) {
      this.loading = true;
      axios.delete(`api/task/delete/${id}`)
        .then(response => {
          console.log('response', response);
          this.fetchTasks();
        })
        .catch(error => {
          console.log('error', error);
        })
    },
    getColor(completed) {
      return completed === TASK_STATUS.PENDING ? '#F39C12' : '#27AE60 ';
    },
    getStatusMessage(completed) {
      return completed === TASK_STATUS.PENDING ? 'mudar status para CONCLUÍDO' : 'mudar status para PENDENTE';
    },
    redirectToCreate() {
      this.$router.push('/create');
    },
  },
};
</script>

<style scoped>
* {
  color: black
}
</style>