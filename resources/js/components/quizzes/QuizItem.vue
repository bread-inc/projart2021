<template>
  <!-- element-->
  <a :href="'/bread/quiz/' + quiz.id + '/info'" class="quiz quiz-3x">
      <div v-if="quiz.picture" class="quiz-thumb quizMap" :style="'background-image: url(\&#39;' + quiz.picture +'\&#39;);'"></div>
      <div v-else class="quiz-thumb">
          <h5>{{quiz.title}}</h5>
      </div>
      <div class="label">
          <small>{{quiz.title}}</small>
          <small></small>
      </div>
  </a>
  <!-- .element -->
</template>
<script>
export default {
  props: ["quiz"],
};
</script>

<style>

</style>
