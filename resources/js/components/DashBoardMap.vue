<template>


  <div id="admin-map">
        <label for="coord_x">Coordonnée X</label>
        <input class="form-control" name="coord_x" type="text" v-model="this.questionPosition[0]" placeholder="Cordone X" />
        <label for="coord_y">Coordonnée Y</label>
        <input class="form-control" name="coord_y" type="text" v-model="this.questionPosition[1]" placeholder="Cordone Y" />
        <label for="coord_y">Radius indice</label>
        <input class="form-control" name="radius" v-model="this.radiusCircle" placeholder="Radius">


    <l-map
    v-on:click ="click"
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
          <l-circle @ready="storeCircle" :lat-lng="[questionPosition[0]|| 0, questionPosition[1]|| 0]" :radius="this.radiusCircle" color="blue" />
      <l-marker
      draggable
      @ready="storemarker"
        :lat-lng="[
          questionPosition[0] || 0,
          questionPosition[1]|| 0,
        ]"
        @moveend="endMove"
      >
       <l-popup>
           <p>Distance x = {{questionPosition[0]}}</p>
           <p>Distance y = {{questionPosition[1]}}</p>
       </l-popup>
      </l-marker>
    </l-map>
     <input type="submit" value="Enregistrer les modifications" class="btn btn-primary">
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
   data: Object,
  },
  data() {
    return {
      userLocation: {},
      zoom: 18,
      arrayRegions: [],
      questionPosition: [],
      field:'',
      radiusCircle:0,
    };
  },

  init() {
    this.mapleaf = null;
    this.circleLeaflet = null;
    this.popupLeaflet = null;
    this.makrerLeaf = null;

  },
  watch:{
      field: function (val) {
          this.$root.bladeValue = val;
      }
  },
 async beforeMount() {
    // Leaflet imports

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

    click(test){


        let latlng = this.mapleaf.layerPointToLatLng([test.layerX || 0, test.layerY || 0]);

        console.log (latlng);
        this.questionPosition[0] =latlng.lat;
        this.questionPosition[1] =latlng.lng;

        console.log(this.questionPosition[0]);

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

      var inputX = document.getElementsByName("coord_x");
        console.log(inputX);
        inputX.value = (this.questionPosition[0]);

    console.log(this.data);


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
#admin-map{
    height:200px;

}

</style>
