// Display imports
import BadgeList from './components/badges/BadgeList.vue';
import ScoreList from './components/scores/ScoreList.vue';
import RegionList from './components/regions/RegionList.vue';
import QuizList from './components/quizzes/QuizList.vue';
import GameContainer from './components/game/GameContainer.vue';

// Game imports
import test from './components/Map.vue';
import ExampleComponent from './components/ExampleComponent.vue';
import 'leaflet/dist/leaflet.css';
import testMap from './components/mapLeaflet.vue';
import GameDesktopMap from './components/GameDesktopMap.vue';
import { createApp } from 'vue';

const app = createApp({
    components : {
        'badge-list' : BadgeList,
        'score-list' : ScoreList,
        'region-list' : RegionList,
        'quiz-list' : QuizList,
        'game-container' : GameContainer,
        "test": test,
        "comp":ExampleComponent,
        "testleaf": testMap,
        "game-desktop-map":GameDesktopMap,
    }
}).mount('#vue-app')
