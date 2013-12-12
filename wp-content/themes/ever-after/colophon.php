<?php
/**
 * Colophon
 *
 * This template is displayed just before closing #page.
 * By default it displays generator link along with the
 * theme name and the author.
 *
 * @package Ever_After
 * @since Ever After 1.0
 */
?>

<footer id="colophon" role="contentinfo">
	<div id="site-info">
		<?php do_action( 'forever_credits' ); ?>
		<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'everafter' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'everafter' ), 'WordPress' ); ?></a>
		<?php printf( __( 'Theme: %1$s by %2$s.', 'everafter' ), 'Ever After', '<a href="http://automattic.com/" rel="designer">Automattic</a>' ); ?>
	</div>
</footer><!-- #colophon -->