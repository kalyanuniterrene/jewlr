<?php
/**
 * Template Name: Left Sidebar
 *
 * @package WP Pro Real Estate 7
 * @subpackage Template
 */
 
global $ct_options; 

$inside_page_title = get_post_meta($post->ID, "_ct_inner_page_title", true);

get_header();

while ( have_posts() ) : the_post();

if($inside_page_title == "Yes") { 
    // Custom Page Header Background Image
    if(get_post_meta($post->ID, '_ct_page_header_bg_image', true) != '') {
        echo'<style type="text/css">';
        echo '#single-header { background: url(';
        echo get_post_meta($post->ID, '_ct_page_header_bg_image', true);
        echo ') no-repeat center center; background-size: cover;}';
        echo '</style>';
    } ?>

    <!-- Single Header -->
    <div id="single-header">
        <div class="dark-overlay">
            <div class="container">
                <h1 class="marT0 marB0"><?php the_title(); ?></h1>
                <?php if(get_post_meta($post->ID, '_ct_page_sub_title', true) != '') { ?>
                    <h2 class="marT0 marB0"><?php echo get_post_meta($post->ID, "_ct_page_sub_title", true); ?></h2>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- //Single Header -->
<?php } ?>

<!-- Container -->
<div class="container marT60 padB60">

    <div id="sidebar" class="col span_3 first">
           <div id="sidebar-inner">
                <?php
                if (is_active_sidebar('left-sidebar-pages')) {
                    dynamic_sidebar('Left Sidebar Pages');
                } ?>
            </div>
        </div>

        <!-- Page Content -->
        <div class="content col span_9">
        
            <!-- Inner Content -->
            <div class="inner-content">
                <?php the_content(); ?>
            </div>
            <!-- //Inner Content -->

            <!-- Comments -->
            <?php if ( comments_open() || '0' != get_comments_number() ) :

                echo '<div class="clear"></div>';

                // If comments are open or we have at least one comment, load up the comment template
                comments_template();
            
            endif; ?>
            <!-- End Comments -->
        </div>
        <!-- //Page Content -->

            <div class="clear"></div>

    <?php endwhile; ?>

</div>
<!-- //Container -->

<?php get_footer(); ?>