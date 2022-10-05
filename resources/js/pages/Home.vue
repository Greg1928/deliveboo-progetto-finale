<template>
        <main class="main__content">
            <section class="hero">
                <div class="container">
                    <div class="hero__content row">
                        <div class="hero__left col">
                            <div class="hero__left__text">
                                <h1>Cibo preferito a casa tua</h1>
                            </div>
                            <a href="#first"><button type="button" class="btn__hero" @click="scrollFunction">Scegli la tipologia</button></a>
                        </div>
                        <div class="hero__right col">
                            <img src="img/header/p_hamburgher.png">
                        </div>
                    </div>
                </div>
            </section>
            <section class="recommendation">
                <div class="recommendation__text">
                    <h1 class="recommendation__text__top">Consigliati da noi</h1>
                    <h2 class="recommendation__text__bottom">Scegli un ristorante</h2>
                </div>
                <div class="container">
                    <div class="recommendation__restaurant">
                        <div class="recommendation__restaurant__info" v-for="(recommendation, index) in recommendations" :key="index">
                            <a href="#">
                                <img :src="recommendation.image">
                                <div class="recommendation__restaurant__text">
                                    <p>{{recommendation.restaurant_name}}</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            <section class="type">
                <div class="type__title__container">
                    <div class="type__title">
                        <div class="container">
                            <h1 class="text-center">Scegli cosa vuoi mangiare e noi troviamo i ristoranti</h1>
                        </div>
                    </div>
                </div>
                <div class="row w-100 ml-0">
                    <div class="col-lg-2 col-md-12 d-flex p-0">
                        <div class="type__list__container" id="first">
                            <label class="ms_type" v-for="type in types" :key="type.id">

                                <input type="checkbox" :value="type.name" :id="type.name" v-model="checkedTypes" @change="filterRestaurants()"/>
                                {{ type.name }}
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-12 p-4" v-if="filteredRestaurants.length > 0">
                        <div class="type__restaurant">
                            <div class="type__restaurant__content justify-content-around">
                                <div class="type__restaurant__content__single col-xxl-6 col-xl-4 col-lg-4 col-md-6 col-12" v-for="restaurant in filteredRestaurants" :key="restaurant.id">
                                    <router-link class="text-decoration-none text-dark" :to="{ name: 'single-restaurant', params: { slug: restaurant.slug } }">
                                        <div class="restaurant__logo__img" v-if="restaurant.image">
                                            <img :src="`/storage/${restaurant.image}`" :alt="restaurant.name">
                                        </div>
                                        <div class="restaurant__logo__placeholder" v-else>
                                            <img src="https://via.placeholder.com/100" :alt="restaurant.name">
                                        </div>
                                        <p class="restaurant__name mt-2 mb-5">{{restaurant.name}}</p>
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-12 d-flex justify-content-center align-items-center" v-else>
                        <h1 class="text-center">
                            Nessun ristorante trovato
                            <i class="fa-regular fa-face-sad-tear"></i>
                        </h1>
                    </div>
                </div>
            </section>
        </main>
</template>

<script>
    export default {
        name: 'Home',
        data() {
            return {
                types: "",
                restaurants: [],
                checkedTypes: [],
                filteredRestaurants: [],
                loading: true,
                recommendations: [
                    {
                        image: "/img/main1/restorants_recommended/BurgherKing.png",
                        restaurant_name: "BurgherKing"
                    },
                    {
                        image: "/img/main1/restorants_recommended/Dominos.png",
                        restaurant_name: "Dominos"
                    },
                    {
                        image: "/img/main1/restorants_recommended/KomiShushi.png",
                        restaurant_name: "KomiShushi"
                    },
                    {
                        image: "/img/main1/restorants_recommended/MC_donalds.png",
                        restaurant_name: "MC Donalds"
                    },
                    {
                        image: "/img/main1/restorants_recommended/OldWildWest.png",
                        restaurant_name: "Old Wild West"
                    },
                    {
                        image: "/img/main1/restorants_recommended/PizzaHut.png",
                        restaurant_name: "Pizza Hut"
                    },
                    {
                        image: "/img/main1/restorants_recommended/PokeHouse.png",
                        restaurant_name: "Poke House"
                    },
                    {
                        image: "/img/main1/restorants_recommended/RoadHouse.png",
                        restaurant_name: "RoadHouse"
                    },
                    {
                        image: "/img/main1/restorants_recommended/KFC.png",
                        restaurant_name: "KFC"
                    },
                    
                ],
            }
            
        },
        mounted() {
            this.getTypes();
            this.getRestaurants();
        },
        computed: {
            filterTypes() {
                return this.restaurants.filter((restaurant) => {
                    restaurant.types.forEach((type) => {
                        console.log(this.checkedTypes);
                        if (this.checkedTypes.includes(type.name)) {
                            this.filteredTypes.push(restaurant);
                        }
                    });
                });
            },
        },
        methods:{
            scrollFunction() {
                const anchors = document.querySelectorAll('a[href*="#"]')                
                for(let anchor of anchors){
                    anchor.addEventListener("click", function(elem){
                        elem.preventDefault();
                        const blockID = anchor.getAttribute('href');
                        document.querySelector('' + blockID ).scrollIntoView({
                            behavior: "smooth",
                            block: "start"
                        })
                    })
                }
            },
            getRestaurants() {
                axios.get('/api/restaurants')
                .then((response) => {
                    this.restaurants = response.data;
                    this.filteredRestaurants = this.restaurants;
                    this.loading = false;
                })
                .catch((e) => {
                    console.error(e);
                });
            },
            getTypes() {
                axios.get('/api/types')
                .then((response) => {
                    this.types = response.data;
                    this.loading = false;
                })
                .catch((e) => {
                    console.error(e);
                });
            },
            filterRestaurants() {
                if (this.checkedTypes.length == 0) {
                    this.filteredRestaurants = this.restaurants;
                } else {
                    this.filteredRestaurants = [];
                    this.restaurants.forEach((restaurant) => {
                        let included = true;
                        if (restaurant.types.length == 0) {
                            included = false;
                        } else {
                            this.checkedTypes.forEach((type) => {
                                let present = false;
                                restaurant.types.forEach((Rtype) => {
                                    if (Rtype.name == type) {
                                        present = true;
                                    }
                                });
                                if (!present) {
                                    included = false;
                                }
                            });
                        }
                        if (included) {
                            this.filteredRestaurants.push(restaurant);
                        }
                    });
                }
            },
        },
    }
</script>

<style lang="scss" scoped>
    .main__content{
        width: 100%;
        height: auto;
    }

    .ms_type {
        display: block;
        margin: 15px 0;
    }

    @media (max-width: 990px) {
        .ms_type {
            display: inline-block;
            margin: 15px 10px
        }
    }

    @media (max-width: 990px) {
        .ms_type {
            display: inline-block;
            margin: 15px 10px
        }
    }
    
    /*Hero*/
    .hero{
        width: 100%;
        background-color: #373638;
        background-image: url("/img/header/background_header.png");
        
        .hero__right{
            
            img{
                width: 100%;
                margin-top: 200px;
            }
            img:hover{
                margin-top: 185px;
                transition: margin-top 1s;
            }
            @media (max-width: 800px){
                img{
                    display: none;
                }
            }
            
        }
        .hero_content{
            display: flex;
        }

        .hero__left {
            width: 100%;
            height: 700px;
            display: flex;
        }

        .hero__left{
            justify-content: center;
            flex-direction: column;

            &__text h1{
                color: var(--text__primary);
                font-weight: 600;
                font-size: 60px;
            }
            .btn__hero{
                background-color: var(--text__primary);
                border-radius: 15px;
                height: 50px;
                width: 350px;
                margin-top: 2rem;
                color: var(--primary__color);
                border: 5px solid var(--button__hero__border__color);
                font-weight: 600;
                font-size: 20px;
            }
            .btn__hero:hover{
                color: var(--text__primary);
                background-color: var(--primary__color);
                border: 5px solid var(--text__primary);
                transition: 0.3s;
            }
        }
    }
    /*F.Hero*/
    /*Recomandation*/
    .recommendation{
        width: 100%;
        height: auto;
        min-height: 900px;
        background-image: url("/img/main1/main2_background.png");
        background-repeat: no-repeat;
        background-attachment: fixed;


        &__text{
            width: 100%;
            padding-bottom: 2rem;
            padding-top: 1rem;
            background-color: #373638;

            &__top, &__bottom{
                color: var(--text__primary);
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }
            &__top{
                font-size: 35px;
                font-weight: 600;
            }
            &__bottom{
                margin: 0.5rem;
                font-size: 18px;
                font-weight: 400;
            }
        }

        &__restaurant {
            display: flex;
            align-items: center;
            width: 100%;
            justify-content: center;
            flex-wrap: wrap;
            padding: 50px 0;

            &__info {           

                a img{
                    max-width: 350px;
                    margin: 10px;
                    border: 2px solid transparent;
                }
                a img:hover{
                    transition: 0.3s;
                    border-radius: 20px;
                    border: 2px solid var(--primary__color);
                    background-color: var(--primary__color);
                }
            }

            p{
                margin: 10px;
                font-weight: 500;
                font-size: 18px;
                color: var(--text__secondary);
            }
            p:hover{
                color: gray;
                transition: color 0.5s;
            }
            a{
                text-decoration: none;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }
        }

    }
    /*Recommandation*/
    /*Type*/

    .type{
        
        .type__list__container{
            background-image:linear-gradient(to left, rgb(167, 101, 230), rgb(136, 50, 235));
            width: 100%;
            padding: 1rem 2rem;
        }

        @media (max-width: 1030px) {
            .type__list__container {
                display: inline-block;
                padding: 1rem;
            }
        }

        .type__title__container{
            background-image:linear-gradient(to left, rgb(167, 101, 230), rgb(136, 50, 235));
        }

        &__title{
            width: 100%;
            height: auto;
            padding-top: 3rem;
            padding-bottom: 4rem;
            color: var(--text__primary);
            font-size: 40px;
            position: relative;
            background-color: #373638;
        }
        .type__list{
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            padding: 5rem 0;
            

            a{
                text-decoration: none;
            }
            
            li{
                
                list-style: none;
                max-width: 170px;
                max-height: 20px;
                margin: 1rem 0;

                .type__list__sections{

                    width: 100%;

                    &__text{

                        width: auto;
                        display: flex;
                        align-items: center;
                        font-weight: 500;
                        font-size: 20px;
                        border-radius: 15px;
                        margin: 0 10px;
                        padding: 5px;
                        color: var(--primary__color);
                        background-color: var(--text__primary);
                        border: 2px solid transparent;
                        
                    }

                    &__text:hover{
                        color:var(--text__primary);
                        background-color: transparent;
                        border: 2px solid #fff;
                    }
                }
            }
        }
    }

    .onclick{
        display: flex;
        align-items: center;
        font-weight: 500;
        font-size: 20px;
        border-radius: 15px;
        margin: 0 10px;
        color: var(--text__primary);
        background-color: transparent;
        border: 2px solid var(--text__primary);
        padding: 5px;
    }
    
    .type__restaurant{


        h4{
            padding-top: 1rem;
            font-size: 1.5rem;
            font-weight: 600;
        }
        ul{
            list-style: none;
            

            li{
                margin: 1rem 0;

                a{
                    color: #525053;
                    font-size: 20px;
                    font-weight: 500;
                    text-decoration: none;
                }

                li a:hover{
                    color: #111011;
                    transition: 0.3s;
                }
            }
        }
    }
    /*F.Type*/
    /*Restaurants*/

    .type__restaurant__content{
        width: 100%;
        display: flex;
        flex-wrap: wrap;

        &__single{
            width: calc(100% / 3);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
    }
    .restaurant__logo__img{
        border-radius: 15px;
        width: 250px;
        height: 150px;
        background-color: #111011;
        position: relative;
        overflow: hidden;
        img{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        img:hover{
            border-radius: 15px;
            border: 2px solid var(--primary__color);
        }
        
    }
    .restaurant__name{
        font-size: 1.15rem;
        font-weight: 600;
        text-align: center;

        &__type{
            font-size: 0.8rem;
            font-weight: 600;
        }
    }
</style>
