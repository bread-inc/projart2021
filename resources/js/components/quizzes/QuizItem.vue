<template>
  <div class="quiz card w-25" style="width: 18rem">
      <div class="card-body">
          <h5 class="card-title">{{ quiz.title }}</h5>
          <h6 class="card-subtitle mb-2 text-muted">Difficulty : {{ quiz.ponderation }}</h6>
          <p class="card-text">{{ quiz.description }}</p>
          <a :href="'/quizz/' + quiz.id + '/start'" class="btn btn-primary">Start</a>
      </div>
  </div>
</template>

<script>
export default {
  props: ["quiz"],
};
</script>