<template>
  <div class="">
			<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
              <h4 class="modal-title">Quiz terminé</h4>
						</div>
						<div class="modal-body">
								<slot></slot>
						</div>
						<div class="modal-footer">
							<form class="row btnAlone" action="game/completed" method="post">
							<input type="hidden" name="id" :value="id">
							<input type="hidden" name="questionCounter" :value="questionCounter">
							<input type="hidden" name="clueCounter" :value="clueCounter">
							<input type="hidden" name="time" :value="time">
							<input type="hidden" name="failedValidations" :value="failedValidations">
							<button class="btn  btn-gradient">Terminer</button>
							</form>
							<!-- <button type="button" class="btn btn-primary" @click="$emit('close')">End Quiz</button> -->
						</div>
				</div>
			</div>
		</div>
</template>

<script>
export default {
  name: "QuestionValidation",
  emits: ["close"],
  props: {
	  id : Number,
	  questionCounter : Number,
	  clueCounter : Number,
	  time: Number,
	  failedValidations: Number,
  },
  methods: {
    close() {
      this.$emit("close");
    },
  },
};
</script>