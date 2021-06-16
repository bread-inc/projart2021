<template>
  <div id="clue-map">
      <div class="form-group">
        <label for="radius">Radius indice</label>
        <input class="form-control" name="radius" v-model.number="this.radiusCircle" placeholder="Radius">
      </div>
    <l-map
      ref="map"
      :zoom="zoom"
      :center="[
        this.data.coord_x || 0,
        this.data.coord_y || 0,
      ]"
      @update:center="centerUpdated"
    >
      <l-tile-layer
        url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
        layer-type="base"
        name="OpenStreetMap"
      ></l-tile-layer>
          <l-circle :lat-lng="[this.data.coord_x|| 0, this.data.coord_y || 0]" :radius="this.radiusCircle" color="blue" />
      <l-marker
        :lat-lng="[
         this.data.coord_x || 0,
         this.data.coord_y || 0,
        ]"
      >
      </l-marker>
    </l-map>
     <input type="submit" value="Enregistrer" class="btn btn-primary">
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
      radiusCircle:0
    };
  },
  methods: {

    centerUpdated(center) {
      this.center = center;
    },
  },

};
</script>

<style>
#clue-map{
    height:400px;

}

</style>
