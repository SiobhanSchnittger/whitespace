<?php
/**
 * The homepage template file.
 *
 *This is a stand alone page used to appear when someone visits the site. 
 *i.e. The landing page of the site. 
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package mixedmedia
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text">Hello!</h1>
				</header>
			<?php endif; ?>

			


		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>
        

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
