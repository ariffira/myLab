<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
  Template Name: Product Detail
 * @package mymeda
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="wrapper">
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

				

				<?php endwhile; // end of the loop. ?>

				
			</div>
			<div id="section1" class="prod-section section1 lazy" data-original="<?php echo get_bloginfo('template_url'); ?>/images/img1.jpg">
				<div class="wrapper">
					<div class="content right">
						<?php  echo the_field('electronic_health');//the_block('Health Record' ); ?>
					</div>
				</div>
			</div>

			<div id="section2" class="prod-section section2 lazy" data-original="<?php echo get_bloginfo('template_url'); ?>/images/img2.jpg">
				<div class="wrapper">
					<div class="content right">
						<?php  echo the_field('doctors_hotline');//the_block('Doctor Hotline' ); ?>
					</div>
				</div>
			</div>


			<div class="testimonial">
				<div class="wrapper">
				“Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.”
					<p class="by">Patient name, Location</p>
				</div>
			</div>


			<div id="section3" class="prod-section section3 lazy" data-original="<?php echo get_bloginfo('template_url'); ?>/images/lock.jpg">
				<div class="wrapper">
					<div class="content left">
						<?php  echo the_field('security_and_privacy'); //the_block('Security' ); ?>
					</div>
				</div>
			</div>
			
			<div id="section4" class="prod-section section4 lazy" data-original="<?php echo get_bloginfo('template_url'); ?>/images/img4.jpg">
				<div class="wrapper">
					<div class="content left">
						<?php  echo the_field('worldwide_access'); //the_block('World wide access' ); ?>
					</div>
				</div>
			</div>
			
			<div id="section5" class="prod-section section5 lazy" data-original="<?php echo get_bloginfo('template_url'); ?>/images/img5.jpg">
				<div class="wrapper">
					<div class="content left">
						<?php  echo the_field('mobile_usability'); //the_block('Mobile Usability' ); ?>
					</div>
				</div>
			</div>
	
			<div id="section6" class="prod-section section6 lazy" data-original="<?php echo get_bloginfo('template_url'); ?>/images/img6.jpg">
				<div class="wrapper">
					<div class="content left">
						<?php  echo the_field('compatibility_and_scallability'); //the_block('Compatibility' ); ?>
					</div>
				</div>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->
	<a class="scrollup" href="#">Scroll</a>
	

<?php get_footer(); ?>
