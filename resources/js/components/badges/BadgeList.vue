<template>
  <div class="badges container">
    <badge-item v-for="badge in badges" :key="badge" v-bind="{ badge }"></badge-item>
  </div>
</template>

<script>
import BadgeItem from './BadgeItem.vue';


export default {
    components: {
        "badge-item" : BadgeItem,
    },
  props: ["badges"],
};
</script>
