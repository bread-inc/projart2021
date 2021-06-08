<template>
<div class="col-4 text-center mb-3">
  <a :href="'#badges&id=' + badge.id">
      <div
        v-if="auth"
        class="badge"
        :style="'background-color: ' + badge.color"
      ><i :class="'fas ' + badge.pictogram"></i></div>
      <div
        v-else
        class="badge"
        style="background-color: grey"
      ><i :class="'fas ' + badge.pictogram"></i></div>
  </a>
</div>
</template>

<script>
export default {
  props: ["badge", "auth"],
   mounted() {
            console.log('Component mounted.')
        }
};
</script>
