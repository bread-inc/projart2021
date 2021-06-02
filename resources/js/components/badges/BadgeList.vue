<template>
  <div class="badges card-group">
    <badge-item
      v-for="badge in badges"
      :key="badge"
      :badge="badge"
    ></badge-item>
  </div>
</template>

<script>
import BadgeItem from "./BadgeItem.vue";

export default {
  components: {
    "badge-item": BadgeItem,
  },
  props: ["badges"],
};
</script>
