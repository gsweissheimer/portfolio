
			<section class="single_blog_content" id="top-sessao-blog">
				<div class="container">
					<div class="s_blog_text_inner">
						<div class="row">
							<div class="col-lg-8">
                                <?php echo getOneNew($post_id,'
                                    <div class="blog_main_text">
                                        {{details}}

                                    </div>'); ?>
							</div>
                            <!-- TRADUÇÃO   blog_categoria  -->
							<div class="col-lg-3 offset-lg-1">
                                <div class="left_sidebar_area">
                                    <aside class="l_widget categories_wd">
                                        <div class="l_wd_title">
                                            <h3><?=blog_categoria?></h3>
                                        </div>
                                        <ul class="list">

                                            <?php
                                                echo funGetSlide('blog-categories','','','
                                                <li><a href="?categoria={{callAction}}">{{ctaTitle}}  </a></li>
                                            ');

                                            ?>
                                        </ul>
                                    </aside>
                                    <!-- TRADUÇÃO   blog_posts  -->
                                    <aside class="l_widget r_post_wd">
                                        <div class="l_wd_title">
                                            <h3><?=blog_posts?></h3>
                                        </div>
                                    <?= getNews('
                                        <div class="media">
                                            <div class="d-flex" style="max-width: 30%">
                                                <img width="100%" src="{{image}}" alt="">
                                            </div>
                                            <div class="media-body">
                                                <a href="{{href}}"><h4>{{title}}</h4></a>
                                            </div>
                                        </div>',3); ?>






                                    </aside>
                                    <!-- TRADUÇÃO   blog_tags  -->
                                    <aside class="l_widget tags_wd">
                                        <div class="l_wd_title">
                                            <h3><?=blog_tags?></h3>
                                        </div>
                                        <div class="tag_list">
                                            <?php
                                                echo funGetSlide('blog-keys','','','
                                                <a href="?keywords={{callAction}}">{{ctaTitle}}  </a>
                                            ');

                                            ?>
                                        </div>
                                    </aside>
                                    <aside class="l_widget search_wd">
                                        <div class="l_wd_title">
                                            <h3><?=contact_titulo2?></h3>
                                        </div>
                                        
                                        <h2><?=contato_cidade?></h2>
                                        <p><?=contato_endereco1?><br /><?=contato_endereco2?></p>
                                        <p><?=contato_telefone_comercial?></p>
                                        <p><?=contato_correio_comercial?></p>
                                    </aside>
                                </div>
							</div>
						</div>
					</div>
				</div>
			</section>