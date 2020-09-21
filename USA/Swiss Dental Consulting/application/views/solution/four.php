
        <?php
            echo funGetAdvancedBanners($solutionTag.'four', '
                <div class="section back-white iconsAbout" id="about">
                    <div class="section padding-top-bottom">
                        <div class="container">
                            <div class="six columns">
                                <div class="title-text left remove-padding titleMain" style="margin: 20px 0 20px">
                                    <h3 class="remove-padding" data-scroll-reveal="enter bottom move 100px over 1s after 0.3s" style="max-width: 100%;">{{title}}</h3>
                                    <p style ="margin-left: 0;text-transform: none;margin-top: 25px;line-height: 21px;" data-scroll-reveal="enter bottom move 100px over 1s after 0.3s">{{text}}<span></span></p>
                                    <div class="ctaAlign" style="margin-top: 120px" data-scroll-reveal="enter bottom move 100px over 1s after 0.3s">
                                        <a href="{{callAction}}" class="btn primary">{{callTitle}}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="six columns" data-scroll-reveal="enter bottom move 100px over 1s after 0.3s">
                                <img style="width: 100%" src="{{img}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>');
        ?>
