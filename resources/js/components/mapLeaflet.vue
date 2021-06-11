<template>
  <button class="btn btn-info" @click="getUserPosition">locate</button>
  <button class="btn btn-warning" @click="creaIndice"> indice</button>
  <button class="btn btn-warning" @click="checkDistance"> find </button>
  <button class="btn btn-warning" @click="rndCircle1()"> test rnd circle 1 </button>
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
<l-circle @ready="storeCirlceRnd" :lat-lng="[questionLocation.lat || 0, questionLocation.lng || 0]" :radius="600" color="green" />
<l-circle :lat-lng="[indiceCircleRnd.lat || 0, indiceCircleRnd.lng || 0]" :radius="300" color="orange" />
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
      indiceCircleRnd: {},
      test: 125,
      distanceQuestionPosuser:0,
      zoom: 18,
      distanceOk: true,

    };
  },
  init(){
      this.mapleaf = null;
      this.circleLeaflet = null;
      this.circleLeafletRnd = null
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


    },

    creaIndice2()
    {

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

    storeCirlceRnd(circleObject)
    {
        this.circleLeafletRnd = circleObject;
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


        testRandomCircle(r)
        {
        let x = 0;
        let y = 0;
        do{
            let max = r/2;
            let min = -(r/2);
            x = Math.random() * (max- min) + min;
            y = Math.random() * (max- min) + min;

        }while((Math.pow(x,2) + Math.pow(y,2)) >= Math.pow(r/2,2))


        return [x,y];
        },

        /**
         * generate random point in a rectangle
         */
        plotrandom(bounds)
        {

            var southWest = bounds.getSouthWest();
            var northEast = bounds.getNorthEast();
            var lngSpan = northEast.lng - southWest.lng;
            var latSpan = northEast.lat - southWest.lat;


            var point = [southWest.lat + latSpan * Math.random(),southWest.lng + lngSpan * Math.random()];

            return point;

        },

        /**
         * r = radius circle -> distance max
         * coordXY = objet avec coordonée latng du cercle avec circle.getLatLng();
         * bound = bound du cercle avec circle.getBounds();
         */
        rndTest(r,coordXY,bound)
            {
            let i=0;
            let plot;
            do{
            plot = this.plotrandom(
                bound);
            i++;
            }while(this.mapleaf.distance(plot,coordXY) > r)

            return plot
            },

        /**
         * genrate random circle1
         */
        rndCircle1()
        {
           let coordXY = this.circleLeafletRnd.getLatLng();
           let bound = this.circleLeafletRnd.getBounds();
           let radius = 300;

           let newClue = this.rndTest(radius,coordXY,bound);

            this.indiceCircleRnd = {
            lat: newClue[0],
            lng: newClue[1],
            radius: 300,
            }
            return newClue;

            },

     }
};
</script>

<style>
#game-map{

 /*height:300px;*/
}

</style>
