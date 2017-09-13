<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
  Template Name: products
 * @package mymeda
 */

get_header(); ?>
<div class="wrapper">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php  if ( have_posts() ) : while ( have_posts() ) : the_post();?>

				<?php get_template_part( 'content', 'page' ); ?>

			<?php endwhile; endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

</div>



	<?php
	$type = 'products';
	$args=array(
	'post_type' => $type,
	'orderby'   => 'count',
	'post_status' => 'publish',
	'posts_per_page' => -1,
	'caller_get_posts'=> 1,
	'order' => 'ASC');
	$my_query = null;
	$my_query = new WP_Query($args);
	
	if( $my_query->have_posts() ) {
	$i=1;
	while ($my_query->have_posts()) : $my_query->the_post(); ?>
    <?php
//$count_posts = wp_count_posts($type,$args);

//$published_posts = $count_posts->publish;

//echo $published_posts;

?>
<div class="prod-block <?php echo "prod-block".'-'.$i; ?>">
	<div class="wrapper">
		<?php	$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
		<div class="prod-image-container">
			<?php echo '<img class="placeholder" src="'.get_bloginfo('template_url').'/images/prod-preview.png" alt="">'; ?>
			<img class="prod-image" src="<?php echo  $url; ?>" alt="">
		</div>
		<div class="prod-info">
			<span class="price"><?php echo get_post_meta($post->ID, 'Price', true); ?></span>
			<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
			<p><?php echo substr(get_the_content(),0,400);?></p>
			
		
		</div>
		
		
	</div>
	<div class="wrapper">
	<div class="quote">
			<span><?php echo  $quote = the_field('Zitat',$post->ID); //echo substr(strip_tags($quote),0,50); ?></span>
			<div class="quote-bg"></div>
		</div>
	</div>
	
	</div>
	<?php
	$i++;
endwhile;
}
?>

<div class="wrapper">
	
	<?php

		global $wp_query;
		$postid = $wp_query->post->ID;
		_e(get_post_meta($postid, 'table', true));
	
	
	?>
</div>





	

<?php get_footer(); ?>
