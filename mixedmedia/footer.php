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
			<div class="col-4 footer-col-1">
				<?php if ( is_active_sidebar( 'footer-column-1-sidebar' ) ) { 
					dynamic_sidebar( 'footer-column-1-sidebar' ); 
				} ?>
			</div>
			<div class="col-4 footer-col-2">
				<?php if ( is_active_sidebar( 'footer-column-2-sidebar' ) ) { 
					dynamic_sidebar( 'footer-column-2-sidebar' ); 
				} ?>
			</div>
			<div class="col-4 social footer-col-3">
				<?php if ( is_active_sidebar( 'footer-column-3-sidebar' ) ) { 
					dynamic_sidebar( 'footer-column-3-sidebar' ); 
				} ?>
			</div>
            <div class="col-4 footer-col-4">
				<?php if ( is_active_sidebar( 'footer-column-4-sidebar' ) ) { 
					dynamic_sidebar( 'footer-column-4-sidebar' ); 
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

?>
 
<script>
jQuery(document).ready(function() {

   <?php if(!empty($easyowl_category)){ ?>
    var owl = jQuery("#header-carousel");
    owl.owlCarousel({
        slideSpeed : 800,
        paginationSpeed : 800,
        pagination: true,
        autoPlay: 3000,
        touchDrag: true,
        mouseDrag: true,
        navigation: false,
        navigationText: ['<span>&laquo</span>','<span>&raquo</span>'],
        singleItem: true,
        addClassActive: true,
        stopOnHover: false,
        autoHeight: false,
        lazyLoad: true,
        lazyEffect: 'fade',
        transitionStyle : 'fade',
        scrollPerPage: false, 
    });
   <?php } ?>
    
    var listings = jQuery("#listing-carousel");
    listings.owlCarousel({
        slideSpeed : 1200,
        pagination: false,
        paginationSpeed : 1200,
        autoPlay: true,
        touchDrag: true,
        mouseDrag: false,
        navigation: true,
        navigationText: ['<span>&laquo</span>','<span>&raquo</span>'],
        singleItem:false,
        items: 4,
        addClassActive: true,
        stopOnHover: true,
        transitionStyle : "fade",
        autoHeight: false,
        lazyLoad: true,
        scrollPerPage: true
    });
 
    var slideshow = jQuery('.jetpack-slideshow');
    
    if(slideshow.length > 0) {
        var images = slideshow.data('gallery');
        
        var container = jQuery('<div class="gallery-preview"><ol></ol></div>');
        container.insertAfter(slideshow);
        
        
        for ( var i = 0; i < images.length; i++ ) {
            var imageInfo = images[i];
            var img = document.createElement( 'img' );
            img.src = imageInfo.src;
            img.title = typeof( imageInfo.title ) !== 'undefined' ? imageInfo.title : '';
            img.alt = typeof( imageInfo.alt ) !== 'undefined' ? imageInfo.alt : '';
            img.align = 'middle';
            img.nopin = 'nopin';
                    
            container.children('ol:first').append( jQuery('<li></li>').append( jQuery(img) ) );
            img.removeAttribute('width');
            img.removeAttribute('height');		
        }
        
        var width  = container.children('ol:first').children('li:first').width();
        container.children('ol:first').width((width * images.length) + 'px');

        container.children('ol:first').on('click', function(event) {
            
            var target = jQuery(event.target);
            
            if(target.is('img'))
                target = target.parents('li:first');
            else if (target.is('li'))
                target = target;
            else
                return;
            
            event.preventDefault();
            //var current = slideshow.children('.slideshow-slide:visible');
            //current.css({ opacity: '0', zIndex: images.length, display: 'none' });
            var next = slideshow.children('.slideshow-slide:eq(' + target.index() + ')');
            next.css({ opacity: '1', zIndex: (images.length + 1), display: 'block'  });
            next.focus();
            next.siblings('.slideshow-slide').css({ opacity: '0', zIndex: images.length, display: 'none' });
        });
        
        
    }
    
});

</script>


</body>
</html>
