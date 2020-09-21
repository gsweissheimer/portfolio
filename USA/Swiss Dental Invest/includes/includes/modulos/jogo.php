<?php 
/* Site Pnid - 2019 */
/* Modulo Jogo/Quiz - Incluir nas páginas respetivas */

?>

<?= funGetAdvancedBanners('home-jogo', '
<article id="jogo" style="background-image: url({{img}});">
    <div class="redtitle moviment">{{title}}</div>
    <h2 class="subtitle moviment">{{subtitle}}</h2>
    <div class="subtext moviment">{{text}}</div>
    <div class="button">
    <a href="{{callAction}}"><button>{{subtext}}</button></a>
    </div>
</article>
'); ?>