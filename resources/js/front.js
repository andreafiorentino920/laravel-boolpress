// Dichiarazione axios 
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Dichiarazione vue
window.Vue = require('vue');

// Importare App
import App from "./App.vue";

// Ritorno app 
const app = new Vue({
    el: '#app',
    render: h => h(App)
});
