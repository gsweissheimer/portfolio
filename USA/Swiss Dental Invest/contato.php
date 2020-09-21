        <?php
            require_once 'includes/generateAllInfo.php';
            include('headerr.php');
        ?>
        
    	<!-- =====================================
    	==== Start Hero -->
        <section class="hero section-padding pb-0 contact pattern-50" data-scroll-index="1">
            <div class="container-fluid">'
                <div class="container">
                    <div class="row">
                                    <?php
                                        echo funGetAdvancedBanners('invest_contact', '
                                        <div class="section-head col-sm-12">
                                            <h4 style="color: #2B4258">
                                                <span style="{{callAction}}">{{title}}</span><br>
                                                {{subtitle}}
                                            </h4>
                                        </div>
                        
                                        <div class="offset-lg-2 col-lg-8 text-center">
                                            <p>{{text}}</p>
                                        </div>');
                                    ?>

                    </div>
                </div>
            </div>
            
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 contact-form">
                        <form class="form" id="" method="post" action="send.php">

                            <div class="messages"></div>

                            <div class="controls">

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input id="form_name" type="text" name="name" placeholder="<?=form_name?>" required style="background-color: #fff;">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input id="form_subject" type="text" name="phone" placeholder="<?=form_phone?>" required style="background-color: #fff;">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input id="form_email" type="email" name="email" placeholder="<?=form_email?>" required style="background-color: #fff;">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea name="description" id="description" placeholder="<?=form_desc?>" cols="30" rows=3></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12 text-center">
                                        <button type="submit" class=""><span><?=send_button?></span></button>
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
        <script src="js/scripts-no-menu.js"></script>

    </body>
</html>




