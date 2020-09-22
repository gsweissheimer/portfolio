
    <!--================1ra sesao =================-->
            <section class="latest_project white_cl">
                <div class="container" style="">
                    <div class="l_text team_inner">
                        <?php
                      echo funGetAdvancedBanners('home_four', '
                                 
                        <h4 class="texto">{{callTitle}}</h4>
                        <div class="float-md-left">
                            <div class="main_title white">
                                <h2 class="texto2">{{title}}</h2>
                            </div>
                        </div>

                       ');
                       ?>
                        <div class="float-md-right">
                            <ul class="portfolio_filter list" style="display: none;">   
                                                        
                              <?php
                              echo funGetSlide('home_four_filter','','','
                                <li class="{{text}}" data-filter="{{subtitle}}"><a href="#">{{title}}</a></li>');
                              ?>
                                              
                            </ul>
                            <!-- TRADUÇÃO   filtrar-->
                            <div style="" class="text-filter">
                               <label><?=filtrar?></label> 
                            </div>
                            <div style="" class="filter">
                                
                                <select class="portfolio_filter form-control selecter" value="" id="produtos" style="">
                                    <?php
                                    echo funGetSlide('home_four_filter','','','                                
                                    <option data-filter="{{subtitle}}" {{ctaTitle}}>{{title}}</option>');
                                    ?>                                
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
                
            </section>

            <div class="fillter_slider owl-carousel">
                <!-- Criar tag no b.o. e cadastrar o conteudo -->
                <?php
                    echo funGetSlide('home_four_items','','','
                      <div class="{{text}}">
                        <div class="projects_item">
                            <div class="projects_item">
                                <img src="{{img}}" alt="">
                                <div class="hover">
                                    <a href="{{ctaTitle}}"><i class="ion-android-arrow-forward"></i></a>
                                    <div class="project_text">
                                        <h5>{{title}}</h5>
                                        <a href="{{ctaTitle}}"><h4>{{subtitle}}</h4></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                    ');    
                ?>                    
                    
                </div>
            <!--================End 1ra sesao =================-->