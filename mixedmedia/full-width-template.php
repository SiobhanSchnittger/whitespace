<?php
/**
 * Template Name: Full-width Page
 * 
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package mixedmedia
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="full-width site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>

			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
