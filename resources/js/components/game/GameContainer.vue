<template>
  <div class="game container">
    <div class="row mb-2">
      <button class="btn btn-info mr-2 col" @click="this.nextQuestion">
        Next Question
      </button>
      <button class="btn btn-info mr-2 col" @click="this.nextClue">
        Next Clue
      </button>
    </div>
    <div class="debug">
      <p>Question : {{ currentQuestion.description }}</p>
      <p v-if="currentClue">Clue : {{ currentClue.description }}</p>
    </div>
    <question-validation v-if="showQuestionValidation" class="modal" type="dialog">Success!</question-validation>
    <game-map
      :question="currentQuestion"
      :clue="currentClue || 0"
      @getDistance="validate"
    ></game-map>
  </div>
</template>

<script>
import GameMap from "./GameMap.vue";
import QuestionValidation from './modals/QuestionValidation.vue';

export default {
  name: "GameContainer",
  components: {
    "game-map": GameMap,
    "question-validation": QuestionValidation,
  },
  props: {
    data: Object,
  },
  data() {
    return {
      questionIndex: 0,
      clueIndex: -1,
      showQuestionValidation: false,
      showQuestionFailure: false,
    };
  },
  computed: {
    currentQuestion() {
      return this.data.questions[this.questionIndex];
    },
    currentClue() {
      return this.data.questions[this.questionIndex].clues[this.clueIndex];
    },
  },
  watch: {
    questionIndex() {
      this.clueIndex = -1;
    },
  },
  methods: {
    nextQuestion() {
      let questionsLength = this.data.questions.length;
      if (this.questionIndex < questionsLength - 1) {
        this.questionIndex++;
      } else {
        console.log("You have finished this Quiz !")
      }
    },

    nextClue() {
      let cluesLength = this.data.questions[this.questionIndex].clues.length;
      if (this.clueIndex < cluesLength - 1) this.clueIndex++;
    },

    validate(distance) {
        let tolerance = this.currentQuestion.radius;
        if (distance < tolerance) {
            console.log("Validated at : " + distance + "m from target");
            this.showQuestionValidation = true;
        } else {
            console.log("Rejected at : " + distance + "m from target");
        }
    }
  },
};
</script>