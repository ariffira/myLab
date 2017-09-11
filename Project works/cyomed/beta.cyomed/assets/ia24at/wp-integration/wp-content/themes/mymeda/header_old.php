<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package mymeda
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<header  class="header" id="masthead" class="site-header" role="banner">
		<div class="wrapper">
			<div class="site-branding">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			</div>

			<nav id="site-navigation" class="main-navigation" role="navigation">
				<span class="menu-toggle"><?php _e( 'Menu', 'mymeda' ); ?></span>
				

				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</nav><!-- #site-navigation -->
			<div class="toplinks">
				<ul>
					<li><a href="#">Register</a></li>
					<li><a href="#">Login</a></li>
					<li class="last"><a href="#">English</a></li>
				</ul>
				<div class="toplinks-bg"></div>
			</div>
		</div>
	</header><!-- #masthead -->
	<?php
		if (is_front_page())
	{?>

	<div class="banner-container">
		<div class="banner">
			<ul class="wideslider">
				<li><?php echo '<img src="'.get_bloginfo('template_url').'/images/slide1.png" alt="" />'; ?></li>
				<li><?php echo '<img src="'.get_bloginfo('template_url').'/images/slide2.png" alt="" />'; ?></li>
				<li><?php echo '<img src="'.get_bloginfo('template_url').'/images/slide3.png" alt="" />'; ?></li>
				<li><?php echo '<img src="'.get_bloginfo('template_url').'/images/slide4.png" alt="" />'; ?></li>
			</ul>

			<div id="bx-pager">
				<a data-slide-index="0" href="" class="slidetm1"><?php echo '<img src="'.get_bloginfo('template_url').'/images/sliderth4.png" alt="" />'; ?></a>
				<a data-slide-index="1" href="" class="slidetm2"><?php echo '<img src="'.get_bloginfo('template_url').'/images/sliderth3.png" alt="" />'; ?></a>
				<a data-slide-index="2" href="" class="slidetm3"><?php echo '<img src="'.get_bloginfo('template_url').'/images/sliderth2.png" alt="" />'; ?></a>
				<a data-slide-index="3" href="" class="slidetm4"><?php echo '<img src="'.get_bloginfo('template_url').'/images/sliderth1.png" alt="" />'; ?></a>
			</div>
			
		</div>
		<div class="banner-btm"><?php echo '<img src="'.get_bloginfo('template_url').'/images/banner-btm.png" alt="" />'; ?></div>
	</div>
	<div class="banner-mobile">
		<div class="banner">
			<ul class="mobileslider">
				<li><?php echo '<img src="'.get_bloginfo('template_url').'/images/slide1.png" alt="" />'; ?></li>
				<li><?php echo '<img src="'.get_bloginfo('template_url').'/images/slide2.png" alt="" />'; ?></li>
				<li><?php echo '<img src="'.get_bloginfo('template_url').'/images/slide3.png" alt="" />'; ?></li>
				<li><?php echo '<img src="'.get_bloginfo('template_url').'/images/slide4.png" alt="" />'; ?></li>
			</ul>

			<div id="mob-pager" class="clear" >
				<a data-slide-index="0" href="" class="slidetm1"><?php echo '<img src="'.get_bloginfo('template_url').'/images/sliderth4.png" alt="" />'; ?></a>
				<a data-slide-index="1" href="" class="slidetm2"><?php echo '<img src="'.get_bloginfo('template_url').'/images/sliderth3.png" alt="" />'; ?></a>
				<a data-slide-index="2" href="" class="slidetm3"><?php echo '<img src="'.get_bloginfo('template_url').'/images/sliderth2.png" alt="" />'; ?></a>
				<a data-slide-index="3" href="" class="slidetm4"><?php echo '<img src="'.get_bloginfo('template_url').'/images/sliderth1.png" alt="" />'; ?></a>
			</div>
			
		</div>
		<div class="banner-btm"><?php echo '<img src="'.get_bloginfo('template_url').'/images/banner-btm.png" alt="" />'; ?></div>
	</div>

	<?php } else { ?>

		<div class="banner-container">
			<div class="banner">
			<?php $page_id=get_the_ID();
				if(is_page()) { $image='banner-page-'.$page_id.'.png'; };
				if(!file_exists(TEMPLATEPATH.'/images/'.$image)) { $image='banner-image.png'; }
				echo '<img src="'.get_bloginfo('template_url').'/images/'.$image.'" alt="" />'; ?>
			</div>
		</div>
	<?php } ?>

	


	<div id="content" class="site-content">
