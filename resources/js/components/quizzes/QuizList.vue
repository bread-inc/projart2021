<template>
<div class="horizontal-slider-container">
  <div class="horizontal-slider">
    <quiz-item 
      v-for="quiz in quizzes"
      :key="quiz"
      :quiz="quiz"
    ></quiz-item>
  </div>
</div>
</template>

<script>
import QuizItem from "./QuizItem.vue";

export default {
  components: {
    "quiz-item": QuizItem,
  },
  props: ["quizzes"],
};
</script>