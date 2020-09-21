        <?php
            require_once 'includes/generateAllInfo.php';
            include('header.php');
        ?>
        
		<!-- ====== Header ======  -->
		<section id="home" class="min-header bg-img" data-scroll-index="0" data-overlay-dark="5" data-background="img/banner-mercado.jpg" data-stellar-background-ratio="0.5">
			<div class="container-fluid">
				<div class="row">
					<div class="v-middle mt-30">
						<div class="text-center col-md-12">
                            
                        
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- ====== End Header ======  -->
        
    	<!-- =====================================
    	==== Start Hero -->
        <section class="hero section-padding pb-0" data-scroll-index="1">
            <div class="container">
                <div class="row">
                    <div class="offset-lg-2 col-lg-8 text-center mb-80">
                        <?php
                            echo funGetAdvancedBanners('invest_mercado_second', '

                                <h4 class="extra-text blueMoon"><span style="font-weight: 700;">{{callTitle}}</span> {{callAction}}</h4>
                                {{title}}
                                {{subtitle}}
                                <p>{{text}}</p>
        
                                <div class="order" style="text-align: center">
                                    <a href="#0" class="butn butn-bg" data-scroll-nav="6">
                                        <span>{{subtext}}</span>
                                    </a>
                                </div>
                            </div>');
                         ?>
                         <?php
                             echo funGetSlide('invest_mercado_third','','','
                             <div class="col-lg-4">
                                 <div class="item text-center mb-md50">
                                     <div class="post-img">
                                         <img src="{{img}}" alt="">
                                     </div>
                                     <div class="content">
                                         <h5 class="blueMoon"><a href="#0">{{title}}</a></h5>
                                         <p>{{text}}</p>
                                     </div>
                                 </div>
                             </div>');
                          ?>



                </div>
            </div>
        </section>
    	<!-- End Hero ====
    	======================================= -->

        <!-- =====================================
        ==== Start Quote -->
        <div class="quote bg-img section-padding" data-overlay-dark="8" data-background="img/mercado_banner_4.jpg" data-scroll-index="1">
            <div class="container">
                <div class="row">
                    <div class="offset-lg-2 col-lg-8 text-center">
                        <p><?=invest_mercado_quote?></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Quote ====
        ======================================= -->

    	<!-- =====================================
    	==== Start Hero -->
        <section class="hero section-padding pb-0 bottompattern" data-scroll-index="1">
            <div class="container">
                <div class="row">

                    <div class="col-lg-5">
                        <div class="mission">

                            <div class="section-head mb-30">
                                <h4 class="blueMoon"><span><?=invest_mercado_fourth_up?></span><br>
                                    <div style="font-weight: 700;"><?=invest_mercado_fourth_down?></div>
                                </h4>
                            </div>
                        <?php
                            echo funGetAdvancedBanners('invest_mercado_second', '
                            <p>{{title}}</p>
                            <p>{{subtitle}}</p>
                            <p>{{text}}</p>');
                         ?>



                            <a href="https://swissdentalinvest.com/saiba-mais.php" class="butn butn-bg">
                                <span><?=invest_mercado_know_more?></span>
                            </a>

                        </div>
                    </div>

                    <div class="col-lg-5 offset-lg-1">
                        <div class="skills">

                            <div class="prog-item">
                                <div class="skills-progress"><span data-percent='20%' data-value='<?=invest_mercado_chart_acoes?>'></span></div>
                            </div>
                            <div class="prog-item">
                                <div class="skills-progress"><span data-percent='70%' data-value='<?=invest_mercado_chart_sdi?>'></span></div>
                            </div>
                            <div class="prog-item">
                                <div class="skills-progress"><span data-percent='25%' data-value='<?=invest_mercado_chart_imob?>'></span></div>
                            </div>
                            <div class="prog-item">
                                <div class="skills-progress"><span data-percent='15%' data-value='<?=invest_mercado_chart_ethic?>'></span></div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>
    	<!-- End Hero ====
    	======================================= -->

    	<!-- =====================================
    	==== Start Hero -->
        <section class="hero section-padding pb-0 pattern"  data-scroll-index="1">
            <div class="container">
                <div class="row">
                    <div class="offset-lg-2 col-lg-8 text-center mb-60">
                        <h4 class="extra-text blueMoon"><?=invest_mercado_fifth_ti?><div style="font-weight: 700;display: contents;"> <?=invest_mercado_fifth_tle?></div></h4>
                        <?php
                            echo funGetAdvancedBanners('invest_mercado_fifth_text', '
                            <p>{{title}}</p>
                            <p>{{subtitle}}</p>');
                         ?>
                    </div>

                    <div class="market_chart graphic_trigger desktop-only mb-80">
                    
                        <img style="mix-blend-mode: multiply;" class="chartGif" src="">
                        <img style="mix-blend-mode: multiply;" class="chartPng" src="img/graficos/<?=varaibleLang?>/grafico_dados.png">
                        <img style="mix-blend-mode: multiply;width: 100%;"  class="mobileOnly" src="img/grafico_dados_mob.png" alt="">
                        
                    </div>
                    
                    <div class="col-lg-12 mobileOnly">
                    
                        <img style="mix-blend-mode: multiply;width: 100%;" src="img/grafico_dados_mob.png" alt="">
                        
                    </div>

                </div>
            </div>
        
            
            <div class="container pt-80 pb-80">
                <div class="row">

                    <div class="col-lg-6">
                        <div class="mission">

                            <div class="section-head mb-30">
                                <h4 style="color: #2B4258"><span><?=invest_mercado_sixth_ti?></span><br>
                                <?=invest_mercado_sixth_tle?>
                                </h4>
                            </div>
                                <?php
                                    echo funGetAdvancedBanners('invest_mercado_sixth_text', '
                                    <p>{{text}}</p>
                                    <p>{{subtext}}</p>');
                                ?>

                            

                            <a href="https://swissdentalinvest.com/saiba-mais.php" class="butn butn-bg">
                                <span><?=invest_mercado_know_more?></span>
                            </a>

                        </div>
                    </div>

                    <div class="col-lg-5">
                        <img style="mix-blend-mode: multiply;" src="img/mercado_banner_5.jpg" alt="">
                    </div>

                </div>
            </div>
        </section>
    	<!-- End Hero ====
    	======================================= -->

    	<!-- =====================================
    	==== Start Numbers -->
        <div class="numbers section-padding bg-img" data-overlay-dark="6" data-background="img/mercado_banner_6.jpg">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6">
                        <div class="item text-center mb-md50">
                            <h2>U$ <div class="count">37</div><?=invest_mercado_numbers_one?></h2>
                            <h6><?=invest_mercado_numbers_two?></h6>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="item text-center mb-md50">
                            <h2>+<div class="count">50</div>%</h2>
                            <h6><?=invest_mercado_numbers_three?></h6>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="item text-center">
                            <h2>U$ <div class="count">8,18</div><?=invest_mercado_numbers_one?></h2>
                            <h6><?=invest_mercado_numbers_four?></h6>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="item text-center mb-sm50">
                            <h2><div class="count">7,9</div>%</h2>
                            <h6><?=invest_mercado_numbers_five?></h6>
                        </div>
                    </div>

                    			 			

                </div>
            </div>
        </div>
    	<!-- End Numbers ====
    	======================================= -->

    	<!-- =====================================
    	==== Start Hero -->
        <section class="hero section-padding pb-0" data-scroll-index="1">
            <div class="container pt-80 pb-80">
                <div class="row">

                    <div class="col-lg-6">
                        <div class="mission">

                            <div class="section-head mb-30">
                                <h4 style="color: #2B4258"><span><?=invest_home_last_op?></span><br>
                                    <?=invest_home_last_down?>
                                </h4>
                            </div>
                        <?php
                            echo funGetAdvancedBanners('invest_mercado_last', '
                            <p>{{title}}</p>
                            <p>{{subtitle}}</p>
                            <p>{{text}}</p>

                            <a href="{{callAction}}" class="butn butn-bg">
                                <span>{{callTitle}}</span>
                            </a>');
                         ?>


                        </div>
                    </div>

                    <div class="col-lg-5">
                        <img src="<?=mercado_banner_sette?>" alt="">
                    </div>

                </div>
            </div>
        </section>
    	<!-- End Hero ====
    	======================================= -->

        <!-- =====================================
        ==== Start Contact -->
        <section class="contact" data-scroll-index="6">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 contact-form">
                        <form class="form" id="contact-form" method="post" action="contact.php">

                            <div class="messages"></div>

                            <div class="controls">

                                <div class="row">
                                    <?php
                                        echo funGetAdvancedBanners('invest_contact', '
                                        <div class="section-head col-sm-12">
                                            <h4 style="color: #2B4258">
                                                <span>{{title}}</span><br>
                                                {{subtitle}}
                                            </h4>
                                        </div>');
                                    ?>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input id="form_name" type="text" name="name" placeholder="Nome" required="required">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input id="form_subject" type="text" name="subject" placeholder="Telefone">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input id="form_email" type="email" name="email" placeholder="Email" required="required">
                                        </div>
                                    </div>

                                    <div class="col-md-12 text-center">
                                        <button type="submit"><span>Enviar</span></button>
                                    </div>

                                </div>                             
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Contact ====
        ======================================= -->

        <?php
            include('footer.php');
            //include('footer.html');
        ?>

        <!-- jQuery -->
		<script src="js/jquery-3.0.0.min.js"></script>
		<script src="js/jquery-migrate-3.0.0.min.js"></script>

		<!-- popper.min -->
		<script src="js/popper.min.js"></script>

	  	<!-- bootstrap -->
		<script src="js/bootstrap.min.js"></script>

		<!-- scrollIt -->
		<script src="js/scrollIt.min.js"></script>

		<!-- animated.headline -->
		<script src="js/animated.headline.js"></script>

		<!-- jquery.waypoints.min -->
		<script src="js/jquery.waypoints.min.js"></script>

		<!-- jquery.counterup.min -->
		<script src="js/jquery.counterup.min.js"></script>

		<!-- owl carousel -->
		<script src="js/owl.carousel.min.js"></script>

		<!-- jquery.magnific-popup js -->
		<script src="js/jquery.magnific-popup.min.js"></script>

		<!-- stellar js -->
		<script src="js/jquery.stellar.min.js"></script>

      	<!-- isotope.pkgd.min js -->
      	<script src="js/isotope.pkgd.min.js"></script>

        <!-- YouTubePopUp.jquery -->
        <script src="js/YouTubePopUp.jquery.js"></script>

      	<!-- validator js -->
      	<script src="js/validator.js"></script>

      	<!-- custom scripts -->
        <script src="js/scripts.js"></script>

        <!-- graphics_animations -->
      <script src="js/graphics_animations_market.js"></script>

    </body>
</html>




