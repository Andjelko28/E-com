import './bootstrap';
import routes from '../js/routes';
import { createApp } from 'vue';

import App from '../components/App.vue';

createApp(App)
    .use(routes)
    .mount('#app');
