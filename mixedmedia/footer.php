<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mixedmedia
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
    
    <div class="row">
			<div class="col-3">
				<?php if ( is_active_sidebar( 'footer-column-1-sidebar' ) ) { 
					dynamic_sidebar( 'footer-column-1-sidebar' ); 
				} ?>
			</div>
			<div class="col-3">
				<?php if ( is_active_sidebar( 'footer-column-2-sidebar' ) ) { 
					dynamic_sidebar( 'footer-column-2-sidebar' ); 
				} ?>
			</div>
			<div class="col-3 social">
				<?php if ( is_active_sidebar( 'footer-column-3-sidebar' ) ) { 
					dynamic_sidebar( 'footer-column-3-sidebar' ); 
				} ?>
			</div>
		</div>	
        
        
		<div class="site-info">
	
           
			
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<?php
$easyowl_category = get_post_meta( get_the_ID(), '_easyowl_category_slug', true );
$easyowl_post_count = get_post_meta( get_the_ID(), '_easyowl_post_count', true );


 if(!empty($easyowl_category)){ ?>
<script>
jQuery(document).ready(function() {

  jQuery("#header-carousel").owlCarousel({
 
      navigation : false, // Show next and prev buttons
      slideSpeed : 300,
      paginationSpeed : 400,
      singleItem:true,
 
      // "singleItem:true" is a shortcut for:
      items : <?php echo !empty($easyowl_post_count) ? $easyowl_post_count : 5  ?>
      // itemsDesktop : false,
      // itemsDesktopSmall : false,
      // itemsTablet: false,
      // itemsMobile : false
 
  });
  
  jQuery('.link').on('click', function(event){
    var $this = $(this);
    if($this.hasClass('clicked')){
      $this.removeAttr('style').removeClass('clicked');
    } else{
      $this.css('background','#7fc242').addClass('clicked');
    }
  });
 
});

</script>
<?php } ?>



</body>
</html>
