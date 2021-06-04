<template>
  <button class="btn btn-info" @click="getUserPosition">locate</button>
  <button class="btn btn-warning" @click="creaIndice"> indice</button>
  <button class="btn btn-warning" @click="checkDistance"> find </button>
   <button class="btn btn-warning" @click="locateEvry"> localisationauto </button>
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
<l-circle :lat-lng="[userLocation.lat || 0, userLocation.lng || 0]" :radius="10" color="blue" />
</l-marker>
<l-marker :lat-lng="[questionLocation.lat,questionLocation.lng]">
</l-marker>
<l-circle :lat-lng="[indiceCircle.lat || 0,indiceCircle.lng || 0]" :radius="indiceCircle.radius || 0" color="red" />
  </l-map>
   </div>
</template>
<script>
import { LMap, LTileLayer, LMarker, LPopup, LCircleMarker, LCircle} from "@vue-leaflet/vue-leaflet";
export default {
  components: {LMap, LTileLayer, LMarker, LPopup, LCircleMarker,LCircle},
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
        lat: 46.783823675203024,
        lng: 6.645928812723402,
        radius: 300,
      })
    },
  },
  computed:{

  },
  data() {
    return {
      userLocation: {},
      indiceCircle: {},
      distanceQuestionPosuser:0,
      zoom: 18,
      distanceOk: false,

    };
  },
  init(){
      this.mapleaf = null;
  },
   async beforeMount() {
    // HERE is where to load Leaflet components!
    const { circleMarker } = await import("leaflet/dist/leaflet-src.esm");

    // And now the Leaflet circleMarker function can be used by the options:
    circleMarker([46.783823675203024,6.645928812723402], { radius: 8 });
    this.mapIsReady = true;
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
        this.indiceCircle = {
        lat: 46.783823675203024,
        lng: 6.645928812723402,
        radius: 350, //premier 750
        }
    },

    findDistance() {
    let distance = this.mapleaf.distance([this.userLocation.lat|| 0, this.userLocation.lng || 0] ,[this.questionLocation.lat, this.questionLocation.lng]);
    this.distanceQuestionPosuser = distance;
    },

    //store object map from leaflet
    storemap(mapObject) {
    this.mapleaf = mapObject
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

    findRandomPosition()
    {

    },


  }
};
</script>

<style>
#game-map{

 height:300px;
}

</style>
