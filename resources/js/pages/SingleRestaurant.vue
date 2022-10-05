<template>
    <div v-if="restaurant">
        <!--Header-->
        <header class="restaurant__section">
            <div class="restaurant">
                <div class="container">
                    <div class="restaurant__content">
                        <div class="restaurant__content__left">
                            <div class="restaurant__content__left__img">
                                <div v-if="restaurant.image">
                                    <img :src="`/storage/${restaurant.image}`" :alt="restaurant.name">
                                </div>
                                <div v-else>
                                    <img src="https://via.placeholder.com/150" :alt="restaurant.name">
                                </div>
                            </div>
                        </div>
                        <div class="restaurant__content__right">
                            <h4 class="restaurant__content__right__welcome">Benvenuto a: </h4>
                            <h1 class="restaurant__content__right__name">{{restaurant.name}}</h1>
                            <p class="restaurant__content__right__address">{{restaurant.address}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!--F.Header-->
        <!--Main-->
        <main>
            <div class="main__content">
                <div class="container">
                    <div class="row">
                        <!--Dishes-->
                        <div class="dishes col-lg-8 col-md-12">
                            <div class="dishes__content" v-if="restaurant.dishes.length > 0">
                                <h1 class="text-center">I nosti Piatti</h1>
                                <div class="dishes__content__allDishes" v-for="dish in restaurant.dishes" :key="dish.id">
                                    <div class="dishes__sigle">
                                        <div class="dishes__sigle__img" v-if="dish.image">
                                            <img :src="`/storage/${dish.image}`" :alt="dish.name">
                                        </div>
                                        <div class="dishes__sigle__img" v-else>
                                            <img src="https://via.placeholder.com/100" :alt="dish.name">
                                        </div>
                                        <div class="dishes__sigle__content">
                                            <span class="dishes__sigle__content__name">{{dish.name}}</span>
                                            <div class="dishes__sigle__content__description">
                                                <p>Ingredienti:</p>
                                                <p>{{dish.description}}</p>
                                            </div>
                                            <div class="dishes__sigle__content__price">
                                                <span class="">Prezzo: {{dish.price}} €</span>
                                            </div>
                                        </div>
                                        <div class="dishes__sigle__btn">
                                            <button @click="addToCart(dish)" type="button">Aggiungi</button>
                                        </div>
                                    </div>
                                    <div class="separation"></div>
                                </div>                               
                            </div>
                            <h2 v-else>Non sono presenti piatti</h2>
                        </div>
                        <!--F.Dishes-->
                        <!--Card-->
                        <div class="col-lg-4 col-md-12">
                            <div class="cart__content">
                                <h2 class="text-center m-2">Carrello</h2>
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
                                        <span class="cart__items__price col-2">{{cartItem.price}}</span>
                                        <div class="cart__items__addCart col-4">
                                            <button @click="reduceQuantity(cartItem.quantity, cartItem.id)" class="button__down" type="button"></button>
                                            <div class="price">{{cartItem.quantity}}</div>
                                            <button @click="addQuantity(cartItem.id)" class="button__up" type="button"></button>
                                            <button @click="deleteFromCart(cartItem.id)" class="btn__off">Rimuovi</button>
                                        </div>
                                        <div class="separation"></div>
                                    </div>
                                </div>
                                <div class="total">
                                    <div class="total__text">Totale:</div>
                                    <div class="total__price">{{getTotal}}</div>
                                </div>
                                <div class="text-center">
                                    <button class="total__btn" style="background-color: #b45cff; color: white" type="button">
                                        <router-link :to="{ name: 'checkout'}" style="color: white; text-decoration: none; display: block;">Completa ordine</router-link>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!--F.Card-->
                    </div>
                </div>
            </div>
        </main>
        <!--F.Main-->
    </div>
</template>

<script>
    import swal from 'sweetalert';

    export default {
        name: 'Singlerestaurant',
        data() {
            return {
                restaurant: null,
                dishes: [],
                cartItems: []
            }
        },
        created() {
            axios.get(`/api/restaurants/${this.$route.params.slug}`)
            .then((response) => {
                this.restaurant = response.data;
            })
            .catch((e) => {
                this.$router.push({name: 'page-404'});
            });
        },
        mounted() {
            if (localStorage.getItem("cartItems")) {
            this.cartItems = JSON.parse(localStorage.getItem("cartItems"));
            }
        },
        methods: {
            addToCart(dish) {
                if (this.cartItems.length > 0 && dish.restaurant_id != this.cartItems[0].restaurant_id) {
                    swal({
                        title: "Attenzione",
                        text: "Puoi ordinare da un solo ristorante per volta!",
                        icon: "warning",
                        dangerMode: true,
                    })
                } else {
                    if (this.cartItems.find((item) => item.id === dish.id)) {
                    this.cartItems.find((item) => item.id === dish.id).quantity++;
                    } else {
                    this.cartItems.push({
                        id: dish.id,
                        name: dish.name,
                        image: dish.image,
                        price: dish.price,
                        restaurant_id: dish.restaurant_id,
                        quantity: 1,
                        total: 0,
                    });
                    }
                }
                this.updateTotal();
                localStorage.setItem("cartItems", JSON.stringify(this.cartItems));
            },
            addQuantity(id) {
                this.cartItems.forEach((cartItem) => {
                    if (cartItem.id === id) {
                        cartItem.quantity++;
                    }
                });
                this.updateTotal();
                localStorage.setItem("cartItems", JSON.stringify(this.cartItems));
            },
            reduceQuantity(quantity, id) {
                if (quantity > 1) {
                    this.cartItems.forEach((cartItem) => {
                    if (cartItem.id === id) {
                        cartItem.quantity--;
                    }
                    });
                }
                this.updateTotal();
                localStorage.setItem("cartItems", JSON.stringify(this.cartItems));
            },
            deleteFromCart(id) {
                this.cartItems = this.cartItems.filter((cartItem) => cartItem.id !== id);
                this.updateTotal();
                localStorage.setItem("cartItems", JSON.stringify(this.cartItems));
            },
            updateTotal() {
                this.cartItems.forEach(cartItem => {
                    cartItem.total = cartItem.quantity * cartItem.price;
                });
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
    };
</script>

<style lang="scss" scoped>
    .separation{
        width: 100%;
        height: 1px;
        background-color: rgba(107, 107, 107, 0.651);
        margin: 1rem 0;
    }
    .restaurant{
        width: 100%;
        padding: 3rem 0;
        height: auto;
        background-image: url(/img/SingleRestaurant/SingleRestourantBackgroundTop.jpg);
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;

        &__content{
            display: flex;
            flex-wrap: wrap;
            align-items: flex-end;

            &__left{                
                    &__img{
                    border-radius: 10px;
                    width: 450px;
                    height: 280px;
                    background-color: #fff;
                    position: relative;
                    overflow: hidden;
                    border: 2px solid #fff;
                    box-shadow:  5px  5px 10px #3333334b,
                                -5px -5px 10px #3333334b,
                                5px -5px 10px #3333334b,
                                -5px  5px 10px #3333334b;
                    img{
                        top: 50%;
                        left: 50%;
                        width: 450px;
                        height: 280px;
                        object-fit: cover;
                        transform: translate(-50% -50%);
                    }
                }
            }

            &__right{
                margin-top: 1.5rem;
                margin-left: 1.5rem;
                color: var(--single__restaurants__text__white);

                &__welcome{
                    font-weight: 400;
                    font-size: 1.2rem;
                }

                &__name{
                    font-weight: 700;
                    font-size: 3rem;
                }

                &__address{
                    font-weight: 600;
                    font-size: 1rem;
                }
            }
        }
    }
    /*Main*/

    .dishes{
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

        &__content{

            width: 100%;
            height: auto;
            padding: 2rem 1rem;

            h1{
                font-weight: 600;
                font-size: 1.4rem;
            }

            &__allDishes{
                padding-top: 1rem;

                .dishes__sigle{
                    display: flex;
                    padding: 0.5rem 0;

                    

                    &__content{
                        width: 400px;
                        margin-left: 1rem;
                        display: flex;
                        flex-direction: column;
                        flex-wrap: wrap;
                        justify-content: flex-start;

                        &__name{
                            font-weight: 600;
                            font-size: 1.1rem;
                            color: rgb(27, 27, 27);
                        }
                        &__description{
                            p:first-child{
                                margin-top: 0.5rem;
                                color: rgb(58, 58, 58);
                                font-weight: 600;
                                font-size: 0.8rem;
                            }
                            p:last-child{
                                color: rgb(58, 58, 58);
                                font-weight: 500;
                                font-size: 1rem;
                            }
                        }

                        &__price{
                            width: 8rem;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            border-radius: 15px;
                            padding: 0.2rem;
                            background-color: rgb(63, 189, 91);
                            font-weight: 500;
                            font-size: 0.8rem;
                            color: #fff;

                        }
                    }
                    
                    &__img{

                        border-radius: 10px;
                        min-width: 150px;
                        max-height: 110px;
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
                            width: 150px;
                            height: 110px;
                            object-fit: cover;
                            transform: translate(-50% -50%);
                        }
                        
                    }

                    &__btn{
                        width: 100px;
                        display: flex;
                        justify-content: flex-end;
                        align-items: flex-end;

                        button {
                        width: 100px;
                        height: 30px;
                        background-color: var(--primary__color);
                        border-radius: 15px;
                        margin-top: 2rem;
                        color: var(--text__primary);
                        border: 2px solid transparent;
                        font-weight: 600;
                        font-size: 0.8rem;
                        }
                        button:hover{
                            background-color: transparent;
                            border: 2px solid var(--primary__color);
                            color: var(--primary__color);
                            transition: 0.2s;

                        }
                    }
                }
            }
        }
    }

    /*Cart*/
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
</style>