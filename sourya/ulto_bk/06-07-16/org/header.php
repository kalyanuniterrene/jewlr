<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HOME</title>
    <link href="<?php bloginfo('template_url')?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php bloginfo('template_url')?>/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php bloginfo('template_url')?>/css/responsive.css" rel="stylesheet">  
    <link href="<?php bloginfo('template_url')?>/css/style.css" rel="stylesheet">
    <link href="<?php bloginfo('template_url')?>/css/style2.css" rel="stylesheet" type="text/css" />
        		
  </head>
  <body>
  
  	<header class="mainHeader">
    	<div class="topHeader">
        	<div class="container">
            	<div class="col-md-4 col-sm-4 col-xs-6">
                	<div class="logoSection">
                    <?php if(get_option('webq_header_logo_upload')){?>
                    	<a href="<?php echo get_home_url();?>"><img src="<?php echo get_option('webq_header_logo_upload')?>"></a>
                    <?php }?>
                    </div>
                </div><!--logo-->
                <div class="col-md-8  col-sm-8 col-xs-12">
                	<div class="topHeaderNavs">
                    	<ul class="list-inline pull-right">
                        	<li><a href="">Shopping <img src="<?php bloginfo('template_url')?>/img/shopping_bag_icon.png"/></a></li>
                            <li><a href="">Free Shipping <img src="<?php bloginfo('template_url')?>/img/shipping_icon.png"/></a></li>
                            <li><a href="">Join</a></li>
                             <li>|</li>
                            <li><a href="">Sign In</a></li>
                        </ul>
                    </div>                   
                </div><!--top header links-->
            </div><!--container-->
            <div class="clr"></div>
        </div><!--end of top header-->
        
        <div class="bottomHeader">
        	<div class="container">
            	<nav class="navbar navbar-default">                          
                            <div class="navbar-header">
                              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                              </button>                              
                            </div>
                        
                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<?php
/*class Wpse8170_Menu_Walker extends Walker_Nav_Menu {

    var $number = 1;

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names .'>';

        // add span with number here
        if ( $depth == 0 ) { // remove if statement if depth check is not required
            $output .= sprintf( '<span>%02s.</span>', $this->number++ );
        }

        $atts = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
        $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
        $atts['href']   = ! empty( $item->url )        ? $item->url        : '';

        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

}*/
?>

<?php wp_nav_menu( array( 'theme_location' => 'header-menu','menu_class'=>'nav navbar-nav' ) ); ?>

                            <!-- <ul class="nav navbar-nav">
                                <li><a href="#">Home</a></li>                                
                                <li class="dropdown">
                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Products <span class="caret"></span></a>
                                  <ul class="dropdown-menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#">One more separated link</a></li>
                                  </ul>
                                </li>dropdown
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Blog</a></li>
                                <li><a href="#">Contact Us</a></li>
                              </ul>-->
                              
                              <ul class="nav navbar-nav navbar-right">
                                <div class="navbarSearch">
                                	<input type="text" class="navbarInput" placeholder="Search">
                                    <a href="#"><img src="<?php bloginfo('template_url')?>/img/search_icon.png"/></a>
                                </div>
                              </ul>
                            </div><!-- /.navbar-collapse -->
                        </nav>
            </div>
            <div class="clr"></div>
        </div><!--end of bottom Header-->
    	
    </header>