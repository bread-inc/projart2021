<template>
  <div class="">
			<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Histoire du lieu</h4>
						</div>
						<div class="modal-body">
								<slot></slot>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-gradient" @click="$emit('close')">Prochaine question</button>
						</div>
				</div>
			</div>
		</div>
</template>

<script>
export default {
  name: "QuestionSkip",
  emits: ["close"],
  methods: {
    close() {
      this.$emit("close");
    },
  },
};
</script>
