
<!--================4ta sesao=================-->
     <section class="full_project_area">
        <div class="container">
            <!-- TRADUÇÃO   odotologia_sessao_4_titulo  -->
            <h5 style="padding: 0px; margin-bottom: 20px; text-align: left; font-weight: bold !important; font-size: 18px !important;"><?=odotologia_sessao_4_titulo?></h5>
            <div class="main_title white">
                <?php
                echo funGetAdvancedBanners('odontologia_five', '

                <h2 class="odt-subtitulo-sessao-4">{{title}}</h2>

                <p class="odt-texto-sessao-4" style="">{{subtitle}}</p>
                   
                ');
                ?>
            </div>
            <ul class="isotope_fillter list" style="display: none">
               <?php
                echo funGetSlide('home_four_filter','','','
                    <li class="{{text}}" data-filter="{{subtitle}}"><a href="#">{{title}}</a></li>');
                ?>
                
            </ul>
            <!-- TRADUÇÃO   filtrar-->
            <div style="" class="text-filter-odt">
                <label><?=filtrar?></label> 
            </div>
            <div style="" class="filter-odt">
                                
                <select class="portfolio_filter form-control selecter-odt" value="" id="produtos2" style="">
                        <?php
                        echo funGetSlide('home_four_filter','','','                                
                        <option data-filter="{{subtitle}}" {{ctaTitle}}>{{title}}</option>');
                        ?>                                
                </select>
            </div>


            <div class="blog_ms_inner row selector-odt">
                <?php
                    echo funGetSlide('odontologia_four_items','','','
                      
                <div class="col-lg-4 col-sm-6 {{text}}">
                    <div class="blog_g_item">
                        <div class="press_img_item">
                            <div class="press_img">
                                <img class="img-fluid" src="{{img}}" alt="">
                            </div>
                            <div class="date">
                                <a href="{{ctaTitle}}">{{title}}</a>                                
                            </div>
                            <a href="{{ctaTitle}}"><h4>{{subtitle}}</h4></a>                            
                            <a class="see_btn" href="{{ctaTitle}}"  style="color: #b21f24 !important; border-bottom: 2px solid #b21f24 !important; display: inline; margin-top: 50px !important;" >{{callAction}}</a>
                        </div>
                    </div>
                </div>
                    ');    
                ?>    
                               
            </div>
        </div>
    </section> 
<!--================End 4ta sesao =================-->