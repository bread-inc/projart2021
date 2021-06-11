<template>
  <div class="">
			<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
              <h4 class="modal-title">Failure</h4>
						</div>
						<div class="modal-body">
								<slot></slot>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-gradient" @click="$emit('close')">Try again</button>
						</div>
				</div>
			</div>
		</div>
</template>

<script>
export default {
  name: "QuestionValidation",
  emits: ["close"],
  methods: {
    close() {
      this.$emit("close");
    },
  },
};
</script>