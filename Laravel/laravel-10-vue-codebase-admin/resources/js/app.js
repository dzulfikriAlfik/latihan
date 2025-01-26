import './bootstrap';

import { createApp, onMounted } from 'vue';
import router from './routes/index';
import VueSweetalert2 from 'vue-sweetalert2';
import useAuth from './composables/auth';
import { abilitiesPlugin } from '@casl/vue';
import ability from './services/ability';

import { domMixins } from "@/mixins/domMixins.js";
import { logMixin } from "@/mixins/logMixin.js";

createApp({
    setup () {
        const { getUser } = useAuth()
        // onMounted(getUser)
    }
})
    .use(router)
    .use(VueSweetalert2)
    .use(abilitiesPlugin, ability)
    .mixin(domMixins)
    .mixin(logMixin)
    .mount('#app')
