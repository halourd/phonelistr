import './bootstrap';
import  { createApp} from "vue"
import router from './router/router';

import App from "./App.vue"
import SkeletalLoader from './components/SkeletalLoader.vue';

const app = createApp(App);
app.component('SkeletalLoader', SkeletalLoader);
app.use(router);
app.mount("#app");