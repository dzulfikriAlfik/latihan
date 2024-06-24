import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import './index.css'
import axios from 'axios'
import Pusher from 'pusher-js'

// Enable pusher logging - don't include this in production
Pusher.logToConsole = true

import Echo from 'laravel-echo'

window.Pusher = require('pusher-js')

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'be68b2f3ed173360fc41',
    cluster: 'ap1',
    forceTLS: true,
})

axios.defaults.withCredentials = true
axios.defaults.baseURL = 'http://127.0.0.1:8000'

store.dispatch('auth/me').finally(() => {
    new Vue({
        router,
        store,
        render: (h) => h(App),
    }).$mount('#app')
})

Vue.config.productionTip = false
