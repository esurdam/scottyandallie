<?php

class ScottyAndAllie {
	function __construct() {
		add_action( 'init', array( $this, 'init' ) );
		add_action( 'pre_get_posts', array( $this, 'pre_get_posts' ) );
	}

	function pre_get_posts( &$query ) {
		if ( $query->is_main_query() && $query->is_post_type_archive( 'wedding_party' ) ) {
			$tax = 'wedding_party_type';
			$terms = get_terms( $tax );

			$types = array(
				'groom',
				'best-man',
				'groomsman',
				'bride',
				'sister-of-the-bride',
				'maid-of-honor',
				'bridesmaid'
			);

			$ids = array();
			foreach ( $types as $type ) {
				$term = wp_list_filter( $terms, array( 'slug' => $type ) );
				$objects = get_objects_in_term( reset( $term )->term_id, $tax );
				$ids = array_merge( $ids, $objects );
			}

			$query->set( 'post__in', $ids );
			$query->set( 'orderby', 'post__in' );
			$query->set( 'posts_per_page', -1 );
		}
	}

	function init() {
		register_post_type( 'wedding_party', array(
			'public' => true,
			'rewrite' => array( 'slug' => 'wedding-party' ),
			'has_archive' => true,
			'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
			'labels' => array(
				'name'               => _x( 'Wedding Party', 'post type general name', 'forever' ),
				'singular_name'      => _x( 'Wedding Party', 'post type singular name', 'forever' ),
				'menu_name'          => _x( 'Wedding Party', 'admin menu', 'forever' ),
				'name_admin_bar'     => _x( 'Wedding Party', 'add new on admin bar', 'forever' ),
				'add_new'            => _x( 'Add New', 'wedding party', 'forever' ),
				'add_new_item'       => __( 'Add New Wedding Party Member', 'forever' ),
				'new_item'           => __( 'New Wedding Party Member', 'forever' ),
				'edit_item'          => __( 'Edit Wedding Party Member', 'forever' ),
				'view_item'          => __( 'View Wedding Party Member', 'forever' ),
				'all_items'          => __( 'All Wedding Party', 'forever' ),
				'search_items'       => __( 'Search Wedding Party', 'forever' ),
				'parent_item_colon'  => __( 'Parent wedding party:', 'forever' ),
				'not_found'          => __( 'No wedding party found.', 'forever' ),
				'not_found_in_trash' => __( 'No wedding party found in Trash.', 'forever' ),
			)
		) );

		register_taxonomy( 'wedding_party_type', 'wedding_party', array(
			'public' => true,
			'hierarchical' => true,
			'show_admin_column' => true,
			'labels' => array(
				'name'              => _x( 'Wedding Party Type', 'taxonomy general name' ),
				'singular_name'     => _x( 'Wedding Party Type', 'taxonomy singular name' ),
				'search_items'      => __( 'Search Wedding Party Types' ),
				'all_items'         => __( 'All Wedding Party Types' ),
				'parent_item'       => __( 'Parent Wedding Party Type' ),
				'parent_item_colon' => __( 'Parent Wedding Party Type:' ),
				'edit_item'         => __( 'Edit Wedding Party Type' ),
				'update_item'       => __( 'Update Wedding Party Type' ),
				'add_new_item'      => __( 'Add New Wedding Party Type' ),
				'new_item_name'     => __( 'New Wedding Party Type Name' ),
				'menu_name'         => __( 'Wedding Party Type' ),
			)
		) );
	}
}
new ScottyAndAllie;

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @uses forever_add_image_sizes()
 */
function forever_setup() {
	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 */
	load_theme_textdomain( 'forever', get_template_directory() . '/languages' );

	forever_maybe_enable_theme_options();

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'forever' ),
	) );

	/**
	 * Add support for the Aside and Gallery Post Formats
	 */
	add_theme_support( 'post-formats', array( 'gallery', 'image', 'status', 'quote' ) );

	/**
	 * Enqueue styles.
	 */
	function forever_styles() {
		wp_enqueue_style( 'countdown', get_template_directory_uri() . '/css/jquery.countdown.css' );
		wp_enqueue_style( 'forever-style', get_template_directory_uri() . '/style.css' );
		wp_enqueue_style( 'scotty-and-allie-style', get_stylesheet_uri() );
	}
	add_action( 'wp_enqueue_scripts', 'forever_styles' );

	/**
	 * Enqueue Fonts.
	 */
	function forever_fonts() {
		$protocol = is_ssl() ? 'https' : 'http';
		wp_enqueue_style( 'raleway', "$protocol://fonts.googleapis.com/css?family=Raleway:500,600,300,700,800" );
	}
	add_action( 'wp_enqueue_scripts', 'forever_fonts' );

	/**
	 * Enqueue scripts
	 */
	function forever_scripts() {
		wp_enqueue_script( 'p', get_stylesheet_directory_uri() . '/js/jquery.plugin.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'countdown', get_stylesheet_directory_uri() . '/js/jquery.countdown.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'scott', get_stylesheet_directory_uri() . '/js/scott.js', array( 'jquery' ), '', true );

		// enqueue comment reply script
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// enqueue masonry for the guestbook page template
		if ( is_page_template( 'guestbook.php') ) {
			wp_enqueue_script( 'jquery-masonry' );
			wp_enqueue_script( 'guestbook', get_template_directory_uri() . '/js/guestbook.js', array( 'jquery' ), '28-12-2011', true );
		}
	}
	add_action( 'wp_enqueue_scripts', 'forever_scripts' );

	/**
	 * This theme uses Featured Images (also known as post thumbnails)
	 */
	add_theme_support( 'post-thumbnails' );

	/*
	 * Register custom image sizes.
	 */
	forever_add_image_sizes();

}