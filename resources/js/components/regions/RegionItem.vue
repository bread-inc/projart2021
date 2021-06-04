<template>
<div class="col-6 region-container my-2">
    <a :href="'region/' + region.id">
        <div class="region">
            <div class="card-text">
                <h4>{{ region.name }}</h4>
            </div>
            <img :src="'storage' +region.image" :alt="region.name">
        </div>
    </a>
</div>
</template>

<script>
export default {
    props : ["region"]
}
</script>