
    <!--================1ra sesao =================-->
            <section class="latest_project white_cl serv-s-1" style="">
                <div class="container" style="">
                    <div class="l_text team_inner">
                        <?php
                      echo funGetAdvancedBanners('serv_two', '
                                 
                        <h4 class="texto-serv">{{title}}</h4>
                        <div class="float-md-left">
                            <div class="main_title white">
                                <h2 class="texto2-serv">{{subtitle}}</h2>
                                <p  class="texto3-serv" style="padding-right: 0px;">{{text}}</p>
                            </div>
                        </div>

                       ');
                       ?>                        
                    </div>
                </div>
                
            </section>

            <div class="fillter_slider2 owl-carousel" id="carousel-servicos">
                <!-- Criar tag no b.o. e cadastrar o conteudo -->
                <?php
                    echo funGetSlide('serv_two_items','','','
                      <div class="{{text}}">
                        <div class="projects_item">
                            <div class="projects_item">
                                <img src="{{img}}" alt="">
                                <div class="hover" id="servicos-1">
                                    <a href="{{ctaTitle}}" class="page-scroll"><i class="ion-android-arrow-forward"></i></a>
                                    <div class="project_text">
                                        <h5>{{title}}</h5>
                                        <a href="{{ctaTitle}}" class="page-scroll"><h4>{{subtitle}}</h4></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                    ');    
                ?>                    
                    
            </div>
    <!--================End 1ra sesao =================-->