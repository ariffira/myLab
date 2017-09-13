<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package mymedia
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>"/>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
<?php wp_head(); ?>

<script>
jQuery(function(){

    jQuery("html[lang=ar]").find("body").addClass("rtl");

});
</script>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<header id="masthead" class="site-header" role="banner">
			<div class="wrapper">
				<div class="toplinks">

<?php 
    $language = substr(get_bloginfo ( 'language' ), 0, 2);
    if($language == 'en')
	{
echo "<ul><!--li><a href='#'>Register</a></li--><li><a href='#'>Login</a></li></ul>";
	  
	} elseif ($language == 'ar'){
echo "<ul><!--li><a href='#'>تسجيل</a></li--><li><a href='#'>دخول</a></li></ul>";
          
	}  elseif ($language == 'hi'){
echo "<ul><!--li><a href='#'>रजिस्टर</a></li--><li><a href='#'>लॉगिन</a></li></ul>";
        
}  elseif ($language == 'th'){
echo "<ul><!--li><a href='#'>การลงทะเบียน</a></li--><li><a href='#'>เข้าสู่ระบบ</a></li></ul>";
       
}  else {
echo "<ul><!--li><a href='#'>Registrieren</a></li--><li><a href='#'>Anmelden</a></li></ul>";
      

} ?>	

 
						<?php echo qtrans_generateLanguageSelectCode('both'); ?>
						<div class="toplinks-bg"></div>

				</div>
				<div class="site-branding">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo '<img src="'.get_bloginfo('template_url').'/images/logo10.png" alt="">'; ?></a>
				</div>
			</div>
			

			<nav id="site-navigation" class="main-navigation" role="navigation">
				<span class="menu-toggle"><?php _e( 'Menu', 'mymedia' ); ?></span>
				
				<div class="menu-dropdown">
					<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
					<div class="menulinks">
						<a href="#">Register</a>
						<a href="#">Login</a>
						<?php echo qtrans_generateLanguageSelectCode('both'); ?>
						
					</div>
				</div>
			</nav><!-- #site-navigation -->
				
	</header><!-- #masthead -->
	<?php
		if (is_front_page())
	{?>

	<div class="banner-container">
		<div class="banner">
		
			<div class="bx-viewport">
				<?php echo '<img class="slider-bg" src="'.get_bloginfo('template_url').'/images/main_slider_bg.png" alt="">'; ?>
				<ul class="wideslider" id="wideslider">
					<li class="slide1"><div class="bx-caption"><?php echo  the_field('glorious',$post->ID);?></div></li>
					<li class="slide2"><div class="bx-caption"><?php echo  the_field('digital',$post->ID);?></div></li>
					<li class="slide3"><div class="bx-caption"><?php echo  the_field('medikamente',$post->ID);?></div></li>
					<li class="slide4"><div class="bx-caption"><?php echo  the_field('fitness',$post->ID);?></div></li>
				</ul>
			</div>
			<div class="bx-controls bx-has-controls-direction">
				<div class="bx-controls-direction">
					<a href="javascript:slidePrev();" class="bx-prev">Prev</a>
					<a href="javascript:slideNext();" class="bx-next">Next</a>
				</div>
			</div>
			<div id="bx-pager">
				<a href="javascript:slider('0');" class="slidetm1"><?php echo '<img src="'.get_bloginfo('template_url').'/images/sliderthm.png" alt="">'; ?></a>
				<a href="javascript:slider('1');" class="slidetm2"><?php echo '<img src="'.get_bloginfo('template_url').'/images/sliderthm.png" alt="">'; ?></a>
				<a href="javascript:slider('2');" class="slidetm3"><?php echo '<img src="'.get_bloginfo('template_url').'/images/sliderthm.png" alt="">'; ?></a>
				<a href="javascript:slider('3');" class="slidetm4"><?php echo '<img src="'.get_bloginfo('template_url').'/images/sliderthm.png" alt="">'; ?></a>
			</div>
			
		</div>
		<div class="banner-btm"><?php echo '<img src="'.get_bloginfo('template_url').'/images/banner-btm.png" alt="">'; ?></div>
	</div>
	

	<?php } else { ?>

	
	
	  
						
						
		<div class="banner-container">
			<div class="banner">
				<?php echo '<img class="banner-bg" src="'.get_bloginfo('template_url').'/images/inner_banenr_bg.png" alt="">'; ?>
				 <?php $page_id=get_the_ID(); 
				 if(is_page()) { $image='banner_image_'.$page_id.'.jpg'; }; 
				 if ((!file_exists(TEMPLATEPATH. '/images/'.$image))||(!is_page())) { $image='banner_image.jpg' ; } 
				 echo '<div class="banner-inner" style="background-image: url('.get_bloginfo('template_url').'/images/'.$image.');"></div>'; ?>
				
			</div>
		</div>
	<?php } ?>
<?php 

$defaults = array(
	'theme_location'  => '',
	'menu'            => 'main menu',
	'container'       => 'div',
	'container_class' => '',
	'container_id'    => '',
	'menu_class'      => 'menu',
	'menu_id'         => '',
	'echo'            => true,
	'fallback_cb'     => 'wp_page_menu',
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',

	'walker'          => new Custom_Menu_Wizard_Walker,
    '_custom_menu_wizard' => array(
						'title' => '',
		'menu' => 0, // menu id, slug or name
		//determines filter & filter_item ('items' takes precedence over 'children_of' because it's more specific)...
		'children_of' => 'current-item', // empty = show all (dep. on 'items'); menu item id or title (caseless), or current|current-item|parent|current-parent|root|current-ancestor
		'items' => '', // v2.0.0 empty = show all (dep. on 'children_of'); comma- or space-separated list of menu item ids (start level and depth don't apply)
		'start_level' => 3,
		'depth' => 0, // 0 = unlimited
		//only if children_of is (parent|current-parent|root|current-ancestor); determines fallback_no_ancestor, fallback_include_parent & fallback_include_parent_siblings...
		'fallback_parent' => 1, // 1 = use current-item; 'parent' = *and* include parent, 'siblings' = *and* include both parent and its siblings
		//only if children_of is (current|current-item); determines fallback_no_children, fallback_nc_include_parent & fallback_nc_include_parent_siblings...
		'fallback_current' => 1, // 1 = use current-parent; 'parent' = *and* include parent (if available), 'siblings' = *and* include both parent (if available) and its siblings
		//switches...
		'flat_output' => 0,
		'contains_current' => 0, // v2.0.0
		//determines include_parent, include_parent_siblings & include_ancestors...
		'include' =>'', //comma|space|hyphen separated list of 'parent', 'siblings', 'ancestors'
		'ol_root' => 0,
		'ol_sub' => 0,
		//determines title_from_parent & title_from_current...
		'title_from' => '', //comma|space|hyphen separated list of 'parent', 'current'
		'depth_rel_current' => 0, // v2.0.0
		//strings...
		'container' => 'div', // a tag : div|nav are WP restrictions, not the widget's; '' =  no container
		'container_id' => '',
		'container_class' => '',
		'menu_class' => 'menu-widget',
		'widget_class' => '',
		//determines before & after...
		'wrap_link' => '', // a tag name (eg. div, p, span, etc)
		//determines link_before & link_after...
		'wrap_link_text' => '' // a tag name (eg. span, em, strong)
						)
);

//wp_nav_menu( $defaults );

?>







<?php
 $depth =  get_current_page_depth();
 
if($depth > 0) {
$topparent = get_top_ancestor($post->id);
echo "<div class='third-level-menu'><ul>"; wp_list_pages("depth=2&title_li=&child_of=".$topparent."&sort_column=menu_order"); 
echo "</ul></div>";
	
}
function get_top_ancestor($id){
$depth =  get_current_page_depth();
	    $current = get_post($id);
	    if($depth == 1) {
		      return $current->ID;
    	}
		else if($depth == 2) {
		  return  $current->post_parent;
		       
		}
		else {
		     return 0;
		 }
}
	
	
function get_current_page_depth(){
	global $wp_query;
	
	$object = $wp_query->get_queried_object();
	$parent_id  = $object->post_parent;
	$depth = 0;
	while($parent_id > 0){
		$page = get_page($parent_id);
		$parent_id = $page->post_parent;
		$depth++;
	}
 
 	return $depth;
}
?>







	<div id="content" class="site-content">