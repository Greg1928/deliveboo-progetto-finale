window.Vue = require('vue');

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import router from "./router";
import '@fortawesome/fontawesome-free/css/all.css';
import '@fortawesome/fontawesome-free/js/all.js';
	
import App from './views/App';

const app = new Vue({
    el: '#app',
    render: h => h(App),
    router,
});