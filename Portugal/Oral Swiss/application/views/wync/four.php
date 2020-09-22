

                <?php
                    echo funGetAdvancedBanners('wync_four', '
                        <div class="section back-white iconsAbout" id="about">
                            <div class="section padding-top-bottom">
                                <div class="container">
                
                                    <div class="six columns">
                                        <div class="title-text left remove-padding titleMain" style="margin: 20px 0 20px">
                                            <p class="line" style="display:inline-block">{{title}} <span></span></p>
                                            <h3 class="remove-padding" data-scroll-reveal="enter bottom move 100px over 1s after 0.3s" style="max-width: 100%;">{{text}}</h3>
                                            
                                            
                                            <div class="ctaAlign" style="margin-top: 120px">
                                                <a href="{{callAction}}" class="btn primary">{{callTitle}}</a>
                                            </div>
                
                
                                        </div>
                                    </div>
                                    <div class="six columns">
                                        <img style="width: 100%" src="{{img}}" alt="">
                                    </div>
                
                                </div>
                            </div>
                        </div>');
                ?>
