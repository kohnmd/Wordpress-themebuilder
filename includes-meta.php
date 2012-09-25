<?php global $post; ?>
<footer class="blog-meta">
	<ul class="clearfix">
		<li>Posted on <a href="<?php the_permalink(); ?>" rel="bookmark" title="Permalink to <?php the_title_attribute(); ?>"><?php the_time('F jS, Y'); ?></a></li>
		
		<?php if( $post->post_type != 'page' && (comments_open() || get_comments_number() > 0) ) { // get_comments_number used in lieu of have_comments because have_comments only works when in the main wp_query loop ?>
			<li><?php comments_popup_link( 'Leave a comment', '1 comment', '% comments', 'comments-link', 'Comments are off for this post'); ?>
		<?php } ?>
		
		<?php the_tags('<li class="tags-list">Tags: ',', ','</li>'); ?>
		
		<?php edit_post_link('edit', '<li>', '</li>' ); ?>
	</ul>
</footer><!-- .blog-meta -->