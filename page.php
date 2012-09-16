<?php get_header(); ?>
	
	<article class="grid_9" id="main">
		
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

<?php get_sidebar(); ?>
<?php get_footer(); ?>