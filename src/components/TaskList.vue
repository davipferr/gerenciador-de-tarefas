<template>
  <v-card class="container" max-width="1200" dark>
    <v-card-title>
      Lista de Tarefas
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
      no-data-text="Não há tarefas para listar..."
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
      <template v-slot:[`item.taskDetails`]="{ item }">
        <div class="text-center">
          <v-icon
            @click="taskDetails(item.id)"
            title="Ver detalhes da Tarefa"
          >
            mdi-text-box
          </v-icon>
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
            class=""
            @click="updateTask(item.id, item.completed)"
            :title="getStatusMessage(item.completed)"
          >
            mdi-swap-horizontal
          </v-icon>
          <v-icon
            @click="openDialog(item)"
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
    <div>
      <v-dialog v-model="dialogVisible" :modal="dialogVisible" max-width="800px" persistent>
        <v-card dark>
          <v-card-title class="my-3">
            Editar Tarefa
          </v-card-title>
          <v-card-text>
              <v-text-field
                label="Título"
                v-model="editValueTitle"
                :maxlength="60"
                :disabled="loading"
              >
              </v-text-field>
              <div>
                {{ 60 - editValueTitle.length }} caracteres restantes
              </div>
              <v-textarea 
                label="Descrição"
                v-model="editValueDescription"
                :maxlength="1000"
                no-resize
                :disabled="loading"
              >
              </v-textarea>
              <div>
                {{ 1000 - editValueDescription.length }} caracteres restantes
              </div>
          </v-card-text>
          <v-card-actions>
            <v-btn
              @click="updateTask(taskId)"
              style="backgroundColor: #2938D5; color: white;"
              :disabled="loading"
            >
              Salvar
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
            <v-btn
              @click="cancelDialog"
              style="backgroundColor: #BA0606; color: white;"
              :disabled="loading"
            >
              Cancelar
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </div>
    <ButtonRedirectToCreate
      class="justify-content-start d-flex"
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
      editValueTitle: '',
      editValueDescription: '',
      taskId: '',
      dialogVisible: false,
      loading: false,
      headers: [
        { text: '', value: 'taskDetails' },
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
    updateTask(id, completed) {
      this.loading = true;
      const newData = {
        newStatus: completed !== undefined ? 
          (completed === TASK_STATUS.PENDING ? TASK_STATUS.CONCLUDED : TASK_STATUS.PENDING) : '',
        newTitle: this.editValueTitle,
        newDescription: this.editValueDescription,
      }

      axios.put(`/api/task/update/${id}`, newData)
        .then(() => {
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
        .then(() => {
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
    taskDetails(taskId) {
      this.$router.push(`/details/${taskId}`);
    },
    openDialog(items) {
      this.editValueTitle = items.title;
      this.editValueDescription = items.description;
      this.taskId = items.id;
      this.dialogVisible = true;
    },
    cancelDialog() {
      this.dialogVisible = false;
    }
  },
};
</script>

<style scoped>
.loader-spacing {
  margin-left: 8px;
}
</style>
