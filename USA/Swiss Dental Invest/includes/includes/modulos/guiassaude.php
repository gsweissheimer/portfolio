<?php 
/* Site Pnid - 2019 */
/* Modulo Guias de Saude Oral - Incluir ultimas noticias nas páginas respetivas */

?>

<article id="guiassaude">
    <?= funGetFeatures('reabilitacao-oral-guiassaude', '
                    <div class="redtitle moviment"><p>{{title}}</p></div>
                    <h2 class="subtitle moviment">{{subtitle}}</h2>
                    <div class="subtext moviment">{{text}}</div></h3>
                '); ?>
    <div class="grid">
    <?= funGetFeatures('reabilitacao-oral-guiassaude-items', '
                <div class="box moviment">   
                    <div class="image">
                    <img src="{{img}}" alt="{{alt}}">
                    </div>
                     <div class="button">
                    <a href="{{action}}" download><button>{{calltoAction}}</button></a>
                    </div>
                </div>
        '); ?>
    </div>
</article>