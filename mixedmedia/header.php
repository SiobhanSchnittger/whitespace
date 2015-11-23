<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mixedmedia
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link href='https://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Lato:400,300italic,300,400italic,700' rel='stylesheet' type='text/css'>
<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'mixedmedia' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<?php if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><p class="site-title"><?php bloginfo( 'name' ); ?> </p></a>
			<?php endif; ?>
			<p class="site-description"><?php bloginfo( 'description' ); ?></p>
		</div><!-- .site-branding -->
		<div class="nav-wrap">
            <nav id="site-navigation" class="main-navigation" role="navigation">
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( ' ', 'mixedmedia' ); ?><img src="<?php echo get_template_directory_uri() . '/images/toggle.png' ?>" alt="..." /></button>
                <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
            </nav><!-- #site-navigation -->
        </div><!-- #nav-wrap -->
	</header><!-- #masthead -->
    <?php 
    if ( is_front_page() ) {	
    
            //posts_per_page    
            ?>
            <div id="header-carousel" class="owl-carousel">
            <?php
            $external_cta = 'Buy Tickets';
            $events = tribe_get_events(array( 
                'posts_per_page' => 4, 
                'meta_key'   => '_display_event_on_frontpage_event_id',
                'meta_value' => 'yes'
            ));
            foreach ( $events as $slide ) : setup_postdata( $slide ); 
                $external_url = tribe_get_event_website_url( $slide->ID);
                $external_url = !empty($external_url) ? $external_url : get_permalink( $slide->ID );
                ?>
            
                <div class="item"> 
                    <div class="easy-owl-slide slide-<?php echo $slide->ID; ?>">
                        <a href="<?php echo $external_url; ?>">
                            <div class="lazyOwl owl-lazy" data-src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($slide->ID) ); ?>"></div>
                        </a>
                        <div class="slide-meta">                         
                            <?php if(!empty($external_cta)) { ?>
                                <a href="<?php echo $external_url; ?>" class="button slide-cta" target="_blank"><?php echo $external_cta; ?></a>
                            <?php }
                            ?>
                        </div>
                     </div>
                </div>
            <?php
            endforeach;            
            ?>
            </div>
            <?php
    }
    else {
        $easyowl_category = get_post_meta( get_the_ID(), '_easyowl_category_slug', true );
        $easyowl_post_count = get_post_meta( get_the_ID(), '_easyowl_post_count', true );
        if(empty($easyowl_post_count)) {
            $easyowl_post_count = 4;
        }
        if(!empty($easyowl_category)){	?>
        <div id="header-carousel" class="owl-carousel <?php echo $easyowl_category ?>">
     
        <?php    
        $args = array( 'posts_per_page' => $easyowl_post_count, 'category_name' => $easyowl_category );
        
        $slides = get_posts( $args );
        foreach ( $slides as $slide ) : setup_postdata( $slide ); 
            $external_url = get_post_meta( $slide->ID, '_external_link', true );
            $external_url = !empty($external_url) ? $external_url : get_permalink( $slide->ID );
            $external_cta = get_post_meta( $slide->ID, '_external_cta', true );
        ?>
            <div class="item"> 
                <div class="easy-owl-slide slide-<?php echo $slide->ID; ?>">
                    <a href="<?php echo $external_url; ?>">
                        <div class="lazyOwl owl-lazy" data-src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($slide->ID) ); ?>"></div>
                    </a>
                    <div class="slide-meta">
                        <h1><a href="<?php echo $external_url; ?>"><?php echo $slide->post_title; ?></a></h1>
                        <?php
                        $excerpt = get_the_excerpt();
                        $excerpt = trim(str_replace('[...]', '', $excerpt));
                        $excerpt = substr($excerpt, 0, 140);
                        $parts = explode(' ', $excerpt);					
                        $excerpt = implode(' ', array_slice($parts, 0, (count($parts) - 1)));
                        ?>
                        <h2 class="excerpt"><a href="<?php echo $external_url; ?>"><?php echo $excerpt; ?> [...]</a></h2>	
                         <?php 
                        if(!empty($external_cta)) { ?>
                            <a href="<?php echo $external_url; ?>" class="button slide-cta" target="_blank"><?php echo $external_cta; ?></a>
                        <?php }
                        ?>
                    </div>
                 </div>
             </div>
        <?php endforeach; ?>    
        </div>
        <?php } ?>
    <?php 
    }
    $post_type = get_queried_object();
    ?>
    <?php 
    if ( in_category( 'events' ) || in_category( 'blog-videos' ) || in_category('from-the-blog') || is_page_template( 'banner-template.php' )){        
        if ( has_post_thumbnail() ) { 
             $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
            ?><div class="banner-image" style="background-image: url('<?php echo $featured_image[0]; ?>');"></div><?php
        } 
    } else  if ( $post_type->post_type == 'tribe_events' && is_single() == 1) {      
        $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id($post_type->ID), 'full');
        if ( isset($featured_image) ) { 
             ?><div class="banner-image" style="background-image: url('<?php echo $featured_image[0]; ?>');"></div><?php
        } 
    }
    ?>
	<div id="content" class="site-content">
