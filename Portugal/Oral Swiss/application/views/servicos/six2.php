<!--================5ta sesao=================-->
<div class="row six">
  
  <div class="footeer_slider2 owl-carousel" id="footeer_slider2">
          
          <?php
            echo funGetSlideMob('serv_hig_slide_footer','','','
                <div class="">
                  <div class="projects_item">
                    <div class="projects_item">
                      <img class="deskOnly" src="{{img}}" alt="">
                      <img class="mobOnly" src="{{imgg}}" alt="">
                      <div class="hover"><!--class="hover"-->
                        <!--<a href="{{ctaTitle}}"><i class="ion-android-arrow-forward"></i></a>-->
                        <!--------------texto direita------------------->
                        <div class="project_text_direita">
                          <h5>{{title}}</h5>
                          <h4>{{subtitle}}</h4>
                        </div>
                        <!--------------texto izquierda------------------->
                        <div class="project_text_ezquerda">
                          <h5>{{title}}</h5>
                          <h4>{{text}}</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              ');    
            ?> 

  </div> 
   
</div>
<div class="display-flex-cta-servicos" style="">

    <a href="#form_contato_servicos" class="ctaPattern ctaBoxed ctaRedB page-scroll "  data-hover="ctaRedBHover" type="submit" style="border-radius: 0%"><?=alinhadores_cta1?></a>

    <a href="#carousel-servicos" class="ctaPattern ctaBoxed ctaGreyC page-scroll custom-btn"  data-hover="ctaGreyCHover" type="submit" style="border-radius: 0%;"><?=cta_veja_mais_tratamentos?></a>

</div>  
<!--================END 5ta sesao=================-->