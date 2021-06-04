<template>
  <button class="btn btn-info" @click="getUserPosition">locate</button>
  <button class="btn btn-warning" @click="creaIndice"> indice</button>
  <button class="btn btn-warning" @click="checkDistance"> find </button>

 <button class="btn btn-warning" @click="locateEvry"> test rayon random circle </button>
 <div v-if="this.validateDistane">
    <game-popup-success>
 </game-popup-success>
  </div>
<div v-else>
<game-popup-failed>
</game-popup-failed>
</div>

<div id="game-map">
  <l-map
    ref="map"
    :zoom="zoom"
    @ready="storemap"
    :center="[
      userLocation.lat || defaultLocation.lat,
      userLocation.lng || defaultLocation.lng
    ]"
  >
    <l-tile-layer
      url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
      layer-type="base"
      name="OpenStreetMap"
    ></l-tile-layer>
 <l-marker :lat-lng="[userLocation.lat || defaultLocation.lat,userLocation.lng || defaultLocation.lng]">
       <l-popup>
         You are here
        </l-popup>
<l-circle @ready="storeCircle" :lat-lng="[userLocation.lat || 0, userLocation.lng || 0]" :radius="10" color="blue" />
</l-marker>
<l-marker :lat-lng="[questionLocation.lat,questionLocation.lng]">
</l-marker>
<l-circle :lat-lng="[indiceCircle.lat || 0,indiceCircle.lng || 0]" :radius="indiceCircle.radius || 0" color="red" />
  </l-map>
   </div>
</template>
<script>
import { LMap, LTileLayer, LMarker, LPopup, LCircleMarker, LCircle} from "@vue-leaflet/vue-leaflet";
import GameValidationFail from "./GameValidationFail.vue";
import GamePopupSucces from "./GameValidationSucess.vue";
export default {

  components: {LMap, LTileLayer, LMarker, LPopup, LCircleMarker,LCircle, 'game-popup-success': GamePopupSucces, 'game-popup-failed':  GameValidationFail},
   destroyed() {
    console.log('Component has been destroyed!');
  },
  props: {
    defaultLocation: {
      type: Object,
      default: () => ({
        lat: 46.78170795836792,
        lng: 6.647425889233018
      })
    },

     questionLocation: {
      type: Object,
      default: () => ({
        lat: 46.78136221281008,
        lng: 6.647115545330347,
        radius: 300,
      })
    },
  },
  watch:{

  },
  data() {
    return {
      userLocation: {},
      indiceCircle: {},
      test: 125,
      distanceQuestionPosuser:0,
      zoom: 18,
      distanceOk: true,

    };
  },
  init(){
      this.mapleaf = null;
      this.circleLeaflet = null;
  },
   async beforeMount() {
    // HERE is where to load Leaflet components!
    const { circleMarker } = await import("leaflet/dist/leaflet-src.esm");

    // And now the Leaflet circleMarker function can be used by the options:
    circleMarker([46.783823675203024,6.645928812723402], { radius: 8 });
    this.mapIsReady = true;
  },

  computed : {
      validateDistance() {
          return this.distanceOk;
      }
  },


  methods: {
    async getUserPosition() {
      if (navigator.geolocation) {
          console.log("getuserposition");
        navigator.geolocation.getCurrentPosition(pos => {
            console.log("setuserposition");
          this.userLocation = {
            lat: pos.coords.latitude,
            lng: pos.coords.longitude
          };
        });
      }
    },
    creaIndice(){

        // remplacer par indice
        this.indiceCircle = {
        lat: 46.783823675203024,
        lng: 6.645928812723402,
        radius: 350, //premier 750
        }
        console.log(this.indiceCircle.lat);

        this.findRandomPosition(this.indiceCircle.lat,this.indiceCircle.lng,this.indiceCircle.radius);

    },

    findDistance() {
    let distance = this.mapleaf.distance([this.userLocation.lat|| 0, this.userLocation.lng || 0] ,[this.questionLocation.lat, this.questionLocation.lng]);
    this.distanceQuestionPosuser = distance;
    },

    //store object map from leaflet
    storemap(mapObject) {
    this.mapleaf = mapObject
    },

    storeCircle(circleObject)
    {

        this.circleLeaflet = circleObject;
    },

    checkDistance()
    {
        this.findDistance();
        console.log(this.distanceQuestionPosuser);
        if(this.questionLocation.radius < this.distanceQuestionPosuser )
        {

            console.log("ouvre page réssayer");
            this.distanceOK = false;

        }else{
        this.distanceOK = true;
        console.log(this.distanceOk);
        console.log("ouvre page okaywithscore");
        }


    },

    locateEvry()
    {
        let interval = window.setInterval(function()
        {
            this.getUserPosition();
        }, 500);

        interval;
    },

    findRandomPosition(lat,lng,radius)
    {
     this.circleLeaflet.setLatLng(lat,lng)
     this.circleLeaflet.setRadius(radius);
     let cercle = this.circleLeaflet;
     console.log(cercle)
    },


  }
};
</script>

<style>
#game-map{

 height:300px;
}

</style>
