
    <!--================1ra sesao =================-->
            <section class="intes_studio_area white_cl bg-sesao-1">
                <div class="since_text">
                    <!-- TRADUÇÃO banner_text_2a banner_text_2b  -->
                    <h5 > <span><?=banner_text_2a?></span>  <?=banner_text_2b?></h5>
                </div>
                <div class="container">
                    <?php
                        echo funGetAdvancedBanners('home_sessao_1', '   

                        <div class="row">
                            <div class="col-lg-7">

                                <div class="studio_img">

                                    <img src="{{img}}" alt="">
                                    
                                </div>
                            </div>                        
                            
                            <div class="col-lg-4" style="margin-top: 1%; padding-left: 5%;">
                                <div class="studio_text">
                                    <h6 class="s_title white">{{title}}</h6>
                                    <h3>{{subtitle}}</h3>
                                    <p>{{text}}</p>                                    
                                    <p>{{subtext}}</p>
                        ');

                    ?>   
                    <?php
                        echo funGetAdvancedBanners('home_sessao_1_b', '   

                                <p>{{text}}</p>
                                <a class="ctaPattern ctaBottomLine ctaRedC" data-hover="ctaRedCHover" href="{{callAction}}" style="">{{callTitle}}</a>
                        
                        ');

                    ?>   

                                </div>
                            </div>
                        </div>

                </div>
            </section>
    <!--================1ra sesao  br_btn white=================-->