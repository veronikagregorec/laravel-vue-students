import './bootstrap';
import { createApp } from 'vue';

import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'


import ExampleComponent from './components/ExampleComponent.vue';
import StudentFormComponent from './components/student/StudentFormComponent.vue'


const app = createApp({});
app.use(ElementPlus)

app.component('example-component', ExampleComponent);
app.component('student-form-component', StudentFormComponent);

app.mount('#vue-app');
