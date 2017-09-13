<?php
/**
 * mymeda functions and definitions
 *
 * @package mymeda
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 820; /* pixels */
}

if ( ! function_exists( 'mymeda_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function mymeda_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on mymeda, use a find and replace
	 * to change 'mymeda' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'mymeda', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'mymeda' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'mymeda_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
	) );
}
endif; // mymeda_setup
add_action( 'after_setup_theme', 'mymeda_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function mymeda_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'mymeda' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'mymeda_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function mymeda_scripts() {
	wp_enqueue_style( 'mymeda-style', get_stylesheet_uri() );
	wp_enqueue_script( 'mymeda-jquery', get_template_directory_uri() . '/js/jquery.js', array(), '20100206', true );
	wp_enqueue_script( 'mymeda-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'mymeda-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	wp_enqueue_script( 'mymeda-slider', get_template_directory_uri() . '/js/custom.js', array(), '20110206', true );
	wp_enqueue_script( 'mymeda-onepagenav', get_template_directory_uri() . '/js/jquery.nav.js', array(), '20110206', true );
	wp_enqueue_script( 'mymeda-lazyload', get_template_directory_uri() . '/js/jquery.lazyload.js', array(), '20110206', true );
	wp_enqueue_script( 'mymeda-videoslide', get_template_directory_uri() . '/js/jquery.bxslider.min.js', array(), '20110206', true );
	wp_enqueue_script( 'mymeda-fitvideo', get_template_directory_uri() . '/js/jquery.fitvids.js', array('mymeda-videoslide'), '20110206', true );
	
	wp_enqueue_script( 'mymeda-responsivetable', get_template_directory_uri() . '/js/responsive-tables.js', array(), '20110206', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mymeda_scripts' );



/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


add_theme_support( 'post-thumbnails' ); 


add_action('init', 'remove_header_info');
function remove_header_info() {
	remove_action('wp_head', 'qtrans_header');
}

/*
 * Custom Menu Wizard Walker class
 * NB: Walker_Nav_Menu class is in wp-includes/nav-menu-template.php, and is itself an 
 *     extension of the Walker class (wp-includes/class-wp-walker.php)
 */
class Custom_Menu_Wizard_Walker extends Walker_Nav_Menu {

	/**
	 * opens a sub-level with a UL or OL start-tag
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$listtag = empty( $args->_custom_menu_wizard['ol_sub'] ) ? 'ul' : 'ol';
		$output .= "\n$indent<$listtag class=\"sub-menu\">\n";
	}

	/**
	 * closes a sub-level with a UL or OL end-tag
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$listtag = empty( $args->_custom_menu_wizard['ol_sub'] ) ? 'ul' : 'ol';
		$output .= "$indent</$listtag>\n";
	}

	/**
	 * pre-filters elements then calls parent::walk()
	 * 
	 * @filters : custom_menu_wizard_walker_items          array of filtered menu elements; array of args
	 * 
	 * @param array $elements Menu items
	 * @param integer $max_depth
	 * @return string
	 */
	function walk($elements, $max_depth){

		$args = array_slice(func_get_args(), 2);
		$args = $args[0];
		

		if( $max_depth >= -1 && !empty( $elements ) && isset($args->_custom_menu_wizard) ){

			$cmw =& $args->_custom_menu_wizard;
			//in $cmw (array) :
			//  filter : 0 = show all; 1 = kids of (current [root|parent] item or specific item); -1 = specific items (v2.0.0)
			//  filter_item : 0 = current item, -1 = parent of current (v1.1.0), -2 = root ancestor of current (v1.1.0); else a menu item id
			//  flat_output : true = equivalent of $max_depth == -1
			//  include_parent : true = include the filter_item menu item
			//  include_parent_siblings : true = include the siblings (& parent) of the filter_item menu item
			//  include_ancestors : true = include the filter_item menu item plus all it's ancestors
			//  title_from_parent : true = widget wants parent's title
			//  title_from_current : true = widget wants current item's title (v1.2.0)
			//  start_level : integer, 1+
			//  depth : integer, replacement for max_depth and also applied to 'flat' output
			//  depth_rel_current : true = changes depth calc from "relative to first filtered item found" to "relative to current item's level" (if current item is found below level/branch) (v2.0.0)
			//  fallback_no_ancestor : true = if looking for an ancestor (root or parent) of a top-level current item, fallback to current item (v1.1.0)
			//  fallback_include_parent : true = if fallback_no_ancestor comes into play then force include_parent to true (v1.1.0)
			//  fallback_include_parent_siblings : true = if fallback_no_ancestor comes into play then force include_parent_siblings to true (v1.1.0)
			//  fallback_no_children : true = if looking for a current item, and that item turns out to have no children, fallback to current parent (v1.2.0)
			//  fallback_nc_include_parent : true = if fallback_no_children comes into play then force include_parent to true (v1.2.0)
			//  fallback_nc_include_parent_siblings : true = if fallback_no_children comes into play then force include_parent_siblings to true (v1.2.0)
			//  contains_current : true = the output - both Filtered and any Included items - must contain the current menu item (v2.0.0)
			//  items : comma-or-space delimited list of item ids
			//
			//  _walker (array) : for anything that only the walker can determine and that needs to be communicated back to the widget instance
			//
			//$elements is an array of objects, indexed by position within the menu (menu_order),
			//starting at 1 and incrementing sequentially regardless of parentage (ie. first item is [1],
			//second item is [2] whether it's at root or subordinate to first item)
			$cmw['_walker']['fellback'] = false;

			$find_kids_of = $cmw['filter'] > 0;
			$find_specific_items = $cmw['filter'] < 0; //v2.0.0 //v2.0.1:bug fixed (changed < 1 to < 0)
			$find_current_item = $find_kids_of && empty( $cmw['filter_item'] );
			$find_current_parent = $find_kids_of && $cmw['filter_item'] == -1; //v1.1.0
			$find_current_root = $find_kids_of && $cmw['filter_item'] == -2; //v1.1.0
			$depth_rel_current = $cmw['depth_rel_current'] && $cmw['depth'] > 0; //v2.0.0
			//these could change depending on whether a fallback comes into play (v1.1.0)
			$include_parent = $cmw['include_parent'] || $cmw['include_ancestors'];
			$include_parent_siblings = $cmw['include_parent_siblings'];

			$id_field = $this->db_fields['id']; //eg. = 'db_id'
			$parent_field = $this->db_fields['parent']; //eg. = 'menu_item_parent'

			$structure = array(0 => array(
				'level' => 0,
				'ancestors' => array(),
				'kids' => array(),
				'element' => -1,
				'keepCount' => 0
				));
			$levels = array(
				array() //for the artificial level-0
				); 
			$allLevels = 9999;
			$startWithKidsOf = -1;

			foreach( $elements as $i=>$item ){
				$itemID = $item->$id_field;
				$parentID = empty( $item->$parent_field ) ? 0 : $item->$parent_field;


				//if $structure[] hasn't been set then it's an orphan; in order to keep orphans, max_depth must be 0 (ie. unlimited)
				//note that if a child is an orphan then all descendants of that child are also considered to be orphans!
				//also note that orphans (in the original menu) are ignored by this widget!
				if( isset( $structure[ $parentID ] ) ){
					//keep track of current item (as a structure key)...
					if( $item->current && empty( $currentItem ) ){
						$currentItem = $itemID;
					}
					//this level...
					$thisLevel = $structure[ $parentID ]['level'] + 1;
					if( empty( $levels[ $thisLevel ] ) ){
						$levels[ $thisLevel ] = array();
					}
					$levels[ $thisLevel ][] = $itemID;

					$structure[ $itemID ] = array(
						//level within structure...
						'level' => $thisLevel,
						//ancestors (from the artificial level-0, right down to parent, inclusive) within structure...
						'ancestors' => $structure[ $parentID ]['ancestors'],
						//kids within structure, ie array of itemID's...
						'kids' => array(),
						//item within elements...
						'element' => $i,
						//assume no matches...
						'keep' => false
						);
					$structure[ $itemID ]['ancestors'][] = $parentID;
					$structure[ $parentID ]['kids'][] = $itemID;
				}
			} //end foreach

			//no point doing much more if we need the current item and we haven't found it, or if we're looking for specific items with none given...
			$continue = true;
			if( empty( $currentItem ) && ( $find_current_item || $find_current_parent || $find_current_root || $cmw['contains_current'] ) ){
				$continue = false;
			}elseif( $find_specific_items && empty( $cmw['items'] ) ){
				$continue = false;
			}

			// IMPORTANT : as of v2.0.0, start level has been rationalised so that it acts the same across all filters (except for specific items!). 
			// Previously ...
			//   start level for a show-all filter literally started at the specified level and reported all levels until depth was reached.
			//   however, start level for a kids-of filter specified the level that the *immediate* kids of the selected filter had to be at
			//   or below. That was consistent for a specific item, current-item and current-parent filter, but for a current-root filter what
			//   it actually did was test the current item against the start level, not the current item's root ancestor! Inconsistent!
			//   But regardless of the current-root filter's use of start level, there was still the inconsistency between show-all and
			//   kids-of usage.
			// Now (as of v2.0.0) ...
			//   start level and depth have been changed to definitively be secondary filters to the show-all & kids-of primary filter.
			//   The primary filter - show-all, or a kids-of - will provide the initial set of items, and the secondary - start level & depth -
			//   will further refine that set, with start level being an absolute, and depth still being relative to the first item found.
			//   The sole exception to this is when Depth Relative to Current Menu Item is set, which modifies the calculation of depth (only)
			//   such that it becomes relative to the level at which the current menu item can be found (but only if it can be found at or
			//   below start level).
			// The effects of this change are that previously, filtering for kids of an item that was at level 2, with a start level of 4,
			// would fail to return any items because the immediate kids (at level 3) were outside the start level. Now, the returned items
			// will begin with the grand-kids (ie. those at level 4).
			// Note that neither start level nor depth are applicable to a specific items filter (also new at v2.0.0)!
			
			//the kids-of filters...
			if( $continue && $find_kids_of ){
				//specific item...
				if( $cmw['filter_item'] > 0 && isset( $structure[ $cmw['filter_item'] ] ) && !empty( $structure[ $cmw['filter_item'] ]['kids'] ) ){
					$startWithKidsOf = $cmw['filter_item'];
				}
				if( $find_current_item ){
					if( !empty( $structure[ $currentItem ]['kids'] ) ){
						$startWithKidsOf = $currentItem;
					}elseif( $cmw['fallback_no_children'] ){
						//no kids,  and fallback to current parent is set...
						//note that there is no "double fallback", so current parent "can" be the artifical zero element (level-0) *if*
						//     the current item is a singleton( ie. no kids & no ancestors)!
						$ancestor = array_slice( $structure[ $currentItem ]['ancestors'], -1, 1 );
						$startWithKidsOf = $ancestor[0]; //can be zero!
						$include_parent = $include_parent || $cmw['fallback_nc_include_parent'];
						$include_parent_siblings = $include_parent_siblings || $cmw['fallback_nc_include_parent_siblings'];
						$cmw['_walker']['fellback'] = 'to-parent';
					}
				}elseif( $find_current_parent || $find_current_root ){
					//as of v2.0.0 the fallback to current item - for current menu items at the top level - is deprecated, but
					//retained for a while to maintain backward compatibility
					//if no parent : fall back to current item (if set)...
					if( $structure[ $currentItem ]['level'] == 1 && $cmw['fallback_no_ancestor'] ){
						$startWithKidsOf = $currentItem;
						$include_parent = $include_parent || $cmw['fallback_include_parent'];
						$include_parent_siblings = $include_parent_siblings || $cmw['fallback_include_parent_siblings'];
						$cmw['_walker']['fellback'] = 'to-current';
					}else{
						//as of v2.0.0, the artificial level-0 counts as parent of a top-level current menu item...
						if( $find_current_parent ){
							$ancestor = -1;
						}elseif( $structure[ $currentItem ]['level'] > 1 ){
							$ancestor = 1;
						}else{
							$ancestor = 0;
						}
						$ancestor = array_slice( $structure[ $currentItem ]['ancestors'], $ancestor, 1 );
						if( !empty( $ancestor ) ){
							$startWithKidsOf = $ancestor[0]; //as of v2.0.0, this can now be zero!
						}
					}
				}
			}

			if( $continue ){
				//right, let's set the keep flags
				//for specific items, go straight in on the item id (start level and depth do not apply here)...
				if( $find_specific_items ){
					foreach( preg_split('/[,\s]+/', $cmw['items'] ) as $itemID ){
						if( isset( $structure[ $itemID ] ) ){
							$structure[ $itemID ]['keep'] = true;
							$structure[0]['keepCount']++;
						}
					}
				//for show-all filter, just use the levels...
				}elseif( !$find_kids_of ){
					//prior to v2.0.0, depth was always related to the first item found, and still is *unless* depth_rel_current is set
					if( $depth_rel_current && !empty( $currentItem ) && $structure[ $currentItem ]['level'] >= $cmw['start_level'] ){
						$bottomLevel = $structure[ $currentItem ]['level'] + $cmw['depth'] - 1;
					}else{
						$bottomLevel = $cmw['depth'] > 0 ? $cmw['start_level'] + $cmw['depth'] - 1 : $allLevels;
					}
					for( $i = $cmw['start_level']; isset( $levels[ $i ] ) && $i <= $bottomLevel; $i++ ){
						foreach( $levels[ $i ] as $itemID ){
							$structure[ $itemID ]['keep'] = true;
							$structure[0]['keepCount']++;
						}
					}
				//for kids-of filters, run a recursive through the structure's kids...
				}elseif( $startWithKidsOf > -1 ){
					//prior to v2.0.0, depth was always related to the first item found, and still is *unless* depth_rel_current is set
					//NB the in_array() of ancestors prevents depth_rel_current when startWithKidsOf == currentItem
					if( $depth_rel_current && !empty( $currentItem ) && $structure[ $currentItem ]['level'] >= $cmw['start_level'] 
							&& in_array( $startWithKidsOf, $structure[ $currentItem ]['ancestors'] ) ){
						$bottomLevel = $structure[ $currentItem ]['level'] - 1 + $cmw['depth'];
					}else{
						$bottomLevel = $cmw['depth'] > 0 
							? max( $structure[ $startWithKidsOf ]['level'] + $cmw['depth'], $cmw['start_level'] + $cmw['depth'] - 1 ) 
							: $allLevels;
					}
					//$structure[0]['keepCount'] gets incremented in this recursive method...
					$this->_cmw_set_keep_kids( $structure, $startWithKidsOf, $cmw['start_level'], $bottomLevel );
				}
			
				if( $structure[0]['keepCount'] > 0 ){
					//we have some items! we now may need to set some more keep flags, depending on the include settings...

					//do we need to include parent, parent siblings, and/or ancestors?...
					//NB these are not restricted by start_level!
					if( $find_kids_of && $startWithKidsOf > 0 ){
						if( $include_parent ){
							$structure[ $startWithKidsOf ]['keep'] = true;
							//add the class directly to the elements item...
							$elements[ $structure[ $startWithKidsOf ]['element'] ]->classes[] = 'cmw-the-included-parent';
						}
						if( $include_parent_siblings ){
							$ancestor = array_slice( $structure[ $startWithKidsOf ]['ancestors'], -1, 1);
							foreach($structure[ $ancestor[0] ]['kids'] as $itemID ){
								//may have already been kept by include_parent...
								if( !$structure[ $itemID ]['keep'] ){
									$structure[ $itemID ]['keep'] = true;
									//add the class directly to the elements item...
									$elements[ $structure[ $itemID ]['element'] ]->classes[] = 'cmw-an-included-parent-sibling';
								}
							}
						}
						if( $cmw['include_ancestors'] ){
							foreach( $structure[ $startWithKidsOf ]['ancestors'] as $itemID ){
								if( $itemID > 0 && !$structure[ $itemID ]['keep'] ){
									$structure[ $itemID ]['keep'] = true;
									//add the class directly to the elements item...
									$elements[ $structure[ $itemID ]['element'] ]->classes[] = 'cmw-an-included-parent-ancestor';
								}
							}
						}
					}
				}
			}

			$substructure = array();
			//check that (a) we have items, and (b) if we must have current menu item, we've got it...
			if( $structure[0]['keepCount'] > 0 && ( !$cmw['contains_current'] || $structure[ $currentItem ]['keep'] ) ){

				//might we want the parent's title as the widget title?...
				if( $find_kids_of && $cmw['title_from_parent'] && $startWithKidsOf > 0 ){
					$cmw['_walker']['parent_title'] = apply_filters(
						'the_title',
						$elements[ $structure[ $startWithKidsOf ]['element'] ]->title,
						$elements[ $structure[ $startWithKidsOf ]['element'] ]->ID
						);
				}
				//might we want the current item's title as the widget title?...
				if( !empty( $currentItem ) && $cmw['title_from_current'] ){
					$cmw['_walker']['current_title'] = apply_filters(
						'the_title',
						$elements[ $structure[ $currentItem ]['element'] ]->title,
						$elements[ $structure[ $currentItem ]['element'] ]->ID
						);
				}

				//now we need to gather together all the 'keep' items from structure;
				//while doing so, we need to set up levels and kids, ready for adding classes...
				foreach( $structure as $k=>$v ){
					if( $k > 0 && $v['keep'] ){
						$substructure[ $k ] = $v;
						//take a copy of the elements item...
						$substructure[ $k ]['element'] = $elements[ $v['element'] ];
						//use kids as a has-submenu flag...
						$substructure[ $k ]['kids'] = 0;
						//any surviving parent (except the artificial level-0) should have submenu class set on it...
						array_shift( $v['ancestors'] ); //remove the level-0
						for( $i = count( $v['ancestors'] ) - 1; $i >= 0; $i-- ){
							if( isset( $substructure[ $v['ancestors'][ $i ] ] ) ){
								$substructure[ $v['ancestors'][ $i ] ]['kids']++;
							}else{
								//not a 'kept' ancestor so remove it...
								array_splice( $v['ancestors'], $i, 1 );
							}
						}
						//ancestors now only has 'kept' ancestors...
						$substructure[ $k ]['level'] = count( $v['ancestors'] ) + 1;
						//need to ensure that the parent_field of all the new top-level (ie. root) items is set to
						//zero, otherwise the parent::walk() will assume they're orphans and ignore them.
						//however, we also need to check - especially for a specific-items filter (v2.0.0) - that parent_field of a 
						//child actually points to the closest 'kept' ancestor; otherwise, given A (kept) > B (not kept) > C (kept)
						//the parent_field of C would point to a non-existent B and would subsequently be considered an orphan!
						if( $substructure[ $k ]['level'] == 1){
							$substructure[ $k ]['element']->$parent_field = 0;
						}else{
							//NB even though this really only needs to be done for $find_specific_items, I'm doing it regardless.
							//set to the closest ancestor, ie. the new(?) parent...
							$ancestor = array_slice( $v['ancestors'], -1, 1 );
							$substructure[ $k ]['element']->$parent_field = $ancestor[0];
						}
					}
				}
			}

			//put substructure's elements back into $elements (remember that it's a 1-based array!)...
			$elements = array();
			$i = 1;
			foreach( $substructure as $k=>$v ){
				$elements[ $i ] = $v['element'];
				//add the submenu class?...
				if( $v['kids'] > 0 ){
					$elements[ $i ]->classes[] = 'cmw-has-submenu';
				}else{
					//3.7 adds a menu-item-has-children class to (original) menu items that have kids : remove it as the item is now childless...
					$elements[ $i ]->classes = array_diff( $elements[ $i ]->classes, array('menu-item-has-children') );
				}
				//add the level class...
				$elements[ $i ]->classes[] = 'cmw-level-' . $v['level'];
				$i++;
			}
			unset( $structure, $substructure );

			//since we've done all the depth filtering, set max_depth to unlimited (unless 'flat' was requested!)...
			if( !$cmw['flat_output'] ){
				$max_depth = 0;
			}
		} //ends the check for bad max depth, empty elements, or empty cmw args

		return empty( $elements ) ? '' : parent::walk( apply_filters( 'custom_menu_wizard_walker_items', $elements, $args ), $max_depth, $args );
	}

	/**
	 * recursively set the keep flag if within specified level/depth
	 */
	function _cmw_set_keep_kids( &$structure, $itemId, $topLevel, $bottomLevel ){
		$ct = count( $structure[ $itemId ]['kids'] );
		for( $i = 0; $i < $ct; $i++ ){
			$j = $structure[ $itemId ]['kids'][ $i ];
			if( $structure[ $j ]['level'] <= $bottomLevel ){
				$structure[ $j ]['keep'] = $structure[ $j ]['level'] >= $topLevel;
				if( $structure[ $j ]['keep'] ){
					$structure[0]['keepCount']++;
				}
			}
			if( $structure[ $j ]['level'] < $bottomLevel ){
				$this->_cmw_set_keep_kids( $structure, $j, $topLevel, $bottomLevel );
			}
		}
	}

} //end Custom_Menu_Wizard_Walker class

function remove_core_updates(){
global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
}
add_filter('pre_site_transient_update_core','remove_core_updates');
add_filter('pre_site_transient_update_plugins','remove_core_updates');
add_filter('pre_site_transient_update_themes','remove_core_updates');






add_action('init', 'register_slider');
 
function register_slider() {
 
	$labels = array(
		'name' => _x('Video Slider', 'post type general name'),
		'singular_name' => _x('slider', 'post type singular name'),
		'add_new' => _x('Add New', 'slider'),
		'add_new_item' => __('Add New Slider'),
		'edit_item' => __('Edit Slider'),
		'new_item' => __('New Slider'),
		'view_item' => __('View Slider '),
		'search_items' => __('Search Slider'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 4,
		'supports' => array('title', 'editor')
	  ); 

 
	register_post_type( 'slider' , $args );
}

//add filter to ensure the  service, or service, is displayed when user updates a service

function slider_updated_messages( $messages ) {
  global $post, $post_ID;

  $messages['slider'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Slider updated. <a href="%s">View Slider</a>', 'your_text_domain'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.', 'your_text_domain'),
    3 => __('Custom field deleted.', 'your_text_domain'),
    4 => __('Slider updated.', 'your_text_domain'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Slider restored to revision from %s', 'your_text_domain'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Slider published. <a href="%s">View Slider</a>', 'your_text_domain'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Slider saved.', 'your_text_domain'),
    8 => sprintf( __('Slider submitted. <a target="_blank" href="%s">Preview Slider</a>', 'your_text_domain'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Slider scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Slider</a>', 'your_text_domain'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Slider draft updated. <a target="_blank" href="%s">Preview Slider</a>', 'your_text_domain'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}
add_filter( 'post_updated_messages', 'slider_updated_messages' );  



                                           