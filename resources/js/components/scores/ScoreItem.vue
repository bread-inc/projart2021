<template>
    <tr>
        <td scope="row">{{ score.rank }}</td>
        <td><img src="#" :alt="score.pseudo" class="rounded-circle"></td>
        <td>
            <a :href="'/user/' + score.user_id"><b>{{ score.pseudo}}</b></a>
            <small>{{ score.score}} pts</small>
        </td>
    </tr>
</template>

<script>
export default {
    props : ["score", "index"]
}
</script>