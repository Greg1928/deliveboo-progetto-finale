<template>
    <div class="container">
        <div v-if="!isLoading">
        <div class="row justify-content-center my-5">
            <div class="col-lg-8 col-md-12">
                <div class="box card">
                    <h2 class="text-center m-3" style="font-weight: 600; font-size: 1.4rem;">Dati personali</h2>
                    <div class="card-body">
                        <form>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Nome*</label>
    
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" required pattern="[a-zA-Z'-'\s]*" autofocus title="Il nome deve contenere solo lettere">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="surname" class="col-md-4 col-form-label text-md-right">Cognome*</label>
    
                                <div class="col-md-6">
                                    <input id="surname" type="text" class="form-control" name="surname" required pattern="[a-zA-Z'-'\s]*" autofocus title="Il cognome deve contenere solo lettere">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">Indirizzo*</label>
    
                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control" name="address" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-mail*</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">Telefono*</label>
    
                                <div class="col-md-6">
                                    <input id="phone" type="tel" class="form-control" name="phone" required pattern="[0-9]{10}" autofocus title="Il numero di telefono deve contenere dieci cifre">
                                </div>
                            </div>

                            <div>
                                <p>*campo obbligatorio</p>
                            </div>        
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="cart__content">
                    <h2 class="text-center mb-2">Il tuo Ordine</h2>
                    <div class="cart__content__table row">
                        <p class="cart__content__table__name col-6">Piatto</p>
                        <p class="cart__content__table__name col-2">Prezzo</p>
                        <p class="cart__content__table__name__quantity col-4">Quantità</p>
                    </div>
                    <div class="separation"></div>
                    <div class="cart__items" v-for="cartItem in cartItems" :key="cartItem.id">
                        <div class="row">
                            <div class="cart__items__description col-6" v-if="cartItem.image">
                                <img class="cart__items__description__img" :src="`/storage/${cartItem.image}`" :alt="cartItem.name">
                                <span class="cart__items__description__name">{{cartItem.name}}</span>
                            </div>
                            <div class="cart__items__description col-6" v-else>
                                <img class="cart__items__description__img" src="https://via.placeholder.com/100" :alt="cartItem.name">
                                <span class="cart__items__description__name">{{cartItem.name}}</span>
                            </div>
                            <span class="cart__items__price col-2">{{cartItem.total}}€</span>
                            <div class="cart__items__addCart col-4">
                                <div class="price">{{cartItem.quantity}}</div>
                            </div>
                            <div class="separation"></div>
                        </div>
                    </div>
                    <div class="total">
                        <div class="total__text">Totale:</div>
                        <div class="total__price">{{getTotal}}</div>
                    </div>
                    <div class="text-center">
                        <button class="total__btn" @click="$router.go(-1)" style="background-color: #b45cff; color: white" type="button">Modifica ordine</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="box card col-6 mx-auto">
            <h2 class="text-center m-3" style="font-weight: 600; font-size: 1.4rem;">Pagamento</h2>
            <div class="card-body">
                <div style="padding: 10px 10px 20px; font-size: 22px;">
                    <span class="mr-3">Carte accettate</span>
                    <i class="fa-brands fa-cc-visa" style="color:navy;"></i>
                    <i class="fa-brands fa-cc-amex" style="color:blue;"></i>
                    <i class="fa-brands fa-cc-mastercard" style="color:red;"></i>
                    <i class="fa-brands fa-cc-discover" style="color:orange;"></i>
                </div>
                <form>
                    <div class="form-group row">
                        <label for="name" class="ml-4 col-form-label text-md-right">Nome sulla carta*</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" required autofocus placeholder="Mario Rossi">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cardNumber" class="ml-4 col-form-label text-md-right">Numero della carta*</label>

                        <div class="col-md-6">
                            <input id="cardNumber" type="text" class="form-control" name="cardNumber" required autofocus placeholder="1111-2222-3333-4444">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="expireMonth" class="ml-4 col-form-label text-md-right">Mese di scadenza*</label>

                        <div class="col-md-6">
                            <input id="expireMonth" type="text" class="form-control" name="expireMonth" required autofocus placeholder="Gennaio">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="expireYear" class="ml-4 col-form-label text-md-right">Anno di scadenza*</label>

                        <div class="col-md-3">
                            <input id="expireYear" type="text" class="form-control" name="expireYear" required placeholder="2025">
                        </div>

                        <label for="cvv" class="ml-4 col-form-label text-md-right">CVV*</label>

                        <div class="col-md-3">
                            <input id="cvv" type="text" class="form-control" name="cvv" required placeholder="123">
                        </div>
                    </div>

                    <div>
                        <p>*campo obbligatorio</p>
                    </div>        

                    <div class="form-group row mb-0 justify-content-center">
                        <div class="col-md-6 text-center">
                            <button class="btn" @click="change()" style="background-color: #b45cff; color: white; border-radius: 15px;" type="button">
                               Acquista
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
        <div class="ms_spinner"  v-else>
            <h4>Pagamento in corso...</h4>
            <div class="spinner-border ms_circle" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        name: 'Checkout',
        data() {
            return {
                cartItems: [],
                isLoading: false
            }
        },
        mounted() {
            if (localStorage.getItem("cartItems")) {
                this.cartItems = JSON.parse(localStorage.getItem("cartItems"));
            }
        },
        methods: {
            payment() {
                alert("L'ordine è stato effettuato");
            },
            editOrder() {
                this.cartItems.forEach(element => {
                    console.log(element);
                });
            },
            change() {
                this.isLoading = true;
                // simulate AJAX
                setTimeout(() => {
                    this.isLoading = false;
                    this.$router.push('/pagamento');
                }, 4000)
            },
            
        },
        computed: {
            getTotal() {
                let total = 0;
                this.cartItems.forEach(cartItem => {
                    total += cartItem.total;
                });
                return `${total.toFixed(2)} €`;
            }
        }
    }
</script>

<style lang="scss" scoped>
    .container{
        .form-control{ 
            border: 3px solid #b45cff;
            border-radius: 15px;
        }

        .ms_spinner {
            min-height: calc(100vh - 200px);
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            .ms_circle{
                width: 100px;
                height: 100px;
                color: var(--primary__color);
                font-size: 25px;
            }
            h4 {
                font-size: 2rem;
                margin-bottom: 2.5rem;
            }
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

        .cart {
            &-header {
                font-weight: bold;
                font-size: 1.25em;
                color: #333;
            }
        
            &-column {
                display: flex;
                align-items: center;
                border-bottom: 1px solid black;
                margin-right: 1.5em;
                padding-bottom: 10px;
                margin-top: 10px;
            }
        
            &-row {
                display: flex;
            }
        
            &-item {
                width: 45%;
            }
        
            &-price {
                width: 20%;
                font-size: 1.2em;
                color: #333;
            }
        
            &-quantity {
                width: 35%;
            }
        
            &-item-title {
                color: #333;
                margin-left: .5em;
                font-size: 1.2em;
            }
        
            &-item-image {
                width: 75px;
                height: auto;
                border-radius: 10px;
            }

            &-item-quantity {
                height: 34px;
                width: 50px;
                border-radius: 5px;
                border: 1px solid #56CCF2;
                background-color: #eee;
                color: #333;
                padding: 0;
                text-align: center;
                font-size: 1.2em;
                margin-right: 25px;
            }

            &-row:last-child {
                border-bottom: 1px solid black;
            }

            &-row:last-child &-column {
                border: none;
            }

            &-total {
                text-align: end;
                margin-top: 10px;
                margin-right: 10px;
            }

            &-total-title {
                font-weight: bold;
                font-size: 1.5em;
                color: black;
                margin-right: 20px;
            }

            &-total-price {
                color: #333;
                font-size: 1.1em;
            }
        }

        .cart__content{
            margin: 2rem 0;
            width: 100%;
            background-color: rgb(255, 255, 255);
            padding: 1.5rem;
            border: 2px solid gray;
            border-radius: 15px;
            box-shadow:  2px  2px 10px #6363631e,
                        -2px -2px 10px #6363631e,
                        2px -2px 10px #6363631e,
                        -2px  2px 10px #6363631e;

        h2{
            font-weight: 600;
            font-size: 1.4rem;
        }
        &__table{
            margin-top: 1rem;
            display: flex;
            padding: 0;
            margin: 0;

            .col-6, .col-1, .col-2, .col-3, .col-4, .col-5, .col-7, .col-8, .col-9, .col-10, .col-11, .col-12{
                padding: 0;
                margin: 0;
            }
            

            &__name{
                font-weight: 600;
                font-size: 0.8rem;
                display: flex;
                justify-content: flex-start;

            &__quantity{
                display: flex;
                justify-content: center;
                font-weight: 600;
                font-size: 0.8rem;
            }
            }
        }
        


        .cart__items{

            &__price{
                display: flex;
                justify-content: flex-end;
            }

            &__description{

                &__img{

                border-radius: 10px;
                min-width: 40px;
                max-height: 30px;
                background-color: #fff;
                position: relative;
                overflow: hidden;
                border: 2px solid var(--primary__color);
                box-shadow:  2px  2px 10px #6363631e,
                            -2px -2px 10px #6363631e,
                            2px -2px 10px #6363631e,
                            -2px  2px 10px #6363631e;
                    img{

                        top: 50%;
                        left: 50%;
                        width: 40px;
                        height: 30px;
                        object-fit: cover;
                        transform: translate(-50% -50%);
                    }

                }

                &__name{
                font-weight: 600;
                font-size: 0.8rem;
            }
            }
            &__addCart{
        
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
    
            .price{
                margin: 0 0.5rem;
            }
            /*buttons*/
            .button__up{
                width: 15px;
                height: 15px;
                background-color: rgb(63, 189, 91);
                border: 2px solid transparent;
                border-radius: 50%;
            }
            .button__up:hover{
                background-color: transparent;
                transition: 0.15s;
                border: 2px solid rgb(36, 250, 83);
            }
            .button__down{
                width: 15px;
                height: 15px;
                background-color: rgb(253, 75, 75);
                border: 2px solid transparent;
                border-radius: 50%;
            }
            .button__down:hover{
                background-color: transparent;
                transition: 0.15s;
                border: 2px solid rgb(255, 124, 124);
            }
            .btn__off{
                margin-top: 5px;
                border-radius: 15px;
                color: #fff;
                padding: 2px;
                background-color: rgb(253, 75, 75);
                font-size: 0.7rem;
                border: 2px solid transparent;
                font-weight: 600;
            }
            .btn__off:hover{
                border: 2px solid rgb(253, 75, 75);
                color: rgb(253, 75, 75);
                background-color: transparent;
                transition: 0.2s;
            }
            }
        }


    /*F.Cart*/


    }

    .total{
        margin-bottom: 1rem;
        display: flex;
        align-items: flex-end;

        &__text{
            font-size: 1rem;
            font-weight: 600;
        }

        &__price{
            font-size: 1.1rem;
            font-weight: 500;
            color: rgb(121, 121, 121);
            margin-left: 10px;
        }
    }
    .total__btn{
        width: 170px;
        height: 30px;
        background-color: var(--primary__color);
        border-radius: 15px;
        color: var(--text__primary);
        border: 2px solid transparent;
        font-weight: 600;
        font-size: 0.8rem;
    }

        .separation{
        width: 100%;
        height: 1px;
        background-color: rgba(107, 107, 107, 0.651);
        margin: 1rem 0;
    }


    }

</style>