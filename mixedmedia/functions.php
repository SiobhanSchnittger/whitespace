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
	
	
	 add_widget_to_sidebar( 'upcoming-events-sidebar', 'sticky-posts',
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
				'excerpt_readmore' => __('More Info &rarr;', 'upw'),
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
		
		add_widget_to_sidebar( 'blog-posts-sidebar', 'sticky-posts',
			array (
				'title' 	=> 'From the Blog',
				'title_link' => get_category_link( get_cat_ID( 'Blog' ) ),
				'number' => '6',
				'post_types' => 'post',
				'cats' => get_cat_ID( 'Blog' ),
				'show_excerpt' => true,
				'show_title' => true,
				'atcat' => false,
				'thumb_w' => 150,
				'thumb_h' => 100,
				'thumb_crop' => 1,
				'excerpt_length' => 10,
				'excerpt_readmore' => __('More Info &rarr;', 'upw'),
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
		
		$locations = get_theme_mod('nav_menu_locations');
	
		$location = 'left-footer';
		$menu_id = null;
		if (isset($locations[$location])) {
			$menu_id = $locations[$location];
		}
		if(!empty($menu_id)){
			add_widget_to_sidebar( 'footer-column-1-sidebar', 'nav_menu',
				array (
					'nav_menu' 	=> $menu_id
				)
			);
		}
		
		$location = 'middle-footer';
		$menu_id = null;
		if (isset($locations[$location])) {
			$menu_id = $locations[$location];
		}
		if(!empty($menu_id)){
			add_widget_to_sidebar( 'footer-column-2-sidebar', 'nav_menu',
				array (
					'nav_menu' 	=> $menu_id
				)
			);
		}
		
		$location = 'right-footer';
		$menu_id = null;
		if (isset($locations[$location])) {
			$menu_id = $locations[$location];
		}
		if(!empty($menu_id)){
			add_widget_to_sidebar( 'footer-column-3-sidebar', 'nav_menu',
				array (
					'nav_menu' 	=> $menu_id
				)
			);
		}
		
		$location = 'right-footer2';
		$menu_id = null;
		if (isset($locations[$location])) {
			$menu_id = $locations[$location];
		}
		if(!empty($menu_id)){
			add_widget_to_sidebar( 'footer-column-4-sidebar', 'nav_menu',
				array (
					'nav_menu' 	=> $menu_id
				)
			);
		}
		
		register_nav_menus(array(
			'primary' => __('Primary Navigation'),
			'left-footer' => __('Left Footer Navigation Menu'),
			'middle-footer' => __('Middle Footer Navigation Menu'),
			'right-footer' => __('Right Footer Navigation Menu'),
			'right-footer2' => __('Right Footer2 Navigation Menu'),
		));
	
		add_menu_to_location('Left Footer Navigation Menu', 'left-footer');
		add_menu_to_location('Middle Footer Navigation Menu', 'middle-footer');
		add_menu_to_location('Right Footer Navigation Menu', 'right-footer');
		add_menu_to_location('Right Footer Navigation Menu', 'right-footer2');

		
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
			'name'          => 'Upcoming Events',
			'id'            => 'upcoming-events-sidebar',
			'before_widget' => '<section class="widget %1$s %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h1>',
			'after_title'   => '</h1>',
	) );
	
	register_sidebar(array(
			'name'          => 'From the Blog',
			'id'            => 'blog-posts-sidebar',
			'before_widget' => '<section class="widget %1$s %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h1>',
			'after_title'   => '</h1>',
	) );
	
	register_sidebar(array(
		'name'          => 'Footer Column 1',
		'id'            => 'footer-column-1-sidebar',
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	));
	
	register_sidebar(array(
		'name'          => 'Footer Column 2',
		'id'            => 'footer-column-2-sidebar',
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	));
	
	register_sidebar(array(
		'name'          => 'Footer Column 3',
		'id'            => 'footer-column-3-sidebar',
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	));
	
	register_sidebar(array(
		'name'          => 'Footer Column 4',
		'id'            => 'footer-column-4-sidebar',
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	));

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


/**
 * Add Neta Box for Event Date
 */
 
 
 
function event_date_add_meta_box() {

	$screens = array( 'post' );

	foreach ( $screens as $screen ) {

		add_meta_box(
			'event_date_sectionid',
			__( 'Event Date', '' ),
			'event_date_meta_box_callback',
			$screen
		);
	}
}
add_action( 'add_meta_boxes', 'event_date_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function event_date_meta_box_callback( $post ) {

	// Add a nonce field so we can check for it later.
	wp_nonce_field( 'event_date_save_meta_box_data', 'event_date_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, '_event_date', true );

	echo '<label for="event_date">';
	_e( 'Event Date', 'event_date_textdomain' );
	echo '</label> ';
	echo '<input type="date" id="event_date" name="event_date" value="' . esc_attr( $value ) . '" size="25" />';

}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function event_date_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['event_date_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['event_date_meta_box_nonce'], 'event_date_save_meta_box_data' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */
	
	// Make sure that it is set.
	if ( ! isset( $_POST['event_date'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['event_date'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_event_date', $my_data );
	
	
}
add_action( 'save_post', 'event_date_save_meta_box_data' );

 
/**
 * Add Meta Box for External Link
 */
 
 
 
function external_link_add_meta_box() {

	$screens = array( 'post' );

	foreach ( $screens as $screen ) {

		add_meta_box(
			'external_link_sectionid',
			__( 'External Link', '' ),
			'external_link_meta_box_callback',
			$screen,
			'side',
			'high'
		);
	}
}
add_action( 'add_meta_boxes', 'external_link_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function external_link_meta_box_callback( $post ) {

	// Add a nonce field so we can check for it later.
	wp_nonce_field( 'external_link_save_meta_box_data', 'external_link_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, '_external_link', true );

	echo '<label for="external_link">';
	_e( 'External Link', 'external_link_textdomain' );
	echo '</label> ';
	echo '<input type="text" id="external_link" name="external_link" value="' . esc_attr( $value ) . '" size="25" />';
    
    $value = get_post_meta( $post->ID, '_external_cta', true );

    echo '<br />';
	echo '<label for="external_cta">';
	_e( 'Call To Action', 'external_cta_textdomain' );
	echo '</label> ';
	echo '<input type="text" id="external_cta" name="external_cta" value="' . esc_attr( $value ) . '" size="25" />';

}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function external_link_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['external_link_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['external_link_meta_box_nonce'], 'external_link_save_meta_box_data' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */
	
	// Make sure that it is set.
	if ( ! isset( $_POST['external_link'] ) ) {
		return;
	}

	// Sanitize user input.
	$external_link = sanitize_text_field( $_POST['external_link'] );
    $external_cta = sanitize_text_field( $_POST['external_cta'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_external_link', $external_link );
    update_post_meta( $post_id, '_external_cta', $external_cta );
	
	
}
add_action( 'save_post', 'external_link_save_meta_box_data' );


function tribe_custom_widget_featured_image() {
	global $post;

	//echo tribe_event_featured_image( $post->ID, 'thumbnail' );
    $post_id = $post->ID;
    
    if ( is_null( $post_id ) ) {
        $post_id = get_the_ID();
    }

    $image_html     = get_the_post_thumbnail( $post_id, $size );
    $featured_image = '';

    //if link is not specifically excluded, then include <a>
    if ( ! empty( $image_html ) && $link ) {
        $featured_image .= '<div class="tribe-events-event-image"><a href="' . esc_url( tribe_get_event_link() ) . '">' . $image_html . '</a></div>';
    } elseif ( ! empty( $image_html ) ) {
        $featured_image .= '<div class="tribe-events-event-image">' . $image_html . '</div><div class="tribe-events-event-info">';
    }
    
    echo $featured_image;
    add_filter( 'tribe_event_featured_image', '__return_null' );
}
add_action( 'tribe_events_before_the_event_title', 'tribe_custom_widget_featured_image' );

function tribe_custom_widget_closing_div() {
    echo "</div>";
}
add_action( 'tribe_events_after_the_content', 'tribe_custom_widget_closing_div' );
