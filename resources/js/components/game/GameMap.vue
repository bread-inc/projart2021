<template>
  <div id="game-map-mobile">
    <l-map
      ref="map"
      :zoom="zoom"
      :minZoom="minZoom"
      :maxZoom="maxZoom"
      @ready="storeMap"
      :center="[
        userLocation.lat || defaultLocation.lat,
        userLocation.lng || defaultLocation.lng,
      ]"
      @update:center="centerUpdated"
    >
      <div class="buttons-container">
        <button class="button-game bLocate" @click="centerUser">
          <img id="loc" src="/storage/images/locate.png" />
        </button>
        <button class="button-game bValidate" @click="getDistance">
          <img id="loc" src="/storage/images/validate.png" />
        </button>
      </div>
      <l-tile-layer
        url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
        layer-type="base"
        name="OpenStreetMap"
      ></l-tile-layer>
      <l-marker
      @ready="sycnhroPosUser"
        :lat-lng="[
          userLocation.lat || defaultLocation.lat,
          userLocation.lng || defaultLocation.lng,
        ]"

      >
        <l-icon :iconUrl="`/storage/images/position.png`"
        :icon-size="[45, 45]" />
        <l-popup> You are here </l-popup>
      </l-marker>
      <l-circle v-if="clue.radius" @ready="storeClue" :lat-lng="clueLocation"
      :radius="parseInt(clue.radius)"/>
      <l-circle
        @ready="storeCircle"
        :lat-lng="[question.coord_x, question.coord_y]"
        :radius="0"
        color=""
      />
    </l-map>
  </div>
</template>
<script>
import {
  LMap,
  LTileLayer,
  LMarker,
  LIcon,
  LPopup,
  LCircleMarker,
  LCircle,
} from "@vue-leaflet/vue-leaflet";
export default {
  name: "GameMap",
  components: { LMap, LTileLayer, LMarker, LIcon,LPopup, LCircleMarker, LCircle },
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
      minZoom: 12,
      maxZoom: 19,

      clueLocation: Array,
    };
  },

  watch: {
    // Updates the clue circles coordinates when a new clue is activated
    clue: function (newVal, oldVal) {
      this.newClue(newVal.radius * 0.65);
    },
  },

  init() {
    this.mapleaf = null;
    this.randCircleMarker = null;
  },
  async beforeMount() {
    // Set current position
    await this.getUserPosition();
    // Waits until ready to show
    this.mapIsReady = true;
  },

  emits: ["getDistance"],

  methods: {
    // Updates clue circle coordinates when called
    newClue(radius) {
      this.clueLocation = this.randCoord(radius);

    },

    storeMap(mapObject) {
      this.mapleaf = mapObject;
    },

    storeCircle(circleObject) {
      this.randCircleMarker = circleObject;
    },

    storeClue(circleObject) {
      this.clueCircleMarker = circleObject;
      this.clueCircleMarker.setStyle({fill: true,fillColor: "#FF9554",color:"#FF6100" });
    },

    // Attemps to get the current user position
    async getUserPosition() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition((pos) => {
          this.userLocation = {
            lat: pos.coords.latitude,
            lng: pos.coords.longitude,
          };
        });
      }
    },

    // Returns the distance from the question to parent component
    getDistance() {
    this.getUserPosition;
      let distance = this.mapleaf.distance(this.userLocation, [
        this.question.coord_x,
        this.question.coord_y,
      ]);
      this.$emit("getDistance", distance);
    },

     centerUser(){
        this.getUserPosition();
        this.mapleaf.panTo([this.userLocation.lat, this.userLocation.lng]);
    },

    centerUpdated(center) {
      this.center = center;
    },

     sycnhroPosUser()
    {
        setInterval(this.getUserPosition, 2500);

    },

    /**
     * Returns a random generated coordinate within 0.65 of the given radius
     * COORDS = [question.coord_x, question.coord_y]
     *
     * @param {number} radius The radius of the clue
     * @return {[lat, lng]} Randomly generated coordinates
     */
    randCoord(radius) {
      let r = radius;
      let coord = this.randCircleMarker.getLatLng();
      let bound = this.randCircleMarker.getBounds();

      let newClue = this.findPoint(r, coord, bound);

      return newClue;
    },

    /**
     * Returns a point within the given bounds
     *
     * @param {bounds} bounds The bounds of the reference circle
     * @return {[lat, lng]} The coordinates of a randomly generated point
     */
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

    /**
     *  Returns a point within the given radius from the coords
     *
     * @param {number} r The tolerance radius
     * @param {[lat, lng]} coord The coordinates of the question
     * @param {bounds} bounds The bounds of the reference circle
     * @return {[lat, lng]} Randomly generated coordiantes
     */
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

<style scoped>
</style>
