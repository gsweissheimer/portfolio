<!-- Start styles =====================
======================================= -->
<link rel="stylesheet" href="<?php base_url('base.css','css') ?>"/>
<link rel="stylesheet" href="<?php base_url('skeleton.css','css') ?>"/>
<link rel="stylesheet" href="<?php base_url('layout.css','css') ?>"/>
<link rel="stylesheet" href="<?php base_url('color.css','css') ?>"/>
<link rel="stylesheet" href="<?php base_url('font-awesome.css','css') ?>"/>
<link rel="stylesheet" href="<?php base_url('et-line.css','css') ?>"/>
<link rel="stylesheet" href="<?php base_url('owl.carousel.css','css') ?>"/>
<link rel="stylesheet" href="<?php base_url('owl.transitions.css','css') ?>"/>
<link rel="stylesheet" href="<?php base_url('retina.css','css') ?>"/>
<link rel="stylesheet" href="<?php base_url('jquery.fancybox.css','css') ?>"/>
<!-- ==================================
============================ End styles -->
<!-- Start Scripts ====================
======================================= -->
<script type="text/javascript" src="<?php base_url('modernizr.custom.js','js') ?>"></script>
<script type="text/javascript" src="<?php base_url('jquery-2.1.1.js','js') ?>"></script>
<script type="text/javascript" src="<?php base_url('royal_preloader.min.js','js') ?>"></script>
<script type="text/javascript" src="<?php base_url('plugins.js','js') ?>"></script>
<script type="text/javascript" src="<?php base_url('masonry.js','js') ?>"></script>
<script type="text/javascript" src="<?php base_url('isotope.js','js') ?>"></script>
<script type="text/javascript" src="<?php base_url('contact.js','js') ?>"></script>
<!-- ==================================
=========================== End Scripts -->

<script>
    window.onload = function(){
        setTimeout(() => {
            document.getElementById('royal_pre_preloader').remove();
        },500)
    }
</script>

<script>

    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (30*24*60*60*1000));
        var expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
            c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    function reloadCookie(_var) {
        setCookie("lang",_var,30);
        setTimeout(() => {
            location.reload();
        }, 500);
    }

</script>
<script src="https://webserver.swissdentalservices.com/formularios/form-generator.js"></script>
<style>
    .field-area + .field-area {
            margin-top: 20px
        }
        .field-area input[type=email],
        .field-area input[type=text],
        .field-area textarea,
        .field-area select, .showPrefix, .selectedPrefix {
            position: relative;
            width: calc(100% - 40px);
            padding-left: 20px;
            padding-right: 20px;
            font-family: 'Open Sans', sans-serif;
            font-weight: 400;
            letter-spacing: 1px;
            font-size: 13px;
            line-height: 24px;
            margin-top: 20px;
            padding-bottom: 15px;
            background: transparent;
            border: none;
            color: #737373;
            -webkit-transition: border-bottom 0.3s, color 0.3s;
            transition: border-bottom 0.3s, color 0.3s;
            border-bottom: 1px solid rgb(9, 31, 64);
        }

        .showPrefix {
            width: 14%;
            margin: 4px 1%;
        }
        
        .selectedPrefix {
            width: 14%;
        }

        .phoneArea input[type=text] {
            width: 70%

        }

    #area-formSDC__ {
    margin-top: 10px
    }

        .field-area input[type=checkbox] {
            float: left;
            margin-right: 15px;
        }

        #formSDC .checkbox {
            margin-left: 0
        } 
        
        .field-area label {
            height: auto;
            display: block;
            font-family: roboto;
            font-size: 14px;
            font-weight: bold;
            color: #585858;
            width: 353px;
            padding-top: 0;
            padding-right: 0;
            padding-bottom: 5px;
            padding-left: 0;
            margin-top: 0;
            margin-right: 0;
            margin-bottom: 0;
            margin-left: 0px;
            background-color: transparent;
            background-image: none;
            vertical-align: top;
            text-align: left;
            text-align-last: left;
        }

        .checkbox {
            margin-left: 20px
        }

        #formSDC button {
            text-align: center;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-weight: 300;
            cursor: pointer;
            font-size: 21px;
            line-height: 28px;
            margin-bottom: 20px;
            letter-spacing: 1px;
            border-radius: 8px;
            padding: 25px 40px;
        }

        #content option {
            background-color: #fff;
            color: #333;
        }
        
        .formArea ::placeholder {
            color: #333;
            font-size: 18px;
            opacity: 1;
        }

        .formArea :-ms-input-placeholder {
            color: #333;
            font-size: 18px;
        }

        .formArea ::-ms-input-placeholder {
            color: #333;
            font-size: 18px;
        }
        .phoneArea {
            display: flex;
        }
        .formArea .phoneArea .selectedPrefix {
            border-bottom: 2px solid #333;
            font-family: Arial;
            display: inline-block;
            width: 62px;
            height: 45px;
            position: relative;
        }
        .formArea .phoneArea .showPrefix {
            width: 54px;
            height: 45px;
            padding: 10px 5px 0;
            border-bottom: 2px solid #333;
            font-weight: 400;
            color: #333;
        }
        .formArea .phoneArea input {
            margin: 0;
            height: 45px;
        }
        .formArea .phoneArea .selectedOption {
            background-color: transparent;
            color: #333;
            width: 100%;
            height: 100%;
            margin: 0px 19px 0px 0px;
            font-size: 15px;
            line-height: 24.8px;
            padding: 8px 11px;
            box-sizing: border-box;
            border: 0px;
        }
        .prefixDiv {
            position: absolute;
            top: 43px;
            left: -1px;
            display: none;
            background-color: white;
            z-index: 9999;
        }
        .formArea .phoneArea .selectedOption:after {
            position: absolute;
            content: "";
            top: 20px;
            right: 7px;
            width: 1px;
            border: 4px solid transparent;
            border-color: #333 transparent transparent transparent;
        }
        .option {
            padding: 15px;
            color: #ffffff;
            width: 20%;
            transition: all .2s;
        }
        .option:hover {
            background-color: rgba(0,0,0,.2);
        }
        .active_select {
            display: flex;
            flex-flow: row wrap;
            width: 300px;
            top: 43px;
            left: 0px;
            background-color: #333;
        }

        .selectedOption.active_select {
            background-color: #fff;

        }
</style>

<!--
<script>

    var fid = "formSDC";

    var fcta = "<?=formCTA?>"

    var ftks = "https://swissdentalconsulting.com/";

    
  form(fid, fcta, ftks, [{ type: "hidden", name: "origem", value: "LP" }],[
            { type: "form", name: fid, css: "testeform", validate: "true"},
            { type: "hidden", name: "id", value: fid },

            { type: "text", name: "name", value: null, options: null, required: true, css: null, title: null, placeholder: "<?=name?> *", pattern: false },
            { type: "email", name: "email", value: null, options: null, required: true, css: null, title: null, placeholder: "<?=emailForm?> *" },
            { type: "textarea", name: "description", value: null, options: null, required: true, css: null, title: null, placeholder: "<?=textarea?> *" },   

            { type: "checkbox", name: "termos", value: "<a href='https://swissdentalservices.com/termos-condicoes.php' target='blank'><?=aceptTerms?></a>", required: true, css: "notice"},
            { type: "submit", name: "", value: fcta , css: 'contact' }

        ]).start();

</script>
-->
<script>

    var fid = "newsFormSDC";

    var fcta = "<?=formCTA?>"

    var ftks = "https://swissdentalconsulting.com/";

    
  form(fid, fcta, ftks, [{ type: "hidden", name: "origem", value: "LP" }],[
            { type: "form", name: fid, css: "pT0", validate: "true"},
            { type: "hidden", name: "id", value: fid },

            { type: "email", name: "email", value: null, options: null, required: true, css: "mB25", title: null, placeholder: "<?=emailForm?> *" },  

            { type: "submit", name: "", value: fcta , css: 'contact' }

        ]).start();

</script>