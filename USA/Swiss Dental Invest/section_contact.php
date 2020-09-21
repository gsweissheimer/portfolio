

        <!-- =====================================
        ==== Start Contact -->
        <section class="contact" data-scroll-index="6">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 contact-form">
                        <form class="form" id="" method="post" action="send.php">

                            <div class="messages"></div>

                            <div class="controls">

                                <div class="row">
                                    <?php
                                        echo funGetAdvancedBanners('invest_contact', '
                                        <div class="section-head col-sm-12">
                                            <h4 style="color: #2B4258">
                                                <span style="{{callAction}}">{{title}}</span><br>
                                                {{subtitle}}
                                            </h4>
                                        </div>');
                                    ?>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input id="form_name" type="text" name="name" placeholder="<?=form_name?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input id="form_subject" type="text" name="phone" placeholder="<?=form_phone?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input id="form_email" type="email" name="email" placeholder="<?=form_email?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea name="description" id="description" placeholder="<?=form_desc?>" required cols="30" rows=3></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="disabled"><span><?=send_button?></span></button>
                                    </div>

                                </div>                             
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Contact ====
        ======================================= -->