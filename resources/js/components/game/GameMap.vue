<template>
  <h3>{{ data.quiz.title }}</h3>
  <p>Quiz : {{ data.quiz.description }}</p>
  <p>Question : {{ currentQuestion.description }}</p>
  <p>Clue : {{ currentClue.description }}</p>
  <p>{{}}</p>
  <div class="mb-2">
    <button class="btn btn-info mr-2" @click="this.getUserPosition">Locate</button>
    <button class="btn btn-info mr-2" @click="this.nextClue">Clues</button>
    <button class="btn btn-info mr-2" @click="this.getDistance">Distance</button>
  </div>
  <div id="game-map">
    <l-map
      ref="map"
      :zoom="zoom"
      @ready="storemap"
      :center="[
        userLocation.lat || defaultLocation.lat,
        userLocation.lng || defaultLocation.lng,
      ]"
      @update:center="centerUpdated"
    >
      <l-tile-layer
        url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
        layer-type="base"
        name="OpenStreetMap"
      ></l-tile-layer>
      <l-marker
        :lat-lng="[
          userLocation.lat || defaultLocation.lat,
          userLocation.lng || defaultLocation.lng,
        ]"
      >
        <l-popup> You are here </l-popup>
      </l-marker>
      <l-circle
        :lat-lng="[
          currentQuestion.coord_x,
          currentQuestion.coord_y
          ]"
        :radius="parseInt(currentQuestion.radius)"
        color="red"
          />
    </l-map>
  </div>
</template>
<script>
import {
  LMap,
  LTileLayer,
  LMarker,
  LPopup,
  LCircleMarker,
  LCircle
} from "@vue-leaflet/vue-leaflet";
export default {
  components: { LMap, LTileLayer, LMarker, LPopup, LCircleMarker, LCircle },
  props: {
    defaultLocation: {
      type: Object,
      default: () => ({
        lat: 46.78170795836792,
        lng: 6.647425889233018,
      }),
    },
    data: Object,
  },
  computed: {
    currentQuestion() {
      return this.data.questions[this.indexQuestion];
    },
    currentClue() {
      return this.currentQuestion.clues[this.indexClue];
    }
  },
  data() {
    return {
      userLocation: {},
      zoom: 18,
      indexQuestion: 0,
      indexClue: 0,
    };
  },
  init() {
    this.mapleaf = null;
  },
  async beforeMount() {
    // Leaflet imports
    const { circleMarker } = await import("leaflet/dist/leaflet-src.esm");

    // Set current position
    this.getUserPosition();

    circleMarker(this.userLocation, { radius: 8 });

    // Waits until ready to show
    this.mapIsReady = true;
  },

  methods: {
    storemap(mapObject) {
      this.mapleaf = mapObject;
    },

    async getUserPosition() {
      // check if API is supported
      if (navigator.geolocation) {
        // get  geolocation
        navigator.geolocation.getCurrentPosition((pos) => {
          // set user location
          this.userLocation = {
            lat: pos.coords.latitude,
            lng: pos.coords.longitude,
          };
        });
      }
    },

    getDistance() {
      let distance = this.mapleaf.distance(this.userLocation,[this.currentQuestion.coord_x, this.currentQuestion.coord_y]);
      console.log(distance);
    },

    centerUpdated(center) {
      this.center = center;
    },

    nextQuestion() {
      this.indexQuestion++;
    },

    nextClue() {
      let cluesLength = this.data.questions[this.indexQuestion].clues.length;
      if (this.indexClue < cluesLength - 1) this.indexClue++;
    },
  },
};
</script>

<style>
#game-map {
  height: 300px;
}
</style>
