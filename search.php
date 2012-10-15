<?php
/*
 * This template is used to display search results.
 * In general, WordPress' built in search is pretty bad.
 * Therefore I recommend installing a plugin if you'd like
 * to customize the search or display funcitonality.
 * For example: http://wordpress.org/extend/plugins/relevanssi/
 */

global $post;
global $paged;
get_header(); ?>
	
	<section class="grid_9" id="main">
		
		<header>
			<h1 class="page-title">
				Search Results for "<?php the_search_query(); ?>"
				<?php if($paged > 1) echo ' &ndash; Page ' . $paged; ?>
			</h1>
		</header>

		<section id="blog-list">
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>	
				
				<article class="blog-post">
					<header>
						<h2 class="blog-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permalink to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					</header>
					<div class="entry blog-content">
						<?php the_excerpt(); ?>
					</div><!-- .blog-content -->
					
					<?php
					// This grabs the blog-meta footer from the includes-meta.php file.
					// The exact same meta is used both here and several other places,
					// so this makes it easier to update it since it lives in just one place.
					get_template_part('includes', 'meta');
					?>
				</article><!-- .entry.blog-post -->
				
			<?php endwhile; // ends blog post loop ?>
				
				<?php themebuilder_paginate(array('query'=>'blog_query')); // outputs pagination links for the blog_query object ?>
				
			<?php else : // else if !have_posts ?>
				<div class="entry blog-content">
					<p>No results found. Try searching for something else.</p>
				</div>
			<?php endif; // ends if have_posts ?>
		</section><!-- .blog-list -->
		
	</section><!-- #main -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>