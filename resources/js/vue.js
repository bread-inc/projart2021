import BadgeList from './components/badges/BadgeList.vue'
import ScoreList from './components/scores/ScoreList.vue'
import test from './components/Map.vue'
import ExampleComponent from './components/ExampleComponent.vue'
import 'leaflet/dist/leaflet.css'
import testMap from './components/mapLeaflet.vue'

import { createApp } from 'vue';

const app = createApp({
    components : {
        "badge-list" : BadgeList,
        'score-list' : ScoreList,
        "test": test,
        "comp":ExampleComponent,
        "testleaf": testMap,
    }
}).mount('#vue-app')
