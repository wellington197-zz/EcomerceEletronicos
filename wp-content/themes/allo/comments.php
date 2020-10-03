<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Allo
 * @since 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
} ?>
<?php if ( have_comments() ) : ?>
<div id="comments" class="comments">
	<h3 class="comments-title">
		<?php comments_number( esc_html__( 'No Comments', 'allo' ), esc_html__( '1 Comment', 'allo' ), '%'.esc_html__( ' Comments', 'allo' ) ); ?>
	</h3>
	<ol class="comment-list-content">
		<?php
			wp_list_comments( array(
				'style'      => 'ol',
				'short_ping' => true,
				'callback' => 'allo_comment_list',
			) );
		?>
	</ol><!-- .comment-list -->

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="navigation comment-navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'allo' ); ?></h2>
			<div class="nav-links">
				<?php
					$allowed_html_array = array(
				        'span' => array()
				    );
				?>
				<div class="nav-previous"><?php previous_comments_link( wp_kses( __( '<span>&laquo;</span> Older Comments', 'allo' ), $allowed_html_array ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( wp_kses( __( 'Newer Comments <span>&raquo;</span>', 'allo' ), $allowed_html_array ) ); ?></div>
			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
	<?php endif; // check for comment navigation ?>


	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'allo' ); ?></p>
	<?php endif; // have_comments() ?>
</div><!-- #comments -->
<?php endif; ?>
<?php comment_form(); ?>