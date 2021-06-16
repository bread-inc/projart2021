// Display imports
import BadgeList from './components/badges/BadgeList.vue';
import ScoreList from './components/scores/ScoreList.vue';
import RegionList from './components/regions/RegionList.vue';
import QuizList from './components/quizzes/QuizList.vue';
import GameContainer from './components/game/GameContainer.vue';

// Game imports
import 'leaflet/dist/leaflet.css';
import GameDesktopMap from './components/GameDesktopMap.vue';
import AdminMap from './components/AdminMap.vue';
import ClueMap from './components/ClueMap.vue';
import EditAdminMap from './components/EditAdminMap.vue';
import EditClueMap from './components/EditClueMap.vue';
import { createApp } from 'vue';

const app = createApp({
    components : {
        'badge-list' : BadgeList,
        'score-list' : ScoreList,
        'region-list' : RegionList,
        'quiz-list' : QuizList,
        'game-container' : GameContainer,
        "game-desktop-map":GameDesktopMap,
        "admin-map":AdminMap,
        "clue-map":ClueMap,
        "edit-admin-map":EditAdminMap,
        "edit-clue-map": EditClueMap
    }
}).mount('#vue-app')
