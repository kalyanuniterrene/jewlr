<?php

/*

 *Template Name: Home Page

 */

 get_header();

?>

    <?php

	if (have_posts()) :

		while (have_posts()) :

			the_post();

	?>

    <section class="bannerSection">

    	<div class="leftFullInfo">

        	<div class="container">

            	<?php

                	the_content();

				?>

            </div>

    	</div>	

        <?php

        	$image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()) );

		?>

    	<img src="<?php echo $image;?>" width="100%" alt="<?php echo get_the_ID ();?>">

        <div class="clr"></div>

    </section><!--end of banner Section-->

    <?php

		 endwhile;

	endif;

	?>

    <section class="parallelLink">

    	<div class="parallelTop">

        	<h2>CHECK OUT THE LATEST FROM ULTURAPRO</h2>

            <div class="clr"></div>

        </div><!--end of parallel top-->

        <div class="parallelBottom">

        <?php



  $taxonomy     = 'product_cat';

  $orderby      = 'name';  

  $show_count   = 0;      // 1 for yes, 0 for no

  $pad_counts   = 0;      // 1 for yes, 0 for no

  $hierarchical = 1;      // 1 for yes, 0 for no  

  $title        = '';  

  $empty        = 0;



  $args = array(

         'taxonomy'     => $taxonomy,

         'orderby'      => $orderby,

         'show_count'   => $show_count,

         'pad_counts'   => $pad_counts,

         'hierarchical' => $hierarchical,

         'title_li'     => $title,

         'hide_empty'   => $empty

  );

 $all_categories = get_categories( $args );

 foreach ($all_categories as $cat) {

    if($cat->category_parent == 0) {

        $category_id = $cat->term_id;       

        //echo '<br /><a href="'. get_term_link($cat->slug, 'product_cat') .'">'. $cat->name .'</a>';



        $args2 = array(

                'taxonomy'     => $taxonomy,

                'child_of'     => 0,

                'parent'       => $category_id,

                'orderby'      => $orderby,

                'show_count'   => $show_count,

                'pad_counts'   => $pad_counts,

                'hierarchical' => $hierarchical,

                'title_li'     => $title,

                'hide_empty'   => $empty

        );

        $sub_cats = get_categories( $args2 );

        if($sub_cats) {

            foreach($sub_cats as $sub_category) {?>

            <a href="<?php echo get_term_link($sub_category->slug, 'product_cat') ?>">

                <div class="col-md-3 col-sm-3 col-xs-12 links">

                    <h2><?php echo  $sub_category->name ;?></h2>

                </div>

            </a>



            <?php

                

            }   

        }

    }       

}

?>

        

        	            <div class="clr"></div>

        </div>

    	<div class="clr"></div>

    </section><!--parallel link section-->

    

    <section class="shopSection">

    	<div class="container">

<?php

	$counter = '';	

	query_posts(

		array(

		'post_type'=>'product_banner',

		'post_status'=>'publish',

		'posts_per_page'=>3,

		)

	);

	if ( have_posts() ) {

		while ( have_posts() ) { the_post();

		$counter++;

		$image_ban1 = wp_get_attachment_image_src(get_post_thumbnail_id(),'large');

		$image_ban2 = wp_get_attachment_image_src(get_post_thumbnail_id(),'small');

?><?php if($counter == 1){?>

		<div class="col-md-6 col-sm-6">

            	<div class="leftFull">

                	<div class="leftFullInfo">

                    	<?php echo get_the_content();?>

                    	<!--<h1 class="leftFullh1"><span>Ulturapro</span><br>driver <br>starter kit</h1>-->

                        <a href="<?php echo get_permalink( get_page_by_path( 'shop' ) );?>"><button class="shopBtn">SHOP NOW</button></a>

                    </div>

                	<img src="<?php echo $image_ban1[0]?>" alt="<?php echo $counter;?>">

                </div>

            </div>

            <?php }else{?><!--left -->

                <div class="col-md-6 col-sm-6">

                <?php if($counter == 2){?>

                    <div class="rightTop">

                        <div class="rightTopInfo">

                        <?php echo get_the_content();?>

<!--                            <h1 class="leftFullh1"><span>Ulturapro</span><br>novice kit</h1>

-->                            <a href="<?php echo get_permalink( get_page_by_path( 'shop' ) );?>"><button class="shopBtn">SHOP NOW</button></a>

                        </div>

                        <img src="<?php echo $image_ban2[0]?>" alt="<?php echo $counter;?>">

                    </div><!--right top-->

                    <?php }?>

                    <?php if($counter == 3){?>

                    <div class="rightBottom">

                        <div class="rightTopInfo">

                        <?php echo get_the_content();?>

                            <!--<h1 class="leftFullh1"><span>Ulturapro</span><br>budget kit</h1>-->

                            <a href="<?php echo get_permalink( get_page_by_path( 'shop' ) );?>"><button class="shopBtn">SHOP NOW</button></a>

                        </div>

                        <img src="<?php echo $image_ban2[0]?>" alt="<?php echo $counter;?>">

                    </div><!--right bottom-->

                    <?php }?>

                </div>

            <?php }?>

<?php }?>

            

<?php

} 

 

wp_reset_query();

?>

        	<?php /*?><div class="col-md-6 col-sm-6">

            	<div class="leftFull">

                	<div class="leftFullInfo">

                    	<h1 class="leftFullh1"><span>Ulturapro</span><br>driver <br>starter kit</h1>

                        <button class="shopBtn">SHOP NOW</button>

                    </div>

                	<img src="<?php bloginfo('template_url')?>/img/left_img.png">

                </div>

            </div><!--left -->

                <div class="col-md-6 col-sm-6">

                    <div class="rightTop">

                        <div class="rightTopInfo">

                            <h1 class="leftFullh1"><span>Ulturapro</span><br>novice kit</h1>

                            <button class="shopBtn">SHOP NOW</button>

                    </div>

                	<img src="<?php bloginfo('template_url')?>/img/right_top.png"/>

                </div><!--right top-->

                <div class="rightBottom">

                	<div class="rightTopInfo">

                    	<h1 class="leftFullh1"><span>Ulturapro</span><br>budget kit</h1>

                        <button class="shopBtn">SHOP NOW</button>

                    </div>

                	<img src="<?php bloginfo('template_url')?>/img/right_bottom.png"/>

                </div><!--right bottom-->

            </div><!--right--><?php */?>

            <div class="clr"></div>

        </div><!--end container-->

    </section><!--shop section-->

    <section class="you-tube">
    <div class="container">
    <div class="col-md-12 col-sm-12">
    <div class="col-md-2 col-sm-2">
    <?php
            $page_id = 121;
            $page_data = get_page( $page_id );
            $you_tube = $page_data->post_content;
			//echo apply_filters('the_content' , $page_data->post_content);
			echo do_shortcode('[embedyt]https://www.youtube.com/watch?v=HLY37FLz_0E&width=150&height=100[/embedyt]');
			//echo do_shortcode('[embedyt]https://www.youtube.com/watch?v=HLY37FLz_0E&width=200&height=100[/embedyt]');
           ?>
    
    </div>
    <div class="col-md-4 col-sm-4">
   
<h5>HEAVY ADVENTURE, LIGHT EQUIPMENT</h5>
<p>Our Mountain Ultimate concept is a collection of backpack and clothing design for fast and light mountain adventures.</p>
    
    </div>
    <div class="col-md-2 col-sm-2">
    <?php
            $page_id = 121;
            $page_data = get_page( $page_id );
            $you_tube = $page_data->post_content;
			//echo apply_filters('the_content' , $page_data->post_content);
			echo do_shortcode('[embedyt]https://www.youtube.com/watch?v=3-tU7KKcwmo&width=150&height=100[/embedyt]');
			//echo do_shortcode('[embedyt]https://www.youtube.com/watch?v=HLY37FLz_0E&width=200&height=100[/embedyt]');
           ?>
    
    </div>
    <div class="col-md-4 col-sm-4">
   
<h5>PRINTS OF HUMANS</h5>
<p>Last summer Haglöfs friend Klas Tigerström took a trip to Durmitor national park, Montenegro.</p>
    
    </div>
    </div>
     <div class="clr"></div>
     </div>
    </section>

    <section class="productSection">
<div class="topTitle">

            	<h3>Our products</h3>

            </div><!--top title-->
    	<div class="container">

        	

            <div class="productSlide"> 
                      

                <ul id="product_ul">
                

				<?php

                $args = array( 'post_type' => 'product', 'stock' => 1, 'posts_per_page' => 12, 'orderby' =>'date','order' => 'DESC');

                $loop = new WP_Query( $args );

                while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>

                

                <li class="product_li">
               <?php if( $product->get_tags( ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', $tag_count, 'woocommerce' ) . ' ', '.</span>' ))
								{?>
                <div class="new_sale">
                            	<span>-50%</span>
                            </div>
                            <?php	}?>

                    <div class="feature_slide_content">                                           

                        <div class="test_box_image">

                        	<a href="<?php the_permalink(); ?>"><?php if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog');?></a>

                        </div>

                        <div class="clr"></div>

                        <div class="test_box_text">

                            <a href="<?php the_permalink(); ?>"><h5><?php the_title(); ?></h5></a>
                            <?php echo $product->get_price_html(); ?>                                                                                  

                        </div>

                    </div>

                </li>

                 <?php endwhile; ?>

                <?php wp_reset_query(); ?>

                </ul>                    

                <div class="clr"></div>

            </div><!--product slide-->

        </div><!--container-->

    </section>

    <?php get_footer();?>