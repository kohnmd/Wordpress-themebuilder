<?php
/*
 * This template is used as a backup for any archive
 * type, including tags, categories, and dates.
 *
 */

global $post;
global $paged;
get_header(); ?>
	
	<section class="grid_9" id="main">
		
		<header>
			<h1 class="page-title"><?php
				if (is_category()) {
					echo 'Archive for "' . single_cat_title('', false) . '" Category';
				} elseif (is_day()) {
					echo 'Archive for ' . get_the_time('M jS Y');
				} elseif (is_month()) {
					echo 'Archive for ' . get_the_time('M Y');
				} elseif (is_year()) {
					echo 'Archive for ' . get_the_time('Y');
				} elseif (is_tag()) {
					echo 'Archive for "' . single_tag_title('', false) . '" Tag';
				}
				if($paged > 1) echo ' &ndash; Page ' . $paged;
			?></h1>
		</header>

		<section id="blog-list">
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>	
				
				<article class="blog-post">
					<header>
						<h2 class="blog-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permalink to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
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
				</article><!-- .entry.blog-post -->
				
			<?php endwhile; // ends blog post loop ?>
			<?php else : // else if !have_posts ?>
				<div class="entry blog-content">
					<p>There are currently no posts. Check back soon!</p>
				</div>
			<?php endif; // ends if have_posts ?>
		</section><!-- .blog-list -->
		
	</section><!-- #main -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>