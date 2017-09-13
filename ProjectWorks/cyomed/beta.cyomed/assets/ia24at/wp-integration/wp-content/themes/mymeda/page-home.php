<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
  Template Name: Home Page
 * @package mymeda
 */

get_header(); ?>
<div class="wrapper">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="service-row">

		<div class="service-tree">
			<?php echo   the_field('allgemeine',$post->ID);?>
			<span class="left-curve"></span>
			<span class="vline left-vline"></span>
		</div>
		
		<div class="service-tree mid">
			<?php echo   the_field('ihre_digitale',$post->ID);?>
			<span class="vline mid-vline"></span>	
			<span class="line-joint"></span>
		</div>
		<div class="service-tree">
			<?php echo  the_field('english',$post->ID);?>
			<span class="right-curve"></span>
			<span class="vline right-vline"></span>
		</div>
		
	</div>
	
	<span class="hline"></span>
		<div class="row device-image">
		<?php echo '<img src="'.get_bloginfo('template_url').'/images/monitor.png" alt="" />'; ?>
	</div>
	
	<?php endwhile; endif; ?>
</div>
<?php //$language = get_locale();
 $file = 'content/'.'content-videoblock.php';
		include($file);
    /*  echo "I am here";
    $language = substr(get_bloginfo ( 'language' ), 0, 2);
    if($language == 'en')
	{
		$file = 'content/'.'content-videoblock-'.$language.'.php';
		include($file);
	}else{
       $file = 'content/'.'content-videoblock-'.$language.'.php';
	   include($file);
	

} */ 


?>

	

<?php get_footer(); ?>
