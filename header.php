<?php
	require("ua-parser/UAParser.php");
	$deviceResult = UA::parse();
	if ($deviceResult->isComputer == TRUE) header("Location: http://www.mymobilemainstreet.com/");
?><!DOCTYPE html>
<!--[if IEMobile 7 ]>
<html class="no-js iem7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if (gt IEMobile 7) | !(IEMobile) ]><!-->
<html class="no-js"> 
<!--<![endif]-->
<!--[if !(IEMobile) | !(gt IEMobile 7) ]><!-->
<html <?php language_attributes(); ?> >
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, maximum-scale=1.0;" />
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php bloginfo('template_directory'); ?>/images/h/apple-touch-icon.png"><!-- homescreen icon - iPhone Retina Display -->
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php bloginfo('template_directory'); ?>/images/m/apple-touch-icon.png"><!-- homescreen icon - iPad 1st gen -->
<link rel="apple-touch-icon-precomposed" href="<?php bloginfo('template_directory'); ?>/images/l/apple-touch-icon-precomposed.png"><!-- homescreen icon - nonRetina iPhone, iPod, Android 2.1+ -->
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/l/apple-touch-icon.png"><!-- homescreen icon - Nokia devices -->
<meta http-equiv="cleartype" content="on"><!-- font smoothing for IE -->
<meta name="apple-mobile-web-app-capable" content="yes"><!-- run full screen on iPhone when launched from shortcut -->
<link rel="apple-touch-startup-image" href="<?php bloginfo('template_directory'); ?>/images/l/splash.png"><!-- splash images for iOS -->


<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

	?></title>
	

<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/styles/theme-styles.css" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<script src="<?php bloginfo('template_directory'); ?>/js/zepto.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/event.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/iscroll.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/custom-global.js" type="text/javascript" charset="utf-8"></script>
<?php 
	// test to see if device is tablet, if it is write out js attachment
	if ($deviceResult->isTablet == TRUE) {
		echo '<link rel="stylesheet" type="text/css" media="all" href="';
		echo bloginfo('template_directory');
		echo '/styles/tablet-styles.css" />
		<script src="';
		echo bloginfo('template_directory');
		echo '/js/custom-tablet.js" type="text/javascript" charset="utf-8"></script>';
		}

	// test to see if device is mobile, but NOT tablet, if so write js attachment
	else { 
		echo '<script src="';
		echo bloginfo('template_directory');
		echo '/js/custom-handheld.js" type="text/javascript" charset="utf-8"></script>';
		
		}
		
	/* wp head hook, this makes sure plug-in can still register with this hook, deleting could cause issues*/
	wp_head();
	
	$postsPerPage = get_option('posts_per_page');
	
	
?>
</head>

<body <?php body_class('loading'); ?> onload="docLoaded()">
<div id="page" class="hfeed">
	<header id="branding" role="banner">
			<hgroup>
				<h1 id="site-title"><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span></h1>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" id="msmLogo" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"></a>
				<?php 
				if(is_home() == TRUE && $deviceResult->isMobile == TRUE && $deviceResult->isTablet != TRUE)	{
					echo '<a href="javascript:void(0)" onclick="toggleHome()" class="bannerIcon onclick" id="homeIcon"></a>';
				}
				if(is_home() != TRUE)	{
					echo '<a href="/" class="bannerIcon" id="homeIcon"></a>';
				}
				?>
					
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>directory/" class="bannerIcon" id="directoryIcon"></a>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>about/" class="bannerIcon" id="aboutIcon"></a>
				<a href="javascript:void(0)" class="bannerIcon" id="searchIcon"></a>
				<?php get_search_form(); ?>
			</hgroup>
			<div id="bannerSubTitle">
				<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
			</div>
	</header><!-- #branding -->
	<div id="loadHolder">
		<div id="loadCenter"></div>
	</div><!-- end loadHolder -->
	<div id="main">