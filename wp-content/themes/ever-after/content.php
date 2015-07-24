<?php
/**
 * @package EverAfter
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php forever_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>

		<?php if ( comments_open() || ( '0' != get_comments_number() && ! comments_open() ) ) : ?>
		<p class="comments-link"><?php comments_popup_link( '<span class="no-reply">' . __( '0', 'ever-after' ) . '</span>', __( '1', 'ever-after' ), __( '%', 'ever-after' ) ); ?></p>
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php if ( '' != get_the_post_thumbnail() ) { ?>
			<figure class="entry-thumb">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( forever_get_post_thumbnail_size() ); ?></a>
			</figure><!-- .gallery-thumb -->
			<?php the_excerpt(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'ever-after' ), 'after' => '</div>' ) ); ?>

			<div class="entry-likes">
				<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'ever-after' ), 'after' => '</div>' ) ); ?>
				<?php if ( function_exists( 'sharing_display' ) ) {
					sharing_display( '', true );
				}

				if ( class_exists( 'Jetpack_Likes' ) ) {
					$custom_likes = new Jetpack_Likes;
					echo $custom_likes->post_likes( '' );
				} ?>
			</div><!-- .entry-likes -->
		<?php } else { ?>
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'ever-after' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'ever-after' ), 'after' => '</div>' ) ); ?>
		<?php } // if ( '' != get_the_post_thumbnail() ) ?>
	</div><!-- .entry-content -->

	<?php
		// translators: used between list items, there is a space after the comma
		$categories_list = get_the_category_list( __( ', ', 'ever-after' ) );

		// translators: used between list items, there is a space after the comma
		$tags_list = get_the_tag_list( '', __( ', ', 'ever-after' ) );

		// Check to see if there is a need for an article footer
		if (
			'post' == get_post_type() || $categories_list && forever_categorized_blog()
		) :
	?>
	<footer class="entry-meta">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				if ( $categories_list && forever_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'ever-after' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				if ( $tags_list ) :
			?>
			<span class="tag-links">
				<?php printf( __( 'Tagged %1$s', 'ever-after' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php edit_post_link( __( 'Edit', 'ever-after' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- #entry-meta -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
