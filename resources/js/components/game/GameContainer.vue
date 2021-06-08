<template>
  <div class="game container">
    <div class="row mb-2">
      <button class="btn btn-info mr-2 col" @click="this.nextClue">Clue</button>
      <button
        class="btn btn-info mr-2 col"
        @click="this.skipQuestion"
      >
        Skip
      </button>
    </div>
    <div class="debug">
      <p>Question : {{ currentQuestion.description }}</p>
      <p v-if="currentClue">Clue : {{ currentClue.description }}</p>
      <p v-if="currentClue">Clue : {{ currentClue.radius }}</p>
    </div>
    <question-validation
      v-if="showQuestionValidation"
      @close="(showQuestionValidation = false), this.questionIndex++"
    >
      You validated the question {{ parseInt(distance) }} meters from the
      objective
    </question-validation>
    <question-failure
      v-if="showQuestionFailure"
      @close="showQuestionFailure = false"
    >
      You failed the question {{ parseInt(distance) }} meters from the objective
    </question-failure>
    <quiz-success
      v-show="showQuizSuccess"
      :id="data.quiz.id"
      :questionCounter="questionCounter"
      :clueCounter="clueCounter"
      :totalDistance="totalDistance"
      :startTime="startTime"
      :failedValidations="failedValidations"
      @close="endQuiz"
    >
      Congratulations you finished the quiz!
    </quiz-success>
    <game-map
      :question="currentQuestion || 0"
      :clue="currentClue || 0"
      @getDistance="validate"
    ></game-map>
  </div>
</template>

<script>
import GameMap from "./GameMap.vue";
import QuestionValidation from "./modals/QuestionValidation.vue";
import QuestionFailure from "./modals/QuestionFailure.vue";
import QuizSuccess from "./modals/QuizSuccess.vue";

export default {
  name: "GameContainer",
  components: {
    "game-map": GameMap,
    "question-validation": QuestionValidation,
    "question-failure": QuestionFailure,
    "quiz-success": QuizSuccess,
  },
  props: {
    data: Object,
  },
  data() {
    return {
      distance: "",
      totalDistance: 0,
      questionIndex: 0,
      questionCounter: 0,
      clueIndex: -1,
      clueCounter: 0,
      startTime: Date.now(),
      failedValidations: 0,
      showQuestionValidation: false,
      showQuestionFailure: false,
      showQuizSuccess: false,
    };
  },
  computed: {
    currentQuestion() {
      return this.data.questions[this.questionIndex];
    },
    currentClue() {
      return this.currentQuestion.clues[this.clueIndex];
    },
  },
  watch: {
    questionIndex() {
      this.clueIndex = -1;
    },
  },
  methods: {
    nextQuestion() {
      this.questionIndex++;
      if (this.questionIndex >= this.data.questions.length -1) this.endQuiz();
    },

    nextClue() {
      let cluesLength = this.data.questions[this.questionIndex].clues.length;
      if (this.clueIndex < cluesLength - 1)
        this.clueIndex++, this.clueCounter++;
    },

    skipQuestion() {
      this.nextQuestion();
      this.clueCounter -= this.clueIndex + 1;
    },

    endQuiz() {
      this.showQuizSuccess = true;
    },

    validate(distance) {
      this.distance = distance;
      let tolerance = this.currentQuestion.radius;
      if (distance < tolerance) {
        if (this.questionIndex >= this.data.questions.length - 1) {
          this.validateCounter();
          this.endQuiz();
        } else {
          this.validateCounter();
          this.showQuestionValidation = true;
        }
      } else {
        this.failedValidations++;
        this.showQuestionFailure = true;
      }
    },

    validateCounter() {
      this.questionCounter++;
      this.totalDistance += parseInt(this.distance);
    },
  },
};
</script>