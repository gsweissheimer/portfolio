<?php 
/* Site Pnid - 2019 */
/* Modulo Vantagens - Incluir nas páginas respetivas */

?>

<article id="vantagens">
    <?= funGetFeatures('home-vantagens', '
    <div class="redtitle moviment">{{title}}</div>
    <h2 class="subtitle moviment">{{subtitle}}</h2>'); ?>

    <div class="grid">
            <?= funGetFeatures('home-vantagens-itens', '
                <div class="box moviment">   
                    <img class="icon" src="{{img}}">
                    <h3 class="title">{{title}}</h3>
                    <div class="subtext">{{subtitle}}</div>
                </div>
        '); ?>
        
    </div>
</article>