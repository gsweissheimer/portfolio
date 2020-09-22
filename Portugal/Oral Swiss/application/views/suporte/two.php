
    <!--================1ra sesao =================-->
          
        <section class="latest_project white_cl" style="padding-top: 100px;">
            <div class="container" style="">
                <div class="l_text team_inner">
                    <?php
                  echo funGetAdvancedBanners('suporte_fale_connosco', '
                             
                    <!--<h4 class="texto-serv">{{title}}</h4>-->
                    <div class="float-md-left">
                        <div class="main_title white">
                            <h2 class="subtitle-fale-conosco">{{subtitle}}</h2>

                            <p class="" style="padding: 0px;">{{text}}</p>
                           
                        </div>
                    </div>

                   ');
                   ?>                        
                </div> 



                <div class="btn-container">
                    
                    <div class="items item-agend-aberto" id="ageng">

                        <h4 style="margin: 0;"><i class="fas fa-sort-up icom-opem" id="ico1"></i>&nbsp;&nbsp; <?=menu_contact_agendar?></h4>
                        
                    </div>   
                    
                    <div class="items item-fale-fechado" id="fale">

                        <h4 style="margin: 0;"><i class="fas fa-sort-up icom-closed" id="ico2"></i>&nbsp;&nbsp; <?=menu_contact_fale?></h4>
                        
                    </div> 

                </div>

                <div class="form-agendamento" style="display: none;">

                    <!------------------------------------------------------------------------------------------------------------------------------------>


                        <section class="contact_area2 spacing" id="form_contato_agendamento">
                            <div class="container">
                                <div class="row">
                                    
                                    <!-- TRADUÇÃO   contact_titulo_fale_1 -->
                                    <div class="col-lg-4 animatio-div invisible">

                                          <div class="row right_contact_form">
                                            <h4><?=contact_titulo_fale_1?></h4>                                              
                                          </div>
                                          <div id="form-fale-connosco-agendar" class="mobil-form-f-c">

                                          </div>
                                       <!-- <div class="right_contact_form">
                                            <h4><?=contact_titulo_fale_1?></h4>
                                            <form class="row contact_us_form">
                                                <div class="form-group col-md-12">
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="<?=contact_name?>" required>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="<?=contact_email?>" required>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    
                                                      <label for="sel1"><?=contact_clinicas?>:</label>
                                                      <select class="form-control bord-select" id="sel1" required="true">
                                                        <option value="">Selecione</option>
                                                        <option value="Braga">Braga</option>
                                                        <option value="Coimbra">Coimbra</option>
                                                        <option value="Leiria">Leiria</option>
                                                        <option value="Lisboa">Lisboa</option>
                                                        <option value="Porto">Porto</option>
                                                        <option value="Portimão">Portimão</option>
                                                        <option value="Santarém">Santarém</option>
                                                        <option value="Vila Real">Vila Real</option>
                                                        <option value="Viseu">Viseu</option>
                                                        <option value="Londres">Londres</option>
                                                        <option value="Paris">Paris</option>
                                                      </select>
                                                    
                                                </div>
                                                
                                                <div class="form-group col-md-3" style="transform: translateY(15px); ">
                                                   
                                                    <select class="form-control bord-select" id="pais" onChange='link()' style="font-size: 13px">
                                                        
                                                        <option value="+351" selected="">PT</option>
                                                        <option value="+43">AT</option>
                                                        <option value="+32">BE</option>
                                                        <option value="+41">CH</option>
                                                        <option value="+49">DE</option>
                                                        <option value="+45">DK</option>
                                                        <option value="+34">ES</option>
                                                        <option value="+33">FR</option>
                                                        <option value="+44">GB</option>
                                                        <option value="+353">IE</option>
                                                        <option value="+39">IT</option>
                                                        <option value="+352">LU</option>
                                                        <option value="+31">NL</option>
                                                        <option value="+47">NO</option>
                                                        <option value="+46">SE</option>

                                                    </select> 

                                                </div>
                                                <div class="form-group col-md-2">
                                                    <input type="text" class="form-control" id="cod" name="cod" value="+351" placeholder="" disabled="">
                                                </div>
                                                <div class="form-group col-md-7">
                                                    <input type="text" class="form-control" id="telefone" name="telefone" placeholder="<?=contact_telefone?>" onkeypress=" return onlynumber();" required>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    
                                                      <label for="sel2"><?=contact_melhor_altura?>:</label>
                                                      <select class="form-control bord-select" id="sel2" required="true">                         
                                                        <option value="">Selecione</option>
                                                        <option value="manha">Manhã</option>
                                                        <option value="tarde">Tarde</option>
                                                        <option value="noite">Noite</option>
                                                      </select>
                                                    
                                                </div>                               
                                                
                                                                            
                                                <div class="imput-down">
                                                    <input type="checkbox" class="checkbox-inline" id="exampleCheck1">
                                                    <label class="form-check-label" for="exampleCheck1"><a href="https://swissdentalservices.com/termos-condicoes.php" target="blank" style="color: #999999;"> <?=contact_termos?></a> </label>
                                                 </div>
                                                
                                                 TRADUÇÃO   contact_botton
                                                <div class="col-sm-4 btn-down">
                                                    <button type="submit" value="submit" class="ctaPattern ctaBoxed ctaRedB hoverMe" data-hover="ctaRedBHover"><?=contact_botton?> </button>
                                                </div> 
                                                <div class="success-message"><i class="fa fa-check text-primary"></i> Thank you!. Your message is successfully sent...</div>
                                                <div class="error-message">We're sorry, but something went wrong</div>
                                            </form>
                                        </div>  -->
                                    </div>

                                    <div class="col-lg-8 animatio-div invisible">
                                        
                                        <?php
                                        echo funGetAdvancedBanners('fale_conosco_contact_1', '
                                            <img src="{{img}}"  alt="" class="img img-hide">
                                            ');
                                            ?>

                                    </div>




                                </div>
                            </div>
                        </section>

                    <!-----------------------------------------------------segundo------------------------------------------------------------------------>
                </div>
                <div class="form-fale-conosco" style="display: none;">
                        <section class="contact_area2 spacing" id="form_contato_fale_conosco2">
                            <div class="container">
                                <div class="row">
                                    
                                    <!-- TRADUÇÃO   contact_titulo_fale_2 -->
                                    <div class="col-lg-7 animatio-div invisible">
                                        
                                        <?php
                                        echo funGetAdvancedBanners('fale_conosco_contact_2', '
                                            <img src="{{img}}"  alt="" class="img2 img-hide">
                                            ');
                                            ?>

                                    </div>

                                    <div class="col-lg-5 animatio-div invisible">
                                        <div class="right_contact_form">
                                            <h4><?=contact_titulo_fale_2?></h4>
                                            <form class="row contact_us_form"   id="form_fale_connosco" name="form_fale_connosco">
                                                <div class="form-group col-md-12">
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="<?=contact_name?> *" required>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="<?=contact_telefone?> *" required>
                                                </div> 
                                                <div class="form-group col-md-12">
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="<?=contact_email?> *" required>
                                                </div>                        

                                                <div class="form-group col-md-12">
                                                    <textarea class="form-control" name="description" id="description" rows="2" placeholder="<?=contact_messagem?> *" required></textarea>
                                                </div>
                                                
                                                                            
                                                <div class="imput-down">
                                                    <input type="checkbox" class="checkbox-inline" id="exampleCheck_fc" required>
                                                    <label class="form-check-label" for="exampleCheck_fc"><a href="https://swissdentalservices.com/termos-condicoes.php" target="blank" style="color: #999999;"> <?=contact_termos?></a> </label>
                                                 </div>
                                                
                                                <!-- TRADUÇÃO   contact_botton -->
                                                <div class="col-sm-4 btn-down">
                                                    <button type="submit" value="submit" class="ctaPattern ctaBoxed ctaRedB hoverMe" data-hover="ctaRedBHover" id="btn_fale_con"><?=contact_botton?> </button>
                                                </div> 
                                                <div class="success-message"><i class="fa fa-check text-primary"></i> Thank you!. Your message is successfully sent...</div>
                                                <div class="error-message">We're sorry, but something went wrong</div>
                                            </form>
                                        </div>
                                    </div>      


                                </div>
                            </div>
                        </section>
                             

                    <!------------------------------------------------------------------------------------------------------------------------------------>

                    
                </div>
               
            </div>

        </section>  
            
    <!--================1ra sesao  =================-->