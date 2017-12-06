
jQuery(document).ready(function (argument) {  

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

                  canvas.add(new fabric.Group([img1, img2, img3, img4], { left: 0, top: 0}));
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




} // end of createCanvasImage




  
//alert(i);

jQuery(document).on('click','.metal_type',function(){


  var extra_folder = Math.floor((Math.random() * 100) + 1);



   var con =1;

   for (var con = 1; con <= 5; con++) {

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

   for (var con = 1; con <= 5; con++) {

     
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


   for (var con = 1; con <= 5; con++) {
   
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