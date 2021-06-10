<template>

  <div id="game-map">
    <l-map
      ref="map"
      :zoom="zoom"
      @ready="storemap"
      :center="[
        userLocation.lat || 0,
        userLocation.lng || 0,
      ]"
      @update:center="centerUpdated"
    >
      <l-tile-layer
        url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
        layer-type="base"
        name="OpenStreetMap"
      ></l-tile-layer>

      <l-marker
      @ready="storemarker"
        :lat-lng="[
          userLocation.lat || 0,
          userLocation.lng || 0,
        ]" draggable
        @moveend="endMove"
      >
       <l-tooltip>

        </l-tooltip>
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
  LCircle,
  LTooltip,
} from "@vue-leaflet/vue-leaflet";
import QuizItem from "./quizzes/QuizItem.vue"
import QuizList from "./quizzes/QuizList.vue"
export default {
  components: { LMap, LTooltip, LTileLayer, LMarker, LPopup, LCircleMarker, LCircle, "quiz-item" :QuizItem, "quiz-list" :QuizList},
  props: {
   regions: Object,
  },
  data() {
    return {
      userLocation: {},
      zoom: 18,
      arrayRegions: [],
      questionPosition: [],
    };
  },

  init() {
    this.mapleaf = null;
    this.circleLeaflet = null;
    this.popupLeaflet = null;
    this.makrerLeaf = null;

  },
  async beforeMount() {
    // Leaflet imports
    const { circleMarker } = await import("leaflet/dist/leaflet-src.esm");

    // Set current position
    await this.getUserPosition();
    // Waits until ready to show
    this.mapIsReady = true;
  },

  emits: ["getDistance"],

  methods: {
      storemarker(markerObject) {
      this.makrerLeaf = markerObject;
    },
    storemap(mapObject) {
      this.mapleaf = mapObject;
    },
    storeCircle(circleObject)
    {

        this.circleLeaflet = circleObject;
    },
    popUpObject(popupObject)
    {

        console.log(popupObject.getLatLng());

    },

    endMove()
    {
        console.log("endMove");
        let latidueLong = this.makrerLeaf.getLatLng();

        this.questionPosition[0] = latidueLong.lat;
        this.questionPosition[1] = latidueLong.lng;

        var inputX = document.getElementById('x').value;
    var inputY = document.getElementById('y').value;


    },

    //peuplage de la map avec tout les regions

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

};
</script>

<style>
#game-map{

 height:300px;
}

</style>
