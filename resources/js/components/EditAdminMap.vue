<template>


  <div id="admin-map">
        <label for="coord_x">Coordonnée X</label>
        <input class="form-control" name="coord_x" type="text" v-model="this.valuex" placeholder="Cordone X" />
        <label for="coord_y">Coordonnée Y</label>
        <input class="form-control" name="coord_y" type="text" v-model="this.valuey" placeholder="Cordone Y" />
        <label for="radius">Radius indice</label>
        <input class="form-control" name="radius" v-model.number="this.radiusCircle" placeholder="Radius">


    <l-map
      @click ="click"
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
          <l-circle @ready="storeCircle" :lat-lng="[this.valuex || 0, this.valuey || 0]" :radius="this.radiusCircle" color="blue" />
      <l-marker
      @ready="storemarker"
        :lat-lng="[
          this.valuex || 0,
          this.valuey || 0,
        ]"
      >
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
      radiusCircle: parseInt(this.data.radius),
      valuex: this.data.coord_x,
      valuey: this.data.coord_y,
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

      console.log(this.data);
    },
    storemap(mapObject) {
      this.mapleaf = mapObject;
    },

    click(test){

       console.log(this.data.coord_x);

       let x = test.layerX;
       let y = test.layerY;

        console.log(y);
        console.log(x);

       let  latiLongi = this.mapleaf.layerPointToLatLng([x , y]);

        this.valuex =latiLongi.lat;
        this.valuey =latiLongi.lng;

    },

    storeCircle(circleObject)
    {

        this.circleLeaflet = circleObject;
    },
    popUpObject(popupObject)
    {

        console.log(popupObject.getLatLng());

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
    height:400px;

}

</style>
