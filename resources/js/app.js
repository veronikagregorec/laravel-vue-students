import './bootstrap';
import { createApp } from 'vue';
import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'
import store from './store/store.js';
import ExampleComponent from './components/ExampleComponent.vue';
import StudentFormComponent from './components/student/StudentFormComponent.vue'
import StudentTableComponent from './components/student/StudentTableComponent.vue'

const app = createApp({});
app.use(ElementPlus)
app.use(store)
app.component('example-component', ExampleComponent);
app.component('student-form-component', StudentFormComponent);
app.component('student-table-component', StudentTableComponent);

app.mount('#vue-app');
