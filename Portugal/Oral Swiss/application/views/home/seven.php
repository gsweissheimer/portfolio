
    <!--================6ta sesao =================-->
            <section class="meet_team_area">
                <div class="container">
                    <div class="team_inner">
                       <?php
                      echo funGetAdvancedBanners('home_seven', '                                 
                        
                        <h4>{{title}}</h4>
                        <div class="main_title white">
                            <h2>{{subtitle}}</h2>
                            <p>{{text}}</p>
                        </div>
                       ');
                       ?>

                        <div class="team_slider owl-carousel" style="margin-bottom: 50px">
                          <?php
                          echo funGetSlide('home_seven','','','                        
                            <div class="item">
                                <div class="team_item">
                                    <img src="{{img}}" alt="">
                                    <div class="hover">
                                        <h5>{{title}}</h5>
                                        <h6>{{subtitle}}</h6>
                                       <!-- <ul class="list">
                                            <li><a href="{{text}}"><i class="ion-social-twitter"></i></a></li>
                                            <li><a href="{{ctaTitle}}"><i class="ion-social-facebook"></i></a></li>
                                            <li><a href="{{callAction}}"><i class="ion-social-linkedin"></i></a></li>
                                        </ul> -->
                                    </div>
                                </div>
                            </div>
                          ');
                          ?>
                           
                        </div>
                        <?php
                          echo funGetSlide('home_seven_b','','','      
                            <a class="ctaPattern ctaBoxed ctaGreyC" data-hover="ctaGreyCHover" href="{{callAction}}">{{ctaTitle}}</a>
                          ');
                          ?>
                    </div>
                </div>
            </section>
            <!--================End 6ta sesao =================-->