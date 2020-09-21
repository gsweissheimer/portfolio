        <?php
            require_once 'includes/generateAllInfo.php';
            include('header.php');
        ?>
        
    	<!-- ====== Header ======  -->
		<section id="home" class="min-header bg-img" data-scroll-index="0" data-overlay-dark="7" data-background="img/sm_banner_1.jpg" data-stellar-background-ratio="0.5">
			<div class="container-fluid">
				<div class="row">
					<div class="v-middle mt-30">
						<div class="text-center col-md-12">
							<h5><?=invest_sm_banner_ti?><br><?=invest_sm_banner_tle?></h5>
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
                    <div class="offset-lg-2 col-lg-8 text-center">
                        <h4 class="extra-text blueMoon"><span><?=invest_sm_second_ti?></span> <?=invest_sm_second_tle?></h4>
                        <p><?=invest_sm_second_text?></p>
                    </div>
                </div>
            </div>






            <div class="feat bg-gray pt-80 pb-50 mt-80">
                <div class="container">
                    <div class="row">
                        <?php
                            echo funGetSlide('invest_sm_second','','','
                            <div class="col-lg-4">
                                <div class="item">
                                    <span class="icon">
                                        <img src="{{img}}" alt="">
                                    </span>
                                    <h6 style="color: #ec1c24">{{title}}</h6>
                                    {{subtitle}}
                                </div>
                            </div>');
                         ?>

                    </div>

                    <div class="order" style="text-align: center">
                        <a href="#0" class="butn butn-bg" data-scroll-nav="6">
                            <span><?=invest_now?></span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Hero ====
        ======================================= -->


        <!-- =====================================
        ==== Start Quote -->
        <div class="quote bg-img section-padding" data-overlay-dark="7" data-background="img/sm_banner_2.jpg" data-scroll-index="1">
            <div class="container">
                <div class="row">
                    <div class="offset-lg-2 col-lg-8 text-center">
                        <p><?=invest_sm_quote?></p>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- End Quote ====
        ======================================= -->

    	<!-- =====================================
    	==== Start Hero -->
        <section class="hero section-padding pb-0" data-scroll-index="1">
            <div class="container">
                <div class="row">

                    <div class="col-lg-7">
                        <div class="mission">

                            <div class="section-head mb-30">
                                <h4 class="blueMoon"><span><?=invest_sm_fourth_ti?></span><br>
                                    <?=invest_sm_fourth_tle?>
                                </h4>
                            </div>
                            <?php
                                echo funGetAdvancedBanners('invest_sm_fourth', '
                                <p>{{subtext}}</p>
                                <p>{{subtitle}}</p>
                                <p>{{text}}</p>');
                            ?>



                            <a href="#0" class="butn butn-bg" data-scroll-nav="6">
                                <span><?=invest_start_now?></span>
                            </a>

                        </div>
                    </div>

                    <div class="col-lg-5">
                        <img src="img/sm_banner_4.png" alt="">
                    </div>

                </div>
            </div>
        </section>
    	<!-- End Hero ====
    	======================================= -->

    	<!-- =====================================
    	==== Start Portfolio -->
        <section class="portfolio section-padding pattern" data-scroll-index="2">
            <div class="container">
                <div class="row">
                    
                    <div class="section-head col-sm-12">
                        <h4 class="blueMoon">
                            <span><?=invest_sm_fifth_ti?></span><br>
                            <?=invest_sm_fifth_tle?>
                        </h4>
                    </div>

                    <!-- filter links -->
                    <div class="filtering col-sm-12">
                        <span data-filter='*' class="active"><?=invest_sm_fifth_all?></span>
                        <?php
                            echo funGetSlide('invest_sm_paises','','','<span data-filter=".{{text}}">{{title}}</span>');
                         ?>


                    </div>

                    

                    <div class="clearfix"></div>

                    <!-- gallery -->
                    <div class="gallery text-center full-width">
                        <?php
                            echo funGetSlide('invest_sm_paises','','','
                            <div class="col-md-4 items {{text}}">
                                <div class="item-img">
                                    <img src="{{img}}" alt="image">
                                </div>
                            </div>');
                         ?>



                        <div class="clear-fix"></div>

                    </div>

                </div>
            </div>
        </section>
    	<!-- End Portfolio ====
    	======================================= -->

        <!-- =====================================
        ==== Start Services Tabs -->
        <section class="serv-tabs section-padding bg-img" data-overlay-dark="7" data-background="img/sm_banner_3.jpg" data-scroll-index="3">
            <div class="container">
                <div class="row">
                    
                     <div class="section-head col-sm-12">
                        <h4>
                            <span><?=invest_sm_double_ti?></span><br>
                            <?=invest_sm_double_tle?>
                        </h4>
                    </div>

                    <div class="tabs col-sm-12">
                        <div class="content">
                          
                            <div id="tab-1-content" class="tab-item curent">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="item bord">
                                            <p><?=invest_mercado_tab_one_first?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="item spcial">
                                            <p><?=invest_mercado_tab_one_second?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="tab-2-content" class="tab-item">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="item bord">
                                            <p><?=invest_mercado_tab_two_first?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="item spcial">
                                            <p><?=invest_mercado_tab_two_second?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div id="tab-3-content" class="tab-item">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="item bord">
                                            <p><?=invest_mercado_tab_three_first?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="item spcial">
                                            <p><?=invest_mercado_tab_three_second?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="tab-4-content" class="tab-item">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="item bord">
                                            <p><?=invest_mercado_tab_four_first?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="item spcial">
                                            <p><?=invest_mercado_tab_four_second?>/</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-12" style="text-align: center;margin: 50px 0">
                                        
                                        <iframe width="560" height="315" src="https://www.youtube.com/embed/<?=invest_mercado_tab_four_youtube?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="tabs-icon row">

                            <div id="tab-1" class="col-md-3 col-sm-6 active item">
                                <div>
                                    <span class="iconn">
                                        <img src="img/icons/missval.svg" alt="">
                                    </span>
                                    <h6><?=invest_mercado_tab_one_tag?></h6>
                                </div>
                            </div>

                            <div id="tab-2" class="col-md-3 col-sm-6 item">
                                <div>
                                    <span class="iconn">
                                        <img src="img/icons/cresc.svg" alt="">
                                    </span>
                                    <h6><?=invest_mercado_tab_two_tag?></h6>
                                </div>
                            </div>

                            <div id="tab-3" class="col-md-3 col-sm-6 item">
                                <div>
                                    <span class="iconn">
                                        <img src="img/icons/trat.svg" alt="">
                                    </span>
                                    <h6><?=invest_mercado_tab_three_tag?></h6>
                                </div>
                            </div>

                            <div id="tab-4" class="col-md-3 col-sm-6 item">
                                <div>
                                    <span class="iconn">
                                        <img src="img/icons/preocusoc.svg" alt="">
                                    </span>
                                    <h6><?=invest_mercado_tab_four_tag?></h6>
                                </div>
                            </div>
            
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- End Services Tabs ====
        ======================================= -->


        <!-- =====================================
        ==== Start Contact -->
        <?php
            include('section_contact.php');
            //include('footer.html');
        ?>
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

    </body>
</html>




