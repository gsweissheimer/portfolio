
        	<!--================Header Menu Area =================-->
			<header class="header_menu_area white_menu">
				<nav class="navbar navbar-expand-lg navbar-light bg-light">
					<a class="navbar-brand" href="<?php base_url('2020') ?>"><img src="<?php base_url('OS_logo-01-whi.png','img') ?>" alt="" style="width: 150px; height: 35px;"><img src="<?php base_url('OS_logo-01.png','img') ?>" alt="" style="width: 150px; height: 40px;"></a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span></span>
						<span></span>
						<span></span>
					</button>
					<!-- TRADUÇÃO   menu_home -->
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="nav navbar-nav">
							<!--<li class="dropdown submenu <?php echo ($active=='home') ? 'active' : '';?>">
								<a href="<?php base_url('') ?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=menu_home ?></a>
								<ul class="dropdown-menu">
									<li class="active"><a href="index.html">Default</a></li>
									<li><a href="../dark/index.html">Default Dark</a></li>
									<li><a href="home-fullpage.html">Parallax</a></li>
									<li><a href="../dark/home-fullpage.html">Parallax Dark</a></li>
								</ul>-->
							</li>
							<!-- TRADUÇÃO   menu_odontologia_estetica -->
							<li class="dropdown submenu <?php echo ($active=='odt') ? 'active' : '';?>">
								<a href="<?php base_url('odontologia-estetica') ?>"><?=menu_odontologia_estetica ?></a>
								<ul class="dropdown-menu">
									<!--<li class="active"><a href="index.html">Default</a></li>-->
									<!-- TRADUÇÃO   menu_alinhadores, menu_cdeo, menu_dsd, menu_facetas, menu_coroas, menu_implantes, menu_proteses, menu_servico  active_submenu -->
									<li class="<?php echo ($active_submenu=='ali') ? 'active' : '';?>"><a href="<?php base_url('odontologia-estetica/alinhadores') ?>"><?=menu_alinhadores ?></a></li>
									<li class="<?php echo ($active_submenu=='cdeo') ? 'active' : '';?>"><a href="<?php base_url('odontologia-estetica/cdeo') ?>"><?=menu_cdeo ?></a></li>
									<li class="<?php echo ($active_submenu=='dsd') ? 'active' : '';?>"><a href="<?php base_url('odontologia-estetica/dsd') ?>"><?=menu_dsd ?></a></li>
									<li class="<?php echo ($active_submenu=='fac') ? 'active' : '';?>"><a href="<?php base_url('odontologia-estetica/facetas') ?>"><?=menu_facetas ?></a></li>
									<li class="<?php echo ($active_submenu=='cor') ? 'active' : '';?>"><a href="<?php base_url('odontologia-estetica/coroas') ?>"><?=menu_coroas ?></a></li>
									<li class="<?php echo ($active_submenu=='imp') ? 'active' : '';?>"><a href="<?php base_url('odontologia-estetica/implantes') ?>"><?=menu_implantes ?></a></li>
									<li class="<?php echo ($active_submenu=='pro') ? 'active' : '';?>"><a href="<?php base_url('odontologia-estetica/proteses') ?>"><?=menu_proteses ?></a></li>
									<li class="<?php echo ($active_submenu=='ser') ? 'active' : '';?>"><a href="<?php base_url('odontologia-estetica/servicos') ?>"><?=menu_servico ?></a></li>
								</ul>
							</li>
							<!-- TRADUÇÃO   menu_studio -->
							<li class="dropdown submenu <?php echo ($active=='casos') ? 'active' : '';?>">
								<a href="<?php base_url('casos-clinicos') ?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=menu_studio ?></a>
								<!--<ul class="dropdown-menu" style="">
									<li><a href="work-grid.html">Work Grid</a></li>
									<li><a href="work-list.html">Work List</a></li>
									<li><a href="work-masonry.html">Work Masonry</a></li>
									<li><a href="project-detail.html">Project Details</a></li>
								</ul>-->
							</li>
							<!--<li class="dropdown submenu">
								<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Blog</a>
								<ul class="dropdown-menu" style="/*margin-top: 20px*/">
									<li><a href="blog-grid.html">Blog Grid</a></li>
									<li><a href="blog-masonry.html">Blog Masonry</a></li>
									<li><a href="blog-with-sidebar.html">Blog With Sidebar</a></li>
									<li><a href="single-blog-gallery.html">Single Blog Gallery</a></li>
									<li><a href="single-blog-image.html">Single Blog Image</a></li>
									<li><a href="single-blog-video.html">Single Blog Video</a></li>
								</ul>
							</li>-->
							<!-- TRADUÇÃO   menu_nossas_clinicas -->
							<li class="dropdown submenu <?php echo ($active=='clinic') ? 'active' : '';?>"><a href="<?php base_url('nossas-clinicas') ?>"><?=menu_nossas_clinicas ?></a></li>
							<!-- TRADUÇÃO   menu_blog -->
							<li class="dropdown submenu <?php echo ($active=='blog') ? 'active' : '';?>"><a href="<?php base_url('blog') ?>"><?=menu_blog ?></a></li>
							<!-- TRADUÇÃO   menu_sds -->
					        <li class="dropdown submenu <?php echo ($active=='sds') ? 'active' : '';?>"><a href="<?php base_url('sds') ?>"><?=menu_sds ?></a></li>
					        <!-- TRADUÇÃO   menu_fale_conosco -->
					        <li class="dropdown submenu <?php echo ($active=='suport') ? 'active' : '';?>"><a href="<?php base_url('fale-connosco') ?>"><?=menu_fale_conosco ?></a></li>
							<!--<li class="dropdown submenu">
								<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-globe-americas"></i> <?=lang?></a>
								<ul class="dropdown-menu" style="display: flex;flex-flow: column nowrap;">
									<li><a href="#" onclick="reloadCookie('EN')">EN</a></li>
									<li><a href="#" onclick="reloadCookie('PT')">PT</a></li>
									<li><a href="#" onclick="reloadCookie('UK')">UK</a></li>
									<li><a href="#" onclick="reloadCookie('FR')">FR</a></li>				
								</ul>
							</li>-->
														


						</ul>
						<ul class="nav navbar-nav navbar-right"  style="display: flex; flex-wrap: nowrap; justify-content: center;">
							<li class="<?php echo (lang=='EN') ? 'active' : '';?>"><a href="#" onclick="reloadCookie('EN')" >EN</a></li>
							<li class="<?php echo (lang=='PT') ? 'active' : '';?>"><a href="#" onclick="reloadCookie('PT')" >PT</a></li>
							<li class="<?php echo (lang=='UK') ? 'active' : '';?>"><a href="#" onclick="reloadCookie('UK')" >UK</a></li>
							<li class="<?php echo (lang=='FR') ? 'active' : '';?>"><a href="#" onclick="reloadCookie('FR')" >FR</a></li>
						</ul>
					</div>
				</nav>
			</header>
			
			<header class="full_header content-white mobile_menu">
        		<div class="float-left">
        			<a class="logo" href="<?=base_url('2020')?>"><img src="<?php base_url('OS_logo-01-whi.png','img') ?>" alt="" style="width: 150px; height: 35px;"><img src="<?php base_url('OS_logo-01.png','img') ?>" alt="" style="width: 150px; height: 40px;"></a>
        			<a class="phone" href="tel:3689565656"><i class="lnr lnr-phone-handset"></i> (+070) 3689 56 56 56</a>
        		</div>
        		<div class="float-right">
        			<div class="bar_menu">
        				<i class="lnr lnr-menu"></i>
        			</div>
        		</div>
        	</header>
        	
        	<div class="click-capture"></div>
			<div class="side_menu">
				<span class="close-menu lnr lnr-cross right-boxed"></span>
				<div class="menu-lang right-boxed">
					<a href="" class="<?php echo (lang=='EN') ? 'active' : '';?>" onclick="reloadCookie('EN')">EN</a>
					<a href="" class="<?php echo (lang=='PT') ? 'active' : '';?>" onclick="reloadCookie('PT')">PT</a>
					<a href="" class="<?php echo (lang=='UK') ? 'active' : '';?>" onclick="reloadCookie('UK')">UK</a>
					<a href="" class="<?php echo (lang=='FR') ? 'active' : '';?>" onclick="reloadCookie('FR')">FR</a>
				</div>
				<ul class="menu-list right-boxed">
					<!-- TRADUÇÃO   menu_home -->
					<!--<li class="<?php echo ($active=='home') ? 'active' : '';?>">
						<a href="<?php base_url('') ?>"><?=menu_home ?></a>
						
					</li> -->
					<!-- TRADUÇÃO   menu_odontologia_estetica -->
					<li class="<?php echo ($active=='odt') ? 'active' : '';?>" id="odonto"><a href="<?php base_url('odontologia-estetica') ?>"><?=menu_odontologia_estetica ?><i class="ion-chevron-down"></i></a>
						<ul class="list">
							<!-- TRADUÇÃO   menu_alinhadores, menu_cdeo, menu_dsd, menu_facetas, menu_coroas, menu_implantes, menu_proteses, menu_servico -->  
							<li class="<?php echo ($active_submenu=='ali') ? 'active' : '';?>"><a href="<?php base_url('odontologia-estetica/alinhadores') ?>"><?=menu_alinhadores ?></a></li>
							<li class="<?php echo ($active_submenu=='cdeo') ? 'active' : '';?>"><a href="<?php base_url('odontologia-estetica/cdeo') ?>"><?=menu_cdeo ?></a></li>
							<li class="<?php echo ($active_submenu=='dsd') ? 'active' : '';?>"><a href="<?php base_url('odontologia-estetica/dsd') ?>"><?=menu_dsd ?></a></li>
							<li class="<?php echo ($active_submenu=='fac') ? 'active' : '';?>"><a href="<?php base_url('odontologia-estetica/facetas') ?>"><?=menu_facetas ?></a></li>
							<li class="<?php echo ($active_submenu=='cor') ? 'active' : '';?>"><a href="<?php base_url('odontologia-estetica/coroas') ?>"><?=menu_coroas ?></a></li>
							<li class="<?php echo ($active_submenu=='imp') ? 'active' : '';?>"><a href="<?php base_url('odontologia-estetica/implantes') ?>"><?=menu_implantes ?></a></li>
							<li class="<?php echo ($active_submenu=='pro') ? 'active' : '';?>"><a href="<?php base_url('odontologia-estetica/proteses') ?>"><?=menu_proteses ?></a></li>
							<li class="<?php echo ($active_submenu=='ser') ? 'active' : '';?>"><a href="<?php base_url('odontologia-estetica/servicos') ?>"><?=menu_servico ?></a></li>
						</ul>
					</li>
					<!-- TRADUÇÃO   menu_studio -->
					<li class="<?php echo ($active=='casos') ? 'active' : '';?>">
						<a href="<?php base_url('casos-clinicos') ?>"><?=menu_studio ?></a>
						<!--<ul class="list">
							<li><a href="work-grid.html">Work Grid</a></li>
							<li><a href="work-list.html">Work List</a></li>
							<li><a href="work-masonry.html">Work Masonry</a></li>
							<li><a href="project-detail.html">Project Details</a></li>
						</ul>-->
					</li>
					<!--<li>
						<a href="index.html">Blog <i class="ion-chevron-down"></i></a>
						<ul class="list">
							<li><a href="blog-grid.html">Blog Grid</a></li>
							<li><a href="blog-masonry.html">Blog Masonry</a></li>
							<li><a href="blog-with-sidebar.html">Blog With Sidebar</a></li>
							<li><a href="single-blog-gallery.html">Single Blog Gallery</a></li>
							<li><a href="single-blog-image.html">Single Blog Image</a></li>
							<li><a href="single-blog-video.html">Single Blog Video</a></li>
						</ul>
					</li>-->
					<!-- TRADUÇÃO   menu_nossas_clinicas -->
					<li class="<?php echo ($active=='clinic') ? 'active' : '';?>"><a href="<?php base_url('nossas-clinicas') ?>"><?=menu_nossas_clinicas ?></a></li>
					<!-- TRADUÇÃO   menu_blog -->
					<li class="<?php echo ($active=='blog') ? 'active' : '';?>"><a href="<?php base_url('blog') ?>"><?=menu_blog ?></a></li>
					<!-- TRADUÇÃO   menu_sds -->
					<li class="<?php echo ($active=='sds') ? 'active' : '';?>"><a href="<?php base_url('sds') ?>"><?=menu_sds ?></a></li>
					<!-- TRADUÇÃO   menu_fale_conosco -->
					<li class="<?php echo ($active=='suport') ? 'active' : '';?>"><a href="<?php base_url('fale-connosco') ?>"><?=menu_fale_conosco ?></a></li>
				</ul>
				<div class="menu-footer right-boxed">
					<div class="social-list">
                        <a href="#"><i class="ion-social-instagram"></i></a>
                        <a href="#"><i class="ion-social-facebook"></i></a>
                        <a href="#"><i class="ion-social-youtube"></i></a>

						<!--<a href="" class="icon ion-social-dribbble-outline"></a>
						<a href="#"><i class="ion-social-twitter"></i></a>
                        <a href="#"><i class="ion-social-googleplus"></i></a>
                        <a href="#"><i class="ion-social-pinterest"></i></a>
                        <a href="#"><i class="ion-social-linkedin"></i></a>-->

					</div>
					<!-- TRADUÇÃO all_rights -->
					<div class="copy"><?=all_rights?></div>
				</div>
			</div>
			
			<!--================End Header Menu Area =================</div>-->
			