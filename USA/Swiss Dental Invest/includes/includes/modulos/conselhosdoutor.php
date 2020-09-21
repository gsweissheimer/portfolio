<?php 
/* Site Pnid - 2019 */
/* Modulo Conselhos Doutor - Incluir ultimas noticias nas páginas respetivas */

?>

<article id="conselhosdoutor">

        <?= funGetFeatures('reabilitacao-oral-conselhosdoutor', '
            <div class="redtitle">{{title}}</div>
            <h2 class="subtitle">{{subtitle}}</h2>
            <div class="subtext">{{text}}</div>
        '); ?>
    <div class="grid">
        <div class="box">
            <div class="boxproblema">
            <?= funGetFeatures('reabilitacao-oral-conselhosdoutor-pergunta', '
                     <h3 class="pergunta">{{title}}</h3>
            '); ?>


            <?= funGetFeatures('reabilitacao-oral-conselhosdoutor-passos', '
               <div class="passos">
                    <div class="bola"><p>{{title}}</p></div>
                    <h4 class="title">{{subtitle}}
                    <div class="text">{{text}}</div></h4>
                </div>
                '); ?>
            </div>
        </div>
        <?php
    $html = '<div class="box">
             <div class="boxdoutor">
             <div class="title">{{title}}</div>
             <div class="text">{{subtitle}}</div>
             <div id="pnid-conselhosdoutor"></div>
             
             
            </div>
        </div>';
     echo(funGetFeatures("reabilitacao-oral-conselhosdoutor-boxdoutor", $html));
?>
        <div class="mask"></div>

        <script src="https://webserver.swissdentalservices.com/formularios/form-generator.js"></script>
<script>
    form('pnid-conselhosdoutor',"Enviar", "thankpage.php", undefined, [
        { type: "form", name: form.id, css: "testeform", validate: "false"},
        { type: "hidden", name: "marca", value: "PNID" },
        { type: "hidden", name: "origem", value: "SITE" },
        { type: "hidden", name: "identificador", value: "pnid-conselhosdoutor" },
        { type: "hidden", name: "_is", value: "6" },
        { type: "hidden", name: "resposta", value: "<?=NEWSLETTER_RESPOSTA?>" },
        { type: "text", name: "name", value: null, required: true, title: "Nome", placeholder: "Inserir aqui o seu nome" },
        { type: "email", name: "email", value: null, required: true, title: "Email", placeholder: "Inserir aqui o seu email" },
        { type: "text", name: "subject", value: null, required: true, title: "Assunto", placeholder: "Inserir aqui o seu assunto" },
        { type: "textarea", name: "texto", value: null, options: null, required: true, css: null, title: "Texto", placeholder: false },
        { type: "checkbox", name: "termos", value: "<a href='termos-condicoes.php' target='blank'>Li e aceito os Termos e Condições</a>", required: true, css: "notice"},
        { type: "submit", name: "", value: "Enviar" , css: null },
    ]).start();

</script>

</article>
<!-- <script src="assets/js/formulario-reabilitacao-oral.js"></script> -->