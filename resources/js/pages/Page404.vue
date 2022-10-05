<template>
    <div class="container">
        <div class="error">
            <h1 class="error__title">Pagina non trovata</h1>
            <button class="btn btn-outline-secondary mt-5"><router-link class="error__link" :to="{name: 'home'}">Home page</router-link></button>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Page404'
    }
</script>

<style lang="scss" scoped>
    .error {
        padding-top: 5rem;
        text-align: center;
        &__link {
            color: #000;
            text-decoration: none;
        }
    }
</style>