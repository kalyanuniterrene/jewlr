jQuery(document).ready(function (argument) {  

var CurvedText = (function() {

    /**
    * Constructor
    * @method curvedText
    * @param canvas
    * @param {object} options
    */
    function CurvedText( canvas, options ){

      // Options
      this.opts = options || {};
      for ( var prop in CurvedText.defaults ) {
         if (prop in this.opts) { continue; }
         this.opts[prop] = CurvedText.defaults[prop];
      }

      this.canvas = canvas;
      this.group = new fabric.Group([], {selectable: this.opts.selectable});
      this.canvas.add( this.group ) ;
      this._forceGroupUpdate();
      this.setText( this.opts.text );
    }


    /**
    * @method set
    * @param {string} param
    * @param value
    * @return false if the param name is unknown
    */
    CurvedText.prototype.set = function( param, value ) {
      if ( this.opts[param] !== undefined ) {
        this.opts[param] = value;
        if ( param === 'fontSize' || param === 'fontWeight' ) {
          this._setFontStyles();
        }
        if ( param === 'selectable' ) {
          this.group.selectable = value;
        }
        if ( param === 'angle' ) {
          this._forceGroupUpdate();
        }

        this._render();
        return true;
      } else {
        return false;
      }
    };
    
    /**
    * @method get
    * @param {string} param
    * @return value of param, or false if unknown
    */
    CurvedText.prototype.get = function( param ) {
      this._render();
      if ( this.opts[param] !== undefined ) {
        return this.opts[param];
      } else {
        return false;
      }
    };
    
    /**
    * @method getParams
    * @return {object} value of every options
    */
    CurvedText.prototype.getParams = function() {
      this._render();
      return this.opts;
    };
    
    /**
    * Center the group in canvas
    * @method center
    * @return {object} with top and left
    */
    CurvedText.prototype.center = function() {
      //alert(this.canvas.height);
      this.opts.top = this.canvas.height / 2;
      this.opts.left = this.canvas.width / 2;
      this._render();
      return { top:this.opts.top, left:this.opts.left };
    };
    
    /**
    * Remove all letters from canvas
    * @method remove
    */
    CurvedText.prototype.remove = function() {
      var size = this.group.size();
      for ( var i=size; i>=0; i-- ){
        this.group.remove( this.group.item(i) );
      }
      this.canvas.renderAll();
    };
    
    /**
    * Used to change the text
    * @method setText
    * @param {string} newText
    */
    CurvedText.prototype.setText = function( newText ) {

      while ( newText.length !== 0 && this.group.size() >= newText.length ) {
        this.group.remove( this.group.item( this.group.size()-1 ) );
      }
      
      for ( var i=0; i<newText.length; i++ ){
        if ( this.group.item(i) === undefined ){
          var letter = new fabric.Text(newText[i], {
            selectable: true
          });
          this.group.add( letter );
        }
        else{
          this.group.item(i).text = newText[i];
        }
      }
      this.opts.text = newText;
      this._setFontStyles();
      this._render();
    };
    
    /**
    * Update font size and weight
    * @private
    * @method _setFontStyles
    */
    CurvedText.prototype._setFontStyles = function() {
      for ( var i=0; i<this.group.size(); i++ ){
        /*this.group.item(i).set("fontsize", this.opts.fontSize );
        this.group.item(i).set("color", '#fff' );*/
        this.group.item(i).fontWeight = this.opts.fontWeight ;
        this.group.item(i).fontSize = this.opts.fontSize ;
      }
    };

    /**
    * Force update group scale and angles
    * @private
    * @method _forceGroupUpdate
    */
    CurvedText.prototype._forceGroupUpdate = function() {
      this.opts.angle = -0;
      
      this.group.set("angle",357.56067886028063 );
      this.group.scaleX = 0.9348010887618413;
      this.group.scaleY = 0.34854389452760204;
      
      this.group.currentWidth = 173.4555747694377;
      this.group.currentHeight = 25.896702229525328;
      this.group.left = 115;
      this.group.top = 120;
      
      this._render();
    };


    /**
    * calculate the position and angle of each letter
    * @private
    * @method _render
    */
    CurvedText.prototype._render = function() {
        var curAngle=0,angleRadians=0, align=0;

        // Object may have been moved with drag&drop
        /*if ( this.group.hasMoved() ) {*/
          this.opts.top = this.group.top;
          this.opts.left = this.group.left;
        /*}*/
        this.opts.angle = -0;
        this.opts.scaleX = this.group.scaleX;
        this.opts.scaleY = this.group.scaleY;


        // Text align
        if ( this.opts.align === 'center' ) {
          align = ( this.opts.spacing / 2) * ( this.group.size() - 1) ;
        } else if ( this.opts.align === 'right' ) {
          align = ( this.opts.spacing ) * ( this.group.size() - 1) ;
        }
        
        for ( var i=0; i<this.group.size(); i++) {
          // Find coords of each letters (radians : angle*(Math.PI / 180)
          if ( this.opts.reverse ) {
            curAngle = (-i * parseInt( this.opts.spacing, 10 )) + align;
            angleRadians = curAngle * (Math.PI / 180);
            this.group.item(i).set( 'top', (Math.cos( angleRadians ) * this.opts.radius) );
            this.group.item(i).set( 'left', (-Math.sin( angleRadians ) * this.opts.radius) );
          } else {
            curAngle = (i * parseInt( this.opts.spacing, 10)) - align;
            angleRadians = curAngle * (Math.PI / 180);
            this.group.item(i).set( 'top', (-Math.cos( angleRadians ) * this.opts.radius) );
            this.group.item(i).set( 'left', (Math.sin( angleRadians ) * this.opts.radius) ) ;
          }

          //alert(curAngle);


          this.group.item(i).set("angle",curAngle );
          
        }
        
        // Update group coords
        this.group._calcBounds();
        this.group._updateObjectsCoords();
        this.group.top = this.opts.top;
        
        this.group.left = this.opts.left;
        this.group.setCoords();

        this.canvas.renderAll();
    };



   
    return CurvedText;





})();

function createImage(){

    /*canvas = new fabric.Canvas('c1');*/

  var src = jQuery('.fancy-image1').attr('src');

  canvas.setBackgroundImage(src, canvas.renderAll.bind(canvas));


  var original = canvas.getActiveObject();


    var str = jQuery('#eng_input_text1').val();
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
      spacing: 30,
      radius: 100,
      text: str,
      align: 'center',
      reverse: false,
      fontSize: 28,
      fontWeight: 'bold',
      selectable: true
    };
    Example = new CurvedText( canvas, {angle:50} );

    Example.setText( str ) ;


    /*Checking the length and min is 5*/

    /*case 1*/

    Example.set( 'currentHeight', 5.003672418653247 ) ;

    if(n<=3)
    {
      
      
      Example.center();
      Example.set( 'reverse', true ) ;
      Example.set( 'top', 132 ) ; 
      Example.set( 'spacing', 8 ) ; 
      Example.set( 'left', 204.33475249083943 ) ; 
      Example.set( 'radius', 100 ) ; 
      Example.set( 'width', 178.13589139289846 ) ; 
       Example.set( 'reverse', false ) ;  
    }
    if(n>3 && n<=5)
    {
      
      
      Example.center();
      Example.set( 'reverse', true ) ;
      Example.set( 'top', 132 ) ; 
      Example.set( 'spacing', 8 ) ; 
      Example.set( 'left', 204.33475249083943 ) ; 
      Example.set( 'radius', 100 ) ; 
      Example.set( 'width', 178.13589139289846 ) ; 
       Example.set( 'reverse', false ) ;  
    }

    if(n>5 && n<=7)
    {
      
      
      Example.center();
      Example.set( 'reverse', true ) ;
      Example.set( 'top', 132 ) ; 
      Example.set( 'spacing', 8 ) ; 
      Example.set( 'left', 204.33475249083943 ) ; 
      Example.set( 'radius', 100 ) ; 
      Example.set( 'width', 178.13589139289846 ) ; 
       Example.set( 'reverse', false ) ;  
    }


    if(n>7 && n<=9)
    {
      console.log(n);
      //Example = new CurvedText( canvas, {angle:50} );
      Example.center();
      Example.set( 'reverse', true ) ;
      Example.set( 'top', 132 ) ; 
      Example.set( 'spacing', 8 ) ; 
      Example.set( 'left', 204.33475249083943 ) ; 
      Example.set( 'radius', 100 ) ; 
      Example.set( 'width', 178.13589139289846 ) ; 
       Example.set( 'reverse', false ) ;  
    }

    if(n==10)

    {
      Example.center();
      Example.set( 'reverse', true ) ;
      Example.set( 'top', 132 ) ; 
      Example.set( 'spacing', 8 ) ; 
      Example.set( 'left', 204.33475249083943 ) ; 
      Example.set( 'radius', 100 ) ; 
      Example.set( 'width', 178.13589139289846 ) ; 
       Example.set( 'reverse', false ) ;  
    }



    if(n>10 && n<=16){
      console.log(n);
      //Example = new CurvedText( canvas, {angle:50} );
      Example.center();
      Example.set( 'reverse', true ) ;
      Example.set( 'top', 160 ) ; 
      Example.set( 'spacing', 8 ) ; 
      Example.set( 'left', 200.33475249083943 ) ; 
      Example.set( 'radius', 130 ) ; 
      Example.set( 'width', 178.13589139289846 ) ; 
       Example.set( 'reverse', false ) ;  
    
    }

    

  

 
 
  jQuery('.radius, .spacing, .align, .fontSize').change(function(){
    Example.set( jQuery(this).attr('class'), jQuery(this).val() ) ;    
  });
  jQuery('.reverse').change(function(){
    Example.set( 'reverse', ( jQuery(this).val() == 'true' ) ) ;    
  });

//alert(canvas.getObjects().length);
var le = canvas.getObjects().length;
canvas.setActiveObject(canvas.item(le-1));


  }


jQuery('#eng_input_text1').keyup(function(){

  //createImage();

});

jQuery('.eng1').click(function(){

  createImage();

      var newsrc = canvas.toDataURL();

     jQuery('.fancy-image1').attr('old-url',jQuery('fancy-image1').attr('src'));

      jQuery('.fancy-image1').attr('src',newsrc);

   });


var canvas = new fabric.Canvas('c');

var counter;

function createCanvasImage (counter,metal_org,color_org,style_org,stone_org,extra_folder){

  var i = counter;


  //alert(i);

  

  //var sku = jQuery(this).find('img').attr('data-sku');

  jQuery('#metal').val(1);

  jQuery('#style').val(style_org);


   var s = stone_org.split(',');



  //jQuery('#stone').val(stone_org);

  
  
  // get the color code and then explode
  var v = color_org.split(',');



  jQuery('#color').attr('data-val1',v[0]);
  jQuery('#color').attr('data-val2',v[1]);
  jQuery('#color').attr('data-val3',v[2]);




  
    //alert(metal_data);
   // var url_param='http://localhost/public_sc/jewlr/file_path/index.php?metal='+metal+'&view=1&style='+style+'&stone='+stone+'&color='+color;





var view = jQuery('#view').val();
var h = jQuery('#height').val();
var w = jQuery('#width').val();

var stone_new="";
var stone_1 = jQuery('#stone').val();
var stone_2 = '';
if(jQuery(document).find('#stone2').length > 0){
  stone_2 = jQuery('#stone2').val(); 

  //stone_new =  'http://localhost/public_sc/jewlr/file_path/style/view_'+ i +'/'+jQuery('#style').val() +'/2/'+ stone_2 +'.png';

  if(i==1)
  {
    stone_new =  'http://localhost/public_sc/jewlr/file_path/style/view_'+ 1 +'/'+jQuery('#style').val() +'/2/'+ stone_2 +'.png';
  }

  if(i==2)
  {
    stone_new =  'http://localhost/public_sc/jewlr/file_path/style/view_'+ 2 +'/'+jQuery('#style').val() +'/2/'+ stone_2 +'.png';
  }
  if(i==3)
  {
    stone_new =  'http://localhost/public_sc/jewlr/file_path/style/view_'+ 3 +'/'+jQuery('#style').val() +'/2/'+ stone_2 +'.png';
  }
  if(i==4)
  {
    stone_new =  'http://localhost/public_sc/jewlr/file_path/style/view_'+ 4 +'/'+jQuery('#style').val() +'/2/'+ stone_2 +'.png';
  }
  if(i==5)
  {
    stone_new =  'http://localhost/public_sc/jewlr/file_path/style/view_'+ 5 +'/'+jQuery('#style').val() +'/2/'+ stone_2 +'.png';
  }
  
  console.log(stone_new);
  //alert(stone_new);
}


  

var metal = 'http://localhost/public_sc/jewlr/file_path/'+'metal/'+jQuery('#metal').val() +'/view_'+i +'/'+jQuery('#metal').val() +'.png';
var style = 'http://localhost/public_sc/jewlr/file_path/'+'style/view_'+ i +'/'+jQuery('#style').val() +'.png';
var stone = 'http://localhost/public_sc/jewlr/file_path/'+'style/view_'+ i +'/'+jQuery('#style').val() +'/'+ stone_1 +'.png';
var metal_shadow = 'http://localhost/public_sc/jewlr/file_path/'+'metal/'+jQuery('#metal').val() +'/view_'+ i +'/shadow_'+jQuery('#metal').val() +'.png';
var img_Url =i+'.png' ;
var v1 = v[0];
var v2 = v[1];
var  v3 = v[2];
var glow = parseFloat(jQuery('#glow').val());
canvas.setHeight(h);
canvas.setWidth(w);

//alert(v1);


var session_id = jQuery('#session_id').val();






  fabric.Image.fromURL(metal_shadow, function(img) {
    var img1 = img.scale(0.5).set({ left: 0, top: 0 });

    fabric.Image.fromURL(metal, function(img) {

      //alert(v1);

        var img2 = img.scale(0.5).set({ left: 0, top: 0 });
             img2.filters.push(
              new fabric.Image.filters.Gamma({gamma: [v1, v2, v3]}),
               new fabric.Image.filters.Brightness({ brightness: glow })
              );
             img2.applyFilters();

        fabric.Image.fromURL(style, function(img) {
            var img3 = img.scale(0.5).set({ left: 0, top: 0 });
                img3.filters.push(
              new fabric.Image.filters.Gamma({gamma: [v1, v2, v3]}),
               new fabric.Image.filters.Brightness({ brightness: glow })
              );
             img3.applyFilters();

            fabric.Image.fromURL(stone, function(img) {
            var img4 = img.scale(0.5).set({ left: 0, top: 0 });

                if(stone_2 == ''){

                              var ttt = new fabric.Text('foo', { 
                                        fontFamily: 'Delicious_500', 
                                        left: 150, 
                                        top: 120 ,
                                        fontSize: 20
                                      });

                              if(i==1)
                              {
                                canvas.add(new fabric.Group([img1, img2, img3, img4], { left: 0, top: 0}));
                              }
                              else{
                                
                                canvas.add(new fabric.Group([img1, img2, img3, img4], { left: 0, top: 0}));
                              }

                  
                  var v = canvas.toDataURL();  

                  //jQuery('body').append('<img src='+ v +'>');

                  

                 // alert(i);

                  jQuery.ajax({
                        url: "http://localhost/public_sc/jewlr/file_path/process.php",
                        data: {imageData:v,session_id:session_id,view:i,extra_folder:extra_folder},
                        type: "POST",
                          success: function(response)
                          {

                             //alert(response);

                             var result = jQuery.trim(response);

                             //alert(response);
                             jQuery('.fancy-image'+result).attr('src','');

                             jQuery('.fancy-image'+result).attr('src','http://localhost/public_sc/jewlr/file_path/'+session_id+'/'+extra_folder+'/'+result+'.png');

                             //getCanvasImage(session_id);
                           
                          }
                        });




                }else{
                     fabric.Image.fromURL(stone_new, function(img) {
                      var img5 = img.scale(0.5).set({ left: 0, top: 0 });

                        canvas.add(new fabric.Group([img1, img2, img3, img4, img5], { left: 0, top: 0}));

                        var v = canvas.toDataURL();  

                        //jQuery('body').append('<img src='+ v +'>');

                        jQuery.ajax({
                        url: "http://localhost/public_sc/jewlr/file_path/process.php",
                        data: {imageData:v,session_id:session_id,view:i,extra_folder:extra_folder},
                        type: "POST",
                          success: function(response)
                          {

                             var result = jQuery.trim(response);

                             //alert(response);
                             jQuery('.fancy-image'+result).attr('src','');

                             jQuery('.fancy-image'+result).attr('src','http://localhost/public_sc/jewlr/file_path/'+session_id+'/'+extra_folder+'/'+result+'.png');
                           
                          }
                        });


                      });  
                }   

            });
        });
    });
});
/*canvas.renderAll();*/
createImage();
/*canvas.renderAll();*/

} // end of createCanvasImage




  
//alert(i);

jQuery(document).on('click','.metal_type',function(){


  var extra_folder = Math.floor((Math.random() * 100) + 1);



   var con =1;

   for (var con = 1; con <= 1; con++) {

    var metal_org = jQuery(this).attr('data-metal');
    var color_org = jQuery(this).attr('data-color');
    var style_org = jQuery(".face-option.selected-item").attr('data-styleorder');
    var stone_org = jQuery(".stone-option.selected-item").attr('data-stoneorder');
    

   createCanvasImage (con,metal_org,color_org,style_org,stone_org,extra_folder);
     
   }

});

jQuery(document).on('click','.face-option',function(){
   
    var extra_folder = Math.floor((Math.random() * 100) + 1);

    var con =1;

   for (var con = 1; con <= 1; con++) {

     
    var style_org = jQuery(this).attr('data-styleorder');
    var metal_org = jQuery(".metal_type.selected-item").attr('data-metal');
    var color_org = jQuery(".metal_type.selected-item").attr('data-color');
    
    var stone_org = jQuery(".stone-option.selected-item").attr('data-stoneorder');
    

    createCanvasImage (con,metal_org,color_org,style_org,stone_org,extra_folder);
     
   }

});

jQuery(document).on('click','.stone-option',function(){


    //getting the selected stone value of the each panel

    var side1_stone1_selected = jQuery(".ranitul-0").find('.selected-item').attr('data-stoneorder');


    var side1_stone2_selected =  jQuery(".ranitul-1").find('.selected-item').attr('data-stoneorder');

    console.log('side1_stone2_selected '+ side1_stone2_selected +' side1_stone1_selected ' + side1_stone1_selected);

    //for the front view only

    var stone_org;

    if(side1_stone1_selected !=undefined)
    {
      stone_org = side1_stone1_selected;
    }

    if(side1_stone2_selected !=undefined)
    {
      stone_org = side1_stone1_selected+','+side1_stone2_selected;
    }

    jQuery('#stone').val(side1_stone1_selected);
    jQuery('#stone2').val(side1_stone2_selected);

    //console.log(jQuery('#stone2').val());


    var extra_folder = Math.floor((Math.random() * 100) + 1);

    var con =1;


   for (var con = 1; con <= 1; con++) {
   
    var color_org =jQuery(".metal_type.selected-item").attr("data-color");
    var metal_org =jQuery(".metal_type.selected-item").attr("data-metal");
    var style_org=jQuery(".face-option.selected-item").attr("data-styleorder");
    //var stone_org=jQuery(this).attr("data-stoneorder");

     createCanvasImage (con,metal_org,color_org,style_org,stone_org,extra_folder);
     
   }


});


  fabric.Object.prototype.transparentCorners = false;
  var $ = function(id){return document.getElementById(id)};

  //canvas.deactivateAll().renderAll();
  f = fabric.Image.filters;

  canvas.on({
    'object:selected': function() {
      fabric.util.toArray(document.getElementsByTagName('input'))
                          .forEach(function(el){ el.disabled = false; })

      var filters = ['grayscale', 'invert', 'remove-color', 'sepia', 'brownie',
                      'brightness', 'contrast', 'saturation', 'noise', 'vintage',
                      'pixelate', 'blur', 'sharpen', 'emboss', 'technicolor',
                      'polaroid', 'blend-color', 'gamma', 'kodachrome',
                      'blackwhite', 'blend-image', 'hue', 'resize'];

      for (var i = 0; i < filters.length; i++) {
        $(filters[i]) && (
        $(filters[i]).checked = !!canvas.getActiveObject().filters[i]);
      }
    },
    'selection:cleared': function() {
      fabric.util.toArray(document.getElementsByTagName('input'))
                          .forEach(function(el){ el.disabled = true; })
    }
  });

  function applyFilter(index, filter) {
    var obj = canvas.getActiveObject();
    obj.filters[index] = filter;
    var timeStart = +new Date();
    obj.applyFilters();
    var timeEnd = +new Date();
    var dimString = canvas.getActiveObject().width + ' x ' +
      canvas.getActiveObject().height;
    $('bench').innerHTML = dimString + 'px ' +
      parseFloat(timeEnd-timeStart) + 'ms';
    canvas.renderAll();
  }

  function getFilter(index) {
    var obj = canvas.getActiveObject();
    return obj.filters[index];
  }
  function applyFilterValue(index, prop, value) {
    var obj = canvas.getActiveObject();
    if (obj.filters[index]) {
      obj.filters[index][prop] = value;
      var timeStart = +new Date();
      obj.applyFilters();
      var timeEnd = +new Date();
      var dimString = canvas.getActiveObject().width + ' x ' +
        canvas.getActiveObject().height;
      $('bench').innerHTML = dimString + 'px ' +
        parseFloat(timeEnd-timeStart) + 'ms';
      canvas.renderAll();
    }
  }


  });