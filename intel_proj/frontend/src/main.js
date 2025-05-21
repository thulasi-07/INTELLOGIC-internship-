import { createApp } from 'vue';
import './style.css';
import App from './App.vue';
import axiosInstance from './axios';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';


const app = createApp(App); 

app.config.globalProperties.$axios = axiosInstance; 

app.mount('#app'); 