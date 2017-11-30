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
	<script src="http://code.jquery.com/jquery.min.js"></script>
	<script src="http://fabricjs.com/lib/fabric.js"></script>

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



<!-- 	<div class="controls">
 
  <label>Use WebGl<input type="checkbox" id="webgl" checked=""></label>
  <div id="bench"></div>
<p>
    <label><span>Grayscale:</span> <input type="checkbox" id="grayscale"></label><br>
    <label><span>Avg.</span> <input type="radio" id="average" name="grayscale"></label>
    <label><span>Lum.</span> <input type="radio" id="lightness" name="grayscale"></label>
    <label><span>Light.</span> <input type="radio" id="luminosity" name="grayscale"></label>
  </p>
	<p>
    <label><span>Contrast:</span> <input type="checkbox" id="contrast"></label>
    <br>
    <label>Value: <input type="range" id="contrast-value" value="0" min="-1" max="1" step="0.003921"></label>
  </p>
  <p>
    <label><span>Brightness:</span> <input type="checkbox" id="brightness"></label>
    <br>
    <label>Value: <input type="range" id="brightness-value" value="0.1" min="-1" max="1" step="0.003921"></label>
  </p>
  <p>
    <label><span>Sepia:</span> <input type="checkbox" id="sepia" ></label>
  </p>

  <p>
    <label><span>Vintage:</span> <input type="checkbox" id="vintage" ></label>
  </p>

  <p>
    <label><span>Technicolor:</span> <input type="checkbox" id="technicolor" ></label>
  </p>
 
   <p id="forGama">
    <label><span>Gamma:</span> <input type="checkbox" id="gamma" ></label>
    <br>
    <label>Red: <input type="range" id="gamma-red" value="1" min="0.2" max="2.2" step="0.003921" > <span class="rval"></span> </label>
    <br>
    <label>Green: <input type="range" id="gamma-green" value="1" min="0.2" max="2.2" step="0.003921" > <span class="rval"></span></label>
    <br>
    <label>Blue: <input type="range" id="gamma-blue" value="1" min="0.2" max="2.2" step="0.003921" ><span class="rval"></span></label>
  </p>  

  <p>
    <label><span>Hue:</span> <input type="checkbox" id="hue" ></label>
    <br>
    <label>Value: <input type="range" id="hue-value" value="0" min="-2" max="2" step="0.002" ></label>
  </p>
  <p>
  <label><span>Blend Color:</span> <input type="checkbox" id="blend" ></label>
  <br>
  <label>Mode:</label>
    <select id="blend-mode" name="blend-mode">
      <option selected="" value="add">Add</option>
      <option value="diff">Diff</option>
      <option value="subtract">Subtract</option>
      <option value="multiply">Multiply</option>
      <option value="screen">Screen</option>
      <option value="lighten">Lighten</option>
      <option value="darken">Darken</option>
      <option value="overlay">Overlay</option>
      <option value="exclusion">Exclusion</option>
      <option value="tint">Tint</option>
    </select>
    <br>
    <label>Color: <input type="color" id="blend-color" value="#00f900"></label><br>
    <label>Alpha: <input type="range" id="blend-alpha" min="0" max="1" value="1" step="0.01"></label><br>
  </p>
 
</div> -->










	<script src="canvas.js"></script>

</body>
</html>