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
		<div class="site-info">
			<a href=" ">Mixedmedia &copy; 2015</a>
			<span class="sep"> | </span>
            30 Fortunes Walk, Citywest, Co. Dublin. 
            <span class="sep"> | </span>
            +353 85 1566645
            <span class="sep"> | </span>
            <a href="mailto:hello@mixedmedia.ie">hello@mixedmedia.ie</a>
			
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
