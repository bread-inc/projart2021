<template>
  <tr :class="id === score.user_id ? 'my-score' : 'score'">
      <td scope="row">{{ score.rank }}</td>
      <td><img :src="score.avatar" :alt="'alt text'" class="rounded-circle" /></td>
      <td>
        <a :href="'/bread/user/' + score.user_id"
          ><b>{{ score.pseudo }}</b></a
        >
        <small>{{ score.score }} pts</small>
      </td>
  </tr>
</template>

<script>
export default {
  props: ["score", "id"],
};
</script>