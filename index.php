<?php 
	require("header.php"); 
	require("sidebar.php");
?>
<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<div class="pageCrumb category">
			<a href="#" onclick="history.go(-1);return false;" class="backBtn onclick">
				<span></span>
				<?php // The next line should ideally be used to display the parent category name, instead of the word 'back', but I haven't gotten it working for some reason ?>
				<h2 class="crumbCat">Back</h2>
			</a>
		</div><!-- end #pageCrumb -->
		<section id="primary">
			<div id="content" role="main">
			
					<?php get_template_part( 'content' ); ?>
			
			</div><!-- end #content -->
		</div><!-- end #primary -->
	<?php endwhile; ?>
<?php else : ?>

	<div class="pageCrumb category">
		<a href="#" onclick="history.go(-1);return false;" class="backBtn onclick">
			<span></span>
			<h2 class="crumbCat">Back</h2>
		</a>
	</div><!-- end #pageCrumb -->
	<section id="primary">
		<div id="content" role="main">
			<div class="contentWrapper">
				<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven' ); ?></p>
				<?php get_search_form(); ?>
			</div><!-- end .contentWrapper -->
		</div><!-- end #content -->
	</div><!-- end #primary -->

<?php endif; ?>





<?php get_footer(); ?>