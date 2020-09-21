<?php 
/* Site Pnid - 2019 */
/* Modulo Solucoes - Incluir nas páginas respetivas */

?>

        <?= funGetAdvancedBanners( $solucoestop, '
<article id="solucoes" style="background-image: url({{img_2}}), url({{img}}), url(assets/img/wavecopy7.png), url(assets/img/wavecopy7.png)">
    <h1 class="redtitle moviment">{{title}}</h1>
    <h2 class="subtitle moviment">{{subtitle}}</h2>
    <div class="subtext moviment">{{text}}</div>
    <div class="grid">
        '); ?>
         <?= funGetAdvancedBanners( $solucoestop, '<div class="image"><img src="{{img}}" alt="{{callTitle}}"></div>'); ?>
        <?= funGetAdvancedBanners($solucoesmiddle, '
        <div class="box one lateral">
            <h3 class="title">{{title}}</h3>
            <div class="subtitle_two">
            {{subtitle}}
            </div>
            <div class="button">
            <a href="{{callAction}}"><button>{{subtext}}</button></a>
            </div>
        </div>
        '); ?>
        <?= funGetAdvancedBanners( $solucoestop, '<div class="image"><img src="{{img_2}}" alt="{{callAction}}"></div>'); ?>
        <?= funGetAdvancedBanners($solucoesbottom, '
        <div class="box two lateralR">
            <h3 class="title">{{title}}</h3>
            <div class="subtitle_two">
            {{subtitle}}
            </div>
            <div class="button">
            <a href="{{callAction}}"><button>{{subtext}}</button></a>
            </div>
        </div>
    </div>
</article>
        '); ?>
