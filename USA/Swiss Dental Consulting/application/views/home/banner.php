
    <div class="section full-height banner" id="home">
        <div class="home-carousel-wrap">						
            <div id="sync1" class="">
                <?php
                    echo funGetAdvancedBanners('home_banner', '
                        <div class="item" style="background-image: url({{img}});">
                            <div class="home-mask"></div>
                            <div class="home-text">
                                <div class="container fade-elements">
                                    <div class="twelve columns center">
                                        <h1>{{title}}</h1>
                                        <h2>{{subtitle}}</h2>
                                        <a href="{{callAction}}" class="btn primary">{{callTitle}}</a>
                                    </div>
                                </div>
                            </div>	
                        </div>');
                ?>
            </div>

                
            <div id="sync2" class="owl-carousel fade-elements">
                <div class="item">
                </div>
                <div class="item">
                </div>
                <div class="item">
                </div>
            </div>							
        </div>
        
        <a href="#about" data-gal="m_PageScroll2id" data-ps2id-offset="78"><div class="link-down fade-elements"></div></a>
        
    </div>