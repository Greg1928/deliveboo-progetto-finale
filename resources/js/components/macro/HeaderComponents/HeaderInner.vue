<template>     

<!-- Navigation-->
    <div class="navbar__content">
        <div class="container">
            <nav class="navbar__content__navigation">
                <div class="navbar__content__navigation__left">
                    <img src="/img/logo/logo_picknick.png" alt="Logo Picknick">
                </div>
                <a href="#" class="toggle__button" @click="menu()">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </a>
                <div class="navbar__content__navigation__right">
                    <ul @click="menuClose()">
                        <li>
                            <router-link :to="{ name: 'home' }"><p>Home</p></router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'about' }"><p>Chi Siamo</p> </router-link>
                        </li>
                        <li>
                            <a class="" href="/admin/home"><p>Area Riservata</p></a>
                        </li>
                    </ul>
                </div>
            </nav>                 
        </div>
    </div>         
</template>
  
<script>
    export default {
        name: 'HeaderInner',
        methods: {
            menu(){
                const SetMenu = document.getElementsByClassName('navbar__content__navigation__right')[0];
                SetMenu.classList.toggle('active');
            },
            menuClose(){
                const SetMenu = document.getElementsByClassName('navbar__content__navigation__right')[0];
                SetMenu.classList.remove('active')
            }
        }
    }
</script>
  
<style lang="scss" scoped>

    /*Navigation*/
    .navbar__content{
        min-height: 70px;
        padding: 1rem 0;
        display: flex;
        align-items: center;
        background-image: linear-gradient(to left, rgb(151, 72, 224), rgb(136, 50, 235));
        border-bottom: 2px solid #fff;

        &__navigation{
            display: flex;
            justify-content: space-between;
            align-items: center;

            &__left{
                display: flex;
                align-items: center;
            }

            &__right{
                
                ul{
                    margin: 0;
                    padding: 0;
                    display: flex;

                    li {
                        list-style-type: none;
                        margin: 0 1.25rem;

                        a{

                            text-transform: uppercase;
                            color: var(--text__primary);
                            font-weight: 500;
                            text-decoration: none;
                            position: relative;

                                p{
                                    font-size: 0.9rem;
                                    font-weight: 600;                                   
                                }
                            }

                        a::before {

                            content: '';
                            bottom: 0;
                            left: 0;
                            width: 0;
                            position: absolute;
                            height: 2px;
                            background-color: #ffffff;
                            transition: 0.3s;
                            border-radius: 10px;
                        }
                        a:hover:before{

                            width: 100%;
                        }
                    }
                }
            }
        }
    }

    .toggle__button{
        position: absolute;
        top: 1.4rem;
        right: 1.4rem;
        display: none;
        flex-direction: column;
        justify-content: space-between;
        width: 30px;
        height: 21px;

        .bar{
            height: 3px;
            width: 100%;
            background-color: #fff;
            border-radius: 15px;
        }
    }
    @media (max-width: 800px){
        .toggle__button{
            display: flex;
        }
        .navbar__content__navigation__right{
            display: none;
            width: 100%;
        }
        .navbar__content__navigation{
            flex-direction: column;
            align-items: flex-start;
        }
        .navbar__content__navigation__right ul{
            width: 100%;
            padding: 1rem 0;
            flex-direction: column;
            
            li{
                padding: 1rem 0;

                a p{
                    font-size: 1.2rem;
                }
            }
        }
        .navbar__content__navigation__right.active{
            display: flex;
        }
    }
</style>