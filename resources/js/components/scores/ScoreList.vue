<template>
  <div class="scores container">
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Pseudo</th>
          <th scope="col">Score</th>
        </tr>
      </thead>
      <tbody>
        <score-item
          v-for="score in scores"
          :key="score"
          :score="score"
        ></score-item>
      </tbody>
    </table>
  </div>
</template>

<script>
import ScoreItem from "./ScoreItem.vue";

export default {
  components: {
    "score-item": ScoreItem,
  },
  props: ["scores", "index"],
};
</script>