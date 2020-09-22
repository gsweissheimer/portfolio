
					<li>
						<!-- TRADUÇÃO menu_wync -->
						<a href="<?php base_url('por-que-voce-precisa-de-uma-consultoria') ?>"><?=menu_wync?></a>
					</li>
					<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children">
						<!-- TRADUÇÃO menu_solutions -->
						<a href="<?php base_url('solucoes') ?>"><?=menu_solutions?></a>
						<ul class="normal-sub" style="display: none; opacity: 1;">
							<li class="menu-item menu-item-type-post_type menu-item-object-page">
								<a href="<?php base_url('solucao/kick-off') ?>">Kick Off</a>
							</li>
							<li class="menu-item menu-item-type-post_type menu-item-object-page">
								<a href="<?php base_url('solucao/setup') ?>">Setup</a>
							</li>
							<li class="menu-item menu-item-type-post_type menu-item-object-page">
								<a href="<?php base_url('solucao/growth') ?>">Growth</a>
							</li>
							<li class="menu-item menu-item-type-post_type menu-item-object-page">
								<a href="<?php base_url('solucao/triumph') ?>">Triumph</a>
							</li>
						</ul>
					</li>
					<li> 
						<!-- TRADUÇÃO menu_contacto -->
						<a href="<?php base_url('fale-connosco') ?>"><?=menu_contacto?></a>
					</li>
					<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children">
						<!-- TRADUÇÃO lang -->
						<a href="#"><div class="fa fa-globe" aria-hidden="true"></div> <?=lang?></a>
						<ul class="normal-sub" style="display: none; opacity: 1;">
							<li class="menu-item menu-item-type-post_type menu-item-object-page">
								<a href="#" onclick="reloadCookie('PT')">PT</a>
							</li>
							<li class="menu-item menu-item-type-post_type menu-item-object-page">
								<a href="#" onclick="reloadCookie('EN')">US</a>
							</li>
							<li class="menu-item menu-item-type-post_type menu-item-object-page">
								<a href="#" onclick="reloadCookie('UK')">UK</a>
							</li>
							<li class="menu-item menu-item-type-post_type menu-item-object-page">
								<a href="#" onclick="reloadCookie('FR')">FR</a>
							</li>
						</ul>
					</li>