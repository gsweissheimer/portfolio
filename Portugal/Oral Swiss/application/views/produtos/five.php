
<!--================4ta sesao=================container-produto-sessao-4-->

     <section class="speciallization_area white_cl margin-prod" style="">
      

        <div class="container">

            <?php
            echo funGetAdvancedBanners($alias.'_five', '           

                <h6 class="s_title white">{{title}}</h6>

                ');

                ?>
                <div class="row" >

                   <?php
                   echo funGetSlide($alias.'_slide_five','','','
                    <div class="col-lg-4 col-sm-6">
                      <div class="spec_item">

                        <h4 style="font-size: 25px">{{title}}</h4>
                        <p>{{text}}</p>                

                      </div>
                    </div>
                    ');

                    ?>                       
                </div>
                <div class="row cta_margen">
                    <a href="#form_contato" class="ctaPattern ctaBottomLine ctaRedC hoverMe page-scroll" data-hover="ctaRedCHover"><?=$traducoes['cta_3']?></a>
                </div>

        </div>
    </section>
     
<!--================End 4ta sesao =================-->