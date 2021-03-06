<?php
/**
 * Template Name: Contact Page
 * 
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package mixedmedia
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="col-2 site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content-contact', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
