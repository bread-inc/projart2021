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
      <p>Question : {{ fixQuestion.description }}</p>
      <p v-if="fixClue">Clue : {{ fixClue.description }}</p>
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
      v-if="showQuizSuccess"
      @close="endQuiz">
      Congratulations you finished the quiz!
    </quiz-success>
    <game-map
      :question="fixQuestion || 0"
      :clue="fixClue || 0"
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
      questionIndex: 0,
      clueIndex: -1,
      showQuestionValidation: false,
      showQuestionFailure: false,
      showQuizSuccess: false,
    };
  },
  computed: {
    fixQuestion() {
      return this.data.questions[this.questionIndex];
    },
    fixClue() {
      return this.fixQuestion.clues[this.clueIndex];
    },
    postRoute() {
      return 'quizz/' + this.data.quiz.id + '/game/completed';
    }
  },
  watch: {
    questionIndex() {
      this.clueIndex = -1;
    },
  },
  methods: {
    currentQuestion() {
      return this.data.questions[this.questionIndex];
    },
    currentClue() {
      return this.currentQuestion().clues[this.clueIndex];
    },
    nextQuestion() {
      this.questionIndex++;
    },

    nextClue() {
      let cluesLength = this.data.questions[this.questionIndex].clues.length;
      if (this.clueIndex < cluesLength - 1) this.clueIndex++;
    },

    endQuiz() {
      console.log(this.postRoute)
      var xhr = new XMLHttpRequest();
      xhr.open("POST", this.postRoute, true);
      xhr.setRequestHeader('Content-Type', 'application/json');
      xhr.send(JSON.stringify({
          value: this.testData
      }));
    },

    validate(distance) {
      this.distance = distance;
      let tolerance = this.fixQuestion.radius;
      if (distance < tolerance) {
        if (this.questionIndex >= this.data.questions.length - 1) {
          this.showQuizSuccess = true;
        } else {
          this.showQuestionValidation = true;
          // Auto next question
          // this.nextQuestion();
        }
      } else {
        this.showQuestionFailure = true;
      }
    },
  },
};
</script>