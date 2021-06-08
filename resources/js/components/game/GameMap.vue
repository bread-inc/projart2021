<template>
  <div class="row mb-2">
    <button class="btn btn-warning mr-2 col" @click="this.getUserPosition">
      Locate
    </button>
    <button class="btn btn-success mr-2 col" @click="this.getDistance">
      Validate
    </button>
    <button class="btn btn-warning" @click="randCoord()">
      test rnd circle 1
    </button>
  </div>
  <div id="game-map">
    <l-map
      ref="map"
      :zoom="zoom"
      @ready="storeMap"
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
        @ready="storeClue"
        :lat-lng="[question.coord_x, question.coord_y]"
        :radius="parseInt(clue.radius)"
        color="red"
      />
      <l-circle
        v-if="0"
        :lat-lng="[question.coord_x, question.coord_y]"
        :radius="parseInt(question.radius)"
      />
      <l-circle
        @ready="storeCircle"
        :lat-lng="[question.coord_x, question.coord_y]"
        :radius="parseInt(question.radius / 10)"
        color="green"
      />
      <l-circle
        v-if="this.randCircleMarker"
        :lat-lng="randCoord()"
        :radius="parseInt(question.radius)"
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
  name: "GameMap",
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
    clueCoords: Array,
  },
  data() {
    return {
      userLocation: {},
      zoom: 18,
    };
  },

  watch: {
    clue(){
      this.clueCoords = randCoord();
    }
  },

  init() {
    this.mapleaf = null;
    this.randCircleMarker = null;
  },
  async beforeMount() {
    // Leaflet imports
    const { circleMarker } = await import("leaflet/dist/leaflet-src.esm");

    // Set current position
    await this.getUserPosition();

    circleMarker(this.userLocation, { radius: 8 });

    // Waits until ready to show
    this.mapIsReady = true;
  },

  emits: ["getDistance"],

  methods: {
    storeMap(mapObject) {
      this.mapleaf = mapObject;
    },

    storeCircle(circleObject) {
      this.randCircleMarker = circleObject;
    },

    storeClue(circleObject) {
      this.clueCircleMarker = circleObject;
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

    randCoord() {
      let r = this.clue.radius;
      let coord = this.randCircleMarker.getLatLng();
      let bound = this.randCircleMarker.getBounds();

      let newClue = this.findPoint(r, coord, bound);

      console.log([this.question.coord_x, this.question.coord_y]);
      console.log(newClue);

      return newClue;
    },

    randPlot(bounds) {
      var southWest = bounds.getSouthWest();
      var northEast = bounds.getNorthEast();
      var lngSpan = northEast.lng - southWest.lng;
      var latSpan = northEast.lat - southWest.lat;

      var point = [
        southWest.lat + latSpan * Math.random(),
        southWest.lng + lngSpan * Math.random(),
      ];

      return point;
    },

    findPoint(r, coord, bounds) {
      let plot;

      do {
        plot = this.randPlot(bounds);
      } while (this.mapleaf.distance(plot, coord) > r);

      return plot;
    },
  },
};
</script>

<style>
</style>
