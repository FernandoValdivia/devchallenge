import { abilitiesPlugin } from '@casl/vue';
import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import "../src/style.css";

createApp(App).use(router).mount('#app');
const app = createApp(App);
app.use(abilitiesPlugin, ability);
app.mount('#app');
