<?php
// This is the main functions file.
//*********************************************************************************

/*
TO DO:


SHORT-TERM
- add sidebar content


LONG-TERM

1. Create admin page with checklist of things to do when first setting up theme:
	- Nivo Slider
	- All in One SEO
	- Update permalink structure
	- Update timezone in general settings
	- Create custom menu

2. Lock down theme so that error displays if directory or theme name has changed.

3. Create import/export of theme options.

*/


//*********************************************************************************
// Include extra function files
//*********************************************************************************

require_once('includes/admin_menu.php');



//*********************************************************************************
// Clean up head and other bits
//*********************************************************************************

// Enqueue all javascripts and additional stylesheets here (main stylesheet is manually included in header.php
function themebuilder_scripts_method() {
	// used to figure out whether to get secure version of our external CDN scripts
	$protocol = 'http';
	if( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ) {
		$protocol = 'https';
	}
	
	// header scripts
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', $protocol . '://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');
	wp_enqueue_script( 'jquery' );
	wp_register_script( 'modernizr', $protocol . '://cdnjs.cloudflare.com/ajax/libs/modernizr/2.0.6/modernizr.min.js');
	wp_enqueue_script( 'modernizr' );
	if($protocol == 'https') {
		wp_register_script( 'sharethis', $protocol . '://ws.sharethis.com/button/buttons.js');
	} else {
		wp_register_script( 'sharethis', $protocol . '://w.sharethis.com/button/buttons.js');
	}
	wp_enqueue_script( 'sharethis' );
	
	
	// footer scripts
	wp_register_script( 'colorbox', get_bloginfo('template_url').'/js/jquery.colorbox-min.js', array('jquery'), '1.0', TRUE);
	wp_enqueue_script( 'colorbox' );
	wp_register_script( 'custom', get_bloginfo('template_url').'/js/custom.js', array('jquery','colorbox'), '1.0', TRUE);
	wp_enqueue_script( 'custom' );
	if(is_single() && get_post_type()=="bio") {
		// only used in bio lightboxes
		wp_register_script('mousewheel', get_bloginfo('template_directory') . '/js/jquery.mousewheel.js', array('jquery'), false, true);
		wp_enqueue_script('mousewheel');
		wp_register_script('scrollpane', get_bloginfo('template_directory') . '/js/jquery.jscrollpane.min.js', array('jquery'), false, true);
		wp_enqueue_script('scrollpane');
	}
	
	// allows threaded comment replies
	if (!is_admin() && is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	// remove stylesheet from plugins
	wp_deregister_style( 'contact-form-7' );
	wp_deregister_style( 'contact-form-7-rtl' );
}
add_action('wp_enqueue_scripts', 'themebuilder_scripts_method');


// Clean up the wp_head
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
add_filter( 'the_generator', create_function('$a', "return null;") );
function themebuilder_remove_recent_comments_style() {  
	global $wp_widget_factory;  
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );  
}  
add_action( 'widgets_init', 'themebuilder_remove_recent_comments_style' );



// Add RSS links
add_theme_support( 'automatic-feed-links' );

// Remove inline CSS from photo galleries
add_filter('use_default_gallery_style', '__return_false');

// Adds custom stylesheet to admin WYSIWYG
add_editor_style('style-editor.css');


//*********************************************************************************
// Register sidebar widgets, menu nav, and custom post types
//*********************************************************************************

add_theme_support( 'post-thumbnails' ); 

register_sidebar(array(
	'name' => 'Main Sidebar',
	'id' => 'main_sidebar',
	'description' => '',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => '</aside>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
));

function themebuilder_register_menus() {
	register_nav_menus(array(
		  'menu_top' => 'Top Menu',
		  'menu_header' => 'Beneath Header',
		  'menu_footer' => 'Footer Menu'
	));
}
add_action( 'init', 'themebuilder_register_menus' );


function themebuilder_post_type_init() {

	// Add new custom post type "bio"
	$bio_labels = array(
		'name' => _x('Bios', 'post type general name'),
		'singular_name' => _x('Bio', 'post type singular name'),
		'add_new' => _x('Add New', 'bio'),
		'add_new_item' => __('Add New Bio'),
		'edit_item' => __('Edit Bio'),
		'new_item' => __('New Bio'),
		'all_items' => __('All Bios'),
		'view_item' => __('View Bio'),
		'search_items' => __('Search Bios'),
		'not_found' =>  __('No bios found'),
		'not_found_in_trash' => __('No bios found in Trash'), 
		'parent_item_colon' => '',
		'menu_name' => 'Bios'
	);
	$bio_args = array(
		'labels' => $bio_labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => false, 
		'hierarchical' => false,
		'menu_position' => 5,
		'supports' => array( 'title', 'editor', 'thumbnail', 'revisions' ),
		'taxonomies' => array()
	); 
	register_post_type('bio',$bio_args);
	
	// Add new taxonomy "bios" that is like categories for the "bio" custom post type
	$bios_labels = array(
		'name' => _x( 'Bio Categories', 'taxonomy general name' ),
		'singular_name' => _x( 'Bio Category', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Bio Categories' ),
		'all_items' => __( 'All Bio Categories' ),
		'parent_item' => __( 'Parent Bio Category' ),
		'parent_item_colon' => __( 'Parent Bio Category:' ),
		'edit_item' => __( 'Edit Bio Category' ), 
		'update_item' => __( 'Update Bio Category' ),
		'add_new_item' => __( 'Add New Bio Category' ),
		'new_item_name' => __( 'New Bio Category Name' ),
		'menu_name' => __( 'Bio Categories' )
	); 
	$bios_args = array(
		'hierarchical' => true,
		'labels' => $bios_labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'bios' )
	);
	register_taxonomy('bios','bio',$bios_args);
}
add_action( 'init', 'themebuilder_post_type_init' );


//*********************************************************************************
// Make gallery image alts the image caption
// so colorbox will show image caption instead of attachment title
//*********************************************************************************

function fb_img_caption_shortcode($attr, $content = null) {
	// Allow plugins/themes to override the default caption template.
	$output = apply_filters('img_caption_shortcode', '', $attr, $content);
	if ( $output != '' )
		return $output;
	extract(shortcode_atts(array(
		'id'	=> '',
		'align'	=> 'alignnone',
		'width'	=> '',
		'caption' => ''
	), $attr));
	if ( 1 > (int) $width || empty($caption) )
		return $content;
	if ( $id ) $id = 'id="' . $id . '" ';
	return '<dl ' . $id . 'class="wp-caption ' . $align . '" style="width: ' . (10 + (int) $width) . 'px"><dt>'
	. do_shortcode( $content ) . '</dt><dd class="wp-caption-text">' . $caption . '</dd></dl>';
}
add_shortcode('wp_caption', 'fb_img_caption_shortcode');
add_shortcode('caption', 'fb_img_caption_shortcode');



//*********************************************************************************
// Defines display for individual comments
// Note that the trailing </li> is missing -- confusingly, WordPress
// will automatically add that for you. IDK why.
//*********************************************************************************

function themebuilder_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="comment pingback">
		<p>Pingback: <?php comment_author_link(); ?><?php edit_comment_link( 'Edit', '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta clearfix">
				<?php
					// translators: 1: comment author, 2: date and time
					printf( __( '<h4>%1$s</h4> <span class="comment-date">%2$s</span>', 'themebuilder' ),
						get_comment_author_link(),
						sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
							esc_url( get_comment_link( $comment->comment_ID ) ),
							get_comment_time( 'c' ),
							// translators: 1: date, 2: time
							sprintf( __( '%1$s @ %2$s', 'themebuilder' ), get_comment_date('M j, Y'), get_comment_time('g:i A') )
						)
					);
				?>
			</footer><!-- .comment-meta -->

			<div class="comment-content">
				<?php if ( $comment->comment_approved == '0' ) { ?>
					<p>
						<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'themebuilder' ); ?></em>
					</p>
				<?php } ?>
				<?php comment_text(); ?>
				
				<ul class="comment-links clearfix">
					<li><?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'themebuilder' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></li>
					<?php edit_comment_link( __( 'Edit', 'themebuilder' ), '<li>', '</li>' ); ?>
				</ul><!-- .comment-links -->
			</div>
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}


//*********************************************************************************
// Breadcrumbs
// Modified version of this:
// http://dimox.net/wordpress-breadcrumbs-without-a-plugin/
//*********************************************************************************

function themebuilder_breadcrumbs() {

	$css_class = ''; // change if you need to resize width of the breadcrumb container
	$show_on_home = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$delimiter = "li"; // delimiter between crumbs
							// if delimiter is set to "li" then crumbs becomes an unordered list.
	$home = 'Home'; // text for the 'Home' link
	$show_current = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
	$before = '<span class="current">'; // tag before the current crumb
	$after = '</span>'; // tag after the current crumb
	
	if($delimiter == "li") {
		$crumb_tag = "ul";
		$crumb_list = TRUE;
	} else {
		$crumb_tag = "div";
		$crumb_list = FALSE;
	}
	
	global $post;
	$homeLink = get_bloginfo('url');
	if (is_home() || is_front_page()) {
		if ($show_on_home == 1) {
			echo '<' . $crumb_tag . ' id="crumbs" class="' . $css_class . '">';
				if($crumb_list) echo '<li>';
					echo '<a href="' . $homeLink . '">' . $home . '</a>';
				if($crumb_list) echo '</li>';
			echo '</' . $crumb_tag . '>';
		}
	} else {
		echo '<' . $crumb_tag . ' id="crumbs" class="' . $css_class . '">';
		if($crumb_list) echo '<li>';
			echo '<a href="' . $homeLink . '">' . $home . '</a>';
		echo ($crumb_list) ? '</li>' : ' ' . $delimiter . ' ';
		
		if ( is_category() ) {
			global $wp_query;
			$cat_obj = $wp_query->get_queried_object();
			$this_cat = $cat_obj->term_id;
			$this_cat = get_category($this_cat);
			$parentCat = get_category($this_cat->parent);
			if ($this_cat->parent != 0) {
				if($crumb_list) echo '<li>';
					echo(get_category_parents($parentCat, TRUE, ($crumb_list) ? '</li><li>' : ' ' . $delimiter . ' '));
				if($crumb_list) echo '</li>';
			}
			if($crumb_list) echo '<li>';
				echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
			if($crumb_list) echo '</li>';
		} elseif ( is_search() ) {
			if($crumb_list) echo '<li>';
				echo $before . 'Search results for "' . get_search_query() . '"' . $after;
			if($crumb_list) echo '</li>';
		} elseif ( is_day() ) {
			if($crumb_list) echo '<li>';
				echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>';
			echo ($crumb_list) ? '</li><li>' : ' ' . $delimiter . ' ';
				echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a>';
			echo ($crumb_list) ? '</li><li>' : ' ' . $delimiter . ' ';
				echo $before . get_the_time('d') . $after;
			if($crumb_list) echo '</li>';
		} elseif ( is_month() ) {
			if($crumb_list) echo '<li>';
				echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>';
			echo ($crumb_list) ? '</li><li>' : ' ' . $delimiter . ' ';
				echo $before . get_the_time('F') . $after;
			if($crumb_list) echo '</li>';
		} elseif ( is_year() ) {
			if($crumb_list) echo '<li>';
				echo $before . get_the_time('Y') . $after;
			if($crumb_list) echo '</li>';
		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				if($crumb_list) echo '<li>';
					echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
				if($crumb_list) echo '<li>';
				if ($show_current == 1) {
					echo ($crumb_list) ? '<li>' : ' ' . $delimiter . ' ';
						echo $before . get_the_title() . $after;
					if($crumb_list) echo '</li>';
				}
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, ($crumb_list) ? '</li><li>' : ' ' . $delimiter . ' ');
				if ($show_current == 0) {
					if($crumb_list) $cats = substr($cats, 0, -4);
					else $cats = substr($cats, 0, -2-(strlen($delimiter)) );
				}
				if($crumb_list) echo '<li>';
					echo $cats;
				if ($show_current == 1) {
						echo $before . get_the_title() . $after;
					if($crumb_list) echo '</li>';
				}
			}
		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			if($crumb_list) echo '<li>';
				echo $before . $post_type->labels->singular_name . $after;
			if($crumb_list) echo '</li>';
		} elseif ( is_attachment() ) {
			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID);
			$cat = $cat[0];
			if($cat) {
				echo get_category_parents($cat, TRUE, ($crumb_list) ? '</li><li>' : ' ' . $delimiter . ' ');
					echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
				if($crumb_list) echo '</li>';
			}
			if ($show_current == 1) {
				if($crumb_list) echo '<li>';
					echo $before . get_the_title() . $after;
				if($crumb_list) echo '</li>';
			}
		} elseif ( is_page() && !$post->post_parent ) {
			if ($show_current == 1) {
				if($crumb_list) echo '<li>';
					echo $before . get_the_title() . $after;
				if($crumb_list) echo '</li>';
			}
		} elseif ( is_page() && $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			$counter = 0;
			$breadcrumb_count = count($breadcrumbs);
			foreach ($breadcrumbs as $crumb) {
				$counter++;
				if($crumb_list) echo '<li>';
					echo $crumb;
				if($crumb_list) {
					echo '</li>';
				} else {
					if($show_current == 1 || $counter!=$breadcrumb_count) {
						echo ' ' . $delimiter . ' ';
					}
				}
			}
			if ($show_current == 1) {
				if($crumb_list) echo '<li>';
					echo $before . get_the_title() . $after;
				if($crumb_list) echo '</li>';
			}
		} elseif ( is_tag() ) {
			if($crumb_list) echo '<li>';
				echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
			if($crumb_list) echo '</li>';
		} elseif ( is_author() ) {
			global $author;
			$userdata = get_userdata($author);
			if($crumb_list) echo '<li>';
				echo $before . 'Articles posted by ' . $userdata->display_name . $after;
			if($crumb_list) echo '</li>';
		} elseif ( is_404() ) {
			if($crumb_list) echo '<li>';
				echo $before . 'Error 404' . $after;
			if($crumb_list) echo '</li>';
		}
		if ( get_query_var('paged') ) {
			if($crumb_list) echo '<li>';
			elseif ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
				echo __('Page') . ' ' . get_query_var('paged');
			if($crumb_list) echo '</li>';
			elseif ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}
		echo '</' . $crumb_tag . '>';
	}
}
// end themebuilder_breadcrumbs()



//*********************************************************************************
// Pagination Links
// Older & slightly modified version of WP-Paginate by Eric Martin:
// http://www.ericmmartin.com/projects/wp-paginate/
//*********************************************************************************

function themebuilder_paginate($args = null) {
	$defaults = array(
	    'query' => 'wp_query',
		'page' => null,
		'pages' => null, 
		'range' => 2,
		'gap' => 1,
		'anchor' => 1,
		'before' => '<div id="pagination">',
		'after' => '</div><!-- .pagination -->',
		//'title' => false, // no longer used
		'nextpage' => __('older &raquo;'), 'previouspage' => __('&laquo; newer'),
		'echo' => 1
	);

	$r = wp_parse_args($args, $defaults);
	extract($r, EXTR_SKIP);

	if (!$page && !$pages) {
		global $$query;
		
		$page = get_query_var('paged');
		$page = !empty($page) ? intval($page) : 1;

		$posts_per_page = intval(get_query_var('posts_per_page'));
		$pages = intval(ceil($$query->found_posts / $posts_per_page));
	}
	
	$output = "";
	if ($pages > 1) {
		$output = $before . '<ul>';
			$ellipsis = '<li class="pages-gap">...</li>';

			if ($page > 1 && !empty($previouspage)) {
				$output .= '<li class="pages-prev"><a href="' . get_pagenum_link($page - 1) . '">' . $previouspage . '</a></li>';
			}
			
			$min_links = $range * 2 + 1;
			$block_min = min($page - $range, $pages - $min_links);
			$block_high = max($page + $range, $min_links);
			$left_gap = (($block_min - $anchor - $gap) > 0) ? true : false;
			$right_gap = (($block_high + $anchor + $gap) < $pages) ? true : false;

			if ($left_gap && !$right_gap) {
				$output .= sprintf('%s%s%s', 
					themebuilder_paginate_loop(1, $anchor), 
					$ellipsis, 
					themebuilder_paginate_loop($block_min, $pages, $page)
				);
			}
			else if ($left_gap && $right_gap) {
				$output .= sprintf('%s%s%s%s%s', 
					themebuilder_paginate_loop(1, $anchor), 
					$ellipsis, 
					themebuilder_paginate_loop($block_min, $block_high, $page), 
					$ellipsis, 
					themebuilder_paginate_loop(($pages - $anchor + 1), $pages)
				);
			}
			else if ($right_gap && !$left_gap) {
				$output .= sprintf('%s%s%s', 
					themebuilder_paginate_loop(1, $block_high, $page),
					$ellipsis,
					themebuilder_paginate_loop(($pages - $anchor + 1), $pages)
				);
			}
			else {
				$output .= themebuilder_paginate_loop(1, $pages, $page);
			}

			if ($page < $pages && !empty($nextpage)) {
				$output .= '<li class="pages-next"><a href="' . get_pagenum_link($page + 1) . '">' . $nextpage . '</a></li>';
			}
		$output .= '</ul>' . $after;
	}

	if ($echo) {
		echo $output;
	}

	return $output;
}


function themebuilder_paginate_loop($start, $max, $page = 0) {
	$output = "";
	for ($i = $start; $i <= $max; $i++) {
		$output .= ($page === intval($i)) 
			? '<li class="pages-page pages-current">' . $i . '</li>'
			: '<li class="pages-page"><a href="' . get_pagenum_link($i) . '">' . $i . '</a></li>';
	}
	return $output;
}



//*********************************************************************************
// Misc
//*********************************************************************************

function pre_print ($var, $desc="") {
	if($desc) echo $desc . '<br />';
	echo '<pre>';
	print_r($var);
	echo '</pre>';
}

function pre_dump ($var, $desc="") {
	if($desc) echo $desc . '<br />';
	echo '<pre>';
	var_dump($var);
	echo '</pre>';
}

function title_container ($is_desc=FALSE) {
	if(is_home() || is_front_page()) {
		if(!$is_desc) echo 'h1';
		else echo 'h2';
	} else {
		echo 'div';
	}
}

function desc_container () {
	title_container(TRUE);
}