<template>
    <tr>
        <th scope="row">{{ index }}</th>
        <th>{{ score.pseudo}}</th>
        <th>{{ score.score}}</th>
    </tr>
</template>

<script>
export default {
    props : ["score", "index"]
}
</script>