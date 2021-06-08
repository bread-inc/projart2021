<template>
  <div class="game container">
    <div class="modals">
      <question-validation
        v-if="showQuestionValidation"
        @tryAgain="showQuestionValidation = false"
        @validate="validate"
      >
        Are you sure you wish to validate?
      </question-validation>
      <question-success
        v-if="showQuestionSuccess"
        @close="(showQuestionSuccess = false), this.questionIndex++"
      >
        You validated the question {{ parseInt(distance) }} meters from the
        objective
      </question-success>
      <question-failure
        v-if="showQuestionFailure"
        @close="showQuestionFailure = false"
      >
        You failed the question {{ parseInt(distance) }} meters from the
        objective
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
    </div>
    <div class="interface" v-show="playState">
      <game-map
        :question="currentQuestion || 0"
        :clue="currentClue || 0"
        @getDistance="getDistance"
      ></game-map>
      <div class="row mb-2">
        <button class="btn btn-info mr-2 col" @click="this.nextClue">
          Clue
        </button>
        <button class="btn btn-info mr-2 col" @click="this.skipQuestion">
          Skip
        </button>
      </div>
      <p>Question : {{ currentQuestion.description }}</p>
      <p v-if="currentClue">Clue : {{ currentClue.description }}</p>
    </div>
  </div>
</template>

<script>
import GameMap from "./GameMap.vue";
import QuestionValidation from "./modals/QuestionValidation.vue";
import QuestionSuccess from "./modals/QuestionSuccess.vue";
import QuestionFailure from "./modals/QuestionFailure.vue";
import QuizSuccess from "./modals/QuizSuccess.vue";

export default {
  name: "GameContainer",
  components: {
    "game-map": GameMap,
    "question-validation": QuestionValidation,
    "question-success": QuestionSuccess,
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
      showQuestionSuccess: false,
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
    playState() {
      if (
        this.showQuestionValidation ||
        this.showQuestionSuccess ||
        this.showQuizSuccess ||
        this.showQuestionFailure
      ) {
        return false;
      } else {
        return true;
      }
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
      if (this.questionIndex >= this.data.questions.length - 1) this.endQuiz();
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

    getDistance(distance) {
      this.distance = distance;
      this.showQuestionValidation = true;
    },

    validate() {
      this.showQuestionValidation = false;
      let tolerance = this.currentQuestion.radius;
      if (this.distance < tolerance) {
        if (this.questionIndex >= this.data.questions.length - 1) {
          this.validateCounter();
          this.endQuiz();
        } else {
          this.validateCounter();
          this.showQuestionSuccess = true;
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

