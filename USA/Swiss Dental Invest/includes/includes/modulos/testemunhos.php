<?php 
/* Site Pnid - 2019 */
/* Modulo Testemunhos - Incluir nas páginas respetivas */

?>

<article id="testemunhos">
            <?= funGetAdvancedBanners($titulo, '
            <h1 class="redtitle moviment">{{title}}</h1>
            <h2 class="subtitle moviment">{{subtitle}}{{text}}</h2>
            <div class="subtext moviment">{{subtext}}</div>

        '); ?>
        <div class="carousel-testemunho owl-carousel">
                <?= funGetFeatures($conteudo, '
                    <article class="caso moviment">
                        <div class="foto">
                            <img src="{{img}}" alt="{{alt}}">
                        </div>
                        <h3 class="text">
                            {{title}}
                        </h3>
                        <div class="nome">
                            {{subtitle}}
                        </div>
                        <div class="button"><a href="{{action}}"><button class="sabermais">{{calltoAction}}</button></a></div>
                    </article>
                '); ?>

        </div> 



    <div class="button">
    <?= funGetFeatures($button, '
<a href="{{action}}"><button>{{title}}</button></a>
'); ?>    
    </div>
</article>
  <!--SCRIPT SLIDE-->
  <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/owl.navigation.js"></script>
    <script>

       $('.carousel-testemunho').owlCarousel({
            loop: true,
            margin: 10,
            responsive: {
                0: {
                    items: 1,
                    nav: true,
                    navText: ["<img class='padding_nav' src='assets/img/icons/botton-back.png'>", "<img class='padding_nav' src='assets/img/icons/botton-front.png'>"],
                    navClass: ['owl-prev', 'owl-next']
                },
                600: {
                    items: 1,
                    nav: true,
                    navText: ["<img class='padding_nav' src='assets/img/icons/botton-back.png'>", "<img class='padding_nav' src='assets/img/icons/botton-front.png'>"],
                    navClass: ['owl-prev', 'owl-next']
                },
                1000: {
                    items: 2,
                    nav: true,
                    loop: true,
                    navClass: ['owl-prev', 'owl-next']
                },
                1200: {
                    items: 3,
                    nav: true,
                    loop: false,
                    navClass: ['owl-prev', 'owl-next']
                },
                1900: {
                    items: 3,
                    nav: true,
                    loop: false,
                    navClass: ['owl-prev', 'owl-next']
                }
            }
        });
        </script>