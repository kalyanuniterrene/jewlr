<section class="footerTop">

    	<div class="container">

        	<ul class="list-inline">

            	<li><a href=""><img src="<?php bloginfo('template_url')?>/img/return_info-icon.png"/> <span>Return info</span></a></li>

                <li><a href=""><img src="<?php bloginfo('template_url')?>/img/shipping_info-icon.png"/> <span>Shopping info</span></a></li>

                <li><a href="" style="border:none;"><img src="<?php bloginfo('template_url')?>/img/phone_icon.png"/> <span>00 0000 0000 000</span></a></li>

            </ul>

            

        </div><!--container-->

        <div class="clr"></div>

    </section><!--footer top section-->

    

    <footer class="mainFooter">

    	<div class="container">

        	<div class="col-md-5 col-sm-5 col-xs-12">

            	<div class="footerLeft">

                	<div class="leftTop">

                    	<h3>Important Links</h3>

                    </div><!--leftTop--> 

                    <div class="col-md-6 col-sm-6 col-xs-6 footerNav">

                    	<ul>

                        	<li><a href="<?php echo get_permalink( get_page_by_path( 'faqs' ) );?>">Faqs</a></li>

                            <li><a href="<?php echo get_permalink( get_page_by_path( 'gift-vouchers' ) );?>">Gift Vouchers</a></li>

                            <li><a href="<?php echo get_permalink( get_page_by_path( 'product-care' ) );?>">Product Care</a></li>

                            <li><a href="<?php echo get_permalink( get_page_by_path( 'return-exchenges' ) );?>">Returns & Exchanges</a></li>

                            <li><a href="<?php echo get_permalink( get_page_by_path( 'warranty-repairs' ) );?>">Warranty & Repairs</a></li>

                            <li><a href="<?php echo get_permalink( get_page_by_path( 'our-suppliers' ) );?>">Our Suppliers</a></li>

                        </ul>

                    </div> 

                    <div class="col-md-6  col-sm-6 col-xs-6 footerNav">

                    	<ul class="pull-right">

                        	<li><a href="<?php echo get_permalink( get_page_by_path( 'size-guide' ) );?>">Size Guide</a></li>

                            <li><a href="<?php echo get_permalink( get_page_by_path( 'contact-us' ) );?>">Contact Us</a></li>

                            <li><a href="<?php echo get_permalink( get_page_by_path( 'careers' ) );?>">Careers</a></li>

                            <li><a href="<?php echo get_permalink( get_page_by_path( 'terms-conditions' ) );?>">Terms & conditions</a></li>

                        </ul>

                    </div> 

                </div>

                <div class="clr"></div>

            </div><!--left-->

            <div class="col-md-4 col-sm-4 col-xs-12">

            	<div class="footerMiddle">

                	<div class="leftTop">

                    	<h3>Get Our Newsletter</h3>

                    </div><!--middle top--> 

                	<div class="newslatterForm">

					<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>

                    <ul id="sidebar">

                    <?php dynamic_sidebar( 'sidebar-1' ); ?>

                    </ul>

                    <?php endif; ?>

                    	<!--<form>

                    	<input type="text" placeholder="Enter Email" class="newsLetterInput">                     

                        <input type="submit" value="SUBMIT" class="newsLetterBtn">

                         </form>-->

                    </div><!--newsletter form-->

                </div><!--middle-->

            </div><!--middle-->

            <div class="col-md-3 col-sm-3 col-xs-12">

            	<div class="footerRight">

                	<div class="leftTop">

                    	<h3>Stay Connected</h3>

                    </div><!--right top--> 

                    <div class="allSocialNav">

                    	<ul class="list-inline">

                        <?php if(get_option('webq_facebook')){?>

                        	<li><a href="<?php echo get_option('webq_facebook');?>" target="_blank"><i class="fa fa-facebook"></i></a></li>

                        <?php }?>

                        <?php if(get_option('webq_twitter')){?>

                            <li><a href="<?php echo get_option('webq_twitter');?>" target="_blank"><i class="fa fa-twitter"></i></a></li>

                        <?php }?>

                        <?php if(get_option('webq_google_plus')){?>

                            <li><a href="<?php echo get_option('webq_google_plus');?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>

                        <?php }?>

                    </div><!--all social navs-->

                </div><!--right-->

            </div><!--right-->

            <div class="clr"></div>

            <div class="copyright">

            	<?php echo get_option('webq_footer_copyright')?>

            </div><!--copyright-->

        </div><!--container-->

        <div class="clr"></div>

    </footer><!--main footer-->



    

    

  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script src="<?php bloginfo('template_url')?>/js/bootstrap.min.js"></script>

    <script src="<?php bloginfo('template_url')?>/js/custom.js"></script>

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

  </body>

</html>