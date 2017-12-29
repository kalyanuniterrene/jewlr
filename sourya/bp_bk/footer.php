<section class="knowmore_sec">	<div class="container">        <img src="<?php bloginfo('template_url')?>/images/knowmore_btm_img.png" alt="#" class="knowmore_btm_img">    </div></section><footer>
	<div class="container unresponsive_footer">
    	<div class="footer_div1">
        	<!--<ul>
            	<li><a href="#"><img src="<?php bloginfo('template_url')?>/images/footer_menu_arrow.png" alt="#"> ABOUT US</a></li>
                <li><a href="#"><img src="<?php bloginfo('template_url')?>/images/footer_menu_arrow.png" alt="#"> CONTACT US</a></li>
                <li><a href="#"><img src="<?php bloginfo('template_url')?>/images/footer_menu_arrow.png" alt="#"> PRIVACY POLICY</a></li>
                <li><a href="#"><img src="<?php bloginfo('template_url')?>/images/footer_menu_arrow.png" alt="#"> TERMS & CONDITION</a></li>
            </ul>-->
            <?php $defaults = array( 'menu' => 15, 'container' => 'ul', 'container_class' => '', 'container_id' => '', 'menu_class' => 'menu_ul', 'menu_id' => '',
    'echo' => true, 'fallback_cb' => 'wp_page_menu', 'before' => '<img src="'.get_stylesheet_directory_uri().'/images/footer_menu_arrow.png" alt="#">', 'after' => '', 'link_before' => '', 'link_after' => '', 'items_wrap' => '<ul class="new">%3$s</ul>',
    'depth' => 0, 'walker' => '', 'theme_location' => '' );
			wp_nav_menu( $defaults);?>
            <div class="social_div">
            	<div class="social_content">
                    	<a href="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="social_icon"><i class="fa fa-facebook"></i></a>
                    	<a href="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>">Facebook</a>
                </div>
                <div class="social_content">
                    	<a href="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="social_icon"><i class="fa fa-twitter"></i></a>
                    	<a href="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>">Twitter</a>
                </div>
                <div class="social_content">
                    	<a href="<?php echo esc_attr( get_the_author_meta( 'google', $user->ID ) ); ?>" class="social_icon"><i class="fa fa-google-plus"></i></a>
                    	<a href="<?php echo esc_attr( get_the_author_meta( 'google', $user->ID ) ); ?>">Google Plus</a>
                </div>
            </div>
        </div>
        <div class="footer_div2">
        	<img src="<?php bloginfo('template_url')?>/images/footer_logo.png" alt="#" class="footer_logo">
            <p>© 2016 Physic Wear. All Rights Reserved. World Leading Performance Wear.</p>
        </div>
        <div class="footer_div3">
        	<h5>SIGNUP FOR OUR NEWSLETTER</h5>
            <span>
            	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
                    <ul id="sidebar">
                    <?php dynamic_sidebar( 'sidebar-1' ); ?>
                     
                    
                    </ul>
                    <?php endif; ?>
            </span>
        </div>
        <div class="clear"></div>
    </div>
    <div class="container responsive_footer">
	    <div class="footer_div2">
        	<img src="<?php bloginfo('template_url')?>/images/footer_logo.png" alt="#" class="footer_logo">
            
        </div>
    	<div class="footer_div1">
        	<ul>
            	<li><a href="#"><img src="<?php bloginfo('template_url')?>/images/footer_menu_arrow.png" alt="#"> ABOUT US</a></li>
                <li><a href="#"><img src="<?php bloginfo('template_url')?>/images/footer_menu_arrow.png" alt="#"> CONTACT US</a></li>
                <li><a href="#"><img src="<?php bloginfo('template_url')?>/images/footer_menu_arrow.png" alt="#"> PRIVACY POLICY</a></li>
                <li><a href="#"><img src="<?php bloginfo('template_url')?>/images/footer_menu_arrow.png" alt="#"> TERMS & CONDITION</a></li>
            </ul>
            <div class="social_div">
            	<div class="social_content">
                    	<a href="#" class="social_icon"><i class="fa fa-facebook"></i></a>
                    	<a href="#">Facebook</a>
                </div>
                <div class="social_content">
                    	<a href="#" class="social_icon"><i class="fa fa-twitter"></i></a>
                    	<a href="#">Twitter</a>
                </div>
                <div class="social_content">
                    	<a href="#" class="social_icon"><i class="fa fa-google-plus"></i></a>
                    	<a href="#">Google Plus</a>
                </div>
            </div>
        </div>
        <div class="footer_div3">
        	<h5>SIGNUP FOR OUR NEWSLETTER</h5>
            <span>
            	<input type="text" placeholder="Enter your email">
                <a href="#" class="footer_submit"><img src="<?php bloginfo('template_url')?>/images/footer_submit.png" alt="#"></a>
            </span>
            <p><?php echo esc_attr( get_the_author_meta( 'footer-text', $user->ID ) ); ?></p>
        </div>
        <div class="clear"></div>
    </div>
</footer>



<script src="<?php bloginfo('template_url')?>/js/jquery-1.11.0.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url')?>/js/jquery.flexisel.js"></script>
<script type="text/javascript">
//jQuery.noConflict();
$(window).load(function() {
   // $("#flexiselDemo1").flexisel();
    $("#flexiselDemo2").flexisel({
        enableResponsiveBreakpoints: true,
        responsiveBreakpoints: { 
            portrait: { 
                changePoint:481,
                visibleItems: 1
            }, 
            landscape: { 
                changePoint:768,
                visibleItems: 2
            },
            tablet: { 
                changePoint:991,
                visibleItems: 3
            }
        }
    });

});
</script>
