<!--================Contact Area =================container-produto-sessao-4-->
<section class="contact_area2 " id="form_contato_fale_conosco">
	<div class="container">
		<div class="row">
			
			<!-- TRADUÇÃO   contact_titulo -->
			<div class="col-lg-4">
				<div class="right_contact_form">
					<h4><?=contact_titulo?></h4>
					<form class="row contact_us_form">
						<div class="form-group col-md-12">
							<input type="text" class="form-control" id="name" name="name" placeholder="<?=contact_name?>" required>
						</div>
						<div class="form-group col-md-12">
							<input type="email" class="form-control" id="email" name="email" placeholder="<?=contact_email?>" required>
						</div>
                        <div class="form-group col-md-12">
                        	
							  <label for="sel1">Clínicas mais perto de aí:</label>
							  <select class="form-control" id="sel1">
							    <option>1</option>
							    <option>2</option>
							    <option>3</option>
							    <option>4</option>
							  </select>
							
                        </div>
                        
                        <div class="form-group col-md-2">
							<input type="text" class="form-control" id="pt" name="pt" placeholder="PT" required>
						</div>
						<div class="form-group col-md-2">
							<input type="text" class="form-control" id="cod" name="cod" placeholder="+351" required>
						</div>
						<div class="form-group col-md-8">
							<input type="text" class="form-control" id="telefone" name="telefone" placeholder="<?=contact_telefone?>" required>
						</div>

						<div class="form-group col-md-12">
                        	
							  <label for="sel2">Melhor altura para contato:</label>
							  <select class="form-control" id="sel2">
							    <option>1</option>
							    <option>2</option>
							    <option>3</option>
							    <option>4</option>
							  </select>
							
                        </div>

						<!--<div class="form-group col-md-12">
							<textarea class="form-control" name="message" id="message" rows="1" placeholder="<?=contact_messagem?>" required></textarea>
						</div> -->
                        
                                                	
						<div class="imput-down">
						    <input type="checkbox" class="checkbox-inline" id="exampleCheck1">
						    <label class="form-check-label" for="exampleCheck1"><a href="#" style="color: #999999;"> <?=contact_termos?></a> </label>
						 </div>
                        
						<!-- TRADUÇÃO   contact_botton -->
						<div class="col-sm-4 btn-down">
							<button type="submit" value="submit" class="btn btn-block btn-transparent2"><?=contact_botton?> </button>
						</div> 
						<div class="success-message"><i class="fa fa-check text-primary"></i> Thank you!. Your message is successfully sent...</div>
      					<div class="error-message">We're sorry, but something went wrong</div>
					</form>
				</div>
			</div>

			<div class="col-lg-8">
				
				<?php
				echo funGetAdvancedBanners('fale_conosco_contact_1', '
					<img src="{{img}}"  alt="" class="img">
					');
					?>

			</div>




		</div>
	</div>
</section>
<!--================End Contact Area =================-->