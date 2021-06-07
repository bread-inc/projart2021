<template>
  <div class="">
			<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
              <h4 class="modal-title">Success, Quiz finished</h4>
						</div>
						<div class="modal-body">
								<slot></slot>
						</div>
						<div class="modal-footer">
							<form action="game/completed" method="post">
							<input type="hidden" name="_token" value="{{csrf}}">
							<button class="btn btn-primary">End quiz</button>
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
  props: ["csrf"],
  methods: {
    close() {
      this.$emit("close");
    },
  },
};
</script>