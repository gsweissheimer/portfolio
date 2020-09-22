
    <!--================2da sesao =================-->
            <section class="speciallization_area white_cl">
                
                    <img class="mobOnly" src="assets/img/logoDentalMob.png" alt="" style="width: 104%;margin-left: -2%;">

                <div class="container">

                    <?php
                        echo funGetAdvancedBanners('home_three', '
                                          
                            <div class="sesao2">

                                <img class="deskOnly" src="{{img}}" alt="">
                                        
                            </div> 

                            <h6 class="s_title white">{{title}}</h6>

                        ');

                    ?>
                    <div class="row" >

                     <?php
                     echo funGetSlide('home_three','','','
                        <div class="col-lg-4 col-sm-6 mobil">
                            <div class="spec_item" style="display: flex;flex-wrap: wrap;align-content: space-between;height: 100%;">
                                <h4>{{title}}</h4>
                                <p>{{text}}</p>
                                
                                <a class="ctaPattern ctaBottomLine ctaGreyC" data-hover="ctaGreyCHover" href="{{callAction}}">{{ctaTitle}}</a>
                                
                            </div>
                        </div>
                      ');

                      ?>                       
                    </div>

                </div>
            </section>
    <!--================2da sesao view_btn white=================-->