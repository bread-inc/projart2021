<template>
  <div class="row mb-2">
    <button class="btn-desk-locate" @click="this.centerUser">
      <img id="loc" src="/bread/storage/images/locate.png" />
    </button>
  </div>
  <div id="game-map">
    <l-map
      ref="map"
      :zoom="zoom"
      :minZoom="minZoom"
      :maxZoom="maxZoom"
      :zoomDelta= "0.25"
      :zoomSnap= "0"
      @ready="storemap"
      :center="[
       userLocation.lat  || 46.71424131967274,
        userLocation.lng || 8.34749917689746,
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
          userLocation.lat || 46.78129509765656,
          userLocation.lng || 6.6471917511712135,
        ]"
      >
        <l-icon
          :iconUrl="`/bread/storage/images/position.png`"
          :icon-size="[45, 45]"
        />
        <l-popup> You are here </l-popup>
      </l-marker>
      <l-marker
        v-for="region in regions"
        :lat-lng="[region.center_x || 0, region.center_y || 0]"
      >
        <l-icon :iconUrl="`/bread/storage/images/marker.png`" />
        <l-popup @ready="popUpObject">
          <quiz-list :quizzes="region.quizzes"></quiz-list>
        </l-popup>
      </l-marker>
      <l-circle @ready="storeCircle" v-for="region in regions"
        :lat-lng="[region.center_x || 0, region.center_y || 0]">
<l-popup @ready="popUpObject">
          <quiz-list :quizzes="region.quizzes"></quiz-list>
        </l-popup>
      </l-circle>
    </l-map>
  </div>
</template>
<script>
import {
  LIcon,
  LMap,
  LTileLayer,
  LMarker,
  LPopup,
  LCircleMarker,
  LCircle,
} from "@vue-leaflet/vue-leaflet";
import QuizItem from "./quizzes/QuizItem.vue";
import QuizList from "./quizzes/QuizList.vue";
export default {
  components: {
    LMap,
    LTileLayer,
    LMarker,
    LPopup,
    LCircleMarker,
    LCircle,
    LIcon,
    "quiz-item": QuizItem,
    "quiz-list": QuizList,
  },
  props: {
    regions: Object,
  },
  data() {
    return {
      userLocation: {},
      zoom: 8,
      minZoom: 8,
      maxZoom: 19,
      arrayRegions: [],
    };
  },

  init() {
    this.mapleaf = null;
    this.circleLeaflet = null;
    this.popupLeaflet = null;
    this.elem = null;
  },
  async beforeMount() {

    // Set current position
    await this.getUserPosition();
    // Waits until ready to show
    this.mapIsReady = true;
  },

  methods: {
    storemap(mapObject) {
      this.mapleaf = mapObject;
    },

    storeCircle(circleObject) {
      this.circleLeaflet = circleObject;
      this.circleLeaflet.setStyle({fill: true,fillColor: "#FF9554",color:"#FF6100", radius:5000});
    },
    popUpObject(popupObject) {
      this.popupLeaflet = popupObject;
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

    centerUser(){
        this.getUserPosition();
        this.mapleaf.panTo([this.userLocation.lat, this.userLocation.lng]);
    },

    centerUpdated(center) {
      this.center = center;
    },
  },
};
</script>

<style>
#game-map {
}
</style>
