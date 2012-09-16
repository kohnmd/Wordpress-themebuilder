<?php
// Before we do anything, check to see if this post is being called from a lightbox iframe (e.g. on a bio page)
// If so, delever the single_plain.php layout

if(isset($_GET['thecat']) && !empty($_GET['thecat'])) :

    require('single_plain.php');

else :

get_header(); ?>
	
	<article class="grid_9" id="main">
		
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				
				<article class="blog-post">
					<header>
						<h1 class="page-title"><?php the_title(); ?></h1>
					</header>
					<div class="entry blog-content">
						<?php the_content(); ?>
					</div><!-- .blog-content -->
					
					<?php
					// This grabs the blog-meta footer from the includes-meta.php file.
					// The exact same meta is used both here and in the page_blog.php file,
					// so this makes it easier to update it since it lives in just one place.
					get_template_part('includes', 'meta');
					?>
				</article><!-- .blog-post -->
		
		<?php endwhile; // ends main loop ?>
		<?php else : // else if !have_posts ?>
			<article class="entry blog-post">
				<p>No content to display.</p>
			</article>
		<?php endif; // ends if have_posts ?>
		
		<?php comments_template(); ?> 
		
	</article><!-- #main -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
<?php endif;  // ends which single template to deliver ?>