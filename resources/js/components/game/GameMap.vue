<template>
  <div class="row mb-2">
    <button class="btn btn-warning mr-2 col" @click="this.getUserPosition">
      Locate
    </button>
    <button
      class="btn btn-success mr-2 col"
      @click="this.getDistance"
    >
      Validate
    </button>
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
        v-if="clue.radius"
        :lat-lng="[question.coord_x, question.coord_y]"
        :radius="parseInt(clue.radius)"
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
  LCircle,
} from "@vue-leaflet/vue-leaflet";
export default {
  name: 'GameMap',
  components: { LMap, LTileLayer, LMarker, LPopup, LCircleMarker, LCircle },
  props: {
    defaultLocation: {
      type: Object,
      default: () => ({
        lat: 46.78170795836792,
        lng: 6.647425889233018,
      }),
    },
    question: Object,
    clue: "",
  },
  data() {
    return {
      userLocation: {},
      zoom: 18,
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

  emits: ['getDistance'],

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
      let distance = this.mapleaf.distance(this.userLocation, [
        this.question.coord_x,
        this.question.coord_y,
      ]);
      this.$emit("getDistance", distance);
    },

    centerUpdated(center) {
      this.center = center;
    },
  },
}
  
</script>

<style>
#game-map {
  height: 300px;
}
</style>
