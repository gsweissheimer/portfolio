
    <!--================1ra sesao =================-->
          
            <section class="latest_project white_cl margin-cc" style="">
                <div class="container" style="">
                    <div class="l_text team_inner">
                        <?php
                      echo funGetAdvancedBanners('casos_two_a', '
                                 
                        <h4 class="texto-serv">{{title}}</h4>
                        <div class="float-md-left">
                            <div class="main_title white">
                                <h2 class="">{{subtitle}}</h2>

                                <div class="row">
                                    <div class="col-sm-6">                                        
                                        <p class="" style="padding: 0px;">{{text}}</p>
                                    </div>
                                    <div class="col-sm-6">                                        
                                        <p class="" style="padding: 0px;">{{subtext}}</p>
                                    </div>                    
                                </div>
                            </div>
                        </div>

                       ');
                       ?>                        
                    </div>
                               

                    <div class="video_slider owl-carousel" id="videOwl">
                        <?php
                            echo funGetAdvancedBanners('casos_depoimentos_two', '
                            <div class="item">

                                <h2 class="titulo-caso"><span style="color: #b21f24;">{{title}}</span><br><span style="font-size: 26px;">{{subtitle}}</span></h2>
                                <br>
                                <br>
                                <div class="row">

                                    <div class="col-sm-6">
                                       <p style="margin-bottom: 50px;">{{text}}</p>                                
                                    </div>

                                    <div class="col-sm-6">
                                       <p style="margin-bottom: 50px;">{{subtext}}</p>                                
                                    </div>
                                    
                                </div>
                                 
                                <div class="row iframeRow">        
                                    <iframe data-src="{{callAction}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>

                            </div> 
                        ');
                        ?>                    
             
                    </div>

                    <br>
                    <br>
                    <!-- TRADUÇÃO   alinhadores_cta1  -->
                    <div class="row disp-flex-cc" style="">
                        
                        <a class="ctaPattern ctaBottomLine ctaGreyC page-scroll hoverMe" data-hover="ctaGreyCHover" href="#form_contato_casos"><?=alinhadores_cta1?></a>                       
                        
                    </div>                    


                </div>
                
            </section>            

    <!--================1ra sesao  =================-->