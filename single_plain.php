<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <title><?php the_title(); ?> | <?php bloginfo('name'); ?></title>
    
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
	
	<script type="text/javascript">
		// this var is used later in custom.js
		var home_url = '<?php echo home_url('/'); ?>';
	</script>
	<?php wp_head(); ?>
</head>
<body class="plain">
<div id="wrapper-plain">
        
        <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<article id="plain-content" class="clearfix">
				<?php
				if(has_post_thumbnail()) {
					the_post_thumbnail('medium', array('class'=>'alignright'));
				}
				?>
				<h1><?php the_title(); ?></h1>
				<?php
				// show job title custom field if it exists
				if(function_exists('get_custom_field') && get_custom_field('job_title')!="") {
					echo '<h4>' . get_custom_field('job_title') . '</h4>';
				}
				?>
				<?php the_content(); ?>
			</article><!-- #plain_content -->
        <?php endwhile; ?>
</div><!-- #wrapper -->

<?php wp_footer(); ?>

<script type="text/javascript" id="sourcecode">
		jQuery(function(){
			var win = jQuery(window);
			// Full body scroll
			var isResizing = false;
			win.bind(
				'resize',
				function() {
					if (!isResizing) {
						isResizing = true;
						var container = jQuery('#wrapper-plain');
						// Temporarily make the container tiny so it doesn't influence the
						// calculation of the size of the document
						container.css({
							'width': 1,
							'height': 1
						});
						// Now make it the size of the window...
						container.css({
							'width': win.width(),
							'height': win.height()
						});
						isResizing = false;
						container.jScrollPane({
						    verticalDragMinHeight: 50,
						    verticalDragMaxHeight: 250
							//'showArrows': true
						});
					}
				}
			).trigger('resize');

			// Workaround for known Opera issue which breaks demo (see
			// http://jscrollpane.kelvinluck.com/known_issues.html#opera-scrollbar )
			jQuery('body').css('overflow', 'hidden');

			// IE calculates the width incorrectly first time round (it
			// doesn't count the space used by the native scrollbar) so
			// we re-trigger if necessary.
			if (jQuery('#full-page-container').width() != win.width()) {
				win.trigger('resize');
			}
		});
	</script>

</body>
</html>