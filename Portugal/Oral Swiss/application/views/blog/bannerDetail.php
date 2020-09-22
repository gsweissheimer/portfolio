
    <?php echo getOneNew($post_id,'
			<section class="image_banner_area" style="background-image: url({{image}});background-position-y:top;position:relative">
			<div class="filterBlog" style="
				position: absolute;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				background: black;
				z-index: 1;
				opacity: .5;
			"></div>
				<div class="container">
					<div class="single_banner_text" style="position:relative;z-index:2">
						<div class="date">
							<a href="#">{{publishDate}}</a>
							<i class="ion-record"></i>
							<a href="#">{{editor}}</a>
						</div>
						<h3>{{title}}</h3>
					</div>
				</div>
			</section>'); ?>