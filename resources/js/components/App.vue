<template>
    <div>
      <router-view />
    </div>
  </template>
  
  <script>
  import { createRouter, createWebHistory } from 'vue-router';
  import Login from './Login.vue';
  import PerformanceTest from './PerformanceTest.vue';
  
  const routes = [
    { path: '/', component: Login },
    { path: '/performance-test', component: PerformanceTest },
  ];
  
  const router = createRouter({
    history: createWebHistory(),
    routes,
  });
  
  export default {
    router,
  };
  </script>
  