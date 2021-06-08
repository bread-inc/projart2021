<template>
  <div class="row mb-2">
    <button class="btn btn-warning mr-2 col" @click="this.getUserPosition">
      Locate
    </button>
     <button class="btn btn-warning mr-2 col" @click="peuplageMap">
      peupler la carte
    </button>
  </div>
  <div id="game-map">
    <l-map
      ref="map"
      :zoom="zoom"
      @ready="storemap"
      :center="[
        userLocation.lat || defaultLocation.lat,
        userLocation.lng || defaultLocation.lng,
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
          userLocation.lat || defaultLocation.lat,
          userLocation.lng || defaultLocation.lng,
        ]"
      >
        <l-popup> You are here </l-popup>
      </l-marker>
      <l-circle @ready="storeCircle" :lat-lng="[46.78170795836792, 6.647425889233018,]" :radius="300" color="blue" />
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
    defaultLocation: {
      type: Object,
      default: () => ({
        lat: 46.78170795836792,
        lng: 6.647425889233018,
      }),
    },
    question: Object,
  },
  data() {
    return {
      userLocation: {},
      zoom: 18,
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

    circleMarker(this.userLocation, { radius: 8 });

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

    peuplageMap()
    {
            this.plotrandom(this.circleLeaflet.getBounds());
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
