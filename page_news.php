<?php
/*
 * Template Name: News
 *
 * This template is used for a listing of news articles or press
 * releases. It's meant to be used in conjunction with custom fields
 * or a custom metabox which should be used to define external links
 * for the titles to link to. See note below.
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
				<div class="entry blog-intro">
					<?php the_content(); ?>
					<?php edit_post_link('edit', '<p>', '</p>'); ?>
				</div>
			<?php } ?>
		<?php endwhile; endif; // ends main loop ?>
		
		
		<?php
		$page_slug = $post->post_name;
		$category = get_category_by_slug($page_slug);
		if($category) :
			
			$args = array('cat'=>$category->cat_ID, 'paged'=>$paged);
			$news_query = new WP_Query($args);
		
			if($news_query->have_posts()) : ?>
			
				<section id="news-list">
					<?php while($news_query->have_posts()) : $news_query->the_post();?>
						<article class="news-post">
							<header>
								<h2 class="news-title">
									<?php
									// NOTE: This title really should be linking to an external page
									//       that contains the body of the news item. A custom meta box,
									//       or custom fields, or a plugin (e.g. Advanced Cusstom Fields)
									//       should help you define where that link should be entered via
									//       the admin by the user. Then switch out the href below.
									?>
									<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permalink to <?php the_title_attribute(); ?>">
										<?php the_title(); ?>
									</a>
								</h2>
								<div class="news-date">
									<?php the_time('F jS, Y'); ?>
								</div>
							</header>
						</article><!-- .entry.news-post -->
					<?php endwhile; // ends news post loop ?>
				</section><!-- .news-list -->
				<?php themebuilder_paginate(array('query'=>'news_query')); // outputs pagination links for the news_query object ?>
				
			<?php else : // else if !news_query->have_posts ?>
			
				<div class="entry news-content">
					<p>There are currently no posts. Check back soon!</p>
				</div>
			
			<?php endif; // ends if news_query->have_posts ?>
			<?php wp_reset_postdata(); ?>
			
		<?php else : // else if !$category ?>
		
			<div class="entry news-content">
				<p>There are currently no posts. Check back soon!</p>
			</div>
		
		<?php endif; // ends if $category ?>
		
	</section><!-- #main -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>