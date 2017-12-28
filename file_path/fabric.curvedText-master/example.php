<!DOCTYPE html>
<html lang="en">
<head>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  
  <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/fabric.js/1.2.0/fabric.all.min.js"></script>
  <script type="text/javascript" src="curvedText.js"></script> 

<style type="text/css">

canvas {  border:1px solid #000;     }
.controles {  margin:50px 0;   }

</style>

<script>

$(document).ready(function(){

/* var zcanvas = new fabric.Canvas('c1');

zcanvas.setBackgroundImage('http://uniterreneprojects.com/dev/jewlr/media/catalog/product/cache/2/thumbnail/400x/9df78eab33525d08d6e5fb8d27136e95/1/_/1_1_3.png', zcanvas.renderAll.bind(zcanvas));

var tri = new fabric.Triangle();
tri.set({
  width: 70, 
  height: 70, 
  
  fill: 'red'
})


$('canvas').on('click', function() {
  zcanvas.toDataURL();
});
*/




  canvas = new fabric.Canvas('c');

  canvas.setBackgroundImage('http://uniterreneprojects.com/dev/jewlr/media/catalog/product/cache/2/thumbnail/400x/9df78eab33525d08d6e5fb8d27136e95/1/_/1_1_3.png', canvas.renderAll.bind(canvas));

    var str = 'Canvas Canaaa a';
    var n = str.length;
     /**
    * Default options
    */
    CurvedText.defaults = {
      top: 0,
      left: 0,
      scaleX: 1,
      scaleY: 1,
      angle: 40,
      spacing: 20,
      radius: 100,
      text: str,
      align: 'center',
      reverse: false,
      fontSize: 20,
      fontWeight: 'bold',
      selectable: true
    };
    Example = new CurvedText( canvas, {angle:50} );

    /*Checking the length and min is 5*/

    /*case 1*/

    if(n<=3)
    {
      
      
      Example.center();
      Example.set( 'reverse', true ) ;
      Example.set( 'top', 318 ) ; 
      Example.set( 'spacing', 15 ) ; 
      Example.set( 'radius', 60 ) ; 
    }
    if(n>3 && n<=5)
    {
      
      
      Example.center();
      Example.set( 'reverse', true ) ;
      Example.set( 'top', 316 ) ; 
      Example.set( 'spacing', 15 ) ; 
      Example.set( 'radius', 60 ) ; 
    }

    if(n>5 && n<=7)
    {
      
      
      Example.center();
      Example.set( 'reverse', true ) ;
      Example.set( 'top', 314 ) ; 
      Example.set( 'spacing', 15 ) ; 
      Example.set( 'radius', 60 ) ; 
    }


    if(n>7 && n<=9)
    {
      console.log(n);
      //Example = new CurvedText( canvas, {angle:50} );
      Example.center();
      Example.set( 'reverse', true ) ;
      Example.set( 'top', 312 ) ; 
      Example.set( 'spacing', 13 ) ; 
      Example.set( 'radius', 70 ) ; 
    }

    if(n==10)

    {
      Example.center();
      Example.set( 'reverse', true ) ;
      Example.set( 'top', 312 ) ; 
      Example.set( 'spacing', 10 ) ; 
      Example.set( 'radius', 70 ) ; 
    }



    if(n>10 && n<=16){
      console.log(n);
      //Example = new CurvedText( canvas, {angle:50} );
      Example.center();
      Example.set( 'reverse', true ) ;
      Example.set( 'top', 308 ) ; 
      Example.set( 'spacing', 10 ) ; 
      Example.set( 'radius', 70 ) ; 
    /*  Example.set( 'top', 306.36791386064965 ) ; 
      Example.set( 'width', 194.196767947182 ) ; 
      Example.set( 'left', 201.22792707098358 ) ; 
      Example.set( 'currentHeight', 34.76984194294749 ) ; 
      Example.set( 'currentWidth', 149.23865655999336 ) ; 
      Example.set( 'height', 70.33726119594007 ) ; 
      Example.set( 'spacing', 6 ) ; 
      Example.set( 'radius', 80 ) ;*/ 
    }

    

  

 
 
  $('.radius, .spacing, .align, .fontSize').change(function(){
    Example.set( $(this).attr('class'), $(this).val() ) ;    
  });
  $('.reverse').change(function(){
    //alert(( $(this).val() == 'true' ) );
    Example.set( 'reverse', true ) ;    
  });
  $('.text').keyup(function(){



    
    Example.setText( $(this).val() ) ;
  });

function onObjectSelected(o){
    //activeObject = canvas.getActiveObject()
    activeObject = o.target;
    console.log(o.target);

    if(activeObject.isType('text')){
       

    }
    else if(activeObject.isType('image')){
      //display image
    }
    else if( activeObject.isType('xyz')){
      //display shape logic
    }
}

canvas.on('object:selected', onObjectSelected);

  
  



});

</script>

</head>
<body>
<!-- <textarea id="wtd_new_text" rows="1" cols="50"></textarea>
<button id="btn_AddText"  onclick="setText()">Add Text</button>
<button id="btn_UpdateText" onclick="updateText()">Update Text</button> -->

  <canvas id="c" width="400" height="400"></canvas>
  <br>
  <input type="text" class="text" value="Curved text"><br>
  Rayon : <input type="range"  min="0" max="100" value="50" class="radius" /><br>
  Espacement : <input type="range"  min="5" max="40" value="20" class="spacing" /><br>
  inverser le texte : <label><input type="radio" name="reverse" class="reverse" value="true" checked="checked"/> Oui</label> <label><input type="radio" name="reverse" class="reverse" value="false"  /> Non</label><br />
  Alignement : <label><input type="radio" name="align" class="align" value="left" /> Gauche</label> <label><input type="radio" name="align" class="align" value="center" checked="checked" /> Centr�</label>  <label><input type="radio" name="align" class="align" value="right" /> Droite</label><br >
  Taille du texte : <input type="range"  min="3" max="100" value="20" class="fontSize" /><br> 



  <!-- <canvas id="c1" width="600" height="600"> -->
  
</canvas>


<script>

/*function setText() {
curved = new CurvedText( canvas, {spacing:20,radius:50,text:$('textarea#wtd_new_text').val(),reverse:false,angle:0,fontSize:16} );
}    

function updateText() {
  var original = canvas.getActiveObject();
  //canvas.remove(original);
 // setText();
  original.set({
    angle:-2.4602118704557454,currentHeight:24.73012304806753,currentWidth:132.89480561673753,height:70.95267894904724,left:206.9826127300608,scaleX:0.9348010887618413,scaleY:0.34854389452760204,top:312.5357754643744,width:142.16372575342075
  }).setCoords();
  canvas.renderAll();
}*/
</script>

</body>
</html>
