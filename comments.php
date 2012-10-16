<?php
/**
 * The template for displaying Comments.
 * This is based off of the twentyeleven comments.php file,
 * but it's been pretty well modified. For added functionality,
 * refer to the original twentyeleven file.
 */
 
 
// Stop the rest of comments.php from being processed,
// but don't kill the script entirely -- we still have
// to fully load the template.
if ( post_password_required() ) {
	return;
}
?>

<div id="comments">
	<?php if ( have_comments() ) : ?>
		<h3 id="comments-title">
			<?php printf( _n('One Comment', '%1$s Comments', get_comments_number(), 'themebuilder'), number_format_i18n(get_comments_number()) ); ?>
		</h3>

		<ol class="commentlist">
			<?php
			// Displays individual comments.
			// Uses themebuilder_comment() function to define their layout.
			// See functions.php for that function definition.
			wp_list_comments( array( 'callback' => 'themebuilder_comment' ) );
			?>
		</ol>
	<?php endif; // ends if have_comments ?>
	
	<?php
	// Now for the comment form.
	// It's a pain to customize this bad boy, and it basically
	// all has to be done through the following arguments.
	
	$fields = array (
		'author' => 
			'<div class="comment-form-input grid_3 alpha">' .
				'<label for="author" class="assistive-text">' . __( 'Name' ) . '</label> ' .
				'<input id="author" name="author" placeholder="Name" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" tabindex="1"' . (isset($aria_req) ? $aria_req : "") . ' />' .
            '</div><!-- .comment-form-input -->',
		'email' => 
			'<div class="comment-form-input grid_3">' .
				'<label for="email" class="assistive-text">' . __( 'Email' ) . '</label> ' .
				'<input id="email" name="email" placeholder="Email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" tabindex="2"' . (isset($aria_req) ? $aria_req : "") . ' />' .
            '</div><!-- .comment-form-input -->',
		'url' => 
			'<div class="comment-form-input grid_3 omega">' .
				'<label for="url" class="assistive-text">' . __( 'Website' ) . '</label> ' .
				'<input id="url" name="url" placeholder="Website" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" tabindex="3" />' .
            '</div><!-- .comment-form-input -->'
	);
	
	$args = array(
		'fields' => apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field' =>
			'<div class="comment-form-comment">' .
                '<label for="comment" class="assistive-text">' . __( 'Comment' ) . '</label>' .
                '<textarea id="comment" name="comment" tabindex="4" cols="30" rows="8" aria-required="true" placeholder="Comment"></textarea>' .
            '</div><!-- .comment-form-comment -->',
		'comment_notes_before' => "",
		'comment_notes_after' => '<p class="comment-notes">' . __( "Don't worry, we won't display or share you email address in any way. We're good people like that." ) . '</p>',
		'title_reply' => __( 'Leave a Comment' ),
		'label_submit' => __( 'Post Comment' )
	); 


	
	comment_form($args);
	?>

</div><!-- #comments -->
