<template>
  <div class="badges card-group">
    <ul>
      <badge-item
      v-for="badge in badges"
      :key="badge"
      :badge="badge"
      :auth="auth"
    ></badge-item>
    </ul>
  </div>
</template>

<script>
import BadgeItem from "./BadgeItem.vue";

export default {
  components: {
    "badge-item": BadgeItem,
  },
  props: ["badges", "auth"],
};
</script>
