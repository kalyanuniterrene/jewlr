<?php

function getdarausingcurl($method, $url, $header, $data, $json){
    if( $method == 1 ){
        $method_type = 1; // 1 = POST
    }else{
        $method_type = 0; // 0 = GET
    }
 
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_HEADER, 0);

    if( $header !== 0 ){
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    }

    curl_setopt($curl, CURLOPT_POST, $method_type);
 
    if( $data !== 0 ){
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
 
    $response = curl_exec($curl);

    if( $json == 0 ){
        $json = $response;
    }else{
        $json = json_decode($response, true);
    }

    curl_close($curl);
 
    return $json;
}

?>
<?php

session_start();


include 'config.php'; // include app data
$session_data =  $_SESSION;
$user_id =  $session_data['user_info']['data']['id'];
$access_token =  $session_data['access_token'];
/* Get User popular media  */

$method = 0; // method = 1, because we want GET method

$url = "https://api.instagram.com/v1/users/$user_id/media/recent/?access_token=$access_token";

$header = 0; // header = 0, because we do not have header

$data = 0; // because we want GET method


$json = 0; // json = 1, because we want JSON response

$json_data  = getdarausingcurl($method, $url, $header, $data, $json);

$get_recent_media = json_decode($json_data);

?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://beta.canvassignages.com/skin/frontend/revivalpixel/canvas/css/canvas_live_editor/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="http://beta.canvassignages.com/skin/frontend/revivalpixel/canvas/css/canvas_live_editor/custom.css">

     <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

</head>
<body class="insta_photo">
    <header class="clearfix">
       <div class="logo">
          <a href="http://beta.canvassignages.com/">
             <img src="http://beta.canvassignages.com/skin/frontend/rwd/default/images/cs-logo.png" alt="CS">
          </a>
       </div> 
       <iframe src="https://instagram.com/accounts/logout/" width="0" height="0"></iframe>
       <a href="logout.php" class="logout">logout</a>
    </header>
    <div class="container">

        <div class="main">
            <h1>Instagram <span>recent photos</span></h1>
            <ul class="insta_grid">
                <?php
                foreach ($get_recent_media->data as $media) {
                    $content = '<li> <a href="javascript:void(0);">';
                    // output media
                    if ($media->type === 'video') {
                        // video
                        $poster = $media->images->low_resolution->url;
                        $source = $media->videos->standard_resolution->url;
                        $content .= "<video class=\"media video-js vjs-default-skin\" width=\"250\" height=\"250\" poster=\"{$poster}\"
                               data-setup='{\"controls\":true, \"preload\": \"auto\"}'>
                                 <source src=\"{$source}\" type=\"video/mp4\" />
                               </video>";
                    } else {
                        // image
                        $image = $media->images->low_resolution->url;
                        $content .= "<img class=\"media\" src=\"{$image}\"/>";
                    }
                    // create meta section
                    $avatar = $media->user->profile_picture;
                    $username = $media->user->username;
                    $comment = (!empty($media->caption->text)) ? $media->caption->text : '';
                    // $content .= "<div class=\"content\">
                    //            <div class=\"avatar\" style=\"background-image: url({$avatar})\"></div>
                    //            <p>{$username}</p>
                    //            <div class=\"comment\">{$comment}</div>
                    //          </div>";
                    // output media
                    echo $content . '</a> </li>';
                }
                ?>
                
            </ul>  
            <button type="button" class="upload_instaimg flickimage_upload">Upload Image</button>
            <div class="succesa">
                <div class="success_msg_area">
                    <p class="msg"><?php echo $count ?></p>
                    <button class="close_btn">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">

   jQuery(document).ready(function(){
    //This sessionStorage.getItem(); is also a predefined function in javascript
    //will retrieve session and get the value;
    var sessionid = sessionStorage.getItem("session_id");
    //alert(a);
    
    
    
    jQuery(document).on('click', '.insta_grid li', function(){          
             jQuery(this).toggleClass('select');               
           });

           jQuery(document).on('click','.upload_instaimg', function(){
           // console.log('jj');
                jQuery('.insta_grid .select').each(function(){
                    var selected_img=jQuery('.insta_grid .select img');
                     var img_arr = [];
                     var selectedimg=selected_img.length;
                     for ( var i = 0; i < selectedimg; i++ ) {
                        //console.log( );
                        var imgsrc= jQuery('.insta_grid .select:eq('+i+') img ').attr('src');                        
                            img_arr.push(  imgsrc );
                          }  
                          console.log(img_arr);
                          var url ='<?php echo  "http://beta.canvassignages.com/insta_recent_post/image_uploader.php" ; ?>';
                           $.ajax({
                             url: url,
                             data: {img_arr:img_arr , sessionid : sessionid},
                             type: "POST",
                             success: function(response)
                             {
                                 //alert(response); 
                                // console.log(response)
                                //jQuery('.succesa').html(response);  
                                //alert(response)  ;
                                successPop(response);
                                //window.close();                              
                                // $('.flickersrch-images').append(response);                          
                             }
                         });
                });
           });

           function successPop(response){
                jQuery('.succesa').css({'width':'100%', 'opacity':'1'});
                jQuery('.succesa .success_msg_area').append('');
                jQuery('.msg').html(response);
            } 

            jQuery(document).on('click', '.close_btn', function(){
               jQuery('.succesa').css({'width':'0', 'opacity':'0'});
                window.close();
            });

            

           }); 



</script>
</html>


<?php exit; ?>


