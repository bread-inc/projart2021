<template>
  <!-- element-->
  <a :href="'/quiz/' + quiz.id + '/info'" class="quiz quiz-3x">
                            <div v-if="quiz.picture" class="quiz-thumb" :style="'background-image: url(\&#39;' + quiz.picture +'\&#39;);'"></div>
                            <div v-else class="quiz-thumb">
                                <h5>{{quiz.title}}</h5>
                            </div>
                            <div class="label">
                                <small v-if="quiz.difficulty">{{quiz.difficulty}}</small>
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
