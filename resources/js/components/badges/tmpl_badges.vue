<template>
  <div class="container">
    <badge v-for="badge in badges" :key="badge" v-bind="{ badge }"></badge>
  </div>
</template>

<script>
import badge from './badge';

export default {
  props: ["badges"],
};
</script>