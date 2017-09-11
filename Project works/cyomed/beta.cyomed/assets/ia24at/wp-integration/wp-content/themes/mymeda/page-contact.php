<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
   Template Name: Contact
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
		
		<div class="contactform">
		<div class="push-block-inner">
		<div class="wrapper">
			 
		<?php 
    $language = substr(get_bloginfo ( 'language' ), 0, 2);
    if($language == 'en')
	{
echo "<h1>Information? Write to us.</h1>";
	insert_cform('English  Contact');  
	} elseif ($language == 'ar'){
echo "<h1>المعلومات؟ الكتابة لنا.</h1>";
        insert_cform('Arabic Contact');  
	}  elseif ($language == 'hi'){
echo "<h1>सूचना? हमें लिखें.</h1>";
        insert_cform('Hindi Contact'); 
}  elseif ($language == 'th'){
echo "<h1>ข้อมูล? เขียนถึงเรา</h1>";
        insert_cform('Thai Contact'); 
}  else {
echo "<h1>Informationen? Schreiben Sie uns.</h1>";
        insert_cform('Deutsch  Contact'); 

} ?>		
		</div></div></div>

		
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>