<?php 
/* Site Pnid - 2019 */
/* Modulo Marcar Consulta Avaliação - Incluir nas páginas respetivas */

?>

        <?= funGetAdvancedBanners('home-avaliacao-top', '
<article id="avaliacao">
    <div class="grid moviment" style="background-image: url({{img}});">
        <h2 class="title">{{title}}{{subtitle}} <div class="red">{{text}}</div></h2>
        '); ?>

<?= funGetAdvancedBanners('modal_pnid', '
                    <div class="formarc">
                        <div id="pnid-marcacao-website"></div>
                    </div>
                </div>
            </article>
'); ?>
<script src="https://webserver.swissdentalservices.com/formularios/form-generator.js"></script>
<script>
    form('pnid-marcacao-website',"QUERO UMA AVALIAÇÃO SEM CUSTOS","thankpage.php", [
            { type: "form", name: form.id, css: "testeform", validate: "true"},
            { type: "hidden", name: "origem", value: "SITE" },
            { type: "hidden", name: "marca", value: "PNID" }
            ]).start();

</script>
