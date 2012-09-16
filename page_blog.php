<?php
/*
 * Template Name: Blog
 *
 * This template is used for any standard blog-style page.
 * Can also be used for news pages, or custom post types.
 * By default it checks to see if there is a category with
 * the same slug as the page, and displays its posts if
 * there is a match.
 *
 */

global $post;
global $paged;
get_header(); ?>
	
	<section class="grid_9" id="main">
		
		<header>
			<h1 class="page-title"><?php
				the_title();
				if($paged > 1) echo ' &ndash; Page ' . $paged;
			?></h1>
		</header>
		
		<?php // This displays the page content if content is entered into the main page editor. ?>
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>				
			<?php if(trim(get_the_content()) != "") { ?>
				<div class="entry">
					<?php the_content(); ?>
					<?php edit_post_link('edit', '<p>', '</p>'); ?>
				</div>
			<?php } ?>
		<?php endwhile; endif; // ends main loop ?>
		
		
		<?php
		$page_slug = $post->post_name;
		$category = get_category_by_slug($page_slug);
		if($category) :
		?>
			<section id="blog-list">
			
				<?php
				$args = array('cat'=>$category->cat_ID, 'paged'=>$paged);
				$blog_query = new WP_Query($args);
			
				if($blog_query->have_posts()) : while($blog_query->have_posts()) : $blog_query->the_post();?>
					
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
				<?php else : // else if !blog_query->have_posts ?>
					<div class="entry blog-content">
						<p>There are currently no posts. Check back soon!</p>
					</div>
				<?php endif; // ends if blog_query->have_posts ?>
		
			</section><!-- .blog-list -->
		
		<?php else : // else if !$category ?>
			<div class="entry blog-content">
				<p>There are currently no posts. Check back soon!</p>
			</div>
		<?php endif; // ends if $category ?>
		
	</section><!-- #main -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>