<?php

/*

*Template Name: Home page

*/



?>

<?php get_header("custom2");;?>



<section id="featured">

  <div class="container">

    <h2>Featured Female Models</h2>

    <div class="row">

       <div class="text-after"><img src="<?php bloginfo('template_url')?>/images/text_after.png" alt="#"></div>

    </div>

     <div class="row clearfix">

          

          <ul id="flexiselDemo1"> 

  <?php



global $post;



$args = array(

	'posts_per_page'   => 5,

	'offset'           => 0,

	'category'         => '',

	'category_name'    => 'Female',

	'orderby'          => 'date',

	'order'            => 'DESC',

	'include'          => '',

	'exclude'          => '',

	'meta_key'         => '',

	'meta_value'       => '',

	'post_type'        => 'post',

	'post_mime_type'   => '',

	'post_parent'      => '',

	'author'	   => '',

	'author_name'	   => '',

	'post_status'      => 'publish',

	'suppress_filters' => true 

);



$posts_array = get_posts( $args );



//print_r($posts_array);

foreach($posts_array as $post_data)

{

	

	$images = get_post_meta( $post_data->ID,'upload_your_image' );

	 

	 $address = get_post_meta( $post_data->ID, 'address_of_model' );

	

	 

	 $main_address = $address[0]['street_address'].','.$address[0]['street_address2'].','.$address[0]['city_name'].','.$address[0]['state'];



$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post_data->ID) );

$post_name = $post_data->post_name;

?>



     

                     <li>

                       <div class="featured_mail_box">

                           <div class="normal_image_box">

                              <a href="<?php echo $post_data->guid ?>"> <img src="<?php echo $feat_image;?>" alt="#"></a>

                               <div class="female_name"><h3><?php print_r($post_data->post_title) ?></h3></div>

                               <div class="female-info">

                                 <div class="info-parent">

                                     <div class="sub-parent">

                                        <h4>Mylene</h4>

                                        <div class="row clearfix">

                                           <ul class="clearfix">

                                              <li><a href="#"><img src="<?php bloginfo('template_url')?>/images/star.png" alt="#"></a></li>

                                              <li><a href="#"><img src="<?php bloginfo('template_url')?>/images/star.png" alt="#"></a></li>

                                              <li><a href="#"><img src="<?php bloginfo('template_url')?>/images/star.png" alt="#"></a></li>

                                              <li><a href="#"><img src="<?php bloginfo('template_url')?>/images/star.png" alt="#"></a></li>

                                              <li><a href="#"><img src="<?php bloginfo('template_url')?>/images/star.png" alt="#"></a></li>

                                              

                                           </ul>

                                        </div>

                                        <div class="row clearfix">

                                          <p><i class="fa fa-phone"></i>000000000</p>

                                        </div>

                                        <div class="row clearfix">

                                          <p><i class="fa fa-map-marker"></i><?php print_r($main_address);?></p>

                                        </div>

                                        <div class="row">

                                            <ul id="featured-social">

                                              <li><a href="#"><i class="fa fa-facebook"></i></a></li>

                                              <li><a href="#"><i class="fa fa-twitter"></i></a></li>

                                              <li><a href="#"><i class="fa fa-instagram"></i></a></li>

                                              <li><a href="#"><i class="fa fa-google-plus"></i></a></li>

                                              <li><a href="#"><i class="fa fa-envelope"></i></a></li>

                                            </ul>

                                        </div>

                                     </div>

                                 </div>

                               </div>

                           </div>

                       </div> 

                    </li>

     

<?php } ?>

 </ul>

     </div>

  </div>

  

</section>

<section id="featured">

  <div class="container">

    <h2>Featured Male Models</h2>

    <div class="row">

       <div class="text-after"><img src="<?php bloginfo('template_url')?>/images/text_after.png" alt="#"></div>

    </div>

     <div class="row clearfix">

          

          <ul id="flexiselDemo2"> 

                    <li>

                       <div class="featured_mail_box">

                           <div class="normal_image_box">

                               <img src="<?php bloginfo('template_url')?>/images/male/1.jpg" alt="#">

                               <div class="female_name"><h3>Mylene</h3></div>

                               <div class="female-info">

                                 <div class="info-parent">

                                     <div class="sub-parent">

                                        <h4>Mylene</h4>

                                        <div class="row clearfix">

                                           <ul class="clearfix">

                                              <li><a href="#"><img src="<?php bloginfo('template_url')?>/images/star.png" alt="#"></a></li>

                                              <li><a href="#"><img src="<?php bloginfo('template_url')?>/images/star.png" alt="#"></a></li>

                                              <li><a href="#"><img src="<?php bloginfo('template_url')?>/images/star.png" alt="#"></a></li>

                                              <li><a href="#"><img src="<?php bloginfo('template_url')?>/images/star.png" alt="#"></a></li>

                                              <li><a href="#"><img src="<?php bloginfo('template_url')?>/images/star.png" alt="#"></a></li>

                                              

                                           </ul>

                                        </div>

                                        <div class="row clearfix">

                                          <p><i class="fa fa-phone"></i>000000000</p>

                                        </div>

                                        <div class="row clearfix">

                                          <p><i class="fa fa-map-marker"></i>72/D ABC Street, California,

Ca-2548</p>

                                        </div>

                                        <div class="row">

                                            <ul id="featured-social">

                                              <li><a href="#"><i class="fa fa-facebook"></i></a></li>

                                              <li><a href="#"><i class="fa fa-twitter"></i></a></li>

                                              <li><a href="#"><i class="fa fa-instagram"></i></a></li>

                                              <li><a href="#"><i class="fa fa-google-plus"></i></a></li>

                                              <li><a href="#"><i class="fa fa-envelope"></i></a></li>

                                            </ul>

                                        </div>

                                     </div>

                                 </div>

                               </div>

                           </div>

                       </div> 

                    </li>

                    <li>

                       <div class="featured_mail_box">

                           <div class="normal_image_box">

                               <img src="<?php bloginfo('template_url')?>/images/male/2.jpg" alt="#">

                               <div class="female_name"><h3>Mylene</h3></div>

                               <div class="female-info">

                                 <div class="info-parent">

                                     <div class="sub-parent">

                                        <h4>Mylene</h4>

                                        <div class="row clearfix">

                                           <ul class="clearfix">

                                              <li><a href="#"><img src="<?php bloginfo('template_url')?>/images/star.png" alt="#"></a></li>

                                              <li><a href="#"><img src="<?php bloginfo('template_url')?>/images/star.png" alt="#"></a></li>

                                              <li><a href="#"><img src="<?php bloginfo('template_url')?>/images/star.png" alt="#"></a></li>

                                              <li><a href="#"><img src="<?php bloginfo('template_url')?>/images/star.png" alt="#"></a></li>

                                              <li><a href="#"><img src="<?php bloginfo('template_url')?>/images/star.png" alt="#"></a></li>

                                              

                                           </ul>

                                        </div>

                                        <div class="row clearfix">

                                          <p><i class="fa fa-phone"></i>000000000</p>

                                        </div>

                                        <div class="row clearfix">

                                          <p><i class="fa fa-map-marker"></i>72/D ABC Street, California,

Ca-2548</p>

                                        </div>

                                        <div class="row">

                                            <ul id="featured-social">

                                              <li><a href="#"><i class="fa fa-facebook"></i></a></li>

                                              <li><a href="#"><i class="fa fa-twitter"></i></a></li>

                                              <li><a href="#"><i class="fa fa-instagram"></i></a></li>

                                              <li><a href="#"><i class="fa fa-google-plus"></i></a></li>

                                              <li><a href="#"><i class="fa fa-envelope"></i></a></li>

                                            </ul>

                                        </div>

                                     </div>

                                 </div>

                               </div>

                           </div>

                       </div> 

                    </li> 

                    <li>

                       <div class="featured_mail_box">

                           <div class="normal_image_box">

                               <img src="<?php bloginfo('template_url')?>/images/male/3.jpg" alt="#">

                               <div class="female_name"><h3>Mylene</h3></div>

                               <div class="female-info">

                                 <div class="info-parent">

                                     <div class="sub-parent">

                                        <h4>Mylene</h4>

                                        <div class="row clearfix">

                                           <ul class="clearfix">

                                              <li><a href="#"><img src="<?php bloginfo('template_url')?>/images/star.png" alt="#"></a></li>

                                              <li><a href="#"><img src="<?php bloginfo('template_url')?>/images/star.png" alt="#"></a></li>

                                              <li><a href="#"><img src="<?php bloginfo('template_url')?>/images/star.png" alt="#"></a></li>

                                              <li><a href="#"><img src="<?php bloginfo('template_url')?>/images/star.png" alt="#"></a></li>

                                              <li><a href="#"><img src="<?php bloginfo('template_url')?>/images/star.png" alt="#"></a></li>

                                              

                                           </ul>

                                        </div>

                                        <div class="row clearfix">

                                          <p><i class="fa fa-phone"></i>000000000</p>

                                        </div>

                                        <div class="row clearfix">

                                          <p><i class="fa fa-map-marker"></i>72/D ABC Street, California,

Ca-2548</p>

                                        </div>

                                        <div class="row">

                                            <ul id="featured-social">

                                              <li><a href="#"><i class="fa fa-facebook"></i></a></li>

                                              <li><a href="#"><i class="fa fa-twitter"></i></a></li>

                                              <li><a href="#"><i class="fa fa-instagram"></i></a></li>

                                              <li><a href="#"><i class="fa fa-google-plus"></i></a></li>

                                              <li><a href="#"><i class="fa fa-envelope"></i></a></li>

                                            </ul>

                                        </div>

                                     </div>

                                 </div>

                               </div>

                           </div>

                       </div> 

                    </li>

                    <li>

                       <div class="featured_mail_box">

                           <div class="normal_image_box">

                               <img src="<?php bloginfo('template_url')?>/images/male/4.jpg" alt="#">

                               <div class="female_name"><h3>Mylene</h3></div>

                               <div class="female-info">

                                 <div class="info-parent">

                                     <div class="sub-parent">

                                        <h4>Mylene</h4>

                                        <div class="row clearfix">

                                           <ul class="clearfix">

                                              <li><a href="#"><img src="<?php bloginfo('template_url')?>/images/star.png" alt="#"></a></li>

                                              <li><a href="#"><img src="<?php bloginfo('template_url')?>/images/star.png" alt="#"></a></li>

                                              <li><a href="#"><img src="<?php bloginfo('template_url')?>/images/star.png" alt="#"></a></li>

                                              <li><a href="#"><img src="<?php bloginfo('template_url')?>/images/star.png" alt="#"></a></li>

                                              <li><a href="#"><img src="<?php bloginfo('template_url')?>/images/star.png" alt="#"></a></li>

                                              

                                           </ul>

                                        </div>

                                        <div class="row clearfix">

                                          <p><i class="fa fa-phone"></i>000000000</p>

                                        </div>

                                        <div class="row clearfix">

                                          <p><i class="fa fa-map-marker"></i>72/D ABC Street, California,

Ca-2548</p>

                                        </div>

                                        <div class="row">

                                            <ul id="featured-social">

                                              <li><a href="#"><i class="fa fa-facebook"></i></a></li>

                                              <li><a href="#"><i class="fa fa-twitter"></i></a></li>

                                              <li><a href="#"><i class="fa fa-instagram"></i></a></li>

                                              <li><a href="#"><i class="fa fa-google-plus"></i></a></li>

                                              <li><a href="#"><i class="fa fa-envelope"></i></a></li>

                                            </ul>

                                        </div>

                                     </div>

                                 </div>

                               </div>

                           </div>

                       </div> 

                    </li> 

                    <li>

                       <div class="featured_mail_box">

                           <div class="normal_image_box">

                               <img src="<?php bloginfo('template_url')?>/images/male/5.jpg" alt="#">

                               <div class="female_name"><h3>Mylene</h3></div>

                               <div class="female-info">

                                 <div class="info-parent">

                                     <div class="sub-parent">

                                        <h4>Mylene</h4>

                                        <div class="row clearfix">

                                           <ul class="clearfix">

                                              <li><a href="#"><img src="<?php bloginfo('template_url')?>/images/star.png" alt="#"></a></li>

                                              <li><a href="#"><img src="<?php bloginfo('template_url')?>/images/star.png" alt="#"></a></li>

                                              <li><a href="#"><img src="<?php bloginfo('template_url')?>/images/star.png" alt="#"></a></li>

                                              <li><a href="#"><img src="<?php bloginfo('template_url')?>/images/star.png" alt="#"></a></li>

                                              <li><a href="#"><img src="<?php bloginfo('template_url')?>/images/star.png" alt="#"></a></li>

                                              

                                           </ul>

                                        </div>

                                        <div class="row clearfix">

                                          <p><i class="fa fa-phone"></i>000000000</p>

                                        </div>

                                        <div class="row clearfix">

                                          <p><i class="fa fa-map-marker"></i>72/D ABC Street, California,

Ca-2548</p>

                                        </div>

                                        <div class="row">

                                            <ul id="featured-social">

                                              <li><a href="#"><i class="fa fa-facebook"></i></a></li>

                                              <li><a href="#"><i class="fa fa-twitter"></i></a></li>

                                              <li><a href="#"><i class="fa fa-instagram"></i></a></li>

                                              <li><a href="#"><i class="fa fa-google-plus"></i></a></li>

                                              <li><a href="#"><i class="fa fa-envelope"></i></a></li>

                                            </ul>

                                        </div>

                                     </div>

                                 </div>

                               </div>

                           </div>

                       </div> 

                    </li> 

                    <li>

                       <div class="featured_mail_box">

                           <div class="normal_image_box">

                               <img src="<?php bloginfo('template_url')?>/images/male/1.jpg" alt="#">

                               <div class="female_name"><h3>Mylene</h3></div>

                               <div class="female-info">

                                 <div class="info-parent">

                                     <div class="sub-parent">

                                        <h4>Mylene</h4>

                                        <div class="row clearfix">

                                           <ul class="clearfix">

                                              <li><a href="#"><img src="<?php bloginfo('template_url')?>/images/star.png" alt="#"></a></li>

                                              <li><a href="#"><img src="<?php bloginfo('template_url')?>/images/star.png" alt="#"></a></li>

                                              <li><a href="#"><img src="<?php bloginfo('template_url')?>/images/star.png" alt="#"></a></li>

                                              <li><a href="#"><img src="<?php bloginfo('template_url')?>/images/star.png" alt="#"></a></li>

                                              <li><a href="#"><img src="<?php bloginfo('template_url')?>/images/star.png" alt="#"></a></li>

                                              

                                           </ul>

                                        </div>

                                        <div class="row clearfix">

                                          <p><i class="fa fa-phone"></i>000000000</p>

                                        </div>

                                        <div class="row clearfix">

                                          <p><i class="fa fa-map-marker"></i>72/D ABC Street, California,

Ca-2548</p>

                                        </div>

                                        <div class="row">

                                            <ul id="featured-social">

                                              <li><a href="#"><i class="fa fa-facebook"></i></a></li>

                                              <li><a href="#"><i class="fa fa-twitter"></i></a></li>

                                              <li><a href="#"><i class="fa fa-instagram"></i></a></li>

                                              <li><a href="#"><i class="fa fa-google-plus"></i></a></li>

                                              <li><a href="#"><i class="fa fa-envelope"></i></a></li>

                                            </ul>

                                        </div>

                                     </div>

                                 </div>

                               </div>

                           </div>

                       </div> 

                    </li>               

                </ul>

      </div>



  </div>

  

</section>

<section id="porfolio">

  <div class="portfolio-content">

    <div class="container">

      <div class="row">

        <div class="center-content">

          <h2>MODELS ARE CREATED</h2>

          <h5>MAKE YOUR PORTFOLIO </h5>

          <div class="row">

            

               <a href="#">MEET THE PHOTOGRAPHERS</a>

            

          </div>

        </div>

      </div>

    </div>

  </div>

</section>

<section id="post">

  <div class="container">

    <div class="post">

      <h2>RECENT POSTS</h2>

      <nav class="slidernav">

        <div id="navbtns" class="clearfix"> <a href="#" class="previous"><i class="fa fa-angle-left"></i></a> <a href="#" class="next"><i class="fa fa-angle-right"></i></a> </div>

      </nav>

      <div class="crsl-items" data-navigation="navbtns">

        <div class="crsl-wrap">

          <div class="crsl-item">

            <div class="thumbnail"> <img src="<?php bloginfo('template_url')?>/images/thumb01.jpg" alt="nyc subway"> </div>

            <div class="blog-text-area">

                <h3><a href="#">A talk with Alex Vesci – Vans & London Fashion Week photographer </a></h3>

            <div class="comment">

              <ul>

                <li>Friday July 1st, 2016 </li>

                <li class="icon-margin"><i class="fa fa-comment-o" aria-hidden="true"></i> Comments  0</li>

              </ul>

            </div>

            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam a imperdiet nunc. Fusce hendrerit volutpat pretium. Donec feugiat sem lectus, vel ultrices leo luctus <a href="#">[...]</a> </p>

            <span class="underline"></span>

            <p class="share">Share This</p>

            <div class="social-icon">

              <ul>

                <li class="icon-style1"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>

                <li class="icon-style2"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>

                <li class="icon-style3"><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>

                <li class="icon-style4"><a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>

                <li class="icon-style5"><a href="#"><i class="fa fa-tumblr" aria-hidden="true"></i></a></li>

              </ul>

            </div>

            </div>

            

          </div>

          <!-- post #1 -->

          

          <div class="crsl-item">

            <div class="thumbnail"> <img src="<?php bloginfo('template_url')?>/images/thumb02.jpg" alt="nyc subway"> </div>

            <div class="blog-text-area">

               <h3><a href="#">A talk with Alex Vesci – Vans & London Fashion Week photographer </a></h3>

            <div class="comment">

              <ul>

                <li>Friday July 1st, 2016 </li>

                <li class="icon-margin"><i class="fa fa-comment-o" aria-hidden="true"></i> Comments  0</li>

              </ul>

            </div>

            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam a imperdiet nunc. Fusce hendrerit volutpat pretium. Donec feugiat sem lectus, vel ultrices leo luctus <a href="#">[...]</a>  </p>

            <span class="underline"></span>

            <p class="share">Share This</p>

            <div class="social-icon">

              <ul>

                <li class="icon-style1"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>

                <li class="icon-style2"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>

                <li class="icon-style3"><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>

                <li class="icon-style4"><a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>

                <li class="icon-style5"><a href="#"><i class="fa fa-tumblr" aria-hidden="true"></i></a></li>

              </ul>

            </div>

            </div>

            

          </div>

          <!-- post #2 -->

          

          <div class="crsl-item">

            <div class="thumbnail"> <img src="<?php bloginfo('template_url')?>/images/thumb03.jpg" alt="nyc subway"> </div>

            <div class="blog-text-area">

              <h3><a href="#">A talk with Alex Vesci – Vans & London Fashion Week photographer </a></h3>

            <div class="comment">

              <ul>

                <li>Friday July 1st, 2016 </li>

                <li class="icon-margin"><i class="fa fa-comment-o" aria-hidden="true"></i> Comments  0</li>

              </ul>

            </div>

            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam a imperdiet nunc. Fusce hendrerit volutpat pretium. Donec feugiat sem lectus, vel ultrices leo luctus <a href="#">[...]</a>  </p>

            <span class="underline"></span>

            <p class="share">Share This</p>

            <div class="social-icon">

              <ul>

                <li class="icon-style1"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>

                <li class="icon-style2"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>

                <li class="icon-style3"><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>

                <li class="icon-style4"><a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>

                <li class="icon-style5"><a href="#"><i class="fa fa-tumblr" aria-hidden="true"></i></a></li>

              </ul>

            </div>

            </div>

            

          </div>

          <!-- post #3 -->

          

          <div class="crsl-item">

            <div class="thumbnail"> <img src="<?php bloginfo('template_url')?>/images/thumb02.jpg" alt="nyc subway"> </div>

            <div class="blog-text-area">

               <h3><a href="#">A talk with Alex Vesci – Vans & London Fashion Week photographer </a></h3>

            <div class="comment">

              <ul>

                <li>Friday July 1st, 2016 </li>

                <li class="icon-margin"><i class="fa fa-comment-o" aria-hidden="true"></i> Comments  0</li>

              </ul>

            </div>

            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam a imperdiet nunc. Fusce hendrerit volutpat pretium. Donec feugiat sem lectus, vel ultrices leo luctus <a href="#">[...]</a>  </p>

            <span class="underline"></span>

            <p class="share">Share This</p>

            <div class="social-icon">

              <ul>

                <li class="icon-style1"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>

                <li class="icon-style2"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>

                <li class="icon-style3"><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>

                <li class="icon-style4"><a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>

                <li class="icon-style5"><a href="#"><i class="fa fa-tumblr" aria-hidden="true"></i></a></li>

              </ul>

            </div>

            </div>

            

          </div>

          <!-- post #4 -->

          

          

          <div class="crsl-item">

            <div class="thumbnail"> <img src="<?php bloginfo('template_url')?>/images/thumb03.jpg" alt="nyc subway"> </div>

            <div class="blog-text-area">

              <h3><a href="#">A talk with Alex Vesci – Vans & London Fashion Week photographer </a></h3>

            <div class="comment">

              <ul>

                <li>Friday July 1st, 2016 </li>

                <li class="icon-margin"><i class="fa fa-comment-o" aria-hidden="true"></i> Comments  0</li>

              </ul>

            </div>

            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam a imperdiet nunc. Fusce hendrerit volutpat pretium. Donec feugiat sem lectus, vel ultrices leo luctus <a href="#">[...]</a>  </p>

            <span class="underline"></span>

            <p class="share">Share This</p>

            <div class="social-icon">

              <ul>

                <li class="icon-style1"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>

                <li class="icon-style2"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>

                <li class="icon-style3"><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>

                <li class="icon-style4"><a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>

                <li class="icon-style5"><a href="#"><i class="fa fa-tumblr" aria-hidden="true"></i></a></li>

              </ul>

            </div>

            </div>

            

          </div>

          <!-- post #5 --> 

        </div>

        <!-- @end .crsl-wrap --> 

      </div>

      <div class="button-area">

        <div class="dropdown4">

         <a href="#">VIEW ALL POSTS</a>

        </div>

      </div>

    </div>

    <div class="category">

      <h2>CATEGORIES</h2>

      <div class="category-list">

        <ul>

          <li><a href="#">Check out our Premium Unlimited models!</a></li>

          <li><a href="#">Closeup Magazine</a></li>

          <li><a href="#">Fresh Faces - The Contest!</a></li>

          <li><a href="#">Latest from our Members</a></li>

          <li><a href="#">Model Agency Exclusives</a></li>

          <li><a href="#">Model Exclusives</a></li>

          <li><a href="#">Model Industry</a></li>

        </ul>

      </div>

    </div>

  </div>

  <div class="clear"></div>

</section>

<?php get_footer();?>