<template>
    <div class="container d-flex justify-content-center">
        <div class="row justify-content-center my-5 box">
            <div class="col-md-7">
                <div class="alert text-center" role="alert">
                    <h4 class="alert-heading mb-2">Ordine Effettuato!</h4>
                    <p>
                        Grazie per aver acquistato dal sito Picknick, il suo ordine arriverà a breve così da potersi godere il cibo ordinato ancora caldo.
                    </p>
                    <hr />
                    <button class="btn" style="background-color: #b45cff; color: white; border-radius: 15px" type="button">
                        <router-link :to="{ name: 'home'}" style="color: white; text-decoration: none; display: block;">Home</router-link>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Payment",
    };
</script>

<style lang="scss" scoped>
    .row {
        border-radius: 1.25rem;
        box-shadow: 3px 3px 2px 2px #b35cffa2;
        max-width: 50%;
    }

    .box {
        margin: 2rem 0;
        width: 100%;
        height: auto;
        background-color: #fff;
        border-radius: 30px;
        border: 2px solid var(--primary__color);
        box-shadow:  2px  2px 10px #6363631e,
                    -2px -2px 10px #6363631e,
                    2px -2px 10px #6363631e,
                    -2px  2px 10px #6363631e;

    }
</style>