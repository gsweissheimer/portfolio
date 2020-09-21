<?php 
/* Site Pnid - 2019 */
/* Modulo Vantagens Rota - Incluir nas páginas respetivas */

?>

<article id="vantagensrota">
    <?= funGetFeatures('reabilitacao-oral-vantagensrota-title', '
                    <h1 class="redtitle moviment">{{title}}</h1>
                    <h3 class="subtitle moviment">{{subtitle}}</h3>
        '); ?>

    <div class="grid">
        <?= funGetFeatures('reabilitacao-oral-vantagensrota', '
                <div class="box moviment">   
                    <img class="icon" src="{{img}}">
                    <h3 class="title">{{title}}</h3>
                    <div class="subtext">{{subtitle}}</div>
                </div>
        '); ?>
    </div>

</article>