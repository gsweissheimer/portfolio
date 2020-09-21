
        <div class="section padding-top-bottom blue-cinza thirdSolutions">
            <div class="container">
                <div class="twelve columns">
                    <div class="title-text left">
                        <!-- Tradução solutions_three_a e solutions_three_b -->
                        <h3 style="max-width: 100%"><?=solutions_three_a?><span class="after whiteAfter" style="top: 14px;"></span><?=solutions_three_b?></h3>
                    </div>
                </div>
                <div class="clear"></div>
				<div class="container-flex">
                <?php
                    echo funGetSlide('solutions_three','','','
                        <div class="four columns"  data-scroll-reveal="enter bottom move 100px over 1s after 0.3s">
                            <div class="team-wrap">
                                <img src="{{img}}"  />
                                <h6>{{title}}</h6>
                                <p>{{text}}</p>
                            </div>
                        </div>');
                ?>
				</div>
            </div>
        </div>