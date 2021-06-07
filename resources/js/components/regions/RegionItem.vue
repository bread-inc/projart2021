<template>
<div class="col-6 region-container my-2">
    <a :href="'region/' + region.id">
        <div class="region" :style="'background-image:url(storage' +region.image + ');'">
            <div class="card-text">
                <h4>{{ region.name }}</h4>
            </div>
        </div>
    </a>
</div>
</template>

<script>
export default {
    props : ["region"]
}
</script>