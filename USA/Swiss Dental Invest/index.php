        <?php
            require_once 'includes/generateAllInfo.php';
            include('header.php');
        ?>

    	<!-- =====================================
    	==== Start Header -->
    	<header class="header valign bg-img" data-scroll-index="0" data-overlay-dark="8" data-background="img/bg.jpg" data-stellar-background-ratio="0.5">
    		<div class="container">
    			<div class="row">
    				<div class="full-width text-center caption mt-30">
                        <?php
                            echo funGetAdvancedBanners('invest_home_banner', '
                            <h3>{{title}}</h3>
                            <h1 class="cd-headline clip">
                                <span class="blc">{{subtitle}}</span>
                                <span class="cd-words-wrapper">');
                            echo funGetSlide('invest_home_banner','','','<b class="{{text}}">{{title}}</b>');
                            echo funGetAdvancedBanners('invest_home_banner', '</span>
                            </h1>
                            <p>{{text}}</p>
                            <a href="#0" class="butn butn-bord" data-scroll-nav="6">
                                <span>{{subtext}}</span>
                            </a>
                            <a href="{{callAction}}" class="butn butn-bg">
                                <span><p>{{callTitle}}</p></span>
                            </a>');
                         ?>
    				</div>
    			</div>
    		</div>

    		<div class="arrow">
				<a href="#" data-scroll-nav="1">
					<i class="fas fa-chevron-down"></i>
				</a>
			</div>
    	</header>
    	<!-- End Header ====
    	======================================= -->

    	<!-- =====================================
    	==== Start Hero -->
        <section class="hero section-padding pb-0 pattern" data-scroll-index="1">

            <div class="container-fluid">

                <div class="container">

                    <div class="row">
                        
                        <div class="offset-lg-2 col-lg-8 text-center">
                            <?php
                                echo funGetAdvancedBanners('invest_home_second', '

                                <h4 class="extra-text" style="color: #2B4258"><span>{{title}}</span></h4>
    
                                <p>{{subtitle}}</p>');
                            ?>
                        
                        </div>

                    </div>

                </div>

                <div class="row">

                    <div style="width: 100%" class="feat bg-gray pt-80 pb-50 mt-80">
                        <div class="container">
                            <div class="row">
                                <?php
                                    echo funGetSlide('invest_home_second','','','
                                    <div class="col-lg-4">
                                        <div class="item">
                                            <span class="icon"><img src="{{img}}" alt=""></span>
                                            <h6 style="color: #ec1c24">{{title}}</h6>
                                            <p>{{subtitle}}</p>
                                        </div>
                                    </div>');
                                ?>
        
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="container pt-80 pb-80">
                <div class="row">
                    <?php
                        echo funGetAdvancedBanners('invest_home_third', '

                        <div class="col-lg-6">
                            <div class="mission">
    
                                <div class="section-head mb-30">
                                    <h4 style="color: #2B4258"><span>{{title}}</span><br>
                                        {{subtitle}}
                                    </h4>
                                </div>
    
                                <p>{{text}}</p>
    
                                <a href="{{callAction}}" class="butn butn-bg">
                                    <span>{{callTitle}}</span>
                                </a>
    
                            </div>
                        </div>
    
                        <div class="col-lg-5">
                            <img src="{{img}}" alt="">
                        </div>');
                    ?>

                </div>
            </div>
            <div class="container pt-80 pb-80">
                <div class="row">
                    <?php
                        echo funGetAdvancedBanners('invest_home_third_right', '
    
                        <div class="col-lg-5">
                            <img src="{{img}}" alt="">
                        </div>

                        <div class="col-lg-6">
                            <div class="mission">
    
                                <div class="section-head mb-30">
                                    <h4 style="color: #2B4258"><span>{{title}}</span><br>
                                        {{subtitle}}
                                    </h4>
                                </div>
    
                                <p>{{text}}</p>
    
                                <a href="{{callAction}}" class="butn butn-bg">
                                    <span>{{callTitle}}</span>
                                </a>
    
                            </div>
                        </div>');
                    ?>

                </div>
            </div>
        </section>
    	<!-- End Hero ====
    	======================================= -->

        <!-- =====================================
        ==== Start Services Tabs -->
        <section class="serv-tabs section-padding bg-img" data-overlay-dark="7" data-background="img/4.jpg" data-scroll-index="3">
            <div class="container">
                <div class="row">
                    
                     <div class="section-head col-sm-12">
                        <h4>
                            <span><?=invest_home_fourth_ti?></span><br>
                            <?=invest_home_fourth_tle?>
                        </h4>
                    </div>

                    <div class="tabs col-sm-12">

                        <div class="content">
                                <div id="tab-1-content" class="tab-item curent">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="item bord">
                                                <p><?=tab_one_one?></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="item spcial">
                                                <p><?=tab_one_two?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab-2-content" class="tab-item">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="item bord">
                                                <p><?=tab_two_one?></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="item spcial">
                                                <p><?=tab_two_two?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab-3-content" class="tab-item">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="item bord">
                                                <p><?=tab_three_one?></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="item spcial">
                                                <p><?=tab_three_two?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab-4-content" class="tab-item">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="item bord">
                                                <p><?=tab_four_one?></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="item spcial">
                                                <p><?=tab_four_two?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        </div>

                        <div class="tabs-icon row">
                            <?php
                                echo funGetSlide('invest_home_fourth_icons','','','
                                <div id="{{ctaTitle}}" class="col-md-3 col-sm-6 {{callAction}} item">
                                    <div>
                                        <span class="iconn"><img src="{{img}}" alt=""></span>
                                        <h6>{{title}}</h6>
                                    </div>
                                </div>');
                            ?>

            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Services Tabs ====
        ======================================= -->

    	<!-- =====================================
    	==== Start Blog -->
    	<section class="blog section-padding" data-scroll-index="5">
            <div class="container">
                <div class="row">

                    <div class="section-head col-sm-12">
                        <h4 style="color: #2B4258">
                            <span><?=invest_home_blog_up?></span><br>
                            <?=invest_home_blog_down?>
                        </h4>
                    </div>

                    <?php
                        echo funGetSlide('invest_home_blog','','','
                        <div class="col-lg-4">
                            <div class="item text-center">
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

                <div class="order" style="text-align: center">
                    <a href="#0" class="butn butn-bg" data-scroll-nav="6">
                        <span><?=invest_home_talk_to?></span>
                    </a>
                </div>
            </div>
        </section>
    	<!-- End Blog ====
        ======================================= -->
        
        <!-- =====================================
        ==== Start Testimonails -->
    
        <div class="testimonails bg-img section-padding" data-overlay-dark="9" data-background="img/3.jpg">
            <div class="container">
                <div class="row">

                    <div class="offset-lg-1 col-lg-10 text-center over">

                        <div class="owl-carousel owl-theme">
                            <div class="citem">

                                <p style="font-size: 18px; color: white; font-weight: 600;"><?= invest_stripe_home ?></p>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Testimonails ====
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




