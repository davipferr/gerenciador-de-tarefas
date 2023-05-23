import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

export const router = new VueRouter({
    mode: 'history',
    routes: [
      {
        path: '/',
        name: 'Home',
        component: () => import('@/components/HomePage.vue'),
      },
      {
        path: '/create',
        name: 'TaskForm',
        component: () => import('@/components/TaskForm.vue'),
      },
      {
        path: '/list',
        name: 'TaskList',
        component: () => import('@/components/TaskList.vue'),
      },
      {
        path: '/details/:id',
        name: 'TaskDetails',
        component: () => import('@/components/TaskDetails.vue'),
      },
    ],
  });