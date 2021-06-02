<template>
  <div class="quizzes card-group">
    <quiz-item 
      v-for="quiz in quizzes"
      :key="quiz"
      :quiz="quiz"
    ></quiz-item>
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