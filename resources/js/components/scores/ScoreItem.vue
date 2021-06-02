<template>
    <tr>
        <th scope="row">{{ score.rank }}</th>
        <th><a :href="'user/' + score.user_id">{{ score.pseudo}}</a></th>
        <th>{{ score.score}}</th>
    </tr>
</template>

<script>
export default {
    props : ["score", "index"]
}
</script>