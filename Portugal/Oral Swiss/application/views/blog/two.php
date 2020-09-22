
    <!--================1ra sesao =================-->
          
    <section class="blog_sidebar_area" id="top-sessao-blog">
        <div class="container" style="padding-bottom: 70px">
            <div class="row row_direction">
                <div class="col-lg-8 offset-lg-1">
                    <div class="blog_side_inner">

                        <?= getNews('
                            <div class="blog_side_item">
                                <div class="media" style="align-items: stretch;">
                                    <div class="d-flex" style="max-width: 40%">
                                        <img width="100%" src="{{image}}" alt="">
                                    </div>
                                    <div class="media-body" style="display: flex;flex-wrap: wrap;align-items: center;justify-content: flex-start;align-content: space-between;">
                                        <a class="time" style="margin-right:10px;cursor:default">{{publishDate}}</a>
                                        <a class="tag" style="margin:0;cursor:default">{{category}}</a>
                                        <a href="{{href}}"><h4>{{title}}</h4></a>
                                        <a class="ctaPattern ctaBottomLine ctaGreyC" href="{{href}}" style="padding: 0;font-size: 16px;">' . know_more . '</a>
                                    </div>
                                </div>
                            </div>',8); ?>






                    </div>
                    <nav id="pagination" data-blogcounter="<?=blogCounter()?>" aria-label="Page navigation example" class="pagination_inner" style="display: none">
                      <ul class="pagination">
                      </ul>
                    </nav>
                </div>
                <!-- TRADUÇÃO   blog_categoria  -->
                <div class="col-lg-3">
                    <div class="left_sidebar_area">
                        <aside class="l_widget categories_wd">
                            <div class="l_wd_title">
                                <h3><?=blog_categoria?></h3>
                            </div>
                            <ul class="list">

                                <?php
                                    echo funGetSlide('blog-categories','','','
                                    <li><a href="?categoria={{ctaTitle}}">{{ctaTitle}}  </a></li>
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
                                    <a href="?keywords={{ctaTitle}}">{{ctaTitle}}  </a>
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
    </section>           

    <!--================1ra sesao  =================-->

    <script>

        var pagHTML = "";

        const paginationArmy = document.getElementById('pagination');
        const paginationListEl = paginationArmy.querySelector('ul');

        const blogCounter = paginationArmy.dataset.blogcounter;

        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const page = urlParams.get('page');
        const pages = Math.ceil(blogCounter/4);
        const prevPage = page > 1 ? page - 1 : null;
        const nextPage = page < pages ? parseInt(page) + parseInt(1) : null;

        if(blogCounter > 4) definePagination();

        function definePagination() {

            if (page > 1 && page != null) definePrev();

            definePages(pages);

            if (page != pages) defineNext();

            showPagination();

        }

        function definePrev() {

            pagHTML += `<li class="page-item prev" style=""><a class="page-link" href="/blog?page=${prevPage}"><i class="ion-ios-arrow-left"></i></a></li>`;

        }

        function definePages(pages) {

            for (let index = 1; index <= pages; index++) {

                pagHTML += `<li class="page-item page_${index}"><a class="page-link" href="/blog?page=${index}">${index}</a></li>`;

            } 

        }

        function defineNext() {

            pagHTML += `<li class="page-item next" style=""><a class="page-link" href="/blog?page=${nextPage}"><i class="ion-ios-arrow-right"></i></a></li>`;

        }

        function showPagination() {

            paginationListEl.innerHTML = pagHTML;

            paginationArmy.style.display = 'block';

            if (page == 1 || page == null) document.querySelector('.page_1').classList.add('active');
            if (page > 1) document.querySelector('.page_'+page).classList.add('active');

            

        }

    </script>

                        