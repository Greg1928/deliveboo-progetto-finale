<template>
    <header>
        <HeaderInner />
    </header>
</template>

<script>
    import HeaderInner from './HeaderComponents/HeaderInner.vue'


    export default {
        name: 'BaseHeader',
        components: {
        HeaderInner,
}
}
</script>

<style lang="scss" scoped>

</style>