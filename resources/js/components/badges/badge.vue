<template>
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">{{ badge.label }}</div>

        <div class="card-body">{{ badge.pictogram }}</div>
      </div>
    </div>
</template>

<script>
export default {
    props: ["badge"],

};
</script>
