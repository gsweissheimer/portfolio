
        <?php
            echo funGetAdvancedBanners($solutionTag.'three', '
                <div class="section solutions blue-dark" id="blog" style="background-image: url({{img}});background-size: cover;">
                    <div class="section padding-top-bottom">
                        <div class="container">
                            <div class="six columns">
                                <div class="title-text left remove-padding titleMain" style="margin: 20px 0 20px">
                                    <p style="display:inline-block; color:white;margin-left: 0px;">{{title}}<span></span></p>
                                    <h3 class="remove-padding" data-scroll-reveal="enter bottom move 100px over 1s after 0.3s" style="max-width: 100%;color:white">{{subtitle}}</h3>
                                </div>
                            </div>
                            <div class="clear"></div>');
        ?>
        <?php

            $auxBase = array("","","-right","-right","","");
            echo funGetSlide($solutionTag.'three','','','
                <div class="six columns">
                    <div class="journal-wrap{{i}}">
                        <img  src="{{img}}" alt="" data-scroll-reveal="enter right move 150px over 0.7s after 0.2s"/>
                        <div class="journal-det{{i}}" data-scroll-reveal="enter right move 150px over 0.7s after 0.6s">
                            <h5>{{text}}</h5>
                        </div>
                    </div>
                </div>', 'active', '', $auxBase);
        ?>


                </div>	
            </div>	
        </div>