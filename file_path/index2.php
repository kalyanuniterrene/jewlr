<?php


	$view = 1;
	$width = 600;
	$height = 600;
	$width = 600;
	$style = '1';
	$stone = '1';
	$metal = '2';
	$color = '1,1,1';
	$glow = '0.02';
	if(isset($_REQUEST['view'])){
		$view =  $_REQUEST['view'];		
	}
	if(isset($_REQUEST['height'])){
		$height =  $_REQUEST['height'];		
	}
	if(isset($_REQUEST['width'])){
		$width =  $_REQUEST['width'];		
	}
	if(isset($_REQUEST['style'])){
		$style =  $_REQUEST['style'];		
	}
	if(isset($_REQUEST['stone'])){
		$stone =  $_REQUEST['stone'];		
	}
	if(isset($_REQUEST['metal'])){
		 $metal =  $_REQUEST['metal'];		
	}
	if(isset($_REQUEST['color'])){
		$color =  $_REQUEST['color'];		
	}
	if(isset($_REQUEST['glow']) && !empty($_REQUEST['glow'])){
		$glow =  $_REQUEST['glow'];		
	}

    if(empty($_REQUEST['color'])){

    	$color = '1,1,1';
    }

	$exp = explode(",",$color);

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="http://localhost/public_sc/jewlr/file_path/jquery.min.js"></script>
	<script src="http://localhost/public_sc/jewlr/file_path/fabric.js"></script>
	

	<style>	
	#c{
		border:1px solid #ddd;
	}
	.canvas-container{
		float: left;	
    display: none;
	}
	img{
		float: left;
	}
	</style>
</head>
<body>
	<input type="hidden" id="view" value="<?php echo $view; ?>">	
	<input type="hidden" id="height" value="<?php echo $height; ?>">	
	<input type="hidden" id="width" value="<?php echo $width; ?>">	
	<input type="hidden" id="style" value="<?php echo $style; ?>">	
	<input type="hidden" id="stone" value="<?php echo $stone; ?>">	
	<input type="hidden" id="metal" value="<?php echo $metal; ?>">	
	<input type="hidden" id="glow" value="<?php echo $glow; ?>">	
	<input type="hidden" id="color" data-val1="<?php echo $exp[0]; ?>" data-val2="<?php echo $exp[1]; ?>" data-val3="<?php echo $exp[2]; ?>">	

	<canvas id="c" ></canvas>

  <script src="http://localhost/public_sc/jewlr/file_path/canvas.js"></script>

</body>
</html>

