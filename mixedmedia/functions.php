<?php
/**
 * mixedmedia functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package mixedmedia
 */


ini_set('log_errors', 1); 
ini_set('error_log', dirname(__FILE__) . '/error_log.txt'); 
error_reporting(E_ALL);


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
    
    add_image_size( 'this-weekend', 325, 423, true );
    add_image_size( 'upcoming-events', 262, 150, true );
    add_image_size( 'events-listings', 219, 300, true );
    add_image_size( 'event-side-poster', 287, 406, true );
    add_image_size( 'video-thumbnail', 360, 234, true );
    add_image_size( 'related', 304, 429, true );
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



function easyowl_scripts() {
	wp_enqueue_style( 'easyowl-style', get_template_directory_uri(). '/owl-carousel/owl.carousel.css' );
    wp_enqueue_style( 'easyowl-theme', get_template_directory_uri(). '/owl-carousel/owl.theme.css' );
    wp_enqueue_style( 'easyowl-transitions', get_template_directory_uri(). '/owl-carousel/owl.transitions.css' );
	
	wp_enqueue_script( 'easyowl-script', get_template_directory_uri(). '/owl-carousel/owl.carousel.js', array('jquery'), '20120206', true );
}
add_action( 'wp_enqueue_scripts', 'easyowl_scripts' );	
	

 

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function link_event_to_video_add_meta_box() {

	$screens = array( 'post' );

	foreach ( $screens as $screen ) {

		add_meta_box(
			'link_event_to_video_sectionid',
			__( 'Display Event In Sidebar', '' ),
			'link_event_to_video_meta_box_callback',
			$screen,
            'side',
            'high'
		);
	}
}
add_action( 'add_meta_boxes', 'link_event_to_video_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function link_event_to_video_meta_box_callback( $post ) {

     if( ! in_category( 'blog-videos' ) ) { return ;}
	// Add a nonce field so we can check for it later.
	wp_nonce_field( 'link_event_to_video_save_meta_box_data', 'link_event_to_video_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, '_link_event_to_video_event_id', true );

	echo '<label for="link_event_to_video_event_id">';
	_e( 'Event ID', 'link_event_to_video_textdomain' );
	echo '</label> ';
	echo '<input type="text" id="link_event_to_video_event_id" name="link_event_to_video_event_id" value="' . esc_attr( $value ) . '" size="25" />';

}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function link_event_to_video_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['link_event_to_video_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['link_event_to_video_meta_box_nonce'], 'link_event_to_video_save_meta_box_data' ) ) {
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
	if ( ! isset( $_POST['link_event_to_video_event_id'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['link_event_to_video_event_id'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_link_event_to_video_event_id', $my_data );
		
}
add_action( 'save_post', 'link_event_to_video_save_meta_box_data' );


/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function easyowl_add_meta_box() {

	$screens = array( 'page' );

	foreach ( $screens as $screen ) {

		add_meta_box(
			'easyowl_sectionid',
			__( 'Easy Owl Carousel', '' ),
			'easyowl_meta_box_callback',
			$screen,
            'side',
            'high'
		);
	}
}
add_action( 'add_meta_boxes', 'easyowl_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function easyowl_meta_box_callback( $post ) {

	// Add a nonce field so we can check for it later.
	wp_nonce_field( 'easyowl_save_meta_box_data', 'easyowl_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, '_easyowl_category_slug', true );

	echo '<label for="easyowl_category_slug">';
	_e( 'Category Slug', 'easyowl_textdomain' );
	echo '</label> ';
	echo '<input type="text" id="easyowl_category_slug" name="easyowl_category_slug" value="' . esc_attr( $value ) . '" size="25" />';
	
	$value = get_post_meta( $post->ID, '_easyowl_post_count', true );

	echo '<label for="easyowl_post_count">';
	_e( 'Max number of slides to display', 'easyowl_textdomain' );
	echo '</label> ';
	echo '<input type="text" id="easyowl_post_count" name="easyowl_post_count" value="' . esc_attr( $value ) . '" size="25" />';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function easyowl_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['easyowl_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['easyowl_meta_box_nonce'], 'easyowl_save_meta_box_data' ) ) {
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
	if ( ! isset( $_POST['easyowl_category_slug'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['easyowl_category_slug'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_easyowl_category_slug', $my_data );
	
	if ( ! isset( $_POST['easyowl_post_count'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['easyowl_post_count'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_easyowl_post_count', $my_data );
	
}
add_action( 'save_post', 'easyowl_save_meta_box_data' );



function tribe_custom_widget_featured_image() {
	global $post;

	//echo tribe_event_featured_image( $post->ID, 'thumbnail' );
    $size = 'event-side-poster';
    $post_id = $post->ID;
    
    if ( is_null( $post_id ) ) {
        $post_id = get_the_ID();
    }

     $image_html = '';
    
    if (class_exists('MultiPostThumbnails')) {
        $image_html = MultiPostThumbnails::get_the_post_thumbnail(
            get_post_type(),
            'side-poster-image',
            $post_id, 
            $size
        );
    }

    if(empty($image_html)) {
        $image_html = get_the_post_thumbnail( $post_id, $size );
    }
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

function tribe_custom_widget_single_featured_image() {
	global $post;

	//echo tribe_event_featured_image( $post->ID, 'thumbnail' );
    $size = 'event-side-poster';
    $post_id = $post->ID;
    
    if ( is_null( $post_id ) ) {
        $post_id = get_the_ID();
    }
    
    $image_html = '';
    
    if (class_exists('MultiPostThumbnails')) {
        $image_html = MultiPostThumbnails::get_the_post_thumbnail(
            get_post_type(),
            'side-poster-image',
            $post_id, 
            $size
        );
    }

    if(empty($image_html)) {
        $image_html = get_the_post_thumbnail( $post_id, $size );
    }
    $featured_image = '';

    //if link is not specifically excluded, then include <a>
    if ( ! empty( $image_html ) && $link ) {
        $featured_image .= '<div class="tribe-events-single-event-image"><a href="' . esc_url( tribe_get_event_link() ) . '">' . $image_html . '</a></div>';
    } elseif ( ! empty( $image_html ) ) {
        $featured_image .= '<div class="tribe-events-single-event-image">' . $image_html . '</div><div class="tribe-events-single-event-info">';
    }
    
    echo $featured_image;
    add_filter( 'tribe_event_featured_image', '__return_null' );
}
add_action( 'tribe_events_single_event_after_the_content', 'tribe_custom_widget_single_featured_image', 1 );



function tribe_custom_events_slider() { ?>
    
    <div id="listing-carousel" class="owl-carousel owl-theme listings">

    <?php 
    global $post;
    $external_cta = '';
    $external_url = '';
  
    while ( have_posts() ) : the_post(); 
      
        $external_url = get_permalink( $post->ID );

        ?>
        <div class="item"> 
        	<div class="easy-owl-slide slide-<?php echo $post->ID; ?>" alt="<?php echo get_permalink($post); ?>">
				<a href="<?php echo $external_url; ?>">
                    <h5><?php echo tribe_get_start_date( $post, false, 'd.m.Y' ) ?></h5>
					<div class="lazyOwl owl-lazy" data-src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id(), 'events-listings')[0]; ?>"></div>
				</a>			
             </div>
         </div>
        <?php endwhile; ?>
    </div>
    
    <?php
}
add_action( 'tribe_events_before_template', 'tribe_custom_events_slider' );

function tribe_custom_single_events_featured_image($featured_image ) {
     if( is_single() ){
         return null;
     }
}

add_filter( 'tribe_event_featured_image', 'tribe_custom_single_events_featured_image' );


//add_filter( 'jetpack_photon_skip_image', '__return_true' );

add_filter( 'jetpack_photon_skip_for_url', '__return_true' );


function video_panel_shortcode( $atts, $content = null ) {
    $defaults = shortcode_atts( array(
        'videos' => array()
    ), $atts );
	?>
    <div class="video-panel">
		<?php do_shortcode($content) ?>		
	</div>
	<?php
}
add_shortcode( 'videopanel', 'video_panel_shortcode' );

function video_panel_item_shortcode( $atts, $content = null ) {
    $defaults = shortcode_atts( array(
        'id' => '',
		'caption' => '',
		'title' => '',
		'date' => '',		
        'target' => '_self'
    ), $atts );
    
    $image = '';
        
    if(is_numeric($defaults['id'])) {
        $defaults['uri'] = get_permalink($defaults['id']);
        $image = get_the_post_thumbnail($defaults['id'], 'video-thumbnail');
      
    } else {
        $defaults['uri'] = 'https://www.youtube.com/watch?v=' . $defaults['id'];
        $image = '<img src="http://img.youtube.com/vi/' . $defaults['id'] .'/hqdefault.jpg" />';
    }
        
	?>
    <div class="video-panel-item">
		<div class="video-panel-item-video"> 
			<a href="<?php echo $defaults['uri'];?>" target="<?php echo $defaults['target'];?>"><?php echo $image; ?></a>
		</div>
		<div class="video-panel-item-caption"> 
			<a href="<?php echo $defaults['uri'];?>" target="<?php echo $defaults['target'];?>"><h5><?php echo $defaults['caption']; ?></h5></a>
		</div>
		<div class="video-panel-item-title"> 
			<a href="<?php echo $defaults['uri'];?>" target="<?php echo $defaults['target'];?>"><h3><?php echo $defaults['title']; ?></h3></a>
		</div>
		<div class="video-panel-item-date"> 
			<a href="<?php echo $defaults['uri'];?>" target="<?php echo $defaults['target'];?>"><h5><?php echo $defaults['date']; ?></h5></a>
		</div>
	</div>
	<?php
}
add_shortcode( 'videopanelitem', 'video_panel_item_shortcode' );


if (class_exists('MultiPostThumbnails')) {
    new MultiPostThumbnails(
        array(
            'label' => 'Side Poster Image',
            'id' => 'side-poster-image',
            'post_type' => 'tribe_events'
        )
    );
}

function disable_related_my_post_types($allowed_post_types) {
    unset($allowed_post_types['tribe_events']);
    return $allowed_post_types;
}

add_filter( 'rest_api_allowed_post_types', 'disable_related_my_post_types' );

function custom_jetpackchange_image_size ( $thumbnail_size ) {
	$thumbnail_size['width'] = 300;
	$thumbnail_size['height'] = 150;
//	$thumbnail_size['crop'] = true;
	return $thumbnail_size;
}
add_filter( 'jetpack_relatedposts_filter_thumbnail_size', 'custom_jetpackchange_image_size' );

function jetpackme_no_related_posts( $options ) {
    if ( get_post_type() == 'tribe_events' ) {
        $options['enabled'] = false;
    }
    return $options;
}
add_filter( 'jetpack_relatedposts_filter_options', 'jetpackme_no_related_posts' );

function customize_upw_orderby_for_tribe_events( $args ) {
    
    //file_put_contents(dirname(__FILE__) . '/test.txt', print_r($args, true) . '\n', FILE_APPEND | LOCK_EX);
    
    if($args['orderby'] == 'meta_value' && $args['meta_key'] == 'event_date') {
        unset($args['meta_key']);
        $args['orderby']  = 'event_date';        
    }
    
    //file_put_contents(dirname(__FILE__) . '/test.txt', print_r($args, true) . '\n', FILE_APPEND | LOCK_EX);
    
    return $args;
}
add_filter( 'upw_wp_query_args', 'customize_upw_orderby_for_tribe_events' );


//if ( $query->tribe_is_event_query
//pre_get_posts

function exclude_category( $query ) {
    //print_r($query->query_vars);
    if ( $query->query_vars['orderby'] == 'event_date' && $query->query_vars['posts_per_page'] == 3 ) {
        $year = date("Y"); 
        $weekNumber = date("W");    
        $start_date = date('Y-m-d H:i:s', strtotime('+4 days', strtotime($year.'W'.$weekNumber)));
        
        $end_date = date('Y-m-d H:i:s', strtotime($year.'W'.(intval($weekNumber + 1))));
       
        $query->set( 'start_date', $start_date );
        $query->set( 'end_date', $end_date );
    }
}
add_action( 'pre_get_posts', 'exclude_category', 99 );


function customize_post_gallery($output, $attr) {
    // Initialize
	global $post, $wp_locale;
 

	return $output . '<div>test</div>';
}


function display_event_on_frontpage_add_meta_box() {

	$screens = array( 'tribe_events' );

	foreach ( $screens as $screen ) {

		add_meta_box(
			'display_event_on_frontpage_sectionid',
			__( 'Display Event In Frontpage Slider', '' ),
			'display_event_on_frontpage_meta_box_callback',
			$screen,
            'side',
            'high'
		);
	}
}
add_action( 'add_meta_boxes', 'display_event_on_frontpage_add_meta_box' );

function display_event_on_frontpage_meta_box_callback( $post ) {
	wp_nonce_field( 'display_event_on_frontpage_save_meta_box_data', 'display_event_on_frontpage_meta_box_nonce' );

	$value = get_post_meta( $post->ID, '_display_event_on_frontpage_event_id', true );

	?>
    <label for="display_event_on_frontpage_event_id">
        <?php _e( 'Display', 'display_event_on_frontpage_textdomain' ); ?>
	
	<input type="checkbox" 
        id="display_event_on_frontpage_event_id" 
        name="display_event_on_frontpage_event_id" 
        value="yes" 
        <?php if ($value == 'yes' ) { ?> checked <?php } ?>
        />
    </label>
    <?php
}

function display_event_on_frontpage_save_meta_box_data( $post_id ) {
	if ( ! isset( $_POST['display_event_on_frontpage_meta_box_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['display_event_on_frontpage_meta_box_nonce'], 'display_event_on_frontpage_save_meta_box_data' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}


	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}
	} else {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	if( isset( $_POST[ 'display_event_on_frontpage_event_id' ] ) ) {
        update_post_meta( $post_id, '_display_event_on_frontpage_event_id', 'yes' );
    } else {
        update_post_meta( $post_id, '_display_event_on_frontpage_event_id', '' );
    }
		
}
add_action( 'save_post', 'display_event_on_frontpage_save_meta_box_data' );