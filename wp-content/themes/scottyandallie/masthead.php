<?php if ( is_home() ): ?>
<div id="home-gallery">
	<div></div>
	<img src="/wp-content/uploads/photos/1.jpg" />
</div>
<script id="home-gallery-data" type="application/json"><?php
echo json_encode( array(
	'/wp-content/uploads/photos/1.jpg',
	'/wp-content/uploads/photos/2.jpg',
	'/wp-content/uploads/photos/3.jpg',
	'/wp-content/uploads/photos/4.jpg',
	'/wp-content/uploads/photos/5.jpg',
	'/wp-content/uploads/photos/6.jpg',
	'/wp-content/uploads/photos/7.jpg',
	'/wp-content/uploads/photos/8.jpg',
	'/wp-content/uploads/photos/9.jpg',
) );
?></script>
<?php endif; ?>
<header id="masthead" role="banner">
	<h1 id="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

	<?php $header_image = get_header_image(); ?>
	<?php if ( ! empty( $header_image ) ) : ?>
		<a class="custom-header" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<img class="custom-header-image" src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
		</a>
	<?php endif; ?>

	<nav id="access" role="navigation">
		<h1 class="assistive-text section-heading"><?php _e( 'Main menu', 'forever' ); ?></h1>
		<div class="skip-link assistive-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'forever' ); ?>"><?php _e( 'Skip to content', 'forever' ); ?></a></div>

		<?php wp_nav_menu( apply_filters( 'forever-primary-menu-args', array( 'theme_location' => 'primary' ) ) ); ?>
	</nav><!-- #access -->
</header><!-- #masthead -->