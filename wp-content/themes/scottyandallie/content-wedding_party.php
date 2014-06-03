<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'forever' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<div class="entry-meta">
			<?php the_terms( get_the_ID(), 'wedding_party_type' ); ?>
		</div>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php if ( '' != get_the_post_thumbnail() ) { ?>
			<figure class="entry-thumb">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( forever_get_post_thumbnail_size() ); ?></a>
			</figure><!-- .gallery-thumb -->
			<?php the_excerpt(); ?>
		<?php } else { ?>
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'forever' ) ); ?>
		<?php } // if ( '' != get_the_post_thumbnail() ) ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->