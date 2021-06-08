<template>
  <div class="">
			<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
              <h4 class="modal-title">Validate ?</h4>
						</div>
						<div class="modal-body">
								<slot></slot>
						</div>
						<div class="modal-footer">
							<div class="row">
                                <button type="button" id="button-invalidate" class="btn btn-primary col" @click="$emit('tryAgain')">Try again</button>
							    <button type="button" id="button-validate" class="btn btn-primary col" @click="$emit('validate')">Validate</button>
                            </div>
						</div>
				</div>
			</div>
		</div>
</template>

<script>
export default {
  name: "QuestionValidation",
  emits: ["validate", "tryAgain"],
  methods: {
    validate() {
      this.$emit("validate");
    },
    tryAgain() {
      this.$emit("tryAgain");
    },
  },
};
</script>