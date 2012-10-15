<?php
/*
 * Template Name: Bios Gallery
 *
 * This template is used to create a bio page that looks
 * and acts like wordpress' built-in gallery, but displays
 * a grid of headshots and contains the bio info inside
 * of a lightbox. That lightbox content is actually generated
 * inside of single-bio.php.
 *
 */

global $post;
get_header(); ?>
	
	<article class="grid_9" id="main">
		
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				<header>
					<h1 class="page-title"><?php the_title(); ?></h1>
				</header>
				<?php if(trim(get_the_content()) != "") { ?>
					<div class="entry">
						<?php the_content(); ?>
						<?php edit_post_link('edit', '<p>', '</p>'); ?>
					</div>
				<?php } ?>
		<?php endwhile; endif; // ends main loop ?>
		
		<?php
		if(post_type_exists('bio')) :
			$page_id = $post->ID;
			$page_slug = $post->post_name;
			$bio_category = get_term_by('slug', $page_slug, 'bios');
			if($bio_category) {
				$args = array( 'post_type'=>'bio', 'tax_query'=>array(array('taxonomy'=>'bios', 'field'=>'id', 'terms'=>$bio_category->term_id)), 'posts_per_page'=>-1  );
			} else {
				$args = array( 'post_type'=>'bio', 'posts_per_page'=>-1  );
			}
			?>
			<div id="bio-gallery-<?php echo $page_id; ?>" class="bio-gallery gallery gallery-columns-4">
			
				<?php
				$bio_query = new WP_query($args);
				$i = 0;
				if($bio_query->have_posts()) while($bio_query->have_posts()) : $bio_query->the_post();
					if(++$i % 5 == 0) {
						echo '<br class="clear" />';
						$i = 1;
					}
					?>
					<dl class="gallery-item">
						<dt class="gallery-icon"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a></dt>
						<dd class="wp-caption-text gallery-caption">
							<a href="<?php the_permalink(); ?>">
								<?php
								the_title();
								if(function_exists('get_custom_field') && get_custom_field('job_title')!="") {
									echo '<br />' . get_custom_field('job_title');
								}
								?>
							</a>
						</dd>
					</dl>
				<?php
				endwhile; // ends bio_query loop
				wp_reset_postdata();
				wp_reset_query();
				
				if($i != 0) { // add final <br> if it wasn't already added
					echo '<br class="clear" />';
				}
				?>
				<script type="text/javascript">
					// adds parameters to the colorbox hrefs to let the single.php page know that we want to display the simple layout. 
					$('#bio-gallery-<?php echo $page_id; ?> .gallery-item a').each(function() {
						var href = $(this).attr('href');
						$(this).attr('href', href + '?thecat=<?php echo $bio_category->term_id; ?>&iframe=true');
					});
				</script>					
			</div> <!-- #bio-gallery-<?php echo $page_id; ?> -->
			<?php
		endif; // ends if bio post type exists
		?>
		
		
		
	</article><!-- #main -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>