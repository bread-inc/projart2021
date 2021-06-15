<template>
  <div class="">
			<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">

						</div>
						<div class="modal-body">
								<slot></slot>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-border" @click="$emit('close')">Continuer</button>
							<button type="button" class="btn btn-gradient" @click="$emit('skip')">Sauter</button>
						</div>
				</div>
			</div>
		</div>
</template>

<script>
export default {
  name: "QuestionValidation",
  emits: ["close", "skip"],
  methods: {
    close() {
      this.$emit("close");
    },
    skip() {
        this.$emit("skip");
    }
  },
};
</script>
