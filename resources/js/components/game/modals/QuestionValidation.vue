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
          <div class="row">
            <button
              type="button"
              id="button-validate"
              class="rounded-top btn btn-gradient"
              @click="$emit('validate')"
            >
              Confirmer
            </button>
            <button
              type="button"
              id="button-invalidate"
              class="btn btn-border col"
              @click="$emit('tryAgain')"
            >
              Annuler
            </button>
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
