
    <!--================4ta sesao=================-->
            <section class="clients_area white_cl">
                <div class="container team_inner">
                    <!-- TRADUÇÃO   sessao_dep_nossas_clientes -->
                    <h4><?=sessao_dep_nossas_clientes?></h4>
                    <div class="main_title white">
                        <!-- TRADUÇÃO   home_depoimento -->
                        <h2><?=home_depoimento?></h2>
                    </div>
                    <div class="testimonials_slider owl-carousel">
                        <?php
                      echo funGetSlide('home_five','','','                        
                        <div class="item" style="position: relative;">
                            <div class="depoimento" style="display: flex ; flex-wrap: wrap ; align-content: space-between ; height: 373px;">
                                <h4 class="mobil-aling-home"><span class="mobil3" style="color: #000000">{{title}}</span><br>{{subtitle}}</h4>
                                <br>
                                <p class="mobil-text-home">{{text}}</p>
                                <a style="" class="ctaPattern ctaBottomLine ctaRedC hoverMe" data-hover="ctaRedCHover" href="{{ctaTitle}}">{{callAction}}</a>
                            </div>
                            <img src="{{img}}" class="image">
                        </div>
                      ');
                      ?>                       
                    </div>


                    
                </div>
            </section>
    <!--================End 4ta sesao =================-->