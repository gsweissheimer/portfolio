<?php 
/* Site Pnid - 2019 */
/* Modulo Solucoes Dentárias Rota - Incluir nas páginas respetivas */

?>
        <?= funGetAdvancedBanners('reabilitacao-oral-solucoesdentariasrota', '
        <article id="solucoesdentariasrota" style="background-image:  url({{img}}), url({{img_2}})"> 
            <div class="box lateralR">
                <h2 class="redtitle">{{title}}</h2>
                <div class="subtitle">{{subtitle}}</div>
                <div class="subtext">{{text}}</div> 
                <div class="button">
                    <a href="{{callAction}}"><button>{{callTitle}}</button></a>
                </div>  
            </div>
        </article> 
        '); ?>
