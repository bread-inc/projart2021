<template>
  <div class="row mb-2">
    <button class="btn btn-warning mr-2 col" @click="this.getUserPosition">
      Locate
    </button>
    <p>{{regions[0].quizzes}}</p>
     <button class="btn btn-warning mr-2 col" @click="peupleMap">
      peupler la carte
    </button>
    <button @click="testData()">
        Data
    </button>
  </div>
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
        :lat-lng="[
          userLocation.lat || 0,
          userLocation.lng || 0,
        ]"
      >
        <l-popup> You are here </l-popup>
      </l-marker>

      <l-marker
        :lat-lng="[
          46.78170795836792, 6.647425889233018
        ]"
        @ready="storemarker"
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
  LCircle,
} from "@vue-leaflet/vue-leaflet";
export default {
  components: { LMap, LTileLayer, LMarker, LPopup, LCircleMarker, LCircle },
  props: {
   regions: Object,
  },
  data() {
    return {
      userLocation: {},
      zoom: 18,
      arrayRegions: [],
    };
  },

  init() {
    this.mapleaf = null;
    this.circleLeaflet = null;

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
    storemap(mapObject) {
      this.mapleaf = mapObject;
    },
    storeCircle(circleObject)
    {

        this.circleLeaflet = circleObject;
    },

    //peuplage de la map avec tout les regions
   async peupleMap(){
            const { marker } = await import("leaflet/dist/leaflet-src.esm");
            const { popup} = await import("leaflet/dist/leaflet-src.esm");
            var pop = popup;
            this.regions.forEach(element => {

            var markert = marker([element.center_x,element.center_y],{title:element.name});

            markert.addTo(this.mapleaf);
            markert.bindPopup('');

       });

       console.log(regions);
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

    plotrandom(bounds)
        {

            var southWest = bounds.getSouthWest();
            var northEast = bounds.getNorthEast();
            var lngSpan = northEast.lng - southWest.lng;
            var latSpan = northEast.lat - southWest.lat;
            // sera remplacer par les point des région
            let pointsRand =[];
            let NomQuiz = "nom du quiz : ";

            let nbrQuiz =5;
            for (var i = 0; i< nbrQuiz;i++)
            {
                    var point = [southWest.lat + latSpan * Math.random(),southWest.lng + lngSpan * Math.random()];
                    pointsRand.push(point);
            }
            console.log(pointsRand);
            for (var i = 0; i< nbrQuiz;i++)
            {
                   var marker = L.marker(pointsRand[i],{title:NomQuiz+ i});
                   marker.addTo(this.mapleaf);
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

</style>
