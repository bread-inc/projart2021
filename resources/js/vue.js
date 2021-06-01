import BadgeList from './components/badges/BadgeList.vue'
import test from './components/Map.vue'
import ExampleComponent from './components/ExampleComponent.vue'

import { createApp } from 'vue';

const app = createApp({
    components : {
        "badge-list" : BadgeList,
        "test": test,
        "comp":ExampleComponent,
    }
}).mount('#vue-app')
