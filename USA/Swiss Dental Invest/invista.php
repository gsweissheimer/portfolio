        <?php
            require_once 'includes/generateAllInfo.php';
            include('header.php');
        ?>
        
		<!-- ====== Header ======  -->
		<section id="home" class="min-header bg-img" data-scroll-index="0" data-overlay-dark="5" data-background="img/banner-invista.jpg" data-stellar-background-ratio="0.5">
			<div class="container-fluid">
				<div class="row">
					<div class="v-middle mt-30">
						<div class="text-center col-md-12">
							<!--<h5>INVISTA</h5>
							<div class="path">
								<span><a href="#0">Home</a></span>
								<span><a href="#0">Blog</a></span>
								<span><a href="#0">WordPress</a></span>
								<span>Top WordPress Themes and Plugins for Hotels</span>
							</div>-->
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- ====== End Header ======  -->


    	<!-- =====================================
    	==== Start Hero -->
        <section class="hero section-padding pb-0 pattern-50" data-scroll-index="1">
            <div class="container pt-80 pb-80">
                <div class="row">

                    <div class="col-lg-6">
                        <div class="mission">

                            <div class="section-head mb-30">
                                <h4 style="color: #2B4258"><span></span><br>
                                    <?=invest_invista_second_tle?>
                                </h4>
                            </div>
                            <?php
                                echo funGetAdvancedBanners('invest_invista_second', '
                                <p>{{title}}</p>
                                <p>{{subtitle}}</p>
                                <p>{{text}}</p>
    
    
                            </div>
                        </div>
    
                        <div class="col-lg-5">
                            <img src="{{img}}" alt="">
                        </div>');
                            ?>


                </div>
            </div>
            
            <div class="container">
                <div class="row">


                    <?php
                        echo funGetSlide('invest_invista_two','','','
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

                <div class="order" style="text-align: center; padding-bottom: 50px">
                    <a href="mercado.php" class="butn butn-bg">
                        <span><?=invest_invista_know_oport?></span>
                    </a>
                </div>
            </div>
        </section>
    	<!-- End Blog ====
        ======================================= -->


    	<!-- =====================================
    	==== Start Price -->
    	<section class="price section-padding bg-gray" data-scroll-index="4" style="padding: 60px 0 !important">
            <div class="container">
                <div class="row">
                    
                    <div class="section-head col-sm-12">
                        <h4 class="blueMoon">
                            <span></span><br>
                            <?=invest_invista_three_tle?>
                        </h4>
                    </div>

                    <?php
                        echo funGetSlide('invest_invista_three','','','
                            <div class="col-lg-4">
                                <div class="item text-center mb-md50">
        
                                    <div class="type noMargin">
                                        <span class="icon"><i class="icofont icofont-rocket-alt-2"></i></span>
                                        <h4 class="blueMoon" style="text-transform: uppercase;">{{title}}</h4>
                                    </div>
                                    <div class="features" style="padding: 15px 30px 0 !important;">
                                        <ul class="noMargin">
                                            <li class="noMargin">{{text}}</li>
                                        </ul>
                                    </div>
        
                                </div>
                            </div>');
                        ?>

                </div>

                <div class="order" style="text-align: center">
                    <a href="https://swissdentalinvest.com/mercado.php" class="butn butn-bg">
                        <span><?=invest_invista_know_market?></span>
                    </a>
                </div>
            </div>
        </section>
    	<!-- End Price ====
    	======================================= -->


    	<!-- =====================================
    	==== Start Services -->
        <section class="services section-padding pb-70" data-scroll-index="3">
            <div class="container">
                <div class="row">
                    
                    <div class="section-head col-sm-12">
                        <h4 class="blueMoon">
                            <span></span><br>
                            <?=invest_invista_fourth_tle?>
                        </h4>
                    </div>
                        <?php
                            echo funGetSlide('invest_invista_fourth','','','

                            <div class="col-lg-4 col-md-6">
                                <div class="item">
                                    <span class="icon"><img src="{{img}}" alt=""></span>
                                    <h6 class="blueMoon">{{title}}</h6>
                                    <p>{{text}}</p>
                                </div>
                            </div>');
                         ?>


                </div>
            </div>
        </section>
    	<!-- End Services ====
    	======================================= -->


    	<!-- =====================================
    	==== Start Numbers -->
        <div class="numbers section-padding bg-img" data-overlay-dark="6" data-background="img/invista_numbers.jpg">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6">
                        <div class="item text-center mb-md50">
                            <h2><span class="count">98</span>%</h2>
                            <h6><?=invest_invista_fifth_one?></h6>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="item text-center mb-md50">
                            <h2><span class="count">22</span>%</h2>
                            <h6><?=invest_invista_fifth_two?></h6>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="item text-center mb-sm50">
                            <h2><span class="count" style="margin-right: 10px;">5</span><?=invest_invista_sixthh_years?></h2>
                            <h6><?=invest_invista_fifth_trhee?></h6>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="item text-center">
                            <h2><span class="count">350.000</span>€</h2>
                            <h6><?=invest_invista_fifth_four?></h6>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    	<!-- End Numbers ====
    	======================================= -->


    	<!-- =====================================
    	==== Start Hero -->
        <section class="hero section-padding pb-0 graphic_trigger" data-scroll-index="1">
            <div class="container pb-80">
                <div class="row">
                    
                    <div class="section-head col-sm-12 graphic_triger">
                        <h4 class="blueMoon">
                            <span><?=invest_invista_sixthh_ti?></span><br>
                            <?=invest_invista_sixthh_tle?>
                        </h4>
                    </div>

                    <div class="col-lg-6">  


                        <p><?=invest_invista_sixthh_three?></p>

                    </div>

                    <div class="col-lg-6">
                        <p><?=invest_invista_sixthh_two?></p>
                        <p><?=invest_invista_sixthh_one?></p>
                    </div>

                    <div class="col-lg-5" style="display: flex;justify-content: space-around;align-items:baseline; flex-wrap: wrap;margin-top: 80px">

                            <div class="box" style="margin-bottom: 50px; position: relative">
                                <h3 class="button" style="cursor: pointer;"><span class="btnAnm">></span><h3 id="value"></h3></h3>
                                <div class="dropdown">
                                    <h4 class="selectAmount hidedd" id="350">350.000,00€</h4>
                                    <h4 class="selectAmount " id="500">500.000,00€</h4>
                                    <h4 class="selectAmount " id="750">750.000,00€</h4>
                                    <h4 class="selectAmount " id="1000">1.000.000,00€</h4>
                                </div>
                                
                                
                            </div>
        
                            <div class="box">
                                <div class="mb-md50">
                                    <img src="img/icon-2.svg" alt="">
                                    <h5><span id="gain" style="font-weight: 900;"></span><br><?=invest_invista_sixthh_return?><br><?=invest_invista_sixthh_per_year?></h5>
                                </div>
                            </div>
        
                            <div class="box">
                                <div class="mb-md50">
                                    <img src="img/icon-1.svg" alt="">
                                    <h5><span class="count" style="font-weight: 900;">5</span><?=invest_invista_sixthh_years?></h5>
                                </div>
                            </div>
                            
                    </div>

                    <div class="col-lg-7 chartDiv">
                        
                        <img class="chartEl" src="" alt="">
                        
                        <img class="chartPngEl" src="" alt="">

                    </div>

                    <div class="col-lg-12 desktop-only">
                        <table class="table">
                            <thead>
                                <tr>
                                    <?php
                                        echo funGetAdvancedBanners('invest_invista_table_one', '
                                        <th>{{title}}</th>
                                        <th>{{subtitle}}</th>
                                        <th>{{text}}</th>
                                        <th>{{subtext}}</th>
                                        <th>{{callTitle}}</th>
                                        <th>{{callAction}}</th>');
                                    ?>
                                    <?php
                                        echo funGetAdvancedBanners('invest_invista_table_two', '
                                        <th>{{title}}</th>
                                        <th>{{subtitle}}</th>
                                        <th>{{text}}</th>
                                        <th>{{subtext}}</th>');
                                    ?>
                                </tr>
                            </thead>
                            <tbody id="tBody">
                            
                            </tbody>
                        </table>

                    </div>

                    <div class="col-lg-12 mobileOnly">
                        <table class="table">
                            <tbody id="tBodyMob">
                            </tbody>
                        </table>
                        

                    </div>

                </div>
            </div>
        </section>
    	<!-- End Hero ====
    	======================================= -->


    	<!-- =====================================
    	==== Start Hero -->
        <section class="hero section-padding pb-0" data-scroll-index="1" style="padding-top: 0px">
            <div class="container pb-80">
                <div class="row">

                    <div class="col-lg-6">
                        <div class="mission">

                            <div class="section-head mb-30">
                                <h4 style="color: #2B4258"><span><?=invest_invista_seventh_ti?></span><br>
                                    <?=invest_invista_seventh_tle?>
                                </h4>
                            </div>
                            <?php
                                echo funGetAdvancedBanners('invest_invista_seventh', '
                                            <p>{{title}}</p>

                                            <p>{{subtitle}}</p>
                                            
                                            <p>{{text}}</p>
                                            
                                            <p><b>
                                                {{subtext}}
                                            </b></p>


                                    </div>
                                </div>

                                <div class="col-lg-5">
                                    <img src="{{img}}" alt="">
                                </div>');
                            ?>


                </div>
            </div>
        </section>
    	<!-- End Hero ====
    	======================================= -->


        <!-- =====================================
        ==== Start Quote -->
        <div class="quote bg-img section-padding" data-overlay-dark="8" data-background="img/banner_eight.jpg" data-scroll-index="1">
            <div class="container">
                <div class="row">
                    <div class="offset-lg-2 col-lg-8 text-center">
                        <p><?=invest_invista_quote?></p>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- End Quote ====
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

        <!-- Map -->
        <script src="js/map.js"></script>

      	<!-- validator js -->
      	<script src="js/validator.js"></script>

      	<!-- custom scripts -->
        <script src="js/scripts.js"></script>

        <!-- graphics_animations -->
      <script src="js/graphics_animations.js"></script>

    </body>
</html>
