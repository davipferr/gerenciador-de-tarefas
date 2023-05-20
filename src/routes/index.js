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
    ],
  });