<template>
  <div id="mapContainer"></div>
</template>

<script>
import "leaflet/dist/leaflet.css";
import L from "leaflet";

export default {
  name: "LeafletMap",
  data() {
    return {
      map: null
    };
  },
  mounted() {
    this.map = L.map("mapContainer").setView([51.959, -8.623], 12);
    L.tileLayer("http://{s}.tile.osm.org/{z}/{x}/{y}.png", {
      attribution:
        '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(this.map);

    this.map.locate({setView: true, maxZoom: 16});

     function onLocationFound(e) {
  var radius = e.accuracy;

  L.marker(e.latlng).addTo(this.map)
      .bindPopup("Vous etes ici").openPopup();
  L.circle(e.latlng, radius).addTo(this.map);
}
this.map.on('locationfound', onLocationFound);
L.marker([46.78170795836792, 6.646725435477321]).addTo(this.map)
.bindPopup("Reponse").openPopup();
  },
  beforeDestroy() {
    if (this.map) {
      this.map.remove();
    }
  }
};
</script>

<style scoped>
#mapContainer {
  width: 100vw;
  height: 100vh;
}
</style>
