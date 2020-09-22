
        <?php
            $imgBanner = 'https://swissdentalconsulting.com/assets/img/'.$banner_png;
            echo funGetAdvancedBanners($solutionTag.'banner', '
                <div class="section height-1 red-blood internalBanner" id="parallax-2" style="background: url({{img}}) repeat fixed;">
                    <div class="home-text-2">
                        <div class="container fade-elements padding-top banner-cont" style="display: flex;align-items: center;justify-content: space-between;">
                            <div class="left" style="text-align: right;padding: 50px;box-sizing: border-box;">
                                <img style="width: 85%;" src="' . $imgBanner . '" alt="">
                            </div>
                            <div class="lineBanner mobile-only"></div>
                            <div class="right bannerCenter" style="padding: 50px;box-sizing: border-box;">
                                <h2 style="text-align: left">{{title}}</h2>
                                <!--<div class="ctaAlign" style="margin-top: 80px; text-align: left">
                                    <a href="{{callAction}}" class="btn white">{{callTitle}}</a>
                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>');
        ?>
