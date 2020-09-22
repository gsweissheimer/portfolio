<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="<?php base_url('jquery-3.3.1.min.js','js') ?>"></script>
        <script src="<?php base_url('jqueryui.min.js','js') ?>"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?php base_url('popper.min.js','js') ?>"></script>
        <script src="<?php base_url('bootstrap.min.js','js') ?>"></script>
        <!-- Rev slider js -->
        <script src="<?php base_url('jquery.themepunch.tools.min.js','vendors/revolution/js') ?>"></script>
        <script src="<?php base_url('jquery.themepunch.revolution.min.js','vendors/revolution/js') ?>"></script>
        <script src="<?php base_url('revolution.extension.actions.min.js','vendors/revolution/js/extensions') ?>"></script>
        <script src="<?php base_url('revolution.extension.video.min.js','vendors/revolution/js/extensions') ?>"></script>
        <script src="<?php base_url('revolution.extension.slideanims.min.js','vendors/revolution/js/extensions') ?>"></script>
        <script src="<?php base_url('revolution.extension.layeranimation.min.js','vendors/revolution/js/extensions') ?>"></script>
        <script src="<?php base_url('revolution.extension.navigation.min.js','vendors/revolution/js/extensions') ?>"></script>
        <script src="<?php base_url('revolution.extension.parallax.min.js','vendors/revolution/js/extensions') ?>"></script>
        <!-- Extra plugin js -->
        <script src="<?php base_url('jquery.magnific-popup.min.js','vendors/popup') ?>"></script>
        <script src="<?php base_url('parallax.min.js','vendors/parallax') ?>"></script>
        <script src="<?php base_url('owl.carousel.min.js','vendors/owl-carousel') ?>"></script>
        <script src="<?php base_url('imagesloaded.pkgd.min.js','vendors/isotope') ?>"></script>
        <script src="<?php base_url('isotope.pkgd.min.js','vendors/isotope') ?>"></script>
        <script src="<?php base_url('animsition.min.js','vendors/animsition/js') ?>"></script>
        <script src="<?php base_url('nav.js','js') ?>"></script>

        <!-- CTAS mobiles js -->
        <script src="<?php base_url('hoverMeJQ.js','js') ?>"></script>


        <!-- Scroll plugin js -->
        
        <script src="<?php base_url('theme.js','js') ?>"></script>

        <!--para videos https://vjs.zencdn.net/7.8.4/video.js-->
        <script src="<?php base_url('video.js','js') ?>"></script>

        <!--Sweet Alert   -->
        <script src="<?php base_url('sweetalert2.all.min.js','js') ?>"></script>

        <script type="text/javascript">

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

            $('a.page-scroll').on('click', function(event) {

    
                var $anchor = $(this);

                var _href= $($anchor).attr('href');

                if(_href.lastIndexOf("#",0) === 0){

                    event.preventDefault();

                    $('html,body').stop().animate({

                      scrollTop: $(_href).offset().top - 70

                    }, 1500, 'easeInOutExpo');
                }
                

            });

            function reload(){

                
                $('html,body').animate({scrollTop:0}, 100);
                window.location.reload();
            }

         
        /*--------------------botão flutuante-----------------*/
        //var xposition = $('#divAnimation').position().top - window.outerHeight + ($('#divAnimation').height());
        //var xposition = 0;
        var position_blog = 0;

        var blogEl = document.getElementById("top-sessao-blog");

        if(blogEl) {

            position_blog = $('#top-sessao-blog').offset().top;

        }

            window.onscroll =function(){


              if(document.documentElement.scrollTop >1100){

                document.querySelector('.go-top-container').classList.add('show');              


              }else{

                document.querySelector('.go-top-container').classList.remove('show');
              }

                if (blogEl) {

                      if(document.documentElement.scrollTop > position_blog){

                        //document.querySelector('.go-top-container').classList.add('show');
                        //document.querySelector('btn-flotante-blog').classList.add('show-mobile-blog');
                        $('#btn-flotante-blog').addClass('show-mobile-blog');
                        //$('#btn-float-blog').show();
                        
                         
                      } else {

                        //document.querySelector('.btn-flotante-blog').classList.remove('show');
                        //$('#btn-float-blog').hide();
                      }
                }


            }

        document.querySelector('.go-top-container').addEventListener('click', function() {

            window.scrollTo({
                top: 0,
                behavior: 'smooth'

            });
        });
        
        
        $('#odonto').on('click', function(){

          //alert('testando');
          console.log('testando');

        });


        function onlynumber(evt) {
             var theEvent = evt || window.event;
             var key = theEvent.keyCode || theEvent.which;
             key = String.fromCharCode( key );
             
             var regex = /^[0-9.]+$/;
             if( !regex.test(key) ) {
                theEvent.returnValue = false;
                if(theEvent.preventDefault) theEvent.preventDefault();
             }
        }       	
        	
        </script>

        <script src="https://webserver.swissdentalservices.com/formularios/form-generator.js"></script>

        <script>
        /**
        *
        * @param {String} id Id do formulário
        * @param {String} cta Texto para o CTA do formulário.
        * @param {String} thanks Thank Page do site, colocar FALSE caso não queira utilizar.
        * @param {Array} extra Array de objetos com campos extras que serão adicionados ao formulário.
        * @param {Array} data Array de objetos com cada campo que existirá no formulário.
        */
        var existForm = document.getElementById("form-fale-connosco-agendar");
        if( existForm ){

            var fid = "form-fale-connosco-agendar";
            var fcta = "<?=contact_botton?>";//"Saber Mais";
            var ftks = "https://pnid.pt/thankpage.php";
            form(fid, fcta, ftks, [{ type: "hidden", name: "origem", value: "LP" }],[
            { type: "form", name: fid, css: "testeform", validate: "true"},
            { type: "hidden", name: "id", value: fid },


            { type: "text", name: "name", value: null, options: null, required: true, css: null, title: '', placeholder: '<?=contact_name?> *', pattern: false },
            { type: "email", name: "email", value: null, options: null, required: true, css: null, title: '', placeholder:'<?=contact_email?> *' },
            { type: "select", name: "q1", value: null,
            options: {
            "": "Selecione",
            "Braga": "Braga",
            "Coimbra": "Coimbra",
            "Leiria": "Leiria",
            "Lisboa": "Lisboa",
            "Porto": "Porto",
            "Portimão": "Portimão",
            "Santarém": "Santarém",
            "Vila Real": "Vila Real",
            "Viseu": "Viseu",
            "Londres": "Londres",
            "Paris": "Paris"
            },
            required: false, css: null, title: "<?=contact_clinicas?>"
            }, {
            type: "phone" ,
            name: "phone",
            prefix: { "PT": "+351", "AT": "+43","BE": "+32", "CH": "+41","DE": "+49", "DK": "+45","ES": "+34","FR": "+33", "GB": "+44","IE": "+353","IT": "+39","LU": "+352","NL": "+31", "NO": "+47","SE": "+46"},
            required: true,
            css: null,
            title: "",
            placeholder:"<?=contact_telefone?> *"
            }, {
            type: "select", name: 'melhor_altura_para_contacto', value: null, options: {"": "Selecione", "manha": "Manhã", "tarde": "Tarde", "noite": "Noite"}, required: false, title: "<?=contact_melhor_altura?>"
            },
            { type: "checkbox", name: "termos", value: "<a href='https://oralswiss.com/termos-e-condicoes' target='blank'><?=contact_termos?></a>", required: true, css: "notice"},
            { type: "submit", name: "", value: fcta , css: null, id: "agende-fale-connosco" }

            ]).start();

        }
        
        </script>

        <script>
        /**
        *
        * @param {String} id Id do formulário
        * @param {String} cta Texto para o CTA do formulário.
        * @param {String} thanks Thank Page do site, colocar FALSE caso não queira utilizar.
        * @param {Array} extra Array de objetos com campos extras que serão adicionados ao formulário.
        * @param {Array} data Array de objetos com cada campo que existirá no formulário.
        */
        var existForm = document.getElementById("form-geral");
        if( existForm ){
            var fid = "form-geral";
            var fcta = "<?=contact_botton?>";//"Saber Mais";
            var ftks = "https://pnid.pt/thankpage.php";
            form(fid, fcta, ftks, [{ type: "hidden", name: "origem", value: "LP" }],[
            { type: "form", name: fid, css: "testeform", validate: "true"},
            { type: "hidden", name: "id", value: fid },


            { type: "text", name: "name", value: null, options: null, required: true, css: null, title: '', placeholder: '<?=contact_name?> *', pattern: false },
            { type: "email", name: "email", value: null, options: null, required: true, css: null, title: '', placeholder:'<?=contact_email?> *' },
            { type: "select", name: "q1", value: null,
            options: {
            "": "Selecione",
            "Braga": "Braga",
            "Coimbra": "Coimbra",
            "Leiria": "Leiria",
            "Lisboa": "Lisboa",
            "Porto": "Porto",
            "Portimão": "Portimão",
            "Santarém": "Santarém",
            "Vila Real": "Vila Real",
            "Viseu": "Viseu",
            "Londres": "Londres",
            "Paris": "Paris"
            },
            required: false, css: null, title: "<?=contact_clinicas?>"
            }, {
            type: "phone" ,
            name: "phone",
            prefix: { "PT": "+351", "AT": "+43","BE": "+32", "CH": "+41","DE": "+49", "DK": "+45","ES": "+34","FR": "+33", "GB": "+44","IE": "+353","IT": "+39","LU": "+352","NL": "+31", "NO": "+47","SE": "+46"},
            required: true,
            css: null,
            title: "",
            placeholder:"<?=contact_telefone?> *"
            }, {
            type: "select", name: 'melhor_altura_para_contacto', value: null, options: {"": "Selecione", "manha": "Manhã", "tarde": "Tarde", "noite": "Noite"}, required: false, title: "<?=contact_melhor_altura?>"
            },
            { type: "checkbox", name: "termos", value: "<a href='https://oralswiss.com/termos-e-condicoes' target='blank'><?=contact_termos?></a>", required: true, css: "notice"},
            { type: "submit", name: "", value: fcta , css: null, id: "agende-fale-connosco" }

            ]).start();
        }
        </script>

    