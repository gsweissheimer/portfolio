<!--================Contact Area =================container-produto-sessao-4-->
<section class="contact_area2 " id="form_contato_fale_conosco2">
	<div class="container">
		<div class="row">
			
			<!-- TRADUÇÃO   contact_titulo -->
			<div class="col-lg-7">
				
				<?php
				echo funGetAdvancedBanners('fale_conosco_contact_2', '
					<img src="{{img}}"  alt="" class="img2">
					');
					?>

			</div>

			<div class="col-lg-5">
				<div class="right_contact_form">
					<h4><?=contact_titulo?></h4>
					<form class="row contact_us_form">
						<div class="form-group col-md-12">
							<input type="text" class="form-control" id="name" name="name" placeholder="<?=contact_name?>" required>
						</div>
						<div class="form-group col-md-12">
							<input type="text" class="form-control" id="email" name="email" placeholder="<?=contact_email?>" required>
						</div>                        

						<div class="form-group col-md-12">
							<textarea class="form-control" name="message" id="message" rows="2" placeholder="<?=contact_messagem?>" required></textarea>
						</div>
                        
                                                	
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


		</div>
	</div>
</section>
<!--================End Contact Area =================-->