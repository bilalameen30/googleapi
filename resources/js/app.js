import './bootstrap'; // This imports your bootstrap file for any other dependencies or configurations
import { createApp } from 'vue'; // Import Vue's createApp
import App from './components/App.vue'; // Import your main App component
import { createRouter, createWebHistory } from 'vue-router'; // Import Vue Router

// Define your routes
const routes = [
  { path: '/', component: () => import('./components/Login.vue') }, // Login page
  { path: '/performance-test', component: () => import('./components/PerformanceTest.vue') }, // Performance test page
];

// Create the router instance
const router = createRouter({
  history: createWebHistory(), // Use HTML5 history mode
  routes, // Set routes defined above
});

// Create the Vue application instance
const app = createApp(App);

// Use the router with the app instance
app.use(router);

// Automatically register your Vue components if needed
// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

// Mount the Vue application to the DOM
app.mount('#app');
