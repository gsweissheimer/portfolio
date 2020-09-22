
    <!--================2da sesao =================container-produto-sessao-1-->
        <section class="project_villa_area " style="margin-top: -180px;">
            <div class="container">
                
                <?php
                    echo funGetAdvancedBanners($alias.'_three', '

                    <div class="row utilizacao-1" style="margin-bottom: 30px;">
                        <div class="col-lg-4 col-sm-6">
                            <div class="pd_item utilizacao-2">

                                <h5>{{title}} <span>{{subtitle}}</span></h5>
                                
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="pd_item utilizacao-2">

                                <h5>{{text}} <span>{{subtext}}</span></h5>
                                
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 margen-prod-2">
                            <div class="pd_item utilizacao-2">

                                <h5>{{callTitle}} <span>{{callAction}}</span></h5>
                                
                                </h5>
                            </div>
                        </div>
                    </div>
                    
                 ');
                 ?>


                <div class="row cta-mobile">          

                    <a href="#form_contato" class="ctaPattern ctaBottomLine ctaRedC hoverMe page-scroll" data-hover="ctaRedCHover" style="margin-left: 16px;"><?=$traducoes['cta_1']?></a>                           
                   
                </div>

                <br>
                <br>

                <div class="villa_slider owl-carousel">
                    <?php
                        echo funGetSlide($alias.'_slide_three','','','
                        <div class="item">
                                    
                           <img src="{{img}}" alt="">

                        </div> 
                    ');
                    ?>                    
         
                </div>
                
            </div>
        </section>
    <!--================2da sesao=================-->