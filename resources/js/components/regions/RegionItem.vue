<template>
    <a :href="'/region/' + region.id">
        <div class="region card" style="width: 18rem;">
        <img src="" class="card-img-top" alt="">
        <div class="card-body">
            <h5 class="card-title">{{ region.name }}</h5>
        </div>
    </div>
    </a>
</template>

<script>
export default {
    props : ["region"]
}
</script>