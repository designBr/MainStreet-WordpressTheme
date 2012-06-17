<?php 
	require("header.php"); 
	require("sidebar.php");
?>
	<?php if ( have_posts() ) : ?>
		<div class="pageCrumb category">
			<a href="#" onclick="history.go(-1);return false;"  class="backBtn onclick">
				<span></span>
				<h2 class="crumbCat"><?php single_cat_title(); ?></h2>
			</a>
		</div><!-- end #pageCrumb -->
		<section id="primary">
			<div id="content" role="main">

				<ul class="articleList">
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

		          	<li><a href="<?php the_permalink(); ?>">
						<div class="thumbWrap">
							<span>
								<?php show_thumbnail(); ?>
							</span>
						</div><!-- end #thumbWrap -->
						<div class="listText">
							<h3><?php the_title(); ?></h3>
							<h4><?php the_author(); ?></h4>
						</div>
						<div class="clear"></div>
					</a></li>
					<div class="clear"></div>

				<?php endwhile; ?>
				<li class="navigation">
					<div class="pagedLink older">
						<div class="thumbWrap"></div><!-- end #thumbWrap -->
						<div class="listText">
							<? next_posts_link('&larr; Older Entries') ?>
						</div>
					</div>
					<div class="pagedLink newer">
						<div class="thumbWrap"></div><!-- end #thumbWrap -->
						<div class="listText">
							<? previous_posts_link('Newer Entries &rarr;') ?>
						</div>
					</div>
					<div class="clear"></div>
				</li>
				</ul>


			</div><!-- #content -->
		</section><!-- #primary -->
	<?php endif; ?>

<?php get_footer(); ?>