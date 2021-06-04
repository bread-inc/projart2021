<template>
  <div class="col pb-2">
    <li>
      <span class="fa-stack fa-2x">
        <i
          v-if="auth"
          class="fas fa-square fa-stack-2x"
          :style="'color: ' + badge.color"
        ></i>
        <i
          v-else
          class="fas fa-square fa-stack-2x"
          style="color: grey"
        ></i>
        <i :class="'fas ' + badge.pictogram + ' fa-stack-1x fa-inverse'"></i>
      </span>
    </li>
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
