<template>
  <!-- element-->
  <a :href="'/quizz/' + quiz.id + '/start'" class="quiz quiz-3x">
    <div class="quiz-thumb" style="background-image: url('');">
        <h5>{{ quiz.title }}</h5>
    </div>
    <div class="label">
        <small>{{ quiz.ponderation }}</small>
    </div>
  </a>
  <!-- .element -->
</template>

<script>
export default {
  props: ["quiz"],
};
</script>