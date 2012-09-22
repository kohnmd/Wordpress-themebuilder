<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    
    <title><?php
		// This will build a decent title attribute, but really you should install the "All In One SEO Pack" plugin:
		// http://wordpress.org/extend/plugins/all-in-one-seo-pack/
		global $page, $paged;
		wp_title( '|', true, 'right' );
		bloginfo( 'name' );
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | " . $site_description;
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );
	?></title>

    <meta name="description" content="">
    
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
	
	<?php
	// Looking for javascripts? Want to add your own?
	// Check out themebuilder_scripts_method() in functions.php.
	// They all get loaded through either wp_head or wp_footer.
	?>
	<script type="text/javascript">
		// this var is used later in custom.js
		var home_url = '<?php echo home_url('/'); ?>';
		// sharethis uses this
		var switchTo5x = true;
	</script>
	<?php wp_head(); ?>
</head>

<body>
<div id="wrapper">
		
	<header id="top" class="container_12">
		<hgroup class="grid_6">
			<<?php title_container(); ?> id="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></<?php title_container(); ?>>
			<<?php desc_container(); ?> id="site-description"><?php bloginfo( 'description' ); ?></<?php desc_container(); ?>>
		</hgroup>
		
		<div id="header-right" class="grid_6">
			<?php
			// The only difference between the following sets of social icons
			// is the size-## class. By changing between 32 and 16, the icons
			// automatically change to the appropriate size.
			?>
			<div class="header-social size-32">
				<a href="#" class="facebook" title="Facebook">Facebook</a>
				<a href="#" class="twitter" title="Twitter">Twitter</a>
				<a href="#" class="twitter-alt" title="Twitter">Twitter</a>
				<span class="st_sharethis_custom" title="ShareThis"></span>
				<a href="#" class="rss" title="RSS">RSS</a>
				<a href="#" class="youtube" title="YouTube">YouTube</a>
				<a href="#" class="linkedin" title="LinkedIn">LinkedIn</a>
				<a href="#" class="vimeo" title="Vimeo">Vimeo</a>
				<a href="#" class="flickr" title="Flickr">Flickr</a>
				<a href="#" class="gplus" title="Google+">Google+</a>
				<a href="#" class="gplus-alt" title="Google+">Google+2</a>
				<a href="#" class="pinterest" title="Pinterest">Pinterest</a>
			</div>
			<div class="clear"></div>
			
			<div class="header-social size-16">
				<a href="#" class="facebook" title="Facebook">Facebook</a>
				<a href="#" class="twitter" title="Twitter">Twitter</a>
				<a href="#" class="twitter-alt" title="Twitter">Twitter</a>
				<!--
				NOTE: ShareThis can only be added to the page once*, so I've commented this one out.
				      If you're going to use the size-16 icons, you can uncomment it and it'll work.
				      
					  *This isn't actually true, it just requires some customization to accomplish.
				-->
				<!--<span class="st_sharethis_custom" title="ShareThis"></span>-->
				<a href="#" class="rss" title="RSS">RSS</a>
				<a href="#" class="youtube" title="YouTube">YouTube</a>
				<a href="#" class="linkedin" title="LinkedIn">LinkedIn</a>
				<a href="#" class="vimeo" title="Vimeo">Vimeo</a>
				<a href="#" class="flickr" title="Flickr">Flickr</a>
				<a href="#" class="gplus" title="Google+">Google+</a>
				<a href="#" class="gplus-alt" title="Google+">Google+2</a>
				<a href="#" class="pinterest" title="Pinterest">Pinterest</a>
			</div>
			<div class="clear"></div>
			
			<div class="header-search">
				<?php get_search_form( ); ?>
			</div>
			<div class="clear"></div>
		</div><!-- #header-right -->
		
		<div class="clear"></div>
		
		<nav id="header-menu">
			<?php
			// Where the "Beneath Header" navigation is included.
			// Navigation should be built in wp-admin >> Appearance >> Menus.
			// NOTES: custom.js will automatically add a home link to the menu, so no need to include it yourself.
			//		  Also, if you don't want to build the menu in the admin, this will automatically render one based on the page structure.
			wp_nav_menu( array( 'theme_location' => 'menu_header',  'menu_class' => 'main_menu', ) );
			?>
			<div class="clear"></div>
		</nav><!-- #header-menu -->
	</header><!-- #top -->
	
	<div class="container_12">
		<?php 
		// Here are the breadcrumbs.
		// It is outside of the #middle section in case you'd like to add a repeating background to #middle (for example to define the sidebar).
		// It gets wrapped in div#crumbs. You can add a class to them if you'd like in functions.php.
		themebuilder_breadcrumbs();
		?>
	</div>
	
	<section id="middle" class="container_12">