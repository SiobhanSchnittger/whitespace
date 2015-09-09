<?php
/**
 * mixedmedia functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package mixedmedia
 */

if ( ! function_exists( 'mixedmedia_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function mixedmedia_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on mixedmedia, use a find and replace
	 * to change 'mixedmedia' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'mixedmedia', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'mixedmedia' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'mixedmedia_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // mixedmedia_setup
add_action( 'after_setup_theme', 'mixedmedia_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mixedmedia_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'mixedmedia_content_width', 640 );
}
add_action( 'after_setup_theme', 'mixedmedia_content_width', 0 );

/**
 * home sidebar setup
 *
 */
function post_theme_activate(){
	
	$active_widgets = get_option( 'sidebars_widgets' );
	$active_widgets['wp_inactive_widgets'] = array();
	
	update_option('sidebars_widgets', $active_widgets);
	
	
	 add_widget_to_sidebar( 'home-column-1-sidebar', 'sticky-posts',
			array (
				'title' 	=> 'This Weekend',
				'title_link' => get_category_link( get_cat_ID( 'Events' ) ),
				'number' => '3',
				'post_types' => 'post',
				'cats' => get_cat_ID( 'Events' ),
				'show_excerpt' => true,
				'show_title' => true,
				'atcat' => false,
				'thumb_w' => 150,
				'thumb_h' => 100,
				'thumb_crop' => 1,
				'excerpt_length' => 10,
				'excerpt_readmore' => __('Read more &rarr;', 'upw'),
				'order' => 'DESC',
				'orderby' => 'date',
				'morebutton_text' => __('View More Posts', 'upw'),
				'morebutton_url' => site_url(),
				'sticky' => 'show',
				'show_cats' => false,
				'show_tags' => false,
				'show_date' => false,
				'show_time' => false,
				'show_author' => false,
				'show_content' => false,
				'show_readmore' => false,
				'show_thumbnail' => true,
				'custom_fields' => '',
				'show_morebutton' => false
			)
		);
}
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function mixedmedia_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'mixedmedia' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar(array(
			'name'          => 'Home Column 1',
			'id'            => 'home-column-1-sidebar',
			'before_widget' => '<section class="widget %1$s %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
	) );

}




add_action( 'widgets_init', 'mixedmedia_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function mixedmedia_scripts() {
	wp_enqueue_style( 'mixedmedia-style', get_stylesheet_uri() );

	wp_enqueue_script( 'mixedmedia-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'mixedmedia-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mixedmedia_scripts' );


/**
 * Custom Meta Boxes.
 */
 
 

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';



/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


 
 
