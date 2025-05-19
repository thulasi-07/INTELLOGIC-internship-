import { createApp } from 'vue'
import App from './App.vue'

import Antd from 'ant-design-vue'
import 'ant-design-vue/dist/reset.css'


import axios from 'axios'

axios.defaults.baseURL = 'http://127.0.0.1:8000'

const app = createApp(App)

app.use(Antd)

app.mount('#app')
