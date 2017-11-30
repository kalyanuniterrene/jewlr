
jQuery(document).ready(function (argument) {  

var canvas = new fabric.Canvas('c');

var view = jQuery('#view').val();
var h = jQuery('#height').val();
var w = jQuery('#width').val();
var stone_1 = jQuery('#stone').val();
var stone_2 = '';
if(jQuery(document).find('#stone2').length > 0){
  stone_2 = jQuery('#stone2').val(); 
  stone_new =  'style/view_'+ view +'/'+jQuery('#style').val() +'/2/'+ stone_2 +'.png';
}

var metal = 'metal/'+jQuery('#metal').val() +'/view_'+view +'/'+jQuery('#metal').val() +'.png';
var style = 'style/view_'+ view +'/'+jQuery('#style').val() +'.png';
var stone = 'style/view_'+ view +'/'+jQuery('#style').val() +'/'+ stone_1 +'.png';
var metal_shadow = 'metal/'+jQuery('#metal').val() +'/view_'+ view +'/shadow_'+jQuery('#metal').val() +'.png';
var img_Url =view+'.png' ;
var v1 = parseFloat(jQuery('#color').data('val1'));
var v2 = parseFloat(jQuery('#color').data('val2'));
var  v3 = parseFloat(jQuery('#color').data('val3'));
var glow = parseFloat(jQuery('#glow').val());
canvas.setHeight(h);
canvas.setWidth(w);

// fabric.Image.fromURL(metal_shadow, function(myImg) {
//     var img1 = myImg.set({ 
//        left: 0,
//         top: 0,
      
//     }).scale(.5);
  
//     //canvas.add(img1);
//      canvas.insertAt(img1,0);
//     canvas.centerObject(img1);
// });
// canvas.renderAll();

// fabric.Image.fromURL(metal, function(myImg) {
//     var img1 = myImg.set({ 
//        left: 0,
//         top: 0,
      
//     }).scale(.5);

//       img1.filters.push(
//         new fabric.Image.filters.Gamma({gamma: [v1, v2, v3]}),
//          new fabric.Image.filters.Brightness({ brightness: glow })
//         );
//    img1.applyFilters();
    
//     //canvas.add(img1);
//     canvas.insertAt(img1,1);
//     canvas.centerObject(img1);
// });
// canvas.renderAll();

// fabric.Image.fromURL(style, function(myImg) {
//     var img1 = myImg.set({ 
//        left: 0,
//         top: 0,
      
//     }).scale(.5);
//       img1.filters.push(
//         new fabric.Image.filters.Gamma({gamma: [v1, v2, v3]}),
//          new fabric.Image.filters.Brightness({ brightness: glow })
//         );
//        img1.applyFilters();
//     //canvas.add(img1);
//     canvas.insertAt(img1,8);
//     canvas.centerObject(img1);
// });
// canvas.renderAll();

// var img_stone = fabric.Image.fromURL(stone, function(myImg) {
//     var img1 = myImg.set({ 
//        left: 0,
//         top: 0,
       
//     }).scale(.5);
//      //canvas.add(img1);
//     //canvas.insertAt(img1,9);
//     canvas.centerObject(img1);
// });

// canvas.renderAll();



// fabric.Image.fromURL(metal_shadow, function(img) {
//     var img1 = img.scale(0.5).set({ left: 0, top: 0 });

//     fabric.Image.fromURL(metal, function(img) {
//         var img2 = img.scale(0.5).set({ left: 0, top: 0 });
//              img2.filters.push(
//               new fabric.Image.filters.Gamma({gamma: [v1, v2, v3]}),
//                new fabric.Image.filters.Brightness({ brightness: glow })
//               );
//              img2.applyFilters();

//         fabric.Image.fromURL(style, function(img) {
//             var img3 = img.scale(0.5).set({ left: 0, top: 0 });
//                 img3.filters.push(
//               new fabric.Image.filters.Gamma({gamma: [v1, v2, v3]}),
//                new fabric.Image.filters.Brightness({ brightness: glow })
//               );
//              img3.applyFilters();

//             fabric.Image.fromURL(stone, function(img) {
//             var img4 = img.scale(0.5).set({ left: 0, top: 0 });

//                 canvas.add(new fabric.Group([img1, img2, img3, img4], { left: 0, top: 0 }));
//             });
//         });
//     });
// });



jQuery(window).on('load',function(){
  fabric.Image.fromURL(metal_shadow, function(img) {
    var img1 = img.scale(0.5).set({ left: 0, top: 0 });

    fabric.Image.fromURL(metal, function(img) {
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

                  jQuery('body').append('<img src='+ v +'>');

                }else{
                     fabric.Image.fromURL(stone_new, function(img) {
                      var img5 = img.scale(0.5).set({ left: 0, top: 0 });

                        canvas.add(new fabric.Group([img1, img2, img3, img4, img5], { left: 0, top: 0}));
                        var v = canvas.toDataURL();  

                        jQuery('body').append('<img src='+ v +'>');


                      });  
                }   

            });
        });
    });
});


//alert(canvas.getObjects().length);
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

//   $('grayscale').onclick = function() {
//     applyFilter(0, this.checked && new f.Grayscale());
//   };
//   $('average').onclick = function() {
//     applyFilterValue(0, 'mode', 'average');
//   };
//   $('luminosity').onclick = function() {
//     applyFilterValue(0, 'mode', 'luminosity');
//   };
//   $('lightness').onclick = function() {
//     applyFilterValue(0, 'mode', 'lightness');
//   };

//    $('technicolor').onclick = function() {
//     applyFilter(14, this.checked && new f.Technicolor());
//   };

//     $('hue').onclick= function() {
//     applyFilter(21, this.checked && new f.HueRotation({
//       rotation: document.getElementById('hue-value').value,
//     }));
//   };

//     $('sepia').onclick = function() {
//       applyFilter(3, this.checked && new f.Sepia());
//     };

//     $('gamma').onclick = function () {
//       var v1 = parseFloat($('gamma-red').value);
//       var v2 = parseFloat($('gamma-green').value);
//       var v3 = parseFloat($('gamma-blue').value);
//       v1 = 1.984055;
//       v2 = 1.68998;
//       v3 = 0.588179;
//       applyFilter(17, this.checked && new f.Gamma({
//         gamma: [v1, v2, v3],
        
//       }));
//        applyFilter(17, this.checked && new f.Gamma({
//         gamma: [v1, v2, v3],
        
//       }));
//     };
//     $('gamma-red').oninput = function() {
//       var current = getFilter(17).gamma;
//       current[0] = parseFloat(this.value);
//       applyFilterValue(17, 'gamma', current);
//     };
//     $('gamma-green').oninput = function() {
//       var current = getFilter(17).gamma;
//       current[1] = parseFloat(this.value);
//       applyFilterValue(17, 'gamma', current);
//     };
//     $('gamma-blue').oninput = function() {
//       var current = getFilter(17).gamma;
//       current[2] = parseFloat(this.value);
//       applyFilterValue(17, 'gamma', current);
//     };


//    $('hue-value').oninput = function() {

//     applyFilterValue(21, 'rotation', this.value);
//   };
//   $('blend').onclick= function() {
//     applyFilter(16, this.checked && new f.BlendColor({
//       color: document.getElementById('blend-color').value,
//       mode: document.getElementById('blend-mode').value,
//       alpha: document.getElementById('blend-alpha').value
//     }));
//   };

//   $('blend-mode').onchange = function() {
//     applyFilterValue(16, 'mode', this.value);
//   };

//   $('blend-color').onchange = function() {
//     applyFilterValue(16, 'color', this.value);
//   };

//   $('blend-alpha').oninput = function() {
//     applyFilterValue(16, 'alpha', this.value);
//   };
//  $('contrast').onclick = function () {
//     applyFilter(6, this.checked && new f.Contrast({
//       contrast: parseFloat($('contrast-value').value)
//     }));
//   };
//   $('contrast-value').oninput = function() {
//     applyFilterValue(6, 'contrast', parseFloat(this.value));
//   };
// $('brightness').onclick = function () {
//     applyFilter(5, this.checked && new f.Brightness({
//       brightness: parseFloat($('brightness-value').value)
//     }));
//   };
//   $('brightness-value').oninput = function() {
//     applyFilterValue(5, 'brightness', parseFloat(this.value));
//   };



});