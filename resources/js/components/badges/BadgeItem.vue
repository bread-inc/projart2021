<template>
  <div class="col pb-2">
    <div class="card">
      <div class="card-header">{{ badge.label }}</div>
      <div class="card-body">{{ badge.description }}</div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["badge"],
};
</script>