<?php
/**
 * Standard ultimate posts widget template
 *
 * @version     2.0.0
 */
?>

<?php if ($instance['before_posts']) : ?>
  <div class="upw-before">
    <?php echo wpautop($instance['before_posts']); ?>
  </div>
<?php endif; ?>

<div class="upw-posts hfeed blog-wrap">

  <?php if ($upw_query->have_posts()) : 
  	$counter = 0;
  ?>
	<div class="row">
      <?php while ($upw_query->have_posts()) : $upw_query->the_post(); ?>

        <?php $current_post = ($post->ID == $current_post_id && is_single()) ? 'active' : ''; 
		$col_class = 'col-4';
		$thumb_size = 'thumbnail';
		if($upw_query->post_count > 5) {
			if($counter < 2) {
				$col_class = 'col-2';
				$thumb_size = 'medium';
			} else if($counter == 2) { ?>
				</div>
				<div class="row">
			<?php }
		}
		
		
		?>
        
		<div class="<?php echo $col_class; ?>">
        <article <?php post_class($current_post); ?>>
		<div>
          <header>
          
          
		  	<?php if (get_the_title() && $instance['show_title']) : ?>
              <h4 class="entry-title">
                <a href="<?php the_permalink(); ?>" rel="bookmark">
                  <?php the_title(); ?>
                </a>
              </h4>
            <?php endif; ?>
            
            
            <?php if ($instance['show_date'] || $instance['show_author'] || $instance['show_comments']) : ?>

              <div class="entry-meta">

                <?php if ($instance['show_date']) : ?>
                  <time class="published" datetime="<?php echo get_the_time('c'); ?>"><?php echo get_the_time($instance['date_format']); ?></time>
                <?php endif; ?>

                <?php if ($instance['show_date'] && $instance['show_author']) : ?>
                  <span class="sep"><?php _e('|', 'upw'); ?></span>
                <?php endif; ?>

                <?php if ($instance['show_author']) : ?>
                  <span class="author vcard">
                    <?php echo __('By', 'upw'); ?>
                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn">
                      <?php echo get_the_author(); ?>
                    </a>
                  </span>
                <?php endif; ?>

                <?php if ($instance['show_author'] && $instance['show_comments']) : ?>
                  <span class="sep"><?php _e('|', 'upw'); ?></span>
                <?php endif; ?>

                <?php if ($instance['show_comments']) : ?>
                  <a class="comments" href="<?php comments_link(); ?>">
                    <?php comments_number(__('No comments', 'upw'), __('One comment', 'upw'), __('% comments', 'upw')); ?>
                  </a>
                <?php endif; ?>

              </div>

            <?php endif; ?>
            
            
            
            <?php if (current_theme_supports('post-thumbnails') && $instance['show_thumbnail'] && has_post_thumbnail()) : ?>
              <div class="entry-image">
                <a href="<?php the_permalink(); ?>" rel="bookmark">
                  <?php the_post_thumbnail($thumb_size); ?>
                </a>
              </div>
            <?php endif; ?>

            

          </header>

          <?php if ($instance['show_excerpt']) : ?>
            <div class="entry-summary">
              <p>
                <?php echo get_the_excerpt(); ?>
                <?php if ($instance['show_readmore']) : ?>
                  <a href="<?php the_permalink(); ?>" class="more-link"><?php echo $instance['excerpt_readmore']; ?></a>
                <?php endif; ?>
              </p>
            </div>
          <?php elseif ($instance['show_content']) : ?>
            <div class="entry-content">
              <?php the_content() ?>
            </div>
          <?php endif; ?>

          <footer>

            <?php
            $categories = get_the_term_list($post->ID, 'category', '', ', ');
            if ($instance['show_cats'] && $categories) :
            ?>
              <div class="entry-categories">
                <strong class="entry-cats-label"><?php _e('Posted in', 'upw'); ?>:</strong>
                <span class="entry-cats-list"><?php echo $categories; ?></span>
              </div>
            <?php endif; ?>

            <?php
            $tags = get_the_term_list($post->ID, 'post_tag', '', ', ');
            if ($instance['show_tags'] && $tags) :
            ?>
              <div class="entry-tags">
                <strong class="entry-tags-label"><?php _e('Tagged', 'upw'); ?>:</strong>
                <span class="entry-tags-list"><?php echo $tags; ?></span>
              </div>
            <?php endif; ?>

          </footer>
		</div>
        </article>
		</div>
      <?php 
	  $counter = $counter + 1;
	  endwhile; ?>
	</div>
  <?php else : ?>

    <p class="upw-not-found">
      <?php _e('No posts found.', 'upw'); ?>
    </p>

  <?php endif; ?>

</div>

<?php if ($instance['after_posts']) : ?>
  <div class="upw-after">
    <?php echo wpautop($instance['after_posts']); ?>
  </div>
<?php endif; ?>