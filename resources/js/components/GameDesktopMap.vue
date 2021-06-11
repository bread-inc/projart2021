<template>
  <div class="row mb-2">
    <button  class="btn-desk-locate" @click="this.getUserPosition">
      <img id="loc" src="/images/locate.png">
    </button>
<quiz-list>

</quiz-list>

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
        <l-popup @ready="storePopup"> You are here </l-popup>

      </l-marker>
        <l-marker v-for="region in regions"
      :lat-lng="[
        region.center_x || 0,
        region.center_y|| 0,
      ]">
      <l-icon />
        <l-popup
        @ready="popUpObject">

         <quiz-list
:quizzes='region.quizzes'></quiz-list>
        </l-popup>

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
LIcon,
  LMap,
  LTileLayer,
  LMarker,
  LPopup,
  LCircleMarker,
  LCircle,
} from "@vue-leaflet/vue-leaflet";
import QuizItem from "./quizzes/QuizItem.vue"
import QuizList from "./quizzes/QuizList.vue"
export default {
  components: { LMap, LTileLayer, LMarker, LPopup, LCircleMarker, LCircle, LIcon, "quiz-item" :QuizItem, "quiz-list" :QuizList},
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
    this.popupLeaflet = null;
    this.elem = null;


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
    popUpObject(popupObject)
    {

       this.popupLeaflet=popupObject;
    console.log(this.popupLeaflet.isOpen());

    },


    //peuplage de la map avec tout les regions
   async peupleMap(){
            const { marker } = await import("leaflet/dist/leaflet-src.esm");
            const { popup} = await import("leaflet/dist/leaflet-src.esm");
            const objectLenght = Object.keys(this.regions).length;
            var pop = popup;
            var tabPopup =[];

           for (let index = 0; index < objectLenght-1; index++) {
               // console.log(this.regions[index]);
                 var markert = marker([this.regions[index].center_x,this.regions[index].center_y],{title:this.regions[index].name});
                  markert.addTo(this.mapleaf);
                  //markert.bindPopup(this.regions[index].name)

                for (let index2 = 0; index2< this.regions[index].quizzes.length; index2++) {
                  let title = this.regions[index].quizzes[index2].title;
                  let description = this.regions[index].quizzes[index2].description;
                tabPopup[index2] = this.regions[index].quizzes[index2];


                }
                console.log(tabPopup);
              tabPopup.forEach(quiz => {
                  console.log(quiz.id);
                    markert.bindPopup("<quiz-item:quiz="+quiz+"></quiz-item>")
              })

           }

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
            //console.log(pointsRand);
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
#game-map{

 /*height:600px;*/
}

</style>
