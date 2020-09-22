
	<section id="banner" class="main-slider" data-carousel="swiper">
        <div id="banner-container" class="swiper-container full-screen" data-swiper="container">
            <div class="swiper-wrapper">

                <div class="swiper-slide slide-item" data-parallax="image" data-bg-image="<?php echo base_url('img/banner_1.png','img') ?>">

                    <div class="overlay full-screen" data-bg-color="rgba(0,0,0,0.0)">
                        <div class="slide-caption main-banner" style="width: 65%;padding: 50px 100px 50px 200px">
                            <h1 class="slider-huge-title text-center" data-animate="fadeInUp" data-delay="0.6s" data-duration="0.5s">Proteção e tranquilidade, sem se preocupar com gastos <span>futuros</span>.</h1>

                            <div class="slide-tag" data-animate="fadeInUp" data-delay="0.8s" data-duration="0.5s">
                                <p class="price_p">Mensalidades a partir de</p>
                                <h2 class="price">55<span>,53€*</span></h2>
                            </div><!-- /.slide-tag -->

                            <div class="slide-description" data-animate="fadeInUp" data-delay="1.0s" data-duration="0.5s">
                                <em class="banner_em">Encontre o melhor plano<br>de Saúde Oral para você,<br>sua família ou empresa.</em>
                                <p style="margin-top: 150px;font-size: 0.7em;line-height: 12px;font-weight: 400;">*Consulte condições mediante idade,<br>quantidade de pessoas e localização.</p>
                            </div><!-- /.slide-description -->
                        </div><!-- /.slide-caption -->
                        <div class="form-banner">
                            <h3 class="fadeInUp" data-wow-delay="0.2s">Solicite Cotação Aqui</h3>
                            <div class="contact-form">
                                <form id="dt-contact-form" class="dt-contact-form-ajax" action="php/contact.php" method="post">
                                    <div class="col-md-12 wow fadeInUp no-padding" data-wow-delay="0.3s">
                                        <input type="text" name="name" id="dt-name" placeholder="Nome: *" required>
                                    </div>
                                    <div class="col-md-12 wow fadeInUp no-padding" data-wow-delay="0.4s">
                                        <input type="text" name="name" id="dt-name" placeholder="E-mail: *" required>
                                    </div>
                                    <div class="col-md-12 wow fadeInUp no-padding" data-wow-delay="0.5s">
                                        <input type="text" name="name" id="dt-name" placeholder="Cidade: *" required>
                                    </div>
                                    <div class="col-md-12 wow fadeInUp no-padding" data-wow-delay="0.6s">
                                        <input type="text" name="name" id="dt-name" placeholder="Telemóvel: *" required>
                                    </div>
                                    <div class="col-md-12 wow no-padding" data-wow-delay="0.7s">
                                        <input type="text" name="name" id="dt-name" placeholder="Quantidade de vidas (pessoas): *" required>
                                    </div>
                                    <div class="col-md-12 wow no-padding" data-wow-delay="0.9s">
                                        <select name="" id="">
                                            <option>Escolha o plano: *</option>
                                            <option>ROTA</option>
                                            <option>CDP</option>
                                            <option>CD</option>
                                            <option>CDEO</option>
                                            <option>Poupança ROTA</option>
                                            <option>TID</option>
                                        </select>
                                    </div>
                                    <div class="text-center wow fadeInUp" data-wow-delay="1.0s">
                                        <button type="submit" class="dt-btn big red text-uppercase">ENVIAR</button>
                                        <!-- <input type="submit" value="Send" class="dt-btn medium text-uppercase"> -->
                                    </div>
                                    <div class="dt-ajax-response"></div>
                                </form>
                            </div><!-- /.contact-form -->
                        </div>
                    </div><!-- /.overlay -->

                </div>
                
            </div><!-- /.swiper-wrapper -->

        </div><!-- /.swiper-container -->

        <!-- Add Arrows -->
        <div id="banner-slider-next" class="slide-button next dti-slim-right" data-swiper="next">
        </div>
        <div id="banner-slider-prev" class="slide-button prev dti-slim-left" data-swiper="prev">
        </div>
    </section>