<template>
<h3>{{ data.quiz.title }}</h3>
<p>{{ data.quiz.description }}</p>
<p>{{ data.questions[indexQuestion]}} </p>
<p>{{ data.questions[indexQuestion].clues[indexClue]}}</p>
  <button class="btn btn-info" @click="this.getUserPosition">locate</button>
  <button class="btn btn-info" @click="this.nextClue">Clues</button>
  <div id="game-map">
    <l-map
      ref="map"
      :zoom="zoom"
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
} from "@vue-leaflet/vue-leaflet";
export default {
  components: { LMap, LTileLayer, LMarker, LPopup, LCircleMarker },
  props: {
    defaultLocation: {
      type: Object,
      default: () => ({
        lat: 46.78170795836792,
        lng: 6.647425889233018,
      }),
    },
    data : Object,
  },
  data() {
    return {
      userLocation: {},
      zoom: 18,
      indexQuestion : 0,
      indexClue : 0,
    };
  },
  mounted() {
    this.getUserPosition();
  },
  methods: {
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
    centerUpdated(center) {
      this.center = center;
    },
    nextQuestion() {
        this.indexQuestion++;
    },
    nextClue() {
        let maxClue = this.data.questions[this.indexQuestion].clues.length;
        if (this.indexClue < maxClue-1) this.indexClue++;
    }

  },
};
</script>

<style>
#game-map {
  height: 300px;
}
</style>
