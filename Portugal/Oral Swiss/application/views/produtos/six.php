<div class="row six">
  
  <div class="footeer_slider owl-carousel">
          
          <?php
            echo funGetSlideMob($alias.'_slide_footer','','','
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
