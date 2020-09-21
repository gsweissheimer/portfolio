        
        <div class="section padding-top-bottom bg-pattern-bottom">
            <div class="container">
                <div class="twelve columns">
                    <?php
                        echo funGetAdvancedBanners('contact_structure', '
                            <div class="title-text left remove-padding titleMain" style="margin-bottom: 20px">
                                <p style="display:inline-block" class="line">{{title}}<span></span></p>
                                <h3 class="remove-padding" data-scroll-reveal="enter bottom move 100px over 1s after 0.3s" style="max-width: 100%;">{{subtitle}}</h3>
                            </div>');
                    ?>
                </div>

                <?php include('contact/form.php') ?>	
                        
                <!--<div class="clear"></div>
                <div id="ajaxsuccess">Successfully sent!!</div>
                <div class="clear"></div>-->
            </div>
            <!--<a href="../2blog/index.html">
                <div class="section back-dark">
                    <div class="portfolio-bottom-link">Precisa de ajuda com a sua clinica?<br>Entre em contato com nossos representantes</div>
                </div>
            </a>-->
        </div>