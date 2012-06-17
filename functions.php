<?php

// This function pulls the firs image from each post to be used as a thumbnail
function show_thumbnail() {
$files = get_children('post_parent='.get_the_ID().'&post_type=attachment&post_mime_type=image');
	if($files) :
		$keys = array_reverse(array_keys($files));
		$j=0;
		$num = $keys[$j];
		$image=wp_get_attachment_image($num, 'large', false);
		$imagepieces = explode('"', $image);
		$imagepath = $imagepieces[1];
		$thumb=wp_get_attachment_thumb_url($num);
		print "<img src='$thumb' class='thumbnail' />";
	endif;
}

function show_post_image_url() {
$files = get_children('post_parent='.get_the_ID().'&post_type=attachment&post_mime_type=image');
	if($files) :
		$keys = array_reverse(array_keys($files));
		$j=0;
		$num = $keys[$j];
		$image=wp_get_attachment_image($num, 'large', false);
		$imagepieces = explode('"', $image);
		print $imagepieces[5];
	endif;
}

// customize login page logo via inserted stylesheet
function custom_login() { 
	echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('template_directory').'/custom-login/custom-login.css" />'; 
}
add_action('login_head', 'custom_login');



if ( ! function_exists( 'twentyeleven_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own twentyeleven_posted_on to override in a child theme
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_posted_on() {
	printf( __( '<span class="sep">Posted on </span><time class="entry-date" datetime="%3$s" pubdate>%4$s</time>', 'twentyeleven' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		sprintf( esc_attr__( 'View all posts by %s', 'twentyeleven' ), get_the_author() ),
		esc_html( get_the_author() )
	);
}
endif;




?>