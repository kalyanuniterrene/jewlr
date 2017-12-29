<?php
/*
*Template Name: Home page
*/

?>
<?php get_header();?>
<?php
 if (have_posts()) :
  while (have_posts()) :
   the_post();
 ?>
<section class="banner_sec">
<?php
         $image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()) );
  ?>
     <img src="<?php echo $image;?>" width="100%" alt="<?php echo get_the_ID ();?>">
	
  <div class="container">
        <div class="banner_div">
           
                      <?php the_content(); ?>
           
            <a href="http://onlinedevserver.biz/dev/bp/product-category/women_gear/" class="view_btn">VIEW PRODUCTS <img src="<?php bloginfo('template_url')?>/images/btn_aorow.png" alt="#"></a>
        </div>
	</div>
     <?php
   endwhile;
 endif;
 ?>        
    <div class="clear"></div>
    <img src="<?php bloginfo('template_url')?>/images/gear_img1.png" alt="#" class="gear_img1">
</section>
<section class="gear_sec">
	<div class="gear_sec_top">
    	<div class="container">
<?php $thumbnail_id = get_woocommerce_term_meta( 11, 'thumbnail_id', true );
$image = wp_get_attachment_url( $thumbnail_id );?>
        	<img src="<?php echo $image?>" class="gear_img2" alt="#">
            <div class="gear_sec_top_div">
           	  <h2><?php echo get_cat_name(11);?></h2>
            <?php echo category_description( 11 ); ?> 
                <a href="<?php echo get_category_link(11); ?> " class="view_btn">SHOP NOW <img src="<?php bloginfo('template_url')?>/images/btn_aorow.png" alt="#"></a>
            </div>
		</div>           
    </div>
    <div class="gear_sec_bottom">
    	<div class="container">
        <?php $thumbnail_id = get_woocommerce_term_meta( 12, 'thumbnail_id', true );
$image_women = wp_get_attachment_url( $thumbnail_id );?>
        	<img src="<?php echo $image_women;?>" class="gear_img2" alt="#">
            <div class="gear_sec_bottom_div">
                <h2><?php echo get_cat_name(12);?></h2>
                <?php echo category_description( 12 ); ?> 
                <a href="<?php echo get_category_link(12); ?>" class="view_btn">SHOP NOW <img src="<?php bloginfo('template_url')?>/images/btn_aorow.png" alt="#"></a>
            </div>
		</div>            
    </div>
    <div class="gear_sec_bottom athletic_programming">
    	<div class="container">
        <?php $thumbnail_id = get_woocommerce_term_meta( 13, 'thumbnail_id', true );
$image_ath = wp_get_attachment_url( $thumbnail_id );?>
        	<img src="<?php echo $image_ath;?>" class="gear_img2" alt="#">
            <div class="athletic_programming_section">
                <h2><?php echo get_cat_name(13);?></h2>
                <?php echo category_description(13); ?> 
                <a href="<?php echo get_category_link(13); ?>" class="view_btn">SHOP NOW <img src="<?php bloginfo('template_url')?>/images/btn_aorow.png" alt="#"></a>
            </div>
		</div>            
    </div>
</section>

<section class="feature_sec">
	<div class="container">
    	<h3>FEATURED PRODUCTS</h3>
        <h6>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse est</h6>
      <div class="feature_slide_div">
        	<div class="t_slider clearfix">
        		<ul id="flexiselDemo2">

                   <?php
     $args = array( 'post_type' => 'product', 'meta_key' => '_featured','posts_per_page' => 15,'columns' => '3', 'meta_value' => 'yes','product_tag' => '');
     $loop = new WP_Query( $args );
	 
	
     while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
                  
                        <li>    
             <?php woocommerce_show_product_sale_flash( $post, $product ); ?>
             <div class="feature_slide_content">
                         <?php  $tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );    ?>  
                         <?php print_r($loop->product_tag);
                                if( $product->get_tags( ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', $tag_count, 'woocommerce' ) . ' ', '.</span>' ))
								{?>
								
                        	<div class="new_item">
                            	<span>NEW</span>
                            </div>
									
							<?php	}?>
                                <div class="test_box_image">
                                
                                <?php if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); 
								else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="300px" height="300px" />'; ?></a>
                               
                                </div>
                                <div class="test_box_text">
                            	<h5 style="    color: #d71a1a;
    text-align: center;
    line-height: 24px;
    width: 90%;
    margin: 0 auto;
    margin-top: 16px;"><a href="<?php echo get_permalink( $loop->post->ID ) ?>"><?php the_title()."<br/>"; ?></a></h5>
                                <h4 style="margin-top:10px;"><?php echo $product->get_price_html(); ?></h4>
                               
                                <a style="margin-top: 10px;"href="<?php echo get_permalink( $loop->post->ID ) ?>" class="view_btn">
                                <img src="<?php bloginfo('template_url')?>/images/cart_icon2.png" alt="#"> SHOP NOW</a>
							</div>
                             
                        </li>
                <?php
            /**
             * woocommerce_pagination hook
             *
             * @hooked woocommerce_pagination - 10
             * @hooked woocommerce_catalog_ordering - 20
             */
            do_action( 'woocommerce_pagination' );
        ?>
<?php endwhile; ?>
<?php wp_reset_query(); ?>
           			
                </ul>
     </div>
        </div>
    </div>
    
</section>
<?php /*?><section class="knowmore_sec">
<?php
            $page_id = 84;
            $page_data = get_page( $page_id );
            $new_ways = $page_data->post_content;
            $url = wp_get_attachment_url( get_post_thumbnail_id(84) );
               ?>
	<div class="container">
	    <img src="<?php bloginfo('template_url')?>/images/feature_btm_img.png" alt="#" class="feature_btm_img">
    	<?php echo $new_ways; ?>
        <a href="#" class="view_btn">KNOW MORE</a>
        <img src="<?php bloginfo('template_url')?>/images/knowmore_btm_img.png" alt="#" class="knowmore_btm_img">
    </div>
</section><?php */?>
<?php get_footer();?>