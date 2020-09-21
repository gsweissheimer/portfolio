
    <div class="section back-white redSvg white-bg bg-pattern-bottom bg-contain" id="services">
        
        
        <div class="section solutions bg-patter-contact-3 bg-contain" id="blog">
            <div class="section padding-top-bottom">
                <div class="container">
                    <?php
                        echo funGetAdvancedBanners('home_five', '
                            <div class="twelve columns">
                                <div class="title-text remove-padding titleMain titleMainCenter" style="margin-bottom: 20px">
                                    <p style="display:inline-block">{{title}} <span></span></p>
                                    <h3 class="remove-padding" data-scroll-reveal="enter bottom move 100px over 1s after 0.3s" style="max-width: 100%;">{{subtitle}}</h3>
                                </div>
                            </div>
        
                            <div class="twelve columns">
                                <div class="title-text">
                                    <h3 style="max-width: 100%;line-height: 28px;text-align: center">{{text}} <br> <br><span style="font-size: 21px">{{subtext}}</span></h3>
                                </div>
                            </div>');
                    ?>	

                    <div class="clear"></div>

                    <?php
                        echo funGetSlide('home_five_a','','','
                            <div class="six columns">
                                <div class="journal-wrap">
                                    <img  src="{{img}}" alt="" data-scroll-reveal="enter right move 150px over 0.7s after 0.2s"/>
                                    <div class="journal-det" data-scroll-reveal="enter right move 150px over 0.7s after 0.6s">
                                        <h6>{{title}}</h6>
                                        <h5>{{text}}</h5>
                                        <a href="{{callAction}}" class="btn secondary small">{{ctaTitle}}</a>
                                    </div>
                                </div>
                            </div>');
                    ?>
                    
                    <div class="clear desktopMargin"></div>

                    <?php
                        echo funGetSlide('home_five_b','','','
                        <div class="six columns">
                            <div class="journal-wrap-right">
                                <img  src="{{img}}" alt="" data-scroll-reveal="enter left move 150px over 0.7s after 1.2s"/>
                                <div class="journal-det-right" data-scroll-reveal="enter left move 150px over 0.7s after 1.6s">
                                    <h6>{{title}}</h6>
                                    <h5>{{text}}</h5>
                                    <a href="{{callAction}}" class="btn secondary small">{{ctaTitle}}</a>
                                </div>
                            </div>
                        </div>');
                    ?>
                    
                </div>	
            </div>	
        </div>
    </div>