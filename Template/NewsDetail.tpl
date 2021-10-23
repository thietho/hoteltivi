<?php echo $header?>
<main role="main" class="mgt-head">
	<?php echo $banner?>
    <?php echo $bookingform?>
	<div id="position">
		<div class="container">
			<ul>
				<li><a href="#">Home</a>
				</li>
				<li><a href="#">Tin tức</a>
				</li>
				<li><?php echo $content['title']?></li>
			</ul>
		</div>
	</div>
	<!-- End position -->
	<div class="container margin_60">
		<div class="row">

			<div class="col-lg-9">
				<div class="box_style_1">
					<div class="post nopadding">
						
						<h2><?php echo $content['title']?></h2>
						<div class="post_info clearfix">
							<div class="post-left">
								<ul>
									<li><i class="icon-calendar-empty"></i>On <span><?php echo $content['createdat']?></span>
									</li>
									<li><i class="icon-inbox-alt"></i>In <a href="#">Top tours</a>
									</li>
									<li><i class="icon-tags"></i>Tags <a href="#">Works</a> <a href="#">Personal</a>
									</li>
								</ul>
							</div>
							<div class="post-right"><i class="icon-comment"></i><a href="#">25 </a>Comments</div>
						</div>
						<?php echo $content['description']?>
					</div>
					<!-- end post -->
				</div>
				<!-- end box_style_1 -->

				<h4>Các tin cũ hơn</h4>

				<ul class="recent_post">
					<?php foreach($morenews as $item){ ?>
					<li>
						<i class="icon-calendar-empty"></i> <?php echo $item['createdat']?> - <a href="<?php echo $item['link']?>"><?php echo $item['title']?></a>
					</li>
					<?php } ?>
				</ul>
			</div>
			<!-- End col-md-8-->

			<aside class="col-lg-3 add_bottom_30">
				<div class="widget" id="cat_blog">
					<h4>Danh mục</h4>
					<ul>
						<?php foreach($sitebarsitemaps as $sitemap){ ?>
						<li><a href="<?php echo $this->request->createLink($sitemap['sitemapid'])?>"><?php echo $sitemap['sitemapname']?></a></li>
						<?php } ?>
					</ul>
				</div>
				<!-- End widget -->

				<hr>

				<div class="widget">
					<h4>Recent post</h4>
					<ul class="recent_post">
						<?php foreach($newpost as $content){ ?>
						<li>
							<i class="icon-calendar-empty"></i> <?php echo $content['createdat']?>
							<div><a href="<?php echo $content['link']?>" alt="<?php echo $content['title']?>"><?php echo $content['title']?></a>
							</div>
						</li>
						<?php } ?>
					</ul>
				</div>
				<!-- End widget -->
				<hr>

				<!-- End widget -->

			</aside>
			<!-- End aside -->

		</div>
		<!-- End row-->
	</div>
	<!-- End container -->
    
</main>
<?php echo $footer?>
