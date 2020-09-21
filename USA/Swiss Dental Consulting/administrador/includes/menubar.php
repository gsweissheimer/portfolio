<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel hidden">
      <div class="pull-left image">
        <img src="assets/img/user2-160x160.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?= $_COOKIE['usr_ck_name']; ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form hide">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
          </button>
        </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">Comum</li>
      <?php
      if ($_COOKIE['usr_per'] != "2") {
      ?>
        <li class="treeview">
          <a href="config.php">
            <i class="fa fa-cogs"></i> <span>General</span>
          </a>
        </li>
        <li class="treeview">
          <a href="pages.php">
            <i class="fa fa-file"></i> <span>Páginas</span>
          </a>
        </li>
        <li class="treeview">
          <a href="redes-sociais.php">
            <i class="fa fa-share-alt"></i> <span>Redes Sociais</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="redes-sociais.php"><i class="fa fa-circle-o"></i>Consultar</a></li>
            <li><a href="redes-sociais-adicionar.php"><i class="fa fa-circle-o"></i> Adicionar</a></li>
          </ul>
        </li>
        <!-- <li class="treeview">
          <a href="contactos.php">
            <i class="fa fa-phone"></i> <span>Contactos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="contactos.php"><i class="fa fa-circle-o"></i>Consultar</a></li>
            <li><a href="contactos-adicionar.php"><i class="fa fa-circle-o"></i> Adicionar</a></li>
          </ul>
        </li> -->
        <!-- <li class="treeview">
          <a href="parceiros.php">
            <i class="fa fa-users"></i><span> Parceiros</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="parceiros.php"><i class="fa fa-circle-o"></i>Consultar</a></li>
            <li><a href="parceiros-adicionar.php"><i class="fa fa-circle-o"></i>Adicionar</a></li>
          </ul>
        </li> -->
        <li class="treeview">
          <a href="slides.php">
            <i class="fa fa-slideshare"></i> <span>Slides</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="slides.php"><i class="fa fa-circle-o"></i>Consultar</a></li>
            <li><a href="slides-adicionar.php"><i class="fa fa-circle-o"></i>Adicionar</a></li>
            <li><a href="slides-tag-adicionar.php"><i class="fa fa-circle-o"></i>Adicionar Tag</a></li>
          </ul>
        </li>
        <!-- <li class="treeview">
          <a href="banner.php">
            <i class="fa fa-slideshare"></i> <span>Banner</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="banner.php"><i class="fa fa-circle-o"></i>Consultar</a></li>
            <li><a href="banner-tag-adicionar.php"><i class="fa fa-circle-o"></i> Adicionar Tag</a></li>
            <li><a href="banner-adicionar.php"><i class="fa fa-circle-o"></i> Adicionar</a></li>
          </ul>
        </li> -->
        <li class="treeview">
          <a href="advanced-banner.php">
            <i class="fa fa-slideshare"></i> <span>Advanced Banner</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="advanced-banner.php"><i class="fa fa-circle-o"></i>Consultar</a></li>
            <li><a href="advanced-banner-tag-adicionar.php"><i class="fa fa-circle-o"></i> Adicionar Tag</a></li>
            <li><a href="advanced-banner-adicionar.php"><i class="fa fa-circle-o"></i> Adicionar</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="advantages.php">
            <i class="fa fa-plus-circle"></i> <span>Features</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="features.php"><i class="fa fa-circle-o"></i>Consultar</a></li>
            <li><a href="features-adicionar.php"><i class="fa fa-circle-o"></i>Adicionar</a></li>
            <li><a href="features-tag-adicionar.php"><i class="fa fa-circle-o"></i> Adicionar Tag Advantage</a></li>
          </ul>
        </li>
        <!--//////////////////////////////////////////////////////////////////////-->


        <!-- <li class="treeview">
          <a href="advantages.php">
            <i class="fa fa-plus-circle"></i> <span>Packages</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="packages.php"><i class="fa fa-circle-o"></i>Consultar</a></li>
            <li><a href="packages-adicionar.php"><i class="fa fa-circle-o"></i>Adicionar</a></li>
            <li><a href="packages-tag-adicionar.php"><i class="fa fa-circle-o"></i> Adicionar Tag Advantage</a></li>
          </ul>
        </li> -->
        <!-- MENUS -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-bars" aria-hidden="true"></i> <span>Menus</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="menus.php"><i class="fa fa-circle-o"></i>Consultar</a></li>
            <li><a href="menus-adicionar.php"><i class="fa fa-circle-o"></i>Adicionar</a></li>
            <li><a href="menus-tag-adicionar.php"><i class="fa fa-circle-o"></i> Adicionar Tag Advantage</a></li>
          </ul>
        </li>


        <!--//////////////////////////////////////////////////////////////////////-->
        <!-- <li class="treeview">
        <a href="clinicas.php">
          <i class="fa fa-info-circle"></i><span>Modelos</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="active"><a href="modelos.php"><i class="fa fa-circle-o"></i>Ver tudo</a></li>
          <li><a href="modelos-adicionar.php"><i class="fa fa-circle-o"></i> Adicionar modelos</a></li>
          <li class="treeview">
                <a href="#"><i class="fa fa-circle-o"></i>Especificações
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="especificacoes-adicionar.php"><i class="fa fa-circle-o"></i>Adicionar</a></li>
                  <li><a href="especificacoes.php"><i class="fa fa-circle-o"></i>Consultar</a></li>
                </ul>
              </li>
        </ul>

      </li> -->
        <!-- <li class="treeview">
        <a href="clinicas.php">
          <i class="fa fa-hospital-o"></i> <span>Clinicas</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="active"><a href="clinicas.php"><i class="fa fa-circle-o"></i>Ver tudo</a></li>
          <li><a href="clinicas-adicionar.php"><i class="fa fa-circle-o"></i> Adicionar clinica</a></li>
        </ul>
      </li> -->
        <!-- <li class="treeview">
          <a href="media.php">
            <i class="fa fa-video-camera"></i> <span>Medias</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="media.php"><i class="fa fa-circle-o"></i>See All</a></li>
            <li><a href="media-adicionar.php"><i class="fa fa-circle-o"></i> Adicionar Media</a></li>
          </ul>
        </li> -->
        <!-- POPUP -->
        <li class="treeview">
          <a href="popup.php">
            <i class="fa fa-cog"></i> <span>Popup</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="popup.php"><i class="fa fa-circle-o"></i>See all popups</a></li>
            <li><a href="popup-add.php"><i class="fa fa-circle-o"></i> Add popup</a></li>
          </ul>
        </li>
      <?php
      }
      ?>
      <li class="treeview">
        <a href="noticias.php">
          <i class="fa fa-newspaper-o"></i><span>Notícias</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="active"><a href="noticias.php"><i class="fa fa-circle-o"></i>Consultar</a></li>
          <li><a href="noticias-adicionar.php"><i class="fa fa-circle-o"></i>Adicionar</a></li>
        </ul>
      </li>
      <?php
      if ($_COOKIE['usr_per'] != "2") {
      ?>
        <!-- <li class="treeview">
        <a href="eventos.php">
          <i class="fa fa-calendar"></i> <span>Eventos</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="active"><a href="eventos.php"><i class="fa fa-circle-o"></i>Consultar</a></li>
          <li><a href="eventos-adicionar.php"><i class="fa fa-circle-o"></i> Adicionar</a></li>
        </ul>
      </li> -->
        <li class="treeview">
          <a href="traducoes.php">
            <i class="fa fa-language" aria-hidden="true"></i><span> Traduções</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="traducoes.php"><i class="fa fa-circle-o"></i>Ver tudo</a></li>
            <li><a href="traducao-adicionar.php"><i class="fa fa-circle-o"></i> Adicionar tradução</a></li>
          </ul>
        </li>
        <!-- <li class="treeview">
        <a href="paginas.php">
          <i class="fa fa-cog"></i> <span>Paginas</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="active"><a href="paginas.php"><i class="fa fa-circle-o"></i>Ver tudo</a></li>
          <li><a href="paginas-adicionar.php"><i class="fa fa-circle-o"></i> Adicionar Pag </a></li>
        </ul>
      </li> -->
        <li class="treeview">
          <a href="seo.php">
            <i class="fa fa-search"></i><span> SEO</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="seo.php"><i class="fa fa-circle-o"></i>Consultar</a></li>
            <li><a href="seo-adicionar.php"><i class="fa fa-circle-o"></i>Adicionar</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="images.php">
            <i class="fa fa-slideshare"></i> <span>Images</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="images.php"><i class="fa fa-circle-o"></i>Consultar</a></li>
            <li><a href="images-tag-adicionar.php"><i class="fa fa-circle-o"></i> Adicionar Tag</a></li>
            <li><a href="images-adicionar.php"><i class="fa fa-circle-o"></i> Adicionar</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="faqs.php">
            <i class="fa fa-question-circle" aria-hidden="true"></i><span> Faq's</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="faqs.php"><i class="fa fa-circle-o"></i>Consultar</a></li>
            <li><a href="faqs-adicionar.php"><i class="fa fa-circle-o"></i>Adicionar</a></li>
            <li><a href="faqs-tag.php"><i class="fa fa-circle-o"></i>Consultar Tag</a></li>
            <li><a href="faqs-tag-adicionar.php"><i class="fa fa-circle-o"></i> Adicionar Tag</a></li>
          </ul>
        </li>
        <!-- EBOOK -->
        <!-- <li class="treeview">
          <a href="ebooks.php">
            <i class="fa fa-cog"></i> <span>Ebooks</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="ebooks.php"><i class="fa fa-circle-o"></i>See all ebooks</a></li>
            <li><a href="ebooks-adicionar.php"><i class="fa fa-circle-o"></i> Add ebook</a></li> -->
            <!--<li><a href="ebooks-tag.php"><i class="fa fa-circle-o"></i>See all ebook tags</a></li>-->
            <!-- <li><a href="ebooks-tag-adicionar.php"><i class="fa fa-circle-o"></i> Add ebook tag</a></li>
          </ul>
        </li> -->
        <!-- <li>
        <a href="about.php">
          <i class="fa fa-info-circle"></i> <span>About</span>
        </a>
      </li> -->
        <li class="treeview">
          <a href="terms.php">
            <i class="fa fa-info-circle"></i> <span>Terms</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="terms.php"><i class="fa fa-circle-o"></i>Consultar</a></li>
            <li><a href="terms-adicionar.php"><i class="fa fa-circle-o"></i>Adicionar</a></li>
          </ul>
        </li>
        <li class="header">Administrador</li>
        <li class="treeview">
          <a href="utilizadores.php">
            <i class="fa fa-user"></i> <span>Utilizadores</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="utilizadores.php"><i class="fa fa-circle-o"></i>Ver tudo</a></li>
            <li><a href="utilizador-adicionar.php"><i class="fa fa-circle-o"></i> Adicionar Utilizador</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="paises.php">
            <i class="fa fa-globe"></i> <span>Paises</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="paises.php"><i class="fa fa-circle-o"></i>Consultar</a></li>
            <li><a href="paises-adicionar.php"><i class="fa fa-circle-o"></i>Adicionar</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="idiomas.php">
            <i class="fa fa-flag" aria-hidden="true"></i> <span>Idioma</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="idiomas.php"><i class="fa fa-circle-o"></i>Consultar</a></li>
            <li><a href="idiomas-adicionar.php"><i class="fa fa-circle-o"></i>Adicionar</a></li>
          </ul>
        </li>
        <li class="header">Utilizador</li>
        <li class="treeview">
          <a href="paises.php">
            <i class="fa fa-user"></i> <span>Perfil</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="alterar-password.php"><img src="assets/img/icons/lock.svg" width="10" height="10"><span> Alterar Password</span>
            <li><a href="alterar-username.php"><i class="fa fa-circle-o"></i>Alterar Username</a></li>
          </ul>
        </li>
      <?php
      }
      ?>




    </ul>
  </section>
  <!-- /.sidebar -->
</aside>