import './sass/tailwind.scss';
import './sass/custom.scss';

import { createApp } from "vue";

const app = createApp({
    mounted() {
        window.dispatchEvent(new Event('vue-ready'))
    }
});
const files = require.context('./vue', true, /\.vue$/i);
files.keys().map(key => app.component(key.split('/').pop().split('.')[0], files(key).default));
app.mount('#app');