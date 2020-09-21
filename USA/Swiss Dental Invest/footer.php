<style>
    h3 > span.active {
        color: #EC1C24;
    }
    h3 > span.menu {
        cursor: pointer;
        transition: all .3s;
    }
    h3 > span.menu:hover {
        color: #777;
    }
    h3 > span {
        margin-right: 10px;
    }
    h3 > span + span {
        margin-left: 10px;
    }

    .animationAddress {
        transition: all .3s;
        opacity: 1;
    }

    .animationAddress.faded {
        opacity: 0;
    }
    footer p.detail {
        margin: 10px 0;
    }
    footer a,
    footer p {
        color: #777;
        max-width: 100%;
        font-weight: 400;
        transition: .3s;
        font-size: 18px;    
    }
    footer a:hover {
        color: #fff;
    }
    footer img {
        max-width: 85%;
    }
    .social li {
        display: inline;
    }
    footer .main a {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 15px;
    }
    footer .subordinate a {
        font-size: 16px;
        margin-bottom: 5px;
    }
    footer .col-lg-12.strip {
        margin-top: 80px;
    }
    footer .col-lg-12.strip p {
        font-size: 14px
    }
    footer .contact .contact-form {
        padding: 0px !important;
    }
    footer .p0 {
        padding: 0 !important;
    }
    .information .icon img {
        margin-right: 10px;
        width: 60px;
    }
    @media only screen and (max-width: 961px) {
        .clients a {
            max-width: 50% !important;
        }
        .information .info .item .cont {
            margin-left: 0px !important;
        }
        .information .info .item .icon {
            float: none;
        }
    }
</style>


        <!-- =====================================
        ==== Information -->
        <section class="information bg-img" data-overlay-dark="9" data-background="img/3.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 style="margin: 25px 0 35px;font-size: 24px" class="countryButton"><span data-country="ny" class="menu active"><?=invest_home_pais_five?></span> | 
                        <span data-country="ma" class="menu"><?=invest_home_pais_one?></span> | 
                        <span data-country="uk" class="menu"><?=invest_home_pais_two?></span> | 
                        <span data-country="fr" class="menu"><?=invest_home_pais_three?></span> | 
                        <span data-country="sw" class="menu"><?=invest_home_pais_four?></span>
                    </h3>
                    </div>
                                <?php
                                    echo funGetSlide('invest_home_footer_address','','','
                                    <div class="col-lg-4">
                                        <div class="info">
                                            <div class="item">
                                                <span class="icon"><img src="{{img}}" alt=""></span>
                                                <div class="cont">
                                                    <h6>{{title}}</h6>
                                                    {{subtitle}}
                                                    <p style="opacity: 0">mail</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>');
                                ?>


                </div>
                
            </div>
        </section>
        <!-- Information ====
        ======================================= -->


    	<!-- =====================================
    	==== Start Clients -->
    	<div class="clients bg-gray text-center">
            <div class="container">
                <div class="row" style="display: flex; justify-content: space-between; align-items: center">
                    
                    <a href="https://swissdentalservices.com/" target="blank" style="max-width: 10%"><img style="max-width: 99% !important;" src="img/logo-01.svg" alt=""></a>
                    <a href="https://www.swissdentaleducation.com/" target="blank" style="max-width: 10%"><img style="max-width: 99% !important;" src="img/logo-02.svg" alt=""></a>
                    <a href="http://swissdentalhealthplans.com/" target="blank" style="max-width: 10%"><img style="max-width: 99% !important;" src="img/logo-03.svg" alt=""></a>
                    <a href="https://swissdentalinvest.com/" target="blank" style="max-width: 10%"><img style="max-width: 99% !important;" src="img/logo-04.svg" alt=""></a>
                    <a href="https://www.swissdentaltrips.com/" target="blank" style="max-width: 10%"><img style="max-width: 99% !important;" src="img/logo-05.svg" alt=""></a>
                    <a href="https://swissdentalchannel.com/" target="blank" style="max-width: 10%"><img style="max-width: 99% !important;" src="img/logo-06.svg" alt=""></a>
                    <a href="https://www.adip-us.com/" target="blank" style="max-width: 10%"><img style="max-width: 99% !important;" src="img/logo-07.svg" alt=""></a>
                    <a href="https://www.dinp.co.uk/" target="blank" style="max-width: 10%"><img style="max-width: 99% !important;" src="img/logo-08.svg" alt=""></a>
                    <a href="https://meid-center.com/" target="blank" style="max-width: 10%"><img style="max-width: 99% !important;" src="img/logo-09.svg" alt=""></a>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    	<!-- End Clients ====
    	======================================= -->


    	<!-- =====================================
    	==== Start Footer -->
    	<footer class="text-center">
            <div class="container" style="display:flex;justify-content: space-between;align-items: baseline;flex-wrap: wrap">

                <div class="col-lg-3 text-left">

                    <!-- Logo -->
                    <a class="logo" href="https://swissdentalinvest.com">
                        <img src="img/logo-white.svg" alt="logo">          
                    </a>

                    <p class="detail"><?=logo_footer_suport?></p>

                    <div class="social">
                        <ul class="social">
                            <li><a target="blank" href="https://www.facebook.com/SWISSDENTALINVESTPT/"><i class="fab fa-facebook"></i></a></li>
                            <li><a target="blank" href="https://www.instagram.com/sd.invest/"><i class="fab fa-instagram"></i></a></li>
                            <li><a target="blank" href="https://twitter.com/SDINVESTPT"><i class="fab fa-twitter"></i></a></li>
                            <li><a target="blank" href="https://linkedin.com/company/swissdentalinvestportugal"><i class="fab fa-linkedin"></i></a></li>
                            <li><a target="blank" href="https://www.youtube.com/channel/UC0_CjgkRc0WyAtUKXEv-fJw"><i class="fab fa-youtube"></i></a></li>
                        </ul>
                    </div>

                </div>
                <div class="col-lg-3 text-left">
                    <ul>
                        <li class="main">
                            <a target="blank" href="#"><?=financial_links?></a>
                        </li>
                        <!-- MENU menu-footer -->
                        <li class="subordinate">
                            <a target="blank" href="https://www.bloomberg.com">Bloomberg</a>
                        </li>
                        <li class="subordinate">
                            <a target="blank" href="https://www.reuters.com">Reuters</a>
                        </li>
                        <li class="subordinate">
                            <a target="blank" href="https://www.londonstockexchange.com">London Stock Exchange</a>
                        </li>
                        <li class="subordinate">
                            <a target="blank" href="https://live.euronext.com/fr">Euronext</a>
                        </li>
                        <li class="subordinate">
                            <a target="blank" href="https://www.nyse.com/index">NYSE</a>
                        </li>
                        <li class="subordinate">
                            <a target="blank" href="https://www.reit.com">REIT</a>
                        </li>
                        <li class="subordinate">
                            <a target="blank" href="https://edition.cnn.com/business">CNN Financial</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 text-left">
                    <ul>
                        <li class="main">
                            <a target="blank" href="#"><?=suporte_one?></a>
                        </li>
                        <!-- MENU menu-footer -->
                        <li class="subordinate">
                            <a target="blank" href="https://swissdentalservices.com/glossario-saude-oral.php"><?=suporte_two?></a>
                        </li>
                        <!-- MENU menu-footer -->
                        <li class="subordinate">
                            <a target="blank" href="https://swissdentalservices.com/marcas-swiss-dental-services.php"><?=suporte_three?></a>
                        </li>
                        <li class="subordinate">
                            <a target="blank" href="https://swissdentalservices.com/recrutamento.php"><?=suporte_four?></a>
                        </li>
                        <li class="subordinate">
                            <a target="blank" href="https://swissdentalservices.com/formacao.php"><?=suporte_five?></a>
                        </li>
                        <li class="subordinate">
                            <a target="blank" href="https://swissdentalservices.com/termos-condicoes.php"><?=suporte_six?></a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 text-left contact">

                    <p class="detail"><b>Newsletter</b></p>
                    <div class="contact-form">
                        <form class="form" id="contact-form" method="post" action="contact.php" novalidate="true">

                                <div class="col-md-12 p0">
                                    <div class="form-group">
                                        <input id="form_email" type="email" name="email" placeholder="Email" required="required">
                                    </div>
                                </div>

                                <div class="col-md-12 p0">
                                    <button type="submit" class="disabled"><span><?=send_button?></span></button>
                                </div>
                                
                        </form>
                    </div>
                </div>

                <div class="col-lg-12 strip">

                    <p><?=allrights?></p>

                </div>

            </div>
        </footer>
    	<!-- End Footer ====
    	======================================= -->


      	<!-- custom scripts -->
        <script src="js/address.js"></script>

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