<?php
/*
*Template Name: Post page
*/
get_header("custom");
?>
<?php 
while ( have_posts() ) : the_post();?>
<h3><?php echo $post->post_title;?></h3>
<?php $content = get_the_content();
print $content;?>


<?php
echo wpuf_show_custom_fields_new($content);?>
<div class="looks_model">
<h1 style="background:#f2dede;">Preferred Modeling Type</h1>
<div"><?php echo esc_html( get_post_meta( get_the_ID(), 'preferred_modeling_type', true ) );?></div>
<div class="looks_model">
<h1>My Looks</h1>
<div>My height : <?php echo esc_html( get_post_meta( get_the_ID(), 'my_height', true ) );?></div>
<div>My weight : <?php echo esc_html( get_post_meta( get_the_ID(), 'my_weight', true ) );?></div>
<div>My vital statistics : <?php echo esc_html( get_post_meta( get_the_ID(), 'my_vital_statistics', true ) );?></div>
<div>My complexion : <?php echo esc_html( get_post_meta( get_the_ID(), 'my_complexion', true ) );?></div>
<div>My hair color : <?php echo esc_html( get_post_meta( get_the_ID(), 'my_hair_color', true ) );?></div>
<div>My Age : <?php echo esc_html( get_post_meta( get_the_ID(), 'my_age', true ) );?></div>
<div>My Eye Color : <?php echo esc_html( get_post_meta( get_the_ID(), 'my_eye_color', true ) );?></div>
<div>My DOB : <?php echo esc_html( get_post_meta( get_the_ID(), 'dob', true ) );?></div>
<div>My shoe size : <?php echo esc_html( get_post_meta( get_the_ID(), 'my_shoe_size', true ) );?></div>
<div>My body type : <?php echo esc_html( get_post_meta( get_the_ID(), 'my_body_type', true ) );?></div>
<div>My Zodiac Sign : <?php echo esc_html( get_post_meta( get_the_ID(), 'my_zodiac_sign', true ) );?></div>
<div>Experience in modeling : <?php echo esc_html( get_post_meta( get_the_ID(), 'experience_in_modeling', true ) );?></div>
<div>Professional Status : <?php echo esc_html( get_post_meta( get_the_ID(), 'professional_status', true ) );?></div>
<div>Model type : <?php echo esc_html( get_post_meta( get_the_ID(), 'model_type', true ) );?></div>
</div>


  
  <div class="looks_model">
  <h3>My Background/Values</h3>
  <div>My nationality :<?php echo esc_html( get_post_meta( get_the_ID(), 'nationality', true ) );?></div>
  <div>City :<?php $add =(get_post_meta( get_the_ID(), 'my_background_values', true ));
  print_r($add['city_name']);?>
  Country :<?php print_r($add['country_select']); ?> </div>
   </div>
   
   <div class="looks_model">
   <h3>My Lifestyle</h3>
   <div>My Profession :<?php echo esc_html( get_post_meta( get_the_ID(), 'my_profession', true ) );?></div>
  </div>
  
   <div class="looks_model">
   <h3>Languages</h3>
   <div><?php echo esc_html( get_post_meta( get_the_ID(), 'languages', true ) );?></div>
  </div>
  
   <div class="looks_model">
   <h3>About me/Projects/Work Done</h3>
   <div><?php echo esc_html( get_post_meta( get_the_ID(), 'about_me_projects_work_done', true ) );?></div>
  </div>
  
  <div class="looks_model">
   <h3>Social Links</h3>
   <div>Email id :<?php echo esc_html( get_post_meta( get_the_ID(), 'email_id', true ) );?></div>
   <div>Facebook id :<?php echo esc_html( get_post_meta( get_the_ID(), 'facebook_link', true ) );?></div>
  </div>
  
<div class="looks_model">
                    <h3>Contact Me</h3>
                    <div class="form-body">
                        <div>
                            <form>
                                <input id="email" required="" class="form-control col-lg-12" type="email" placeholder="Your Email" name="email">
                                <br>
                                <br>
                                <textarea id="content" class="form-control col-lg-12" name="content"></textarea>
                                <br><br> <br>
                                <input onclick="emailClicked()" type="button" class="btn btn-successs" value="Send">
                            </form>                            
                        </div>
                    </div>
                </div>
                
                
                

<?php
endwhile;

?>
<?php $emailid = esc_html( get_post_meta( get_the_ID(), 'email_id', true ) );?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>

function emailClicked() {
	var ajaxurl='<?php echo admin_url('admin-ajax.php'); ?>';
	var name = $('#email').val();
	var content = $('#content').val();
	var emailid='<?php echo $emailid;?>';
  var data = {
        action: 'get_postal_code',
        postal: name,content,emailid
    };
  $.post(ajaxurl, data, function(response) { alert(); });
}

</script>
<style>
.looks_model
{
	border:3px solid black;
	margin: 15px 0px;
}

</style>
<?php get_footer();?>