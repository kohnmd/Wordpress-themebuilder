<?php 
/*
 * Template Name: Full Width (no sidebar)
 *
 * This template is identical to the main page.php template,
 * except #main is grid_12 and get_sidebar() has been removed.
 *
 */

get_header(); ?>
	
	<article class="grid_12" id="main">
		
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				
				<header>
					<h1 class="page-title"><?php the_title(); ?></h1>
				</header>
				
				<div class="entry">
					<?php the_content(); ?>
					<?php edit_post_link('edit', '<p>', '</p>'); ?>
				</div>
		
		<?php endwhile; // ends main loop ?>
		<?php else : // else if !have_posts ?>
			<div class="entry">
				<p>No content to display.</p>
			</div>
		<?php endif; // ends if have_posts ?>
		
	</article><!-- #main -->
	
<?php get_footer(); ?>