<header class="">
    <div class="content">
        <div class="header">
            <div class="logo">
                <a class="navbar-brand" href="<?php base_url('') ?>"><img src="<?= base_url('OS_logo-01.png','img') ?>" alt=""></a>
            </div>
            <div id="burguer" class="burguer">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div class="menu">
            <div class="links">
				<ul class="main">
					<!-- TRADUÇÃO   menu_odontologia_estetica -->
					<li class="mobileOnly <?php echo ($active=='odt') ? 'active' : '';?>" id="odonto"><a href="<?php base_url('odontologia-estetica') ?>"><?=menu_odontologia_estetica ?></a>
						<ul class="submenu">
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
					<li class="desktopOnly <?php echo ($active=='odt') ? 'active' : '';?>"><a href="javascript: void(0)">Nossos Serviços</a>
						<ul class="submenu first">
							<!-- TRADUÇÃO   menu_alinhadores, menu_cdeo, menu_dsd, menu_facetas, menu_coroas, menu_implantes, menu_proteses, menu_servico -->  
					        <li class="<?php /*echo ($active=='odt') ? 'active' : '';*/ ?>"><a href="<?php base_url('odontologia-estetica') ?>"><?=menu_odontologia_estetica ?></a>
                            <li class="<?php /*echo ($active_submenu=='cdeo') ? 'active' : '';*/ ?>"><a href="javascript: void(0)">Tratamentos</a>
                                <ul class="submenu second">
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
						</ul>
					</li>
					<!-- TRADUÇÃO   menu_studio -->
					<li class="<?php echo ($active=='casos') ? 'active' : '';?>">
						<a href="<?php base_url('casos-clinicos') ?>"><?=menu_studio ?></a>
					</li>
					<!-- TRADUÇÃO   menu_nossas_clinicas -->
					<li class="<?php echo ($active=='clinic') ? 'active' : '';?>"><a href="<?php base_url('nossas-clinicas') ?>"><?=menu_nossas_clinicas ?></a></li>
					<!-- TRADUÇÃO   menu_blog -->
					<li class="<?php echo ($active=='blog') ? 'active' : '';?>"><a href="<?php base_url('blog') ?>"><?=menu_blog ?></a></li>
					<!-- TRADUÇÃO   menu_sds -->
					<li class="<?php echo ($active=='sds') ? 'active' : '';?>"><a href="<?php base_url('sds') ?>"><?=menu_sds ?></a></li>
					<!-- TRADUÇÃO   menu_fale_conosco -->
					<li class="<?php echo ($active=='suport') ? 'active' : '';?>"><a href="<?php base_url('fale-connosco') ?>"><?=menu_fale_conosco ?></a></li>
				</ul>
            </div>
            <div class="translation">
                <ul>
                    <li class="<?php echo (lang=='EN') ? 'active' : '';?>"><a href="javascript: void(0)" onclick="reloadCookie('EN')" >EN</a></li>
                    <li class="<?php echo (lang=='PT') ? 'active' : '';?>"><a href="javascript: void(0)" onclick="reloadCookie('PT')" >PT</a></li>
                    <li class="<?php echo (lang=='UK') ? 'active' : '';?>"><a href="javascript: void(0)" onclick="reloadCookie('UK')" >UK</a></li>
                    <li class="<?php echo (lang=='FR') ? 'active' : '';?>"><a href="javascript: void(0)" onclick="reloadCookie('FR')" >FR</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>