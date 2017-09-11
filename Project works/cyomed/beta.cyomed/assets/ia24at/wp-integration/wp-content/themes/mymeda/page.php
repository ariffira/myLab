<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
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
		</main><!-- #main -->
	</div><!-- #primary -->
<?php //$language = get_locale();
        $file = 'content/'.'content-videoblock.php';
		include($file);
    /*$language = substr(get_bloginfo ( 'language' ), 0, 2);
    if($language == 'en')
	{
		
	}else{
       $file = 'content/'.'content-videoblock-'.$language.'.php';
	   include($file);
	

}*/?>

<?php get_footer(); ?>
