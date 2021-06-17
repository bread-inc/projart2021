<template>
  <div class="game">
    <div class="modals">
      <question-validation
        v-if="showQuestionValidation"
        @tryAgain="showQuestionValidation = false"
        @validate="validate"
      >
        <div class="imageGamePopup">
          <img
            src="/bread/storage/images/confirmeposition.png"
            alt="confirme image"
          />
          <h2>Attention !</h2>
        </div>

        <p>
          Êtes-vous sûr de vouloir valider votre position actuelle ? Vous perdez
          des points si vous n’avez pas trouvé le lieux.
        </p>
      </question-validation>

      <question-skip
        v-if="showQuestionSkip"
        @close="showQuestionSkip = false"
        @skip="(showQuestionDescSkip = true), (showQuestionSkip = false)"
      >
        <div class="imageGamePopup">
          <img
            src="/bread/storage/images/confirmeposition.png"
            alt="skip image"
          />
          <h2>Attention !</h2>
        </div>
        <p>Êtes vous sûr de vouloir passer la question?</p>
      </question-skip>
      <question-desc-skip
        v-if="showQuestionDescSkip"
        @close="(showQuestionDescSkip = false), skipQuestion()"
      >
        <p>{{ currentQuestion.end_text }}</p>
      </question-desc-skip>

      <question-success
        v-if="showQuestionSuccess"
        @close="(showQuestionSuccess = false), nextQuestion()"
      >
        <div class="imageGamePopup">
          <img
            class="imageGamePopup"
            src="/bread/storage/images/bravo.png"
            alt="bravo image"
          />
          <h2>Bravo</h2>
        </div>
        <p>
          Bravo vous avez validé la question à {{ parseInt(distance) }}m de
          l'objectif.
        </p>
        <p>{{ currentQuestion.end_text }}</p>
      </question-success>
      <question-failure
        v-if="showQuestionFailure"
        @close="showQuestionFailure = false"
      >
        <div class="imageGamePopup">
          <img
            class="imageGamePopup"
            src="/bread/storage/images/Oops.png"
            alt="oops image"
          />
          <h2>Oops</h2>
        </div>
        <p>
          Dommage. Vous n’êtes pas encore au bon endroit. Mais ne vous
          découragez pas ! Vous n'êtes qu'à {{ parseInt(distance) }}m de
          l'obectif.
        </p>
      </question-failure>
      <quiz-success
        v-show="showQuizSuccess"
        :id="data.quiz.id"
        :questionCounter="questionCounter"
        :clueCounter="clueCounter"
        :time="timer"
        :failedValidations="failedValidations"
        @close="endQuiz"
      >
        <div class="imageGamePopup">
          <img
            class="imageGamePopup"
            src="/bread/storage/images/bravo.png"
            alt="oops image"
          />
          <h2>Bravo !</h2>
        </div>

        <p>Super vous avez terminé le quizz, découvrez votre score</p>
      </quiz-success>
    </div>
    <div class="interface" v-show="playState">
      <game-map
        :question="currentQuestion || 0"
        :clue="currentClue || 0"
        @getDistance="getDistance"
      ></game-map>
      <div class="navigation">
        <div
          class="
            navigation-buttons
            row
            justify-content-center
            align-self-center
          "
        >
          <a
            id="drawer-button"
            href="#"
            data-drawer-trigger
            aria-controls="drawer-name"
            aria-expanded="false"
          >
            <div class="d-flex flex-row">
              <div class="p-2 flex-fill">
                <button
                  class="rounded-top btn btn-gradient"
                  @click="showQuestionTab = true"
                >
                  Question
                </button>
              </div>
              <div class="p-2 flex-fill">
                <button
                  class="rounded-top btn btn-gradient"
                  @click="showQuestionTab = false"
                >
                  Indices
                </button>
              </div>
            </div>
          </a>
        </div>
      </div>
      <game-drawer>
        <template v-slot:title>
          <div id="TitleQuestion" v-show="showQuestionTab">
            Question : {{ questionIndex + 1 }} sur {{ data.questions.length }}
          </div>
          <div id="TitleIndice" v-show="!showQuestionTab">Indices</div>
        </template>
        <template v-slot:content>
          <div v-show="showQuestionTab">
            <p class="textQuestion">{{ currentQuestion.description }}</p>
            <button class="btnSkip" @click="showQuestionSkip = true">
              Passer la question
            </button>

            <v-pannellum
              :src="'/bread/' + currentQuestion.picture"
              style="height: 43vh; width: auto"
              :minHfov="30"
              :showZoom="true"
              :autoload="true"
              :compass="true"
            ></v-pannellum>
            <div class="SkipCenter"></div>
          </div>
          <div v-show="!showQuestionTab">
            <p class="textQuestion" v-if="previousClues" v-for="clue in previousClues">Indice {{clue.id}}/{{currentQuestion.clues.length}} : {{clue.description}}</p>

            <p class="textQuestion" v-if="currentClue">
              Indice {{clueIndex+1}}/{{currentQuestion.clues.length}} : {{ currentClue.description }}
            </p>
            <p class="textQuestion" v-else>
              Vous n'avez pas encore utilisé d'indice!
            </p>
            <div id="btnClueCont">
            <button
              v-if="clueIndex < currentQuestion.clues.length - 1"
              class="btn btnClue btn-gradient mr-2 col"
              @click="nextClue"
            >
              Nouvel indice
            </button>
            </div>
          </div>
        </template>
      </game-drawer>
    </div>
  </div>
</template>

<script>
import GameMap from "./GameMap.vue";
import QuestionValidation from "./modals/QuestionValidation.vue";
import QuestionSkip from "./modals/QuestionSkip.vue";
import QuestionDescriptionSkip from "./modals/QuestionDescpritionSkip.vue";
import QuestionSuccess from "./modals/QuestionSuccess.vue";
import QuestionFailure from "./modals/QuestionFailure.vue";
import QuizSuccess from "./modals/QuizSuccess.vue";
import GameDrawer from "./drawer/GameDrawer.vue";
import VuePannelum from "vue-pannellum";

export default {
  name: "GameContainer",
  components: {
    "game-map": GameMap,
    "question-skip": QuestionSkip,
    "question-validation": QuestionValidation,
    "question-success": QuestionSuccess,
    "question-failure": QuestionFailure,
    "quiz-success": QuizSuccess,
    "question-desc-skip": QuestionDescriptionSkip,
    "game-drawer": GameDrawer,
    "v-pannellum": VuePannelum,
  },
  props: {
    data: Object,
  },
  data() {
    return {
      distance: "",
      questionIndex: 0,
      questionCounter: 0,
      clueIndex: -1,
      clueCounter: 0,
      timer: 0,
      t: Number,
      failedValidations: 0,
      showQuestionValidation: false,
      showQuestionSuccess: false,
      showQuestionFailure: false,
      showQuizSuccess: false,
      showQuestionTab: true,
      showQuestionSkip: false,
      showQuestionDescSkip: false,
    };
  },
  computed: {
    currentQuestion() {
      return this.data.questions[this.questionIndex];
    },
    currentClue() {
      return this.currentQuestion.clues[this.clueIndex];
    },
    previousClues() {
      let prevClues = [];
      for (let i = 0; i < this.clueIndex; i++) {
        prevClues.push({"id" : i+1, "description": this.currentQuestion.clues[i].description});
      }
      return prevClues;
    },

    playState() {
      if (
        this.showQuestionSkip ||
        this.showQuestionValidation ||
        this.showQuestionSuccess ||
        this.showQuizSuccess ||
        this.showQuestionFailure ||
        this.showQuestionDescSkip
      ) {
        this.stopTimer();
        return false;
      } else {
        this.startTimer();
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
      this.questionIndex++;
      this.clueCounter -= this.clueIndex + 1;
      if (this.questionIndex >= this.data.questions.length) this.endQuiz();
    },

    incrementTimer() {
      this.timer++;
    },

    startTimer() {
      this.t = setInterval(this.incrementTimer, 1000);
    },

    stopTimer() {
      clearInterval(this.t);
    },

    endQuiz() {
      this.clueIndex = 0;
      this.questionIndex = 0;
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
          this.showQuestionSuccess = true;
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
    },
  },
};
</script>
