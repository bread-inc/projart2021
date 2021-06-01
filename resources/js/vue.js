import BadgeList from './components/badges/BadgeList.vue'

import { createApp } from 'vue';

const app = createApp({
    components : {
        "badge-list" : BadgeList,
    }
}).mount('#vue-app')
