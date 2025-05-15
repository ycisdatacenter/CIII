<?php
if ( post_password_required() ) 
{
	return;
}
?>
<div id="comments" class="commentsWrapper">
<div class="emptySpace50"></div>
	<?php if ( have_comments() ): ?>
		<h5 class="h5 as tt-featured-title font-20">
			<?php comments_number(); ?>
		</h5>

		<ol class="commentBlock normall commentlist">
			<?php
				wp_list_comments( array(
					'style'       => 'ul',
					'short_ping'  => true,
					'avatar_size' => 87,
					'callback'    => 'tmc_comment'
				) );
			?>
		</ol>
		<div class="emptySpace60 emptySpace-xs30"></div>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ): ?>
			<nav class="navigation comment-navigation" role="navigation">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation','indofact' ); ?></h2>
				<div class="nav-links">
					<?php
					if ( $prev_link = get_previous_comments_link( esc_html__( 'Older Comments','indofact' ) ) ) {
						printf( '<div class="nav-previous">%s</div>', $prev_link );
					}
					if ( $next_link = get_next_comments_link( esc_html__( 'Newer Comments','indofact' ) ) ) {
						printf( '<div class="nav-next">%s</div>', $next_link );
					}
					?>
				</div>
			</nav>
		<?php endif; 
			endif; 
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ): ?>
		<p class="no-comments"><?php esc_html__( 'Comments are closed.','indofact' ); ?></p>
	<?php endif; 
	comment_form( array(
		'comment_notes_before' => '',
		'comment_notes_after' => ''
	) ); ?>
</div>