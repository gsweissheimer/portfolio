
        <?php
            echo funGetAdvancedBanners('wync_banner', '
                <div class="section full-height back-dark internalBanner" id="home" style="background-image: url({{img}});">
                    <div class="home-text">
                        <div class="container fade-elements">
                            <div class="twelve columns wyncBanner">
                                <h1>{{title}}<br>{{subtitle}}</h1>
                                
                                <a href="{{callAction}}" class="btn primary">{{callTitle}}</a>
                            </div>
                        </div>
                    </div>
                    <a href="#about" data-gal="m_PageScroll2id" data-ps2id-offset="78"><div class="link-down fade-elements"></div></a>
                </div>');
        ?>