<template>
  <div class="negatif" v-if="distanceOk">
    <h1>Oops</h1>
    <p>Dommage vous n'êtes pas ecore au bon endroit</p>
    <p>Mais ne vous découragez pas !</p>

  </div>
  <div class="positif" v-else>
    <h1>GG</h1>
    <p>Vous avez trouvé le bonne endroit</p>
    <p>Mais ne vous découragez pas !</p>
    <a href="retoru" class="btn btn-primary">Retour à la question</a>
  </div>
</template>

<script>
export default{
props: ["distanceOk", "test"],
};

</script>
