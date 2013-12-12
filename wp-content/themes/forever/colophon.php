<?php
/**
 * Colophon
 *
 * This template is displayed just before closing #page.
 * By default it displays generator link along with the
 * theme name and the author.
 *
 * @since Forever 1.1
 */
?>

<footer id="colophon" role="contentinfo">
	<div id="site-info">
		<?php do_action( 'forever_credits' ); ?>
		<a href="http://wordpress.org/" rel="generator">Proudly powered by WordPress</a> <?php printf( __( 'Theme: %1$s by %2$s.', 'forever' ), 'Forever', '<a href="http://automattic.com/" rel="designer">Automattic</a>' ); ?>
	</div>
</footer><!-- #colophon -->