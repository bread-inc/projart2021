<template>


  <div id="admin-map">
      <div class="form-group">
        <label for="coord_x">Coordonnée X</label>
        <input class="form-control" name="coord_x" type="text" v-model="this.valuex" placeholder="Cordone X" />
      </div>
      <div class="form-group">
        <label for="coord_y">Coordonnée Y</label>
        <input class="form-control" name="coord_y" type="text" v-model="this.valuey" placeholder="Cordone Y" />
      </div>
      <div class="form-group">
        <label for="radius">Radius indice</label>
        <input class="form-control" name="radius" v-model.number="this.radiusCircle" placeholder="Radius">
      </div>
         <p>Clique sur la carte pour ajouter le position de la question</p>
    <l-map
      @click ="click"
      ref="map"
      :zoom="zoom"
      @ready="storemap"
      :center="[
        userLocation.lat || 0,
        userLocation.lng || 0,
      ]"
      @update:center="centerUpdated">

      <l-tile-layer
        url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
        layer-type="base"
        name="OpenStreetMap"
      ></l-tile-layer>
          <l-circle :lat-lng="[this.valuex || 0, this.valuey|| 0]" :radius="this.radiusCircle" color="blue" />
      <l-marker
        :lat-lng="[
          this.valuex || 0,
          this.valuey || 0,
        ]"
      >
      </l-marker>
    </l-map>
     <input type="submit" value="Enregistrer la question" class="btn btn-primary">
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
export default {
  components: { LMap, LTooltip, LTileLayer, LMarker, LPopup, LCircleMarker, LCircle},
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
      radiusCircle: 0,
      valuex: 0,
      valuey: 0,
      layerX: 0,
      layerY:0,
    };
  },

  init() {
    this.mapleaf = null;
  },

 async beforeMount() {
    // Leaflet imports

    // Set current position
    await this.getUserPosition();
    // Waits until ready to show
    this.mapIsReady = true;
 },

  methods: {
    storemap(mapObject) {
      this.mapleaf = mapObject;
    },


    /**
     * Generate the position on click on map
     * @param {mapObject} map object of vueleaflet
     */
    click(clickObject){

        this.layerX  = clickObject.layerX;
        this.layerY = clickObject.layerY;

        console.log(clickObject);
        console.log("test");
        let latiLongi = this.mapleaf.layerPointToLatLng([this.layerX  , this.layerY]);

        this.valuex =latiLongi.lat;
        this.valuey =latiLongi.lng;
    },


    /**
     * Get the position of user
     */
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

    /**
     * Center update
     */
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
