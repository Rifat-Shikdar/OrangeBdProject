<template>
    <div class="">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>{{ title }}...
    </div>

</template>

<script>
import { Title } from '#components';

export default {
    name: "Loading",
    props: {
        title: String
    }
}
</script>

<style></style>