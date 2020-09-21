<?php 
/* Site Pnid - 2019 */
/* Modulo Solucoes Dentárias - Incluir nas páginas respetivas */

?>

<?= funGetAdvancedBanners('sobre-solucoes-dentarias', '
<article id="solucoesdentarias" style="background-image: url({{img_2}}), url({{img}}), url(assets/img/wavecopy7.png), url(assets/img/wavecopy7.png), url(assets/img/background-final-novo@1x.svg);">
    <div class="redtitle moviment">{{title}}</div>
    <h2 class="subtitle moviment">{{subtitle}}</h2>
    <div class="subtext moviment">{{text}}</div>
  

'); ?>
  <div class="grid">
        <div class="box one lateral">
            <?= funGetFeatures('sobre-solucoes-dentarias-one', '
            <h3 class="title">{{title}}</h3>
            <div class="subtitle_two">
            {{text}}
            </div>
            <div class="button">
            <a href="{{action}}"><button>{{calltoAction}}</button></a>
            </div>
        '); ?>
        </div>
        <div class="box two lateralR">
        <?= funGetFeatures('sobre-solucoes-dentarias-two', '
            <h3 class="title">{{title}}</h3>
            <div class="subtitle_two">
            {{text}}
            </div>
            <div class="button">
            <a href="{{action}}"><button>{{calltoAction}}</button></a>
            </div>
        '); ?>
        </div>
    </div>
</article>