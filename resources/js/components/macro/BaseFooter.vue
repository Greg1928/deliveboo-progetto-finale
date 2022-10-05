<template>
    <footer class="footer">
      <div class="container">
        <div class="footer__content row">
          <div class="col-lg-2 col-sm-4">
            <div class="mt-n1"><a class="d-inline-block align-middle" href="#"><img class="d-block mb-4" src="/img/logo/logo_picknick.png" width="150"></a></div>
          </div>
          <div class="col-lg-2 col-sm-4">
            <div class="">
              <h3 class="footer__content__name">Linkedin</h3>
              <ul class="footer__content__table" v-for="(linkedinLink, index) in linkedinLinks" :key="index">
                <li class=""><a class="" :href="linkedinLink.link" target="_blank"><p>{{linkedinLink.name}}</p></a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-2 col-sm-4">
            <div class="">
              <h3 class="footer__content__name">Aiuto?</h3>
              <ul class="footer__content__table" v-for="(help, index) in helps" :key="index">
                <li class=""><a class="" href="#"><p>{{help.name}}</p></a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-2 col-sm-4">
            <div class="pb-2 mb-4">
              <h3 class="footer__content__name">Seguici</h3>
              <ul class="footer__content__table" v-for="(follow, index) in follows" :key="index">
                <li class=""><a class="" href="#"><p>{{follow.name}}</p></a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-4 col-sm-8">
            <div class="pb-2 mb-4">
              <h3 class="footer__content__name">Download la nostra app</h3>
              <div class="download">
                <div class="download__google download__style">
                    <a href="#">Download Google Play</a>
                </div>
                <div class="download__apple download__style">
                    <a href="#">Download App Store</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <hr class="hrbar">
        <div class="footer__bottom row">
          <div class="footer__bottom__left__text">© All rights reserved. Made with &hearts; by <a href="#">Class 63 Groupe 6</a></div>
          <div class="footer__bottom__right">
            <ul class="footer__bottom__right__menu">
              <li class="footer__bottom__right__menu__text"><a href="#">Privacy Policy</a></li>
              <li class="footer__bottom__right__menu__text"><a href="#">Terms &amp; Conditions</a></li>
              <li class="footer__bottom__right__menu__text"><a href="#">Cookies Policy</a></li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
</template>

<script>
    export default {
        name: 'BaseFooter',
        data() {
            return {
                linkedinLinks: [
                    {
                        name: "Giuseppe Vetrano",
                        link: "https://www.linkedin.com/in/vetranogiuseppe/"
                    },
                    {
                        name: "Andrii Semenchenko",
                        link: "https://www.linkedin.com/in/andriisemenchenko/"
                    },
                    {
                        name: "Gregorio Sartino",
                        link: "https://www.linkedin.com/in/gregoriosortino/"
                    },
                    {
                        name: "Giuseppe Salamone",
                        link: "https://www.linkedin.com/in/giuseppe-salamone/"
                    },
                ],
                helps: [
                    {
                        name: "Centro di aiuto",
                        link: "#"
                    },
                    {
                        name: "Supporto",
                        link: "#"
                    },
                    {
                        name: "Contatti",
                        link: "#"
                    },
                ],
                follows: [
                    {
                        name: "Facebook",
                        link: "#"
                    },
                    {
                        name: "Twitter",
                        link: "#"
                    },
                    {
                        name: "Instagram",
                        link: "#"
                    },
                    {
                        name: "TikTok",
                        link: "#"
                    },
                    {
                        name: "YouTube",
                        link: "#"
                    },
                ],
            }
            
        },
    }
</script>

<style lang="scss" scoped>
  .footer{
    width: 100%;
    height: auto;
    background-color: var(--footer__color);    

    &__content{
      width: 100%;
      display: flex;
      justify-content: space-between;
      padding-top: 5rem;
        
                &__name{
                color: var(--text__primary);
                font-size: 1.2rem;
                font-weight: 600;

                }

                &__table{

                    margin-top: 1rem;
                    display: flex;
                    justify-content: space-between;

                    li{
                    list-style: none;

                    a {
                        color: rgb(109, 109, 109);
                        text-decoration: none;

                        p{
                            font-weight: 600;
                            font-size: 0.8rem;
                        }
                      }
                    a:hover{
                        color: var(--text__primary);
                        text-decoration: none;
                        transition: 0.25s;
                        }
                    }
                }                
    }
  }

.hrbar{
    background-color: var(--text__primary);
}

.footer__bottom{
    display: flex;
    padding: 1rem;
    justify-content: space-between;

    &__left__text{
        padding: 1rem;
        font-size: 0.8rem;
        font-weight: 600;
        color: rgb(190, 190, 190);

        a{
            color: rgb(255, 255, 255);
            text-decoration: none;
        }
        a:hover{
            color: rgb(190, 190, 190);
            transition: 0.25s;
        }
    }

    &__right{
        padding: 1rem;
        &__menu{
            display: flex;

            &__text{
                list-style: none;
                margin: 0 0.25rem;
                font-size: 0.8rem;
                font-weight: 600;
                a{
                    color: var(--text__primary);
                    text-decoration: none;
                 }
                 a:hover{
                    color: rgb(182, 182, 182);
                    transition: 0.3s;
                 }
            }
        }
    }
}

.download{
    display: flex;
    flex-direction: column;

    &__style{
        max-width: 75%;
        padding: 0.5rem 0;

        a {
            text-decoration: none;
            color: #000;
            display: flex;
            justify-content: center;
            padding: 0.25rem 0;
            background-color: var(--text__primary);
            border-radius: 15px;
            font-size: 1rem;
            font-weight: 600;
            border: 2px solid transparent;
        }
        a:hover{
            background-color: transparent;
            color: var(--text__primary);
            border: 2px solid var(--text__primary);
            transition: 0.25s;
        }
    }
}
</style>