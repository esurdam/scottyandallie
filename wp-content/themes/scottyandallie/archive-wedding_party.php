<?php
/**
 * @package Forever
 * @since Forever 1.0
 */

get_header(); ?>

<section id="primary">
	<div id="content" role="main">

	<?php if ( have_posts() ) : ?>

		<header class="page-header">
			<h1 class="page-title">
				<?php post_type_archive_title() ?>
			</h1>
		</header>

		<div class="wedding-party-column">
		<?php while ( have_posts() ) : the_post(); ?>

			<?php if ( has_term( 'bride', 'wedding_party_type' ) ): ?>
		</div>
		<div class="wedding-party-column">
			<?php endif; ?>

			<?php get_template_part( 'content', get_post_type() ); ?>

		<?php endwhile; ?>
		</div>
		<div class="clear"></div>
	<?php else : ?>

		<article id="post-0" class="post no-results not-found">
			<header class="entry-header">
				<h1 class="entry-title"><?php _e( 'Nothing Found', 'forever' ); ?></h1>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'forever' ); ?></p>
				<?php get_search_form(); ?>
			</div><!-- .entry-content -->
		</article><!-- #post-0 -->

	<?php endif; ?>

	</div><!-- #content -->
</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>