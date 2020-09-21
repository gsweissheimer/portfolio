<?php 
/* Site Pnid - 2019 */
/* Modulo Financiamento - Incluir nas páginas respetivas */

?>

<?= funGetAdvancedBanners('sobre-financiamento', '
<article id="financiamento" style="background-image: url({{img}}) ;">
    <div class="box lateral">
        <div class="redtitle">{{title}}</div>
        <h2 class="subtitle">{{subtitle}}</h2>
        <div class="subtext">{{text}}</div>
        <div class="button">
        <a href="{{callAction}}"><button>{{subtext}}</button></a>
        </div>
    </div>
</article>

'); ?>
