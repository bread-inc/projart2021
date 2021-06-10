<template>
<div class="row mb-5 m-md-0">
    <region-item
      v-for="region in regions"
      :key="region"
      v-bind="{ region }"
    ></region-item>
</div>
</template>

<script>
import RegionItem from "./RegionItem.vue";

export default {
  components: {
    "region-item": RegionItem,
  },
  props: ["regions"],
};
</script>