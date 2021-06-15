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
							<button type="button" class="btn btn-gradient" @click="$emit('close')">Continuer à chercher</button>
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
