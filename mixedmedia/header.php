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
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php endif; ?>
			<p class="site-description"><?php bloginfo( 'description' ); ?></p>
		</div><!-- .site-branding -->
		<div class="nav-wrap">
            <nav id="site-navigation" class="main-navigation" role="navigation">
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'mixedmedia' ); ?></button>
                <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
            </nav><!-- #site-navigation -->
        </div><!-- #nav-wrap -->
	</header><!-- #masthead -->
    <?php 

	$easyowl_category = get_post_meta( get_the_ID(), '_easyowl_category_slug', true );

	if(!empty($easyowl_category)){
	?>
	<div id="header-carousel" class="owl-carousel <?php echo $easyowl_category ?>">
    
	<?php
    
    
    $args = array( 'posts_per_page' => 5, 'category_name' => $easyowl_category );
    
    $slides = get_posts( $args );
    foreach ( $slides as $slide ) : setup_postdata( $slide ); ?>
    	<div class="item"> <div class="easy-owl-slide" style="background-image:url('<?php echo wp_get_attachment_url( get_post_thumbnail_id($slide->ID) ); ?>');" alt="<?php the_title(); ?>"><h1><?php the_title(); ?></h1></div></div>
    <?php endforeach; 
    wp_reset_postdata();?>

    </div>
    <?php } ?>
	<div id="content" class="site-content">
