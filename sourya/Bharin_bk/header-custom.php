<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?>
<?php wp_head('custom-header'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bahrain Model</title>

<link href='https://fonts.googleapis.com/css?family=PT+Sans+Narrow' rel='stylesheet' type='text/css'>

<link href="<?php bloginfo('template_url')?>/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?php bloginfo('template_url')?>/css/custom.css" rel="stylesheet" type="text/css">
<link href="<?php bloginfo('template_url')?>/css/responsive.css" rel="stylesheet" type="text/css">
<!--slider start-->
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url')?>/css/post_styles.css">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url')?>/jvmobilemenu/jv-jquery-mobile-menu.css">


<link href="<?php bloginfo('template_url')?>/css/style.css" rel="stylesheet" type="text/css" />
<?php wp_head(); ?>
</head>
<section id="nav">
   <div class="container">
        <div class="slide_logo">
             <a href="#"><img src="<?php bloginfo('template_url')?>/images/logo.png" alt="#"></a></a>
        </div>
        <div class="slide_right clearfix">
          <div class="slide_menu">
             <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Male</a></li>
                <li><a href="#">Female</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Contact</a></li>
             </ul> 
          </div>
          <div class="slide-login-area clearfix">
             <div class="slide-register"><a href="#">Reginter<i class="fa fa-angle-down"></i></a></div>
             <div class="slide-login"><a href="#">Login<i class="fa fa-angle-down"></i></a></div>
          </div>
        </div>
   </div>
</section>