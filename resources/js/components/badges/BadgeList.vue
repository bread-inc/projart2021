<template>
<div class="row pt-3">
    <badge-item
    v-for="badge in badges"
    :key="badge"
    :badge="badge"
    :auth="auth"
  ></badge-item>
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
