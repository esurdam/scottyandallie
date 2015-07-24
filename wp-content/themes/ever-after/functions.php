<?php
/**
 * Ever After functions and definitions.
 *
 * @package Ever_After
 * @since Ever After 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 870; /* pixels */

/**
 * Disable Forever's theme options.
 *
 * @since Ever After 1.0
 */
add_filter( 'forever-enable-theme-options', '__return_false' );

/**
 * Set up Ever After specific setting.
 *
 * @since Ever After 1.0
 */
function everafter_setup() {
	/**
	 * Declare textdomain for this child theme.
	 * Translations can be filed in the /languages/ directory
	 */
	load_child_theme_textdomain( 'everafter', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'everafter_setup' );

/**
 * Change default custom background image and color.
 *
 * @since Ever After 1.0
 */
function everafter_custom_background_args( $args ) {

	$args = array(
		'default-color' => '060606',
		'default-image' => get_stylesheet_directory_uri() . '/images/body-bg-2x.png',
	);

	return $args;
}
add_action( 'forever_custom_background_args', 'everafter_custom_background_args' );

/**
 * Print additional style for custom background admin page.
 *
 * @since Ever After 1.0
 */
function everafter_admin_background_style( $hook_suffix ) {
	if ( 'appearance_page_custom-background' != $hook_suffix )
		return;
?>
	<style type="text/css">
	#custom-background-image[style*="/images/body-bg-2x.png"] {
		background-size: 40px 40px;
	}
	</style>
<?php
}
add_action( 'admin_enqueue_scripts', 'everafter_admin_background_style' );

/**
 * Adds a class if the site uses the default background image.
 *
 * @since Ever After 1.1
 *
 * @param array $classes The body classes.
 * @return array
 */
function everafter_body_class( $classes ) {
	if ( ! get_theme_mod( 'background_image' ) )
		$classes[] = 'default-background-image';

	return $classes;
}
add_action( 'body_class', 'everafter_body_class' );

/**
 * Change large featured image size.
 *
 * @since Ever After 1.0
 */
function everafter_featured_image_sizes( $sizes ) {

	$sizes['large-feature'] = array( 850, 400, true );

	return $sizes;
}
add_action( 'forever-image-sizes', 'everafter_featured_image_sizes' );

/**
 * Adding new post thumbnail size size.
 *
 * @since Ever After 1.0
 */
function everafter_post_thumbnail_size( $thumbnail_size ) {

	$thumbnail_size = array( 850, 0, false );

	return $thumbnail_size;
}
add_action( 'forever-post-thumbnail-size', 'everafter_post_thumbnail_size' );

/**
 * Change default custom header image, color, and size.
 *
 * @since Ever After 1.0
 */
function everafter_custom_header_args( $args ) {

	$args = array(
		'default-image'          => '',
		'default-text-color'     => '4c4c4b',
		'width'                  => 870,
		'height'                 => 210,
		'flex-height'            => true,
		'flex-width'             => true,
		'random-default'         => false,
		'wp-head-callback'       => 'everafter_header_style',
		'admin-head-callback'    => 'everafter_admin_header_style',
		'admin-preview-callback' => 'everafter_admin_header_image',
	);
	return $args;
}
add_filter( 'forever_custom_header_args', 'everafter_custom_header_args', 999 );

if ( ! function_exists( 'everafter_header_style' ) ) :
/**
 * Custom styles for our blog header
 */
function everafter_header_style() {
	$header_textcolor = get_header_textcolor();
	$header_image     = get_header_image();

	// If no custom options for text are set, let's bail
	if ( empty( $header_image ) && '' == $header_textcolor )
		return;

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	.custom-header {
		display: block;
		text-align: center;
	}
	#masthead img {
		background: transparent;
		border: 0;
		margin: -1.55em 0 1.8em;
		padding: 0;
		vertical-align: middle;
	}
	<?php
		// Has the text been hidden? Let's hide it then.
		if ( 'blank' == $header_textcolor ) :
	?>
		#site-title {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		#site-title a {
			color: #<?php echo $header_textcolor; ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // everafter_header_style()

if ( ! function_exists( 'everafter_admin_header_style' ) ) :
/**
 * Custom styles for the custom header page in the admin
 *
 * @since Ever After 1.0
 */
function everafter_admin_header_style() {
	$header_textcolor = get_header_textcolor();
?>
	<style type="text/css">
	#headimg {
		background: url('<?php echo get_stylesheet_directory_uri(); ?>/images/page-bg.png') #fff;
		padding: 30px;
		text-align: center;
		max-width: 870px;
	}
	.appearance_page_custom-header #headimg {
		border: none;
	}
	#headimg h1 {
		font-family: 'Pacifico', cursive;
		font-size: 50px;
		font-weight: 400;
		line-height: 1.2em;
		margin-bottom: 0.78em;
		text-align: center;
	}
	#headimg h1 a {
		color: #4c4c4b;
		text-decoration: none;
	}
	#headimg img {
		display: block;
		margin: 0 auto;
	}
	<?php
		// If the user has set a custom color for the text use that
		if ( $header_textcolor != HEADER_TEXTCOLOR ) :
	?>
		#headimg h1 a {
			color: #<?php echo $header_textcolor; ?>;
		}
	<?php endif; ?>
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_textcolor ) :
	?>
	#headimg h1 {
		display: none;
	}
	<?php endif; ?>
	</style>
<?php
}
endif; // everafter_admin_header_style

if ( ! function_exists( 'everafter_admin_header_image' ) ) :
/**
 * Custom markup for the custom header admin page.
 *
 * @since Ever After 1.0
 */
function everafter_admin_header_image() {
	$header_textcolor = get_theme_mod( 'header_textcolor',  HEADER_TEXTCOLOR );
	$header_image     = get_header_image();
?>
	<div id="headimg">
		<?php if ( ! empty( $header_image ) ) : ?>
		<img src="<?php echo esc_url( $header_image ); ?>" alt="" />
		<?php endif; ?>

		<?php
		if ( 'blank' == $header_textcolor || '' == $header_textcolor )
			$style = ' style="display:none;"';
		else
			$style = ' style="color:#' . $header_textcolor . ';"';
		?>
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
	</div>
<?php
}
endif;

/**
 * Enqueue font styles.
 *
 * @since Ever After 1.0
 */
function everafter_fonts() {
	$protocol = is_ssl() ? 'https' : 'http';
	wp_enqueue_style( 'everafter-pacifico', "$protocol://fonts.googleapis.com/css?family=Pacifico" );
	wp_enqueue_style( 'everafter-volkorn',  "$protocol://fonts.googleapis.com/css?family=Vollkorn:400italic,700italic,400,700" );
	wp_enqueue_style( 'everafter-oswald',   "$protocol://fonts.googleapis.com/css?family=Oswald:400,700,300" );
}
add_action( 'wp_enqueue_scripts', 'everafter_fonts' );

/**
 * Enqueue font style for the custom header admin page.
 *
 * @since Ever After 1.0
 */
function everafter_admin_fonts( $hook_suffix ) {
	if ( 'appearance_page_custom-header' != $hook_suffix )
		return;

	$protocol = is_ssl() ? 'https' : 'http';
	wp_enqueue_style( 'everafter-pacifico', "$protocol://fonts.googleapis.com/css?family=Pacifico" );
}
add_action( 'admin_enqueue_scripts', 'everafter_admin_fonts' );

/**
 * Enqueue the small menu script.
 *
 * @since Ever After 1.0
 */
function everafter_scripts() {
	wp_enqueue_script( 'everafter-small-menu', get_stylesheet_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );
}
add_action( 'wp_enqueue_scripts', 'everafter_scripts' );

/**
 * Denqueue unused scripts and Google font style from the parent theme.
 *
 * @since Ever After 1.0
 */
function everafter_dequeue_scripts() {
	wp_dequeue_style( 'raleway' );

	if ( is_page_template( 'guestbook.php') ) :
		wp_dequeue_script( 'jquery-masonry' );
		wp_dequeue_script( 'guestbook' );
	endif;
}
add_action( 'wp_enqueue_scripts', 'everafter_dequeue_scripts', 11 );

/**
 * Remove sidebar widget area.
 *
 * @since Ever After 1.0
 */
function everafter_remove_sidebar_widgets() {
	unregister_sidebar( 'sidebar-1' );
}
add_action( 'widgets_init', 'everafter_remove_sidebar_widgets', 11 );

/**
 * Load Jetpack compatibility file.
 */
if ( file_exists( get_stylesheet_directory() . '/inc/jetpack.php' ) )
	require get_stylesheet_directory() . '/inc/jetpack.php';
