<template>
    <div class="about">
        <div class="about__content">
            <div class="about__content__img">
                <div class="container">
                    <img src="/img/about/logo__boolean.png">
                </div>
            </div>
                <div class="about__content__infortation">
                    <div class="container">
                        <h1 class="about__content__infortation__title text-center">Chi siamo</h1>
                        <p class="about__content__infortation__text">Sei mesi fa abbiamo scelto di iniziare un percorso con Boolean nel mondo del Web Developing, in questi mesi abbiamo potuto mettere in pratica le conoscenze teoriche apprese durante le lezioni, creando progetti con difficoltà crescente, molto spesso ispirati a note web app e web pages. In particolare, uno dei progetti più grandi e al cui interno sono presenti tutte le tecnologie imparate durante il corso, è proprio questo in cui state navigando, ovvero una replica della nota app Deliveroo. A differenza dei precedenti, questo progetto è stato svolto in team dandoci, quindi, la possibilità di imparare a lavorare insieme ad altre persone cercando sempre di trovare il giusto compromesso, proprio come nel mondo del lavoro. Adesso però godetevi il vostro cibo preferito spedito direttamente a casa vostra! Team 6 &hearts;
                        </p>
                    </div>
                </div>
        </div>
        <div class="about__us">
            <div class="container">
                <div class="about__us__content">
                    <h1>Un po di noi..</h1>
                    <p class="about__us__content__title">Siamo il team 6 della classe 63:</p>
                    <div class="about__us__content__img">
                        <img :src="ourInformations[currentIndex].img">
                    </div>
                    <p class="about__us__content__comment">{{ourInformations[currentIndex].Comment}}</p>
                    <p class="about__us__content__name">{{ourInformations[currentIndex].name}}</p>
                    <div class="thumbs__about">
                        <div class="thumb__on__left" v-on:click="PrevWeAre()">
                        </div>
                        <div class="thumb" v-for="(ourInformation, indexWeAre) in ourInformations" :key="indexWeAre" :class="currentIndex === indexWeAre ? `active` : null" v-on:click="ChangeWeAre(indexWeAre)"></div>
                        <div class="thumb__on__right" v-on:click="NextWeAre()">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
    name: 'About',
    data(){
        return{
            currentIndex: 0,
            ourInformations: [
                {
                    name: 'Andrii Semenchenko',
                    img: "/img/about/we__Are/andrii__semenchenko.jpg",
                    Comment: 'Sono sempre stato appassionato al codice, per questo ho deciso di partecipare a questo corso, però sono rimasto un po\' deluso in quanto la paperella di boolean è arrivata dopo 6 mesi',
                },
                {
                    name: 'Giuseppe Vetrano',
                    img: "/img/about/we__Are/giuseppe__vetrano.png",
                    Comment: 'Intento a coltivare la passione per la programmazione ho iniziato un percorso di 6 mesi con Boolean che mi ha permesso di acquisire le giuste conoscenze per potermi definire un Jr. Full Stack Web Developer. Con la mia proattività e determinazione cerco costantemente di migliorare sia dal punto di vista lavorativo che nella quotidianità.',
                },
                {
                    name: 'Gregorio Sortino',
                    img: "/img/about/we__Are/gregorio__sartino.jpg",
                    Comment: 'Da sempre appassionato di tecnologia, il mio interesse per questo settore mi ha sempre condotto nello studio e nella ricerca di nuove tecnologie, per di più stimolato dal desiderio di conoscenza che caratterizza la mia persona.',
                },
                {
                    name: 'Giuseppe Salamone',
                    img: "/img/about/we__Are//giuseppe_sa.png",
                    Comment: 'Da sempre appassionato di tecnologia ed informatica, ho trovato nello sviluppo web un mondo stimolante ed in continua evoluzione. Curioso e desideroso di apprendere, trasformo ogni novità nel punto di partenza di un percorso che mi consentirà di crescere professionalmente e come essere umano.',
                },
                
            ],
        }
    },
    created() {
        setInterval(() => {
            this.NextWeAre();
        }, 3000);
    },
    methods: {
        PrevWeAre(){
            if(this.currentIndex === 0){
                this.currentIndex = this.ourInformations.length - 1;
            } else {
                this.currentIndex--;
            }
        },
        NextWeAre(){
            if(this.currentIndex === this.ourInformations.length - 1 ){
                this.currentIndex = 0;
            } else {
                this.currentIndex++;
            }
        },
        ChangeWeAre(indexWeAre){
            this.currentIndex = indexWeAre;
        }
    },
}
</script>

<style lang="scss" scoped>
    .about__content {
        
            &__img{
                width: 100%;
                height: auto;
                background-image: url("/img/about/background__about.jpg");
                background-attachment: fixed;


                .container{
                    width: 100%;
                    padding: 10rem 0;
                }

                img{
                    max-width: 400px;
                    
                }
                
            }
            &__infortation{
                padding: 3rem 0;
                background-image:linear-gradient(to left, rgb(44, 44, 44), rgb(27, 27, 27));
                color: #fff;
                border-top: 2px solid #fff;
                border-bottom: 2px solid #fff;

                &__title{
                    margin: 1rem 0;
                }

                &__text{
                    margin: 3rem 1rem;
                }
            }
    }

    .about__us{
        width: 100%;
        background-image: url("/img/about/we__Are/backgound__we__are.jpg");
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
        padding: 4rem 0;

        &__content{
            width: 100%;
            background-color: #fff;
            border-radius: 15px;
            border: 2px solid #ff00ff83;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            color: var(--color__cube__tundora);
            box-shadow:  5px  5px 10px #ff00ff83,
                        -5px -5px 10px #ff00ff83,
                        5px -5px 10px #ff00ff83,
                        -5px  5px 10px #ff00ff83;

            &__img{
                margin: 2rem 0;
                border-radius: 50%;
                min-width: 300px;
                max-height: 300px;
                background-color: #fff;
                position: relative;
                overflow: hidden;
                border: 10px solid var(--primary__color);
                box-shadow:  2px  2px 10px #6363631e,
                            -2px -2px 10px #6363631e,
                            2px -2px 10px #6363631e,
                            -2px  2px 10px #6363631e;
                img{
                    top: 50%;
                    left: 50%;
                    width: 300px;
                    height: 300px;
                    object-fit: cover;
                    transform: translate(-50% -50%);
                }

                }
            
            h1{
                font-size: 2rem;
                font-weight: 600;
            }

            &__title, &__name{
                font-weight: 600;
                color: rgb(90, 90, 90);
                font-size: 1rem;
                padding: 0.5rem;
                text-align: center;
                line-height: 2;
            }

            &__name {
                margin: 20px;
            }

            &__comment{
                width: 100%;
                margin: 20px;
                height: 120px;
                text-align: center;
            }

            @media (max-width: 800px) {
                &__comment{
                    height: 130px;
                }
            }
        }
    }

    .thumbs__about{
        padding: 1rem 0;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;

        .thumb__on__left{
            width: 15px;
            height: 15px;
            background-color: rgb(255, 94, 94);
            border: 5px solid transparent;
            margin: 0 1rem;
            border-radius: 50%;
        }
        .thumb__on__left:hover{
            background-color: transparent;
            transition: 0.2s;
            border: 5px solid rgb(255, 94, 94);
        }

        .thumb{
            width: 10px;
            height: 10px;
            background-color: rgb(80, 80, 80);
            border: 2px solid transparent;
            margin: 0 0.5rem;
            border-radius: 50%;
        }
        .thumb:hover{
            background-color: transparent;
            border: 2px solid rgb(80, 80, 80);
            transition: 0.2s;
        }

        // background-color: rgb(0, 255, 64);
        .thumb__on__right{
            width: 15px;
            height: 15px;
            background-color: rgb(0, 255, 64);
            border: 5px solid transparent;
            margin: 0 1rem;
            border-radius: 50%;
        }
        .thumb__on__right:hover{
            background-color: transparent;
            transition: 0.2s;
            border: 5px solid rgb(0, 255, 64);
        }

    }
    
</style>