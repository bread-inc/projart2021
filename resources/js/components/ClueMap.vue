<template>
  <div id="clue-map">
        <label for="radius">Radius indice</label>
        <input class="form-control" name="radius" v-model.number="this.radiusCircle" placeholder="Radius">
    <l-map
      ref="map"
      :zoom="zoom"
      @ready="storemap"
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
          <l-circle @ready="storeCircle" :lat-lng="[this.data.coord_x|| 0, this.data.coord_y || 0]" :radius="this.radiusCircle" color="blue" />
      <l-marker
      @ready="storemarker"
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
      radiusCircle:0
    };
  },

  init() {
    this.mapleaf = null;
    this.circleLeaflet = null;
    this.popupLeaflet = null;
    this.makrerLeaf = null;

  },

  methods: {

      storemarker(markerObject) {
      this.makrerLeaf = markerObject;
    },
    storemap(mapObject) {
      this.mapleaf = mapObject;
    },


    storeCircle(circleObject)
    {

        this.circleLeaflet = circleObject;
    },
    popUpObject(popupObject)
    {

    },



    centerUpdated(center) {
      this.center = center;
    },
  },

};
</script>

<style>
#clue-map{
    height:200px;

}

</style>
