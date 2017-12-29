<?php
/**
* Plugin Name: My PostCode
* Plugin URI: http://uniterrene.com/
* Description: Uniterrene websoft is an outsourcing IT & Software offshore development company which provides professional web designing services.
* Version: 1.0 
* Author: Torben Ganer
* Author URI: http://uniterrene.com/
* License: GPL12
*/
function your_function() {
 ?>
 
<script>
jQuery(document).ready(function(){
//$(function() {
	$(".homecss").eq(0).appendTo("#page-content .banner_div .full-screen-section-wrap .be-section-pad .be-custom-column-pad .be-text-block");
	$('.homecss').show();
	$('.innercss').show();
	$('.epm-message.epm-success.message.success.msg').hide();
	 var csscontentlenth = $(".innercss").length;
	 if(csscontentlenth==1){
		 $(".innercss").eq(0).appendTo(".postcodeclass");
		 }else{
	$(".innercss").last().appendTo(".postcodeclass");
	 $(".innercss").eq(1).remove();
	 $(".innercss").eq(0).remove();
	 }
    $('.innercss .code').on('submit', function(e) {
e.preventDefault();
var name =  $(this).find('.inputk1').val();
		/*var letters = /^[0-9a-zA-Z]+$/; 
		if ( name == "" || name.match(letters)) { $('#errork1').show(); return;} */
		if ( name == "") { /*$('#errork1').show();*/ $(this).find('.inputk1').focus(); return;}
		
		$('.innercss .logink').animate({
        'marginTop' : "+=30px" }, {duration: 500,queue:false,complete:
 function() 	{        
		$('.innercss .errork1').hide();
		$('.innercss .checkingp').show();		
		var ajaxurl='<?php echo admin_url('admin-ajax.php'); ?>';
		var data = {
        action: 'get_postal_code',
        postal: name
    };
		$.post(ajaxurl, data, function(response) {
		var configurl='<?php echo get_option( 'pagename_1');?>';
		if(response != '='){
		if(response == true){
			//window.location.replace(configurl);
			window.location.href = configurl;
			}else{
		successinner( response );
		}
		}else{			
			$('.innercss .errorlentch').show();
			$('.innercss .checkingp').hide();
			$('.innercss .errork1').hide();
			$('.innercss .addemail').hide();
			$('.inputk1').val('');
			}
    });
    function successinner( postalkc ) {
		$(".innercss .epm-sign-up-button").val('UPDATE ME');
		$('.innercss .errorlentch').hide();
		$('.innercss .errork1').hide();
		$('.innercss .checkingp').hide();
		$('.innercss .addemail').show();
		$('.inputk1').val('');
      	}
				
}
    });
      
	  });
	   $('.homecss .code').on('submit', function(e) {
e.preventDefault();
var name =  $(this).find('.inputk1').val();
		/*var letters = /^[0-9a-zA-Z]+$/; 
		if ( name == "" || name.match(letters)) { $('#errork1').show(); return;} */
		if ( name == "") { /*$('#errork1').show();*/ $(this).find('.inputk1').focus(); return;}
		
		$('.homecss .logink').animate({
        'marginTop' : "+=30px" }, {duration: 500,queue:false,complete:
 function() 	{        
		$('.homecss .errork1').hide();
		$('.homecss .checkingp').show();		
		var ajaxurl='<?php echo admin_url('admin-ajax.php'); ?>';
		var data = {
        action: 'get_postal_code',
        postal: name
    };
		$.post(ajaxurl, data, function(response) {
		var configurl='<?php echo get_option( 'pagename_1');?>';
		//alert(response);
		if(response != '='){
		if(response == true){
			//window.location.replace(configurl);
			window.location.href = configurl;
			}else{
		success( response );
		}
		}else{			
			$('.homecss .errorlentch').show();
			$('.homecss .checkingp').hide();
			$('.homecss .errork1').hide();
			$('.homecss .addemail').hide();	
			$('.inputk1').val('');
			}
    });
    function success( postalkc ) {
		$(".homecss .epm-sign-up-button").val('UPDATE ME');
		$('.homecss .errorlentch').hide();
		$('.homecss .errork1').hide();
		$('.homecss .checkingp').hide();
		$('.homecss .addemail').show();
		$('.inputk1').val('');
      	}
				
}
    });
      
	  });
});
</script>
<style>
.epm-message.epm-success.message.success + .epm-form-field{
	display:none;
	}
	.epm-message.epm-success.message.success + .epm-form-field + .epm-sign-up-button{
		display:none;
		}
</style>
 <?php
}
add_action( 'wp_footer', 'your_function' );

function add_theme_scripts(){
wp_enqueue_style( 'dscustom', get_template_directory_uri() . '/css/dscustom.css', false, '1.1', 'all');	
	}
add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

// Register Custom Post Type
function postcode_post_type() {
	$labels = array(
		'name'                  => _x( 'Postcodes', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Postcode', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'PostCodes', 'text_domain' ),
		'name_admin_bar'        => __( 'PostCode', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Postcode', 'text_domain' ),
		'description'           => __( 'Post Type Description', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'excerpt', ),
		'taxonomies'            => array(),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-location',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'postcode', $args );	
}
add_action( 'init', 'postcode_post_type', 0 );
add_action('admin_menu' , 'csv_enable_pages');  
function csv_enable_pages() {
    add_submenu_page('edit.php?post_type=postcode', '', 'CSV Importer', 'edit_posts', 'wp-ultimate-csv-importer/index.php&__module=custompost&step=uploadfile', 'custom_function');
}
add_action('admin_head', 'my_custom_css');
function my_custom_css() {
  echo '<style> #toplevel_page_wp-ultimate-csv-importer-index{display: none !important;}#notification_wp_csv+nav.navbar.navbar-default{display: none !important;}
  #FIELDGRP tr:nth-child(n+5){
      display: none !important;
    }
  </style>';
}
function postal_code_get_meta( $value ) {
	global $post;
	$field = get_post_meta( $post->ID, $value, true );
	if ( ! empty( $field ) ) {
		return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
	} else {
		return false;
	}
}
function postal_code_add_meta_box() {
	add_meta_box(
		'postal_code-postal-code',
		__( 'Postal Code', 'postal_code' ),
		'postal_code_html',
		'postcode',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'postal_code_add_meta_box' );
function postal_code_html( $post) {
	wp_nonce_field( '_postal_code_nonce', 'postal_code_nonce' ); ?>

<p>
  <label for="postal_code_code">
    <?php _e( 'Code', 'postal_code' ); ?>
  </label>
  <br>
  <input type="text" name="postal_code_code" id="postal_code_code" value="<?php echo postal_code_get_meta( 'postal_code_code' ); ?>">
</p>
<p>
  <label for="postal_code_area">
    <?php _e( 'Area', 'postal_code' ); ?>
  </label>
  <br>
  <input type="text" name="postal_code_area" id="postal_code_area" value="<?php echo postal_code_get_meta( 'postal_code_area' ); ?>">
</p>
<?php
}
function postal_code_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['postal_code_nonce'] ) || ! wp_verify_nonce( $_POST['postal_code_nonce'], '_postal_code_nonce' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;
	if ( isset( $_POST['postal_code_code'] ) )
		update_post_meta( $post_id, 'postal_code_code', esc_attr( $_POST['postal_code_code'] ) );
	if ( isset( $_POST['postal_code_area'] ) )
		update_post_meta( $post_id, 'postal_code_area', esc_attr( $_POST['postal_code_area'] ) );
}
add_action( 'save_post', 'postal_code_save' );

add_filter( 'manage_postcode_posts_columns', 'set_custom_edit_postcode_columns' );
add_action( 'manage_postcode_posts_custom_column' , 'custom_postcode_column', 10, 2 );

function set_custom_edit_postcode_columns($columns) {
    unset( $columns['date'] );
    $columns['postal_code_area'] = __( 'Postal Code Area', 'text_domain' );
    $columns['postal_code_code'] = __( 'Postal Code', 'text_domain' );

    return $columns;
}

function custom_postcode_column( $column, $post_id ) {
    switch ( $column ) {

        case 'postal_code_area' :
            $terms = get_post_meta( $post_id , 'postal_code_area' , true );
            if ( is_string( $terms ) )
                echo $terms;
            else
                _e( 'Unable', 'text_domain' );
            break;

        case 'postal_code_code' :
            echo get_post_meta( $post_id , 'postal_code_code' , true ); 
            break;

    }
}

add_action("wp_ajax_get_postal_code", "get_postal_code");
add_action("wp_ajax_nopriv_get_postal_code", "get_postal_code");
function get_postal_code(){
$postal = strtolower($_REQUEST["postal"]);
$postal=preg_replace('/\s+/', '', $postal);
$stlenth = strlen($postal);
if(($stlenth >= 5) && ($stlenth <= 7)){

$args = array (
	'post_type'              => array( 'postcode' ),
	/*'s'                      => sanitize_text_field($postal),*/
	'nopaging'               => true,
);
// The Query
$query = new WP_Query( $args );
// The Loop
$result = false;
if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();
		// do something
		$lopval = strtolower(get_post_meta( get_the_ID(), 'postal_code_code', true ));
		$lopval=preg_replace('/\s+/', '', $lopval);
						
		if($lopval == $postal){
	$result = true;
	}
	}
} else {
	// no posts found
}
// Restore original Post Data
wp_reset_postdata();

echo $result;
}else{
	echo '=';
	}
exit();
}
add_action('admin_init', 'my_general_section');  
function my_general_section() {  
    add_settings_section(  
        'my_settings_section', // Section ID 
        'My Postal Code Options', // Section Title
        'my_section_options_callback', // Callback
        'general' // What Page?  This makes the section show up on the General Settings Page
    );
    add_settings_field( // Option 1
        'pagename_1', // Option ID
        'Page Link', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed (General Settings)
        'my_settings_section', // Name of our section
        array( // The $args
            'pagename_1' // Should match Option ID
        )  
    );
    register_setting('general','pagename_1', 'esc_attr');
}
function my_section_options_callback() { // Section Callback
    echo '<p>A little message on editing info</p>';  
}
function my_textbox_callback($args) {  // Textbox Callback
    $option = get_option($args[0]);
    echo '<input type="text" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" style="width:80%;" />';
}
function mypostcodehtml($atts){
	ob_start();
	$postatts = shortcode_atts( array('class' => 'innercss'), $atts, 'POSTCODEHTML' );
	 ?>
<div class="<?php echo $postatts['class'];?>" style="display:none;">
  <div id="errork1" class="errork1"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please enter a valid Postal Code</div>
  <div style="text-align:center;">
    <form method="POST" id="code" class="code" method="post" action="https://lagoonit.com/login/">
    <input id="inputk1" class="inputk1" style="text-align:center;" name="code" placeholder="Enter your postcode" value="">
    <br>
    <input id="orderk1" class="orderk1" type="submit" value="ORDER NOW" name="btnPostal"/>
    </form>
    <br>
    <div id="checkingp" class="checkingp"><img style="position:relative;top:-15px;float:left;width:65px;height:65px;" src="https://lagoonit.com/loading.gif"><span style="position:relative;float:right;">Just checking your postcode</span></div>
  </div>
  <div id="logink" class="logink"></div>
<div id="errorlentch" class="errorlentch" style="display:none;">
Oops that's not a valid postcode. <br />Please try again e.g. <strong>TW11 8NY</strong>.
</div>
<div id="addemail" class="<?php echo 'addemail addemail'.$postatts['class'];?>">Oops we are not there yet, but we are expanding. Please leave your email and we will update you.<br/>
  
  <?php
  echo do_shortcode('[epm_mailchimp]');
  ?>
</div>
<div class="epm-message epm-success message success msg" style="display:none;">
Thank you for subscribing to our newsletter. We will update you once we service your area.
</div>
</div>
<?php 
return ob_get_clean();
	}
add_shortcode( 'POSTCODEHTML', 'mypostcodehtml' );
?>
