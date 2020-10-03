<?php
/**
 * Comment Fields
 *
 * @package Allo
 * @since 1.0
 */
function allo_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}
add_filter( 'comment_form_fields', 'allo_move_comment_field_to_bottom' );

/**
 * Comment Form
 *
 * @package Allo
 * @since 1.0
 */
function allo_comment_form($args) {
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );

	$args['fields'] = array(
      'author' =>
        '<div class="col-md-6"><input id="name" placeholder="'. esc_html__( 'Your Name', 'allo' ) . ( $req ? '*' : '' ) .'" class="form-control" name="author" required="required" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
        '" size="30"' . ( $req ? " aria-required='true'" : '' ) . '/></div>',

      'email' =>
        '<div class="col-md-6"><input id="email" placeholder="'. esc_html__( 'Your Email', 'allo' ) . ( $req ? '*' : '' ) .'" class="form-control" name="email" required="required" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) .
        '" size="30"' . ( $req ? " aria-required='true'" : '' ) . ' /></div>',

      'url' =>
        '<div class="col-md-12"><input id="url" placeholder="'. esc_html__( 'Got a Website?', 'allo' ) .'" class="form-control" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) .
        '" size="30" /></div>'
      );
	$args['id_form'] = "comment_form";
	$args['class_form'] = ( is_singular('product') ) ? "comment-form" : "row comment-form";
	$args['id_submit'] = "comments-submit";
	$args['class_submit'] = "comment-submit";
	$args['name_submit'] = "submit";
	$args['title_reply'] = wp_kses( __( '<span>Leave a Reply</span>', 'allo' ), TL_ALLO_Static::html_allow() );
	/* translators: number of comments. */
	$args['title_reply_to'] = wp_kses( __( 'Leave a Reply to %s', 'allo' ), TL_ALLO_Static::html_allow() );
	$args['cancel_reply_link'] = esc_html__( 'Cancel Reply', 'allo' );
	$args['comment_notes_before'] = "";
	$args['comment_notes_after'] = "";
	$args['label_submit'] = esc_html__( 'Post Comment', 'allo' );
	$args['comment_field'] = '<div class="col-md-12"><textarea id="message" class="comments-textarea" placeholder="'. esc_html__( 'Your Comment here&hellip;', 'allo' ) .'" name="comment" aria-required="true" rows="8" cols="45"></textarea></div>';
	return $args;
}
add_filter('comment_form_defaults', 'allo_comment_form');

/**
 * Comments List
 *
 * @package Allo
 * @since 1.0
 */
function allo_comment_list($comment, $args, $depth) {
	global $comment;
	extract($args, EXTR_SKIP);
	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
<<?php echo wp_kses_post($tag); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
<?php if ( 'div' != $args['style'] ) : ?>
<div id="div-comment-<?php comment_ID() ?>" class="comment-list">
<?php endif; ?>
	<div class="user-photo">
		<?php echo get_avatar($comment,$size='60'); ?>				
	</div><!-- /.author-img -->
	<div class="comment-con">
		<?php /* translators: Comments link. */ ?>
	    <h4 class="comment-author"><?php printf( esc_html__( ' %1$s ', 'allo' ), get_comment_author_link() ); ?></h4>

	    <span class="date">
	    	<?php
	    	    /* translators: Comments date, edit link. */
	    		printf( esc_html__('%1$s at %2$s','allo'), get_comment_date(),  get_comment_time() ); ?><?php edit_comment_link( esc_html__( '(Edit)','allo' ), '  ', '' );
	    	?>
	    </span>

	    <?php comment_text(); ?>
	    <?php if ( $comment->comment_approved == '0' ) : ?>
	    	<p><em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.','allo' ); ?></em>
	    	</p>
	    <?php endif; ?>

	    <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div><!-- /.comment-body -->
	<?php endif; ?>
<?php }