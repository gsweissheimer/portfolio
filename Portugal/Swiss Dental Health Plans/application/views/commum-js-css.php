<!-- Start styles =====================
======================================= -->
<link href='https://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic%7cOpen+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php base_url('template/vendor/loaders.css/loaders.min.css','css') ?>"/>
<link rel="stylesheet" href="<?php base_url('template/vendor/bootstrap/css/bootstrap.min.css','css') ?>"/>
<link rel="stylesheet" href="<?php base_url('template/vendor/fontawesome/css/font-awesome.min.css','css') ?>"/>
<link rel="stylesheet" href="<?php base_url('template/vendor/swiper/css/swiper.min.css','css') ?>"/>
<link rel="stylesheet" href="<?php base_url('template/vendor/animate.css/animate.min.css','css') ?>"/>
<link rel="stylesheet" href="<?php base_url('template/vendor/formstone/css/lightbox.css','css') ?>"/>
<link rel="stylesheet" href="<?php base_url('template/vendor/formstone/css/background.css','css') ?>"/>
<link rel="stylesheet" href="<?php base_url('template/vendor/mediaelement/mediaelementplayer.min.css','css') ?>"/>
<link rel="stylesheet" href="<?php base_url('template/vendor/text-animation-css/css/index.css','css') ?>"/>
<link rel="stylesheet" href="<?php base_url('template/assets/css/app.css','css') ?>"/>
<link rel="stylesheet" href="<?php base_url('template/assets/css/colors/red.css','css') ?>"/>
<link rel="stylesheet" href="<?php base_url('css/mine.css','css') ?>"/>
<!-- ==================================
============================ End styles -->
<!-- Start Scripts ====================
======================================= -->
<script type="text/javascript" src="<?php base_url('template/vendor/modernizr/js/index.js','js') ?>"></script>
<script type="text/javascript" src="<?php base_url('template/vendor/jquery/jquery.min.js','js') ?>"></script>
<script type="text/javascript" src="<?php base_url('template/vendor/bootstrap/js/bootstrap.min.js','js') ?>"></script>
<script type="text/javascript" src="<?php base_url('template/vendor/gmap3/gmap3.min.js','js') ?>"></script>
<script type="text/javascript" src="<?php base_url('template/vendor/isotope/isotope.pkgd.min.js','js') ?>"></script>
<script type="text/javascript" src="<?php base_url('template/vendor/swiper/js/swiper.min.js','js') ?>"></script>
<script type="text/javascript" src="<?php base_url('template/vendor/wow/wow.min.js','js') ?>"></script>
<script type="text/javascript" src="<?php base_url('template/vendor/formstone/js/core.js','js') ?>"></script>
<script type="text/javascript" src="<?php base_url('template/vendor/formstone/js/touch.js','js') ?>"></script>
<script type="text/javascript" src="<?php base_url('template/vendor/formstone/js/transition.js','js') ?>"></script>
<script type="text/javascript" src="<?php base_url('template/vendor/formstone/js/lightbox.js','js') ?>"></script>
<script type="text/javascript" src="<?php base_url('template/vendor/formstone/js/background.js','js') ?>"></script>
<script type="text/javascript" src="<?php base_url('template/vendor/jquery.appear/jquery.appear.js','js') ?>"></script>
<script type="text/javascript" src="<?php base_url('template/vendor/countUp.js/js/countUp.min.js','js') ?>"></script>
<script type="text/javascript" src="<?php base_url('template/vendor/mediaelement/mediaelement-and-player.min.js','js') ?>"></script>
<!--<script type="text/javascript" src="<?php base_url('template/vendor/smoothscroll/SmoothScroll.js','js') ?>"></script>-->
<script type="text/javascript" src="<?php base_url('template/vendor/text-animation/js/index.js','js') ?>"></script>
<script type="text/javascript" src="<?php base_url('template/assets/js/app.js','js') ?>"></script>
<!-- ==================================
=========================== End Scripts -->


<script src="https://webserver.swissdentalservices.com/formularios/form-generator.js"></script>

<script>

    var fid = "sdhpNewsForm";

    var fcta = "Enviar"

    var ftks = "https://swissdentalconsulting.com/";

    
  form(fid, fcta, ftks, [{ type: "hidden", name: "origem", value: "LP" }],[
            { type: "form", name: fid, css: "pT0", validate: "true"},
            { type: "hidden", name: "id", value: fid },

            { type: "email", name: "email", value: null, options: null, required: true, css: "mB25", title: null, placeholder: "Email *" },  

            { type: "submit", name: "", value: fcta , css: 'contact' }

        ]).start();

</script>