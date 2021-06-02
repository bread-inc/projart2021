<template>
<div class="test">
</div>
<label>{{test}}</label>
<div id="game-map">
  <l-map
  @ready="onReady"
  @locationfound="onLocationFound"
  ref="map"
  v-model:zoom="zoom">
    <l-tile-layer
      url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
      layer-type="base"
      name="OpenStreetMap"
    ></l-tile-layer>
    <l-circle-marker :lat-lng="[questions[0].coord_x, questions[0].coord_y]" :radius="50" />
  </l-map>
    <button @click="onLocationFound">New indice</button>
  </div>
</template>
<script>
import { LMap, LTileLayer, LCircleMarker,LMarker,LPopup } from "@vue-leaflet/vue-leaflet";
import {ref, computed} from 'vue';
export default {
    setup(props){
        const test = 0;
        return{test};
    },
    props: ["questions"],
  components: {
    LMap,
    LTileLayer,
    LCircleMarker,
    LMarker,
    LPopup,
  },
  data() {
    return {
      zoom: 16,
    };
  },
   methods: {
    log(a) {
      console.log(a);
    },
    onReady (mapObject) {
    mapObject.locate({setView: true, maxZoom: 16});
    },

    onLocationFound(location){

        let locatPersone = location.latlng;
        let testChiffre = 46.78170795836792;
        console.log(locatPersone.lat);
        return(locatPersone);

    },
     changeIcon() {

     },

  },
};
</script>

<style>
#game-map{

 height:300px;
}

</style>
