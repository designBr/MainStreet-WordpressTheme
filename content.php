<?php
/**
 * The default template for displaying content
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>
	<?php if ( $post->post_name == 'directory' ) : ?>
		<?php the_content(); ?>
	<?php else : ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class('contentWrapper'); ?>>
			<div class="entry-header">
				<a href="#"><?php the_author_posts_link(); ?></a>
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyeleven' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			</div><!-- .entry-header -->
			<div class="entry-content">
				<?php the_content(); ?>
			</div><!-- .entry-content -->
			<div class="entry-meta">
				<div class="morePostLink metaObject">More posts by <span class="authorMetaLink"><?php the_author_posts_link(); ?></span></div>
				<div class="authPage metaObject"><a href="<?php the_author_meta('user_url'); ?>">More info about <span><?php the_author_meta('display_name'); ?></span></a></div>
				<div class="metaPostDate metaObject"><?php twentyeleven_posted_on(); ?></div>	
			</div><!-- #entry-meta -->
		</article><!-- #post-<?php the_ID(); ?> -->
	<?php endif; ?>
	
	
