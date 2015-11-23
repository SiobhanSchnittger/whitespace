<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package mixedmedia
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php mixedmedia_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->
    <?php $video_event_id = get_post_meta( get_the_ID(), '_link_event_to_video_event_id', true );
    if( in_category( 'blog-videos' ) && !empty($video_event_id) )  { ?>
        <div class="row">
            <div class="entry-content content-med">        
                <?php the_content(); ?>        
                <?php
                    wp_link_pages( array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'mixedmedia' ),
                        'after'  => '</div>',
                    ) );
                ?>
            </div><!-- .entry-content -->
            <div class="entry-content-event-sidebar">
                <h2><?php echo tribe_get_start_date( $post, false, 'l j F' ) ?></h2>
                <?php echo get_the_post_thumbnail( $video_event_id, 'this-weekend' ); ?>
                <?php /*
                <p class="tribe-events-list-event-title entry-title summary">
                    <a class="url" href="<?php echo esc_url( tribe_get_event_link($video_event_id) ); ?>" title="<?php the_title_attribute('', '', true, $video_event_id) ?>" rel="bookmark">
                        <?php echo get_the_title($video_event_id) ?>
                    </a>
                </p>
                */ ?>
                <p>
                    <a href="<?php echo tribe_get_event_website_url( $video_event_id ); ?>" class="button btn-med">BUY TICKETS</a>
                    <a href="<?php echo esc_url( tribe_get_event_link($video_event_id) ); ?>" class="button btn-med">MORE INFO</a>
                </p>
            </div>
        </div>
        <?php
    }
    else { ?>
    
	<div class="entry-content">        
            <?php the_content(); ?>        
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'mixedmedia' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
    
    <?php
    } ?>
	<footer class="entry-footer">
		<?php mixedmedia_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

