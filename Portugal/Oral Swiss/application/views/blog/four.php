    
    
   <!--================3ra sesao =================-->
       <section class="container-contato-casos">

                
            <div class="item-contato-casos" style="" id="form_contato_blog">    
            <?php
              echo funGetAdvancedBanners('blog_contact_title', '                             
                
                <h3>{{title}}</h3>
                <p class="h4 mb-4">{{subtitle}}</p>
               ');
               ?>

                <form class="" name="formContact" action="#!">                        
                     
                    <div class="row">

                        <div class="col-sm-6">
                            
                            <!-- TRADUÇÃO   contact_name -->
                            <input type="text" id="Name_blog" name="Name_blog" class="form-control mb-4" placeholder="<?=contact_name?> *" style="border-radius: 0%;" required>

                        </div>

                         <div class="col-sm-6">
                            
                            <!-- TRADUÇÃO   contact_telefone -->
                            <input type="text" id="Telefone_blog" name="Telefone_blog" class="form-control mb-4" placeholder="<?=contact_telefone?> *" style="border-radius: 0%;" required>

                        </div>
                        
                    </div>

                    <div class="row">

                        <div class="col-sm-12">
                            
                            <!-- TRADUÇÃO   contact_email -->
                            <input type="email" id="Email_blog" name="Email_blog" class="form-control mb-4" placeholder="<?=contact_email?> *" style="border-radius: 0%;" required>

                        </div>
                        
                    </div>
                    
                    <!-- TRADUÇÃO   contact_messagem -->
                    <div class="form-group">
                        <textarea class="form-control rounded-0" id="Mensagem_blog" name="Mensagem_blog" rows="8" placeholder="<?=contact_messagem?> *" required></textarea>
                    </div>

                    <div class="" style="margin-bottom: -24px;">
                        <input type="checkbox" class="checkbox-inline" id="exampleCheck_blog" required>
                        <label class="form-check-label" for="exampleCheck_blog"><a href="https://swissdentalservices.com/termos-condicoes.php" target="blank" style="color: #ffffff;"> <?=contact_termos?></a> </label>
                    </div>

                    <div class="row" style="margin-top: 40px;">

                        <div class="col-sm-4">
                            
                            <!-- TRADUÇÃO   contact_botton -->
                            <button class="ctaPattern ctaBoxed ctaWhiteC ctaFullWidth" data-hover="ctaWhiteCHover" type="submit" id="btn_form_contact_blog"><?=contact_botton?></button>

                        </div>
                        
                    </div>
                    

                </form>
                <!-- Default form contact -->

            </div>

            
            <!-- Default form login -->
            
        </section>     
   <!--================3ra sesao =================-->