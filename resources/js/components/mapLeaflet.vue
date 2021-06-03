<template>
  <button class="btn btn-info" @click="this.getUserPosition">locate</button>
  <label>{{cordone}}</label>
<div id="game-map">
  <l-map
    ref="map"
    :zoom="zoom"
    :center="[
      userLocation.lat || defaultLocation.lat,
      userLocation.lng || defaultLocation.lng
    ]"
    @update:center="centerUpdated"
  >
    <l-tile-layer
      url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
      layer-type="base"
      name="OpenStreetMap"
    ></l-tile-layer>
 <l-marker :lat-lng="[userLocation.lat || defaultLocation.lat,
      userLocation.lng || defaultLocation.lng]">
       <l-popup>
         You are here
        </l-popup>
</l-marker>

  </l-map>
   </div>
</template>
<script>
import { LMap, LTileLayer, LMarker, LPopup,LCircleMarker} from "@vue-leaflet/vue-leaflet";
export default {
  components: {LMap, LTileLayer, LMarker, LPopup, LCircleMarker},
  props: {

    defaultLocation: {
      type: Object,
      default: () => ({
        lat: 46.78170795836792,
        lng: 6.647425889233018
      })
    },
    props: ["cordone"],
  },
  data() {
    return {
      userLocation: {},
      zoom: 18,
    };
  },
  mounted() {
    this.getUserPosition();
  },
  methods: {
    async getUserPosition() {
      // check if API is supported
      if (navigator.geolocation) {
        // get  geolocation
        navigator.geolocation.getCurrentPosition(pos => {
          // set user location
          this.userLocation = {
            lat: pos.coords.latitude,
            lng: pos.coords.longitude
          };
        });
      }
    },
    centerUpdated(center){
        this.center = center;
    },
  }
};
</script>

<style>
#game-map{

 height:300px;
}

</style>
