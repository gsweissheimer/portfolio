<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <!--CSS-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,500" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/modulos/modal.css">
    <link rel="stylesheet" href="https://webserver.swissdentalservices.com/formularios/basic_form.css">
    <link rel="stylesheet" href="https://webserver.swissdentalservices.com/formularios/form_exemplo.css">
</head>
<body>

<?= funGetAdvancedBanners('modal_pnid', '
                    <div class="modalArea" id="id04">
                    <div class="yellow" style="background-image:url({{img}})">
                    <h2 class="titlemodal">{{title}}</h2>
                    <span onclick="document.getElementById(\'id04\').style.display=\'none\'" class="closemodal">&times;</span>
                    <div id="pnid-modal-website"></div>
                    </div>
                </div>
'); ?>
<script src="https://webserver.swissdentalservices.com/formularios/form-generator.js"></script>

<script type="text/javascript">
    form("pnid-modal-website", "Quero uma avaliação sem custos", "thankpage.php", [ { type: "hidden", name: "marca", value: "PNID" }, { type: "hidden", name: "perfil", value: "SITE" }]).start();
  

    function setCookie(cname, cvalue, exdays) {
      var d = new Date();
      d.setTime(d.getTime() + (exdays*24*60*60*1000));
      var expires = "expires="+ d.toUTCString();
      document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getCookie(cname) {
      var name = cname + "=";
      var ca = document.cookie.split(';');
      for(var i = 0; i < ca.length; i++) {
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
    </script>

  <script type="text/javascript">
    
      $(document).ready(function(){
    
          rdFormJS = 'formulario-sds';
          UArdFromJS = "UA-61875757-1";
    
    
     var viName = getCookie("nameUser");
     if(viName == ""){
       $('#id04').css('display','flex');
     }else{
       $("#id04").hide();
     }
    
    
      });
      </script>
</body>
</html>
