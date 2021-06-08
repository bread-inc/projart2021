<template>
<table class="score-table">
  <tbody>
        <score-item
          v-for="score in scores"
          :key="score"
          :score="score"
          :id="id"
        ></score-item>
  </tbody>
</table>
</template>

<script>
import ScoreItem from "./ScoreItem.vue";

export default {
  components: {
    "score-item": ScoreItem,
  },
  props: ["scores", "id"],
};
</script>