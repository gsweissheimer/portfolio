<?php 
/* Site Pnid - 2019 */
/* Modulo Blog - Incluir ultimas noticias nas páginas respetivas */
require_once 'includes/generateAllInfo.php';

?>
 
<article id="blog">
    <?= funGetAdvancedBanners('home-blog', '
    <h1 class="redtitle moviment">{{title}}</h1>
    <h2 class="subtitle moviment">{{subtitle}}{{text}}</h2>
    <div class="subtext moviment">{{subtext}}</div>
    '); ?>
    <div class="grid carousel-blog owl-carousel">
        <?= getNews('
        <div class="box moviment"> 
        <div class="image" style="background-image: url({{image}});"></div>
            <h5>{{category}}</h5>
            <div class="title">{{title}}</div>
			<div class="criacao">
				<div class="autor">By {{editor}} </div>&nbsp |&nbsp <div class="data"> {{publishDate}}</div>
			</div>
			<div class="noticia">
			{{details}}
			</div>
			<div class="bottom">
                <a href="{{href}}"><button class="sabermais">SABER MAIS</button></a>
            </div>
        </div>
        ', 3); ?>
    </div>
    	<div class="button">
	        <a href="https://www.pnid.pt/blog.php"><button>Saber mais</button></a>
	    </div>
</article>
 <!--SCRIPT SLIDE-->
 <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/owl.navigation.js"></script>
    <script>

       $('.carousel-blog').owlCarousel({
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
