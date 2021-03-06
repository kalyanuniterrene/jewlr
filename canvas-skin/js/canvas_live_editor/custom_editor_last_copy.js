$(function() {
 
    // Golbal Variables
    //==============================

    var c_width = $('#custom_width');
    var c_height = $('#custom_height');
    var user_custom = { w: 8, h: 8 };
    var user_selected = { w: 8, h: 8 };
    var frame_width = 32;
    var custom_option = 'Custom';
    var $main_canvas = $('.canvasWrap');
    var canvas_defaults = { w: 500, h: 500, max_w: 580, max_height: 500 };
    $('.canvasWrap').width(canvas_defaults.w);
    $('.canvasWrap').height(canvas_defaults.h); 
    var canvas_background = { image: 'http://localhost/public_sc/canvasmagento/canvassignages/Magento-Code/skin/frontend/rwd/default/images/canvas_live_editor/images/bg3.jpg', text: 'DRAG PHOTO HERE', opacity: 1 };
    var dragged_Src = undefined;
    var minimum_image_resolution = { w: 400, h: 400 };
    var SCALE_FACTOR = 1.02;
    var state = [];
    var mods = 0;   
    var rotateAngle = 30; 
    var selectedValue = {
        canvas_type: undefined,
        canvas_w: undefined,
        canvas_h: undefined,
        canvas_style: undefined,
        canvas_style_details: undefined
    }


     //getting the default values from the page
    //============================================

    var canvasType = jQuery('#canvas_type'), 
        canvasWidth = jQuery('#canvas_width'), 
        canvasHeight = jQuery('#canvas_height');

        selectedValue.canvas_w = user_custom.w = user_selected.w = parseInt(canvasWidth.val());
        selectedValue.canvas_h = user_custom.h = user_selected.h = parseInt(canvasHeight.val());

        selectedValue.canvas_type = jQuery('#canvas_type').val();




    // Define the main Canvas
    //==============================

    var main_Editarea = new fabric.Canvas('mainCanvas',{
        preserveObjectStacking: true
    });

    main_Editarea.counter = 0;
    var newleft = 0;
    main_Editarea.selection = false;

    jQuery('.sidebar-content.text button').on('click', function (argument) {
        var user_input_text = jQuery('#comment').val();
        Addtext(user_input_text);
    });

    function Addtext(user_input_text) { 
        var addingText = new fabric.IText(user_input_text, { 
              left: 50,
              top: 100,
              fontFamily: 'Arial',
              fill: '#333',
              fontSize: 30
        });
        main_Editarea.add(addingText);
       // main_Editarea.centerObject(addingText);
        main_Editarea.setActiveObject(addingText)
        main_Editarea.renderAll();
    }



    //default canvas width height
    //==============================

    jQuery(window).on('load', function(argument) {

        jQuery('.loading_img').fadeOut();
        resizeCanvas(user_custom);
        setDefaultS(user_custom, selectedValue);

    });


    // selecting the selected changed canvas type
    //==================================================

    jQuery(document).on('click','.sidebar-content.size-prize > ul > li', function(){        
        selectedValue.canvas_type = jQuery(this).data('canvas-type');
        jQuery('#canvas_type').val(jQuery(this).data('canvas-type'));
    });





    //Adding the background text
    //==============================

    var texts = new fabric.Text(canvas_background.text, {
        fontFamily: 'Open Sans',
        fontSize: 26,
        fontWeight: '600',
        left: main_Editarea.width / 2,
        top: main_Editarea.height / 2,
        selectable: false,
        fill: '#4d4d4d',       

    });
 
    main_Editarea.add(texts);



    //Adding the additional Canvases
    //====================================

    jQuery('.canvasWrap .canvas-container')
        .append('<canvas id="topCanvas" class="abs_canvas"></canvas>' +
            '<canvas id="rightCanvas" class="abs_canvas"></canvas>' +
            '<canvas id="bottomCanvas" class="abs_canvas"></canvas>' +
            '<canvas id="leftCanvas" class="abs_canvas"></canvas>'
        );

    var allMirrorCanvas = [document.getElementById("topCanvas"),
        document.getElementById("rightCanvas"),
        document.getElementById("bottomCanvas"),
        document.getElementById("leftCanvas")
    ];


    //Adding the additional 3d views
    //====================================


    jQuery('.image.canvasWrap')
          .append(
            '<div class="d_view_wraper">'+
                '<div class="d_sides top"><img src="" crossOrigin="Anonymous"></div>'+
                '<div class="d_sides left"><img src="" crossOrigin="Anonymous"></div>'+
                '<div class="d_sides bottom"><img src="" crossOrigin="Anonymous"></div>'+
                '<div class="d_sides right"><img src="" crossOrigin="Anonymous"></div>'+
                '<div class="d_sides front"><img src="" crossOrigin="Anonymous"></div>'+
            '</div>'
          );


    jQuery(document).on('click','.preview-button #prev_top_left', function(){
        top_left_preview();
    }); 

    jQuery(document).on('click','.preview-button #prev_top_right', function(){
       top_right_preview();
    });
    jQuery(document).on('click','.preview-button #prev_left_bottom', function(){
       left_bottom_preview();
    });
    jQuery(document).on('click','.preview-button #prev_right_bottom', function(){
        right_bottom_preview();
    });

    set_3d_options();      

     function set_3d_options(){
        make_3d_top();  
        make_3d_left(); 
        make_3d_right();
        make_3d_bottom();
     } 


    function top_left_preview(){
        jQuery('.d_view_wraper').css({'transform':'rotateX(-'+ 20 +'deg) rotateY('+ 20 +'deg) scale(0.8,0.8)'});
    }

    function top_right_preview(){
        jQuery('.d_view_wraper').css({'transform':'rotateX(-'+ 20 +'deg) rotateY(-'+ 20 +'deg) scale(0.8,0.8)'});
    } 
    function left_bottom_preview(){
        jQuery('.d_view_wraper').css({'transform':'rotateX('+ 20 +'deg) rotateY('+ 20 +'deg) scale(0.8,0.8)'});
    }
    function right_bottom_preview(){
        jQuery('.d_view_wraper').css({'transform':'rotateX('+ 20 +'deg) rotateY(-'+ 20 +'deg) scale(0.8,0.8)'});
    }     

        


    function make_3d_top(){
        jQuery('.d_sides.top')
        .css({'width': '100%', 
            'height': frame_width+'px', 
            'transform': 'rotateX(90deg) translateY(-'+ frame_width +'px)',
            'background':'blue'
        });
    }

     function make_3d_bottom(){
        jQuery('.d_sides.bottom')
        .css({'width': '100%', 
            'height': frame_width+'px', 
            'transform': 'rotateX(-90deg)',
            'background':'blue',
            'bottom': '-'+frame_width+'px'
        });
    }     


     function make_3d_left(){
        jQuery('.d_sides.left')
        .css({'width': frame_width+'px', 
            'height': '100%', 
            'transform': 'rotateY(-90deg) translateX(-'+ frame_width +'px)',
            'background':'orange'
        });
    }  

     function make_3d_right(){
        jQuery('.d_sides.right')
        .css({'width': frame_width+'px', 
            'height': '100%', 
            'transform': 'rotateY(90deg)',
            'background':'yellow',
            'right':'-'+ frame_width +'px'
        });
    }      



    jQuery(document).on('click',function (argument) {
       if(jQuery('.preview-button').hasClass('active') == true) {  
            jQuery('.image.canvasWrap > .canvas-container').fadeOut();
             jQuery('.image.canvasWrap').addClass('changeColor');
            jQuery('.d_view_wraper').addClass('show_d_box');  
            
       }else{        
        jQuery('.image.canvasWrap > .canvas-container').fadeIn();        
        jQuery('.d_view_wraper').css({'transform':'rotateX(0deg) rotateY(0deg) scale(0.8,0.8)'});
        jQuery('.d_view_wraper').removeClass('show_d_box'); 
        jQuery('.image.canvasWrap').removeClass('changeColor');       
       }
    });













    // adding the loader in canvas
    //=======================================

    jQuery('.canvasWrap').append('<div class="loading_img" ><img src="http://localhost/cs_magento/live/Magento-Code/skin/frontend/rwd/default/images/canvas_live_editor/images/loading.gif" alt=""></div>');



    resetCanvas();

    function resetCanvas() {

        var top_canvas = document.getElementById('topCanvas');

        var right_canvas = document.getElementById('rightCanvas');

        var bottom_canvas = document.getElementById('bottomCanvas');

        var left_canvas = document.getElementById('leftCanvas');

        top_canvas.width = main_Editarea.width - (frame_width * 2);
        top_canvas.height = frame_width;
        jQuery('#topCanvas').css({ 'left': frame_width + 'px', 'top': '0px' });



        right_canvas.width = frame_width;
        right_canvas.height = main_Editarea.height - (frame_width * 2);
        jQuery('#rightCanvas').css({ 'right': '0px', 'top': frame_width + 'px' });



        bottom_canvas.width = main_Editarea.width - (frame_width * 2);
        bottom_canvas.height = frame_width;
        jQuery('#bottomCanvas').css({ 'left': frame_width + 'px', 'bottom': '0px' });



        left_canvas.width = frame_width;
        left_canvas.height = main_Editarea.height - (frame_width * 2);
        jQuery('#leftCanvas').css({ 'left': '0px', 'top': frame_width + 'px' });
    }



    // on change the canvas type
    //===================================

    var $canvas_types = jQuery('.sidebar-content.size-prize > ul.nav.nav-tabs');
    var $tab_contents = jQuery('.sidebar-content.size-prize .tab-content')

    $canvas_types.find('> li').click(function (argument) {

        var $current_item = jQuery(this);
        selectedValue.canvas_type = $current_item.data('canvas-type');
        
        if($current_item.data('canvas-type') == 'rolled-cannvas'){

            var returedValue = setting_default_basedon_canvasType($tab_contents.find('#Rolled-Cannvas'));  
            console.log(returedValue);      
            setTheValue(returedValue , 'selector1');   
           
        }else if($current_item.data('canvas-type') == 'thin_gallery'){

           var returedValue = setting_default_basedon_canvasType($tab_contents.find('#Thin-Gallery'));
           console.log(returedValue);
           setTheValue(returedValue, 'selector1'); 

        }else if($current_item.data('canvas-type') == 'thick_gallery'){

           var returedValue = setting_default_basedon_canvasType($tab_contents.find('#Thick-Gallery'));
           console.log(returedValue);
           setTheValue(returedValue, 'selector1'); 

        }
        
       
        
    });

    function setTheValue(returedValue, canS){
        if(returedValue.dataW == 'Custom'){
            goForCustomValues(canS);
        }else{
            selectedValue.canvas_w = user_custom.w = user_selected.w = parseInt(returedValue.dataW);
            selectedValue.canvas_h = user_custom.h = user_selected.h = parseInt(returedValue.dataH);
            resizeCanvas(user_custom);
        }
        
    }

    function setting_default_basedon_canvasType(activeTabContent) {
        var d_datas = { dataW : undefined, dataH : undefined};

        d_datas.dataW = activeTabContent.find('.price-size-table > ul > li.default-selected').find('input').data('w');
        d_datas.dataH = activeTabContent.find('.price-size-table > ul > li.default-selected').find('input').data('h');

        return d_datas;
           
       
    }



    //on change input
    //==============================

    $('input[name=selector1]').on('change', function(argument) {

        jQuery(this).parent().addClass('default-selected').siblings().removeClass('default-selected');

        var user_option = $.trim($('input[name=selector1]:checked').attr('data-w'));
        //alert(user_option);
        if (user_option != custom_option) {

            normal_options('selector1');
            selectedValue.canvas_w = user_selected.w = parseInt($.trim($('input[name=selector1]:checked').attr('data-w')));
            selectedValue.canvas_h = user_selected.h = parseInt($.trim($('input[name=selector1]:checked').attr('data-h')));
            user_custom.w = parseInt(user_selected.w);
            user_custom.h = parseInt(user_selected.h);

            resizeCanvas(user_custom);
        } else {
            console.log('custom selected!');
            custom_option_selected('selector1');
        }

    });

    $('input[name=selector2]').on('change', function(argument) {

         jQuery(this).parent().addClass('default-selected').siblings().removeClass('default-selected');

        var user_option = $.trim($('input[name=selector2]:checked').attr('data-w'));
        if (user_option != custom_option) {

            normal_options('selector2');
            selectedValue.canvas_w = user_selected.w = parseInt($.trim($('input[name=selector2]:checked').attr('data-w')));
            selectedValue.canvas_h = user_selected.h = parseInt($.trim($('input[name=selector2]:checked').attr('data-h')));
            user_custom.w = parseInt(user_selected.w);
            user_custom.h = parseInt(user_selected.h);

            resizeCanvas(user_custom);
        } else {
            console.log('custom selected!');
            custom_option_selected('selector2');
        }

    });


    $('input[name=selector3]').on('change', function(argument) {

         jQuery(this).parent().addClass('default-selected').siblings().removeClass('default-selected');

        var user_option = $.trim($('input[name=selector3]:checked').attr('data-w'));
        if (user_option != custom_option) {

            normal_options('selector3');
            selectedValue.canvas_w = user_selected.w = parseInt($.trim($('input[name=selector3]:checked').attr('data-w')));
            selectedValue.canvas_h = user_selected.h = parseInt($.trim($('input[name=selector3]:checked').attr('data-h')));
            user_custom.w = parseInt(user_selected.w);
            user_custom.h = parseInt(user_selected.h);

            resizeCanvas(user_custom);
        } else {
            console.log('custom selected!');
            custom_option_selected('selector3');
        }

    });

    // Adding image to canvas on click
    //=============================================

    jQuery(document).on('click', '.enable_dragging', function() {
        jQuery('.canvasWrap .loading_img').fadeIn();

        dragged_Src = jQuery(this).attr('src');

        if (check_img_resolution(dragged_Src)) {

            console.log('Its a low resolution image!');
            jQuery('.low_resolution_modal').fadeIn();

        }
        add_image(dragged_Src);

    });


    // adding dragging option to images
    //=============================================

    var uploaded_img_area = jQuery('.uploaded-image');

    uploaded_img_area.find('.uploaded-photo-box').each(function() {
        jQuery(this).children('img').eq(2).addClass('enable_dragging');
    });


    jQuery('.enable_dragging').draggable({
        helper: "clone",
        appendTo: 'body',
        zIndex: 9999,
        revert: true,
        start: function() {
            dragged_Src = jQuery(this).attr('src');
            jQuery(this).addClass('Dragging');
        },
        stop: function(argument) {
            jQuery(this).removeClass('Dragging')
        }
    });


    // changing the canvas border
    //================================

    jQuery(document).on('mousemove', function(argument) {

        change_the_canvas_border();

    });



    // setting the droppable area
    //============================================= 

    jQuery('.canvasWrap canvas#mainCanvas').droppable({

        accept: '.enable_dragging',

        hoverClass: 'hoverOnDrop',

        drop: function(argument) {

            jQuery('.canvasWrap .loading_img').fadeIn();

            if (check_img_resolution(dragged_Src)) {
                console.log('Its a low resolution image!');
                jQuery('.low_resolution_modal').fadeIn();
            }

            add_image(dragged_Src);

        }
    });


    // close the low resolution popup
    //==================================


    jQuery(document).on('click', '.close_low_res_popup', function() {
        jQuery('.low_resolution_modal').fadeOut();
    });


    // delete key pressed
    //========================

    jQuery('html').keyup(function(e) {
        if (e.keyCode == 46) {
            delete_the_selected_obj();
        }
    });


     // image Editor changes
     //=====================================
     //===========================================

    // delete image from image editor
    //====================================

    jQuery('#canvasImageDelete').on('click',function (argument) {
         delete_the_selected_obj();
    });

    // rotate image from editor
    //================================

    $("#photoRotation").click(function(){
        rotate_current_image();        
    });

    jQuery('#photoMaximize').on('click',function (argument) {
        jQuery(this).toggleClass('actives');        

       if( jQuery(this).hasClass('actives') == true){
            jQuery(this).find('.m_fullphoto').text('maximize');
            photosize_changes(true);
       }else{
         jQuery(this).find('.m_fullphoto').text('minimize');
         photosize_changes(false);
       }

    });


    jQuery('#layer-up').on('click',function (argument) {
        bringForwordLayer();
    });

     jQuery('#layer-down').on('click',function (argument) {
        sendbackLayer();
    });

    

    





    // delete image from uploaded images
    //===================================

    jQuery(document).on('click', '.uploaded-photo-box .remove', function() {
        jQuery(this).parent().fadeOut();
    });



    // zoom in

    jQuery(document).on('click', '.for_zoom_in', function(argument) {
        zoomIn();
    });


    // zoom out

    jQuery(document).on('click', '.for_zoom_out', function(argument) {
        zoomOut();
    });



    // save as image

    jQuery(document).on('click', '.save_it', function(argument) {
        //window.open('data:image/svg+xml;utf8,' + main_Editarea.toSVG());
        //window.open(main_Editarea.toDataURL('image'));
        //jQuery('body').append('<img src="'+ main_Editarea.toDataURL('image') +'">')
    });


    // undo
    //=======

    jQuery(document).on('click', '.undo_obj', function(argument) {
        undo();
    });


    // redo
    //=======

    jQuery(document).on('click', '.redo_obj', function(argument) {
        redo();
    });


    // minimize the colorpicker
    //==============================

    jQuery('.color_picker_box .close_low_res_popup img').on('click', function(argument) {

        jQuery('.color_picker_box').toggleClass('minimize_color');

    });



    // calling the update state function when canvas is modified
    //===========================================================

    main_Editarea.on(
        'object:modified',
        function() {          

            updateModifications(true);

        },
        'object:added',
        function() {
            updateModifications(true);
        });



    jQuery('.layerBox').draggable({}); 
    


    jQuery(document).on('click', '.layerItem', function() {

        jQuery(this).addClass('active').siblings().removeClass('active');
        active_current_layer(parseInt(jQuery(this).attr('id')));

    });

    jQuery(document).on('click', '.layerItem i', function() {

        delete_item(jQuery(this).parent().attr('id'));

    });

    jQuery(document).on('click', '.layerBox .close_low_res_popup', function() {
        jQuery('.layerBox').toggleClass('layerHidden');
    });

    // Making the image while click in style tab
    //===========================================

    jQuery('.editor-sidebar li.for_styles_tab ').on('click', function(argument) {
        make_image();
    });

    jQuery('.editor-sidebar > ul > li:not(.for_styles_tab) ').on('click', function(argument) {
        resizeCanvas(user_custom);
        resetColor();
        jQuery('.color_picker_box').fadeOut();
    });


    // Styles of canvas
    //===========================

    jQuery(document).on('click', '#Wrap-Border li', function(argument) {
        removeFrames();
        showCanvases();
        var styleName = jQuery(this).attr('id');
        resetStyle(styleName);

    });


    // Styles of canvas border frames
    //===========================

    jQuery(document).on('click', '#Frames li', function(argument) {

        jQuery('#Wrap-Border li').each(function (argument) {
           jQuery(this).removeClass('selected');
           jQuery(this).removeClass('active');
        });

        var styleName = jQuery(this).find('img').eq(0).attr('src');
        var current_frame_width = jQuery(this).find('img').eq(0).attr('data-border');
       
        frameStyle(styleName, current_frame_width);        

    });

    // jQuery('.textEditorSec').on('mousedown',function (e) {
    //     jQuery(this).addClass('startDrag');
    //     startDrag(e);        
    // });
    //  jQuery('.textEditorSec').on('mouseup',function (e) {
    //     jQuery(this).removeClass('startDrag');
    // });

    //  function startDrag(e) {
    //    jQuery(document).on('mousemove',function(x){        
    //     jQuery('.startDrag').css({'left': x.pageX +'px','top': x.pageY+'px'});
    //    });
    //  }















































































































    function resizeCanvas(user_custom) {


        var input = { w: undefined, h: undefined, ratio: undefined };

        var canvas_final = { w: undefined, h: undefined };

        user_selected.w = input.w = parseInt(user_custom.w);

        user_selected.h = input.h = parseInt(user_custom.h);

        if (input.w > input.h) {

            input.ratio = canvas_defaults.max_w / input.w;

            canvas_final.w = canvas_defaults.max_w;

            canvas_final.h = input.h * input.ratio;

            console.log(canvas_final);

            $('.forWidth').text('WIDTH : ' + user_selected.w + ' inch');

            $('.forheight span').text('HEIGHT : ' + user_selected.h + ' inch');

            //_canvas.width = canvas_final.w;

            //_canvas.height = canvas_final.h;

            main_Editarea.setWidth(canvas_final.w);

            main_Editarea.setHeight(canvas_final.h);


            $('.canvasWrap').width(canvas_final.w);

            $('.canvasWrap').height(canvas_final.h);



        } else if (input.h >= input.w) {

            input.ratio = canvas_defaults.max_height / input.h;

            canvas_final.w = input.w * input.ratio;

            canvas_final.h = canvas_defaults.max_height;

            console.log(canvas_final);

            $('.forWidth').text('WIDTH : ' + user_selected.w + ' inch');

            $('.forheight span').text('HEIGHT : ' + user_selected.h + ' inch');

            //_canvas.setwidth = canvas_final.w;

            //_canvas.height = canvas_final.h;

            main_Editarea.setWidth(canvas_final.w);

            main_Editarea.setHeight(canvas_final.h);

            $('.canvasWrap').width(canvas_final.w);

            $('.canvasWrap').height(canvas_final.h);

        }

        make_base();

        resetCanvas();

        center_text();

        resetColor();

        jQuery('.d_view_wraper').width(canvas_final.w);

        jQuery('.d_view_wraper').height(canvas_final.h);

        // if(canvas_final.w >= 310){

        //     main_Editarea.item(0).set('fontSize','26');
        //     //main_Editarea.renderAll();
        //     center_text()

        // }else if(canvas_final.w < 310 && canvas_final.w >= 300){

        //     main_Editarea.item(0).set('fontSize','25');
        //     center_text()
        //     //main_Editarea.renderAll();

        // }else if(canvas_final.w < 290 && canvas_final.w > 240){

        //     main_Editarea.item(0).set('fontSize','20');
        //     center_text()
        //     //main_Editarea.renderAll();

        // }else if(canvas_final.w < 237 && canvas_final.w > 211){

        //     main_Editarea.item(0).set('fontSize','16');
        //     center_text()
        //     //main_Editarea.renderAll();

        // }else if(canvas_final.w < 211 && canvas_final.w > 180){

        //     main_Editarea.item(0).set('fontSize','10');
        //     center_text()
        //    // main_Editarea.renderAll();

        // }else if(canvas_final.w < 180 && canvas_final.w > 160){

        //     main_Editarea.item(0).set('fontSize','8');
        //     center_text()
        //     //main_Editarea.renderAll();

        // }
      


    }

    // function to set the text center

    function center_text() {
        main_Editarea.centerObject(texts);
    }



    function make_base() {


        center_text();


        fabric.Image.fromURL(canvas_background.image, function(imgs) {           

            imgs.resizeFilter = new fabric.Image.filters.Resize({
                resizeType: 'hermite',
                scaleX: 1 / 6,
                scaleY: 1 / 6,
            });
            imgs.applyFilters();            
            imgs.scaleToHeight(main_Editarea.getHeight()-(frame_width+1));           
            main_Editarea.setBackgroundImage(imgs);
            main_Editarea.backgroundImage.opacity = canvas_background.opacity;
            main_Editarea.renderAll();

        });


    }


    // when custom option selected
    //=============================================

    function custom_option_selected(optionType) {

        var custom_size_option = jQuery('.sidebar-content.size-prize .tab-content');

        if(optionType == 'selector1'){
            custom_size_option.find('#Rolled-Cannvas ul li.custom-size select').removeAttr('disabled', true).removeClass('disable');
            goForCustomValues('selector1');
        }else if(optionType == 'selector2'){
            custom_size_option.find('#Thin-Gallery ul li.custom-size select').removeAttr('disabled', true).removeClass('disable');
            goForCustomValues('selector2');
        }else if(optionType == 'selector3'){
            custom_size_option.find('#Thick-Gallery ul li.custom-size select').removeAttr('disabled', true).removeClass('disable');
             goForCustomValues('selector3');
        }        
        

    }

    function normal_options(optionType) {

        var custom_size_option = jQuery('.sidebar-content.size-prize .tab-content');

        if(optionType == 'selector1'){
            custom_size_option.find('#Rolled-Cannvas ul li.custom-size select').attr('disabled', true).addClass('disable');
        }else if(optionType == 'selector2'){
            custom_size_option.find('#Thin-Gallery ul li.custom-size select').attr('disabled', true).addClass('disable');
        }else if(optionType == 'selector3'){
            custom_size_option.find('#Thick-Gallery ul li.custom-size select').attr('disabled', true).addClass('disable');
        }
        
    }


    function goForCustomValues(optionType) {
        var custom_size_option = jQuery('.sidebar-content.size-prize .tab-content');
        var d_datas = { dataW : undefined, dataH : undefined};

        if(optionType == 'selector1'){

            d_datas.dataW = custom_size_option.find('#Rolled-Cannvas ul li.custom-size select').eq(0).val();
            d_datas.dataH = custom_size_option.find('#Rolled-Cannvas ul li.custom-size select').eq(1).val();
            setTheValue(d_datas);

        }else if(optionType == 'selector2'){

             d_datas.dataW = custom_size_option.find('#Thin-Gallery ul li.custom-size select').eq(0).val();
             d_datas.dataH = custom_size_option.find('#Thin-Gallery ul li.custom-size select').eq(1).val();
             setTheValue(d_datas);

        }else if(optionType == 'selector3'){

             d_datas.dataW = custom_size_option.find('#Thick-Gallery ul li.custom-size select').eq(0).val();
             d_datas.dataH = custom_size_option.find('#Thick-Gallery ul li.custom-size select').eq(1).val();
             setTheValue(d_datas);

        }
       
    }

    jQuery('#Rolled-Cannvas .custom-size .select-box select').eq(0).on('change',function (argument) {        
        var d_datas = { dataW : undefined, dataH : undefined};
        d_datas.dataW = jQuery(this).val();
        d_datas.dataH = jQuery(this).siblings().val();
        setTheValue(d_datas);
    });

    jQuery('#Rolled-Cannvas .custom-size .select-box select').eq(1).on('change',function (argument) {
        var d_datas = { dataW : undefined, dataH : undefined};
        d_datas.dataH = jQuery(this).val();
        d_datas.dataW = jQuery(this).siblings().val();
        setTheValue(d_datas);
    });

    jQuery('#Thin-Gallery .custom-size .select-box select').eq(0).on('change',function (argument) {        
        var d_datas = { dataW : undefined, dataH : undefined};
        d_datas.dataW = jQuery(this).val();
        d_datas.dataH = jQuery(this).siblings().val();
        setTheValue(d_datas);
    });

    jQuery('#Thin-Gallery .custom-size .select-box select').eq(1).on('change',function (argument) {
        var d_datas = { dataW : undefined, dataH : undefined};
        d_datas.dataH = jQuery(this).val();
        d_datas.dataW = jQuery(this).siblings().val();
        setTheValue(d_datas);
    });

    jQuery('#Thick-Gallery .custom-size .select-box select').eq(0).on('change',function (argument) {        
        var d_datas = { dataW : undefined, dataH : undefined};
        d_datas.dataW = jQuery(this).val();
        d_datas.dataH = jQuery(this).siblings().val();
        setTheValue(d_datas);
    });

    jQuery('#Thick-Gallery .custom-size .select-box select').eq(1).on('change',function (argument) {
        var d_datas = { dataW : undefined, dataH : undefined};
        d_datas.dataH = jQuery(this).val();
        d_datas.dataW = jQuery(this).siblings().val();
        setTheValue(d_datas);
    });


    // changing the canvas border
    //=============================================


    function change_the_canvas_border() {

        if (jQuery('#mainCanvas').hasClass('hoverOnDrop') == true) {

            jQuery('#topCanvas').css({ 'border-color': 'red', 'border-width': '3px' });
            jQuery('#rightCanvas').css({ 'border-color': 'red', 'border-width': '3px' });
            jQuery('#bottomCanvas').css({ 'border-color': 'red', 'border-width': '3px' });
            jQuery('#leftCanvas').css({ 'border-color': 'red', 'border-width': '3px' });

        } else {

            jQuery('#topCanvas').css({ 'border-color': '#08b4e0', 'border-width': '2px' });
            jQuery('#rightCanvas').css({ 'border-color': '#08b4e0', 'border-width': '2px' });
            jQuery('#bottomCanvas').css({ 'border-color': '#08b4e0', 'border-width': '2px' });
            jQuery('#leftCanvas').css({ 'border-color': '#08b4e0', 'border-width': '2px' });

        }
    }


    // check image resolution
    //===============================

    function check_img_resolution(dragged_Src) {

        var image = new Image();
        image.src = dragged_Src;

        if (image.naturalWidth > minimum_image_resolution.w && image.naturalHeight > minimum_image_resolution.h) {

            return false;

        } else {

            return true;

        }

    }

    // delete the seleted item on canvas

    function delete_the_selected_obj() {

        var activeObject = main_Editarea.getActiveObject();
        if (activeObject) {

            if (confirm('Are you sure?')) {
                main_Editarea.remove(activeObject);
                jQuery('#contextualEditNav').fadeOut();
            }
        }
    }

    // rotate function

    function rotate_current_image(){
        var activeObject = main_Editarea.getActiveObject();
        var curAngle = activeObject.getAngle();
        activeObject.setAngle(curAngle+rotateAngle);
        activeObject.setCoords();
        main_Editarea.renderAll();
        updateModifications(true);
    }


    // photo size changes

    function photosize_changes(argument) {
        if(argument){
            var activeObject = main_Editarea.getActiveObject();
            activeObject.scaleToHeight((main_Editarea.getHeight())/2);
            main_Editarea.renderAll();
            updateModifications(true);
        }else{
            var activeObject = main_Editarea.getActiveObject();
            activeObject.scaleToHeight(main_Editarea.getWidth());
            main_Editarea.renderAll();
            updateModifications(true);
        }
        
    }


    // bring forword layer

    function bringForwordLayer(argument) {
         var activeObject = main_Editarea.getActiveObject();
         main_Editarea.bringToFront(activeObject);
         main_Editarea.renderAll();
         updateModifications(true);
    }

    // send back layer

    function sendbackLayer(argument) {
         var activeObject = main_Editarea.getActiveObject();
         main_Editarea.sendToBack(activeObject);
         main_Editarea.renderAll();
         updateModifications(true);
    }

    // zoom in element

    function zoomIn() {

        var activeObject = main_Editarea.getActiveObject();

        var scaleX = activeObject.scaleX;
        var scaleY = activeObject.scaleY;
        var left = activeObject.left;
        var top = activeObject.top;

        var tempScaleX = scaleX * SCALE_FACTOR;
        var tempScaleY = scaleY * SCALE_FACTOR;
        var tempLeft = left * SCALE_FACTOR;
        var tempTop = top * SCALE_FACTOR;

        activeObject.scaleX = tempScaleX;
        activeObject.scaleY = tempScaleY;
        activeObject.left = tempLeft;
        activeObject.top = tempTop;

        activeObject.setCoords();

        main_Editarea.renderAll();
    }


    // zoom out element


    function zoomOut() {

        var activeObject = main_Editarea.getActiveObject();


        var scaleX = activeObject.scaleX;
        var scaleY = activeObject.scaleY;
        var left = activeObject.left;
        var top = activeObject.top;

        var tempScaleX = scaleX * (1 / SCALE_FACTOR);
        var tempScaleY = scaleY * (1 / SCALE_FACTOR);
        var tempLeft = left * (1 / SCALE_FACTOR);
        var tempTop = top * (1 / SCALE_FACTOR);

        activeObject.scaleX = tempScaleX;
        activeObject.scaleY = tempScaleY;
        activeObject.left = tempLeft;
        activeObject.top = tempTop;
        activeObject.setCoords();


        main_Editarea.renderAll();
    }


    // adding image to canvas after drop

    function add_image(dragged_Src) {

        active_zoom();

        // removing the previous image from canvas
       
       for(i=0; i<main_Editarea.getObjects().length;i++){
            if(main_Editarea.item(i).get('type') == 'image'){
                main_Editarea.item(i).remove();
            }
       }

        var imgElement = new Image();
        imgElement.src = dragged_Src;
        imgElement.crossOrigin = "anonymous";

        imgInstance = new fabric.Image(imgElement, {
            left: 0,
            top: 0,
        });
        var scaling = main_Editarea.getHeight() / imgElement.height;
        imgInstance.resizeFilter = new fabric.Image.filters.Resize({
            resizeType: 'hermite',
            scaleX: 1 / 6,
            scaleY: 1 / 6
        });
        imgInstance.applyFilters();
        imgInstance.scaleToHeight(main_Editarea.getHeight());
        //imgInstance.scaleToWidth(main_Editarea.getWidth());       
        main_Editarea.add(imgInstance);      
        
        main_Editarea.setActiveObject(imgInstance);
        if (main_Editarea.renderAll()) {

            jQuery('.canvasWrap .loading_img').fadeOut();
        }

        updateModifications(true);
        main_Editarea.counter++;
        newleft += 100;

        add_layer((main_Editarea.getObjects().length) - 1);

    }

    // the redo function
    //======================

    function redo() {


        if (mods > 0) {
            active_undo_state();
            main_Editarea.clear().renderAll();
            main_Editarea.loadFromJSON(state[state.length - 1 - mods + 1]);
            main_Editarea.renderAll();
            //console.log("geladen " + (state.length-1-mods+1));
            mods -= 1;
            //console.log("state " + state.length);
        }

        if (mods == 0) {
            active_undo_state();
            unactive_redo_state();
        }

        console.log(state.length + '==' + mods);
    }



    // adding the canvas state to json
    //============================


    function updateModifications(savehistory) {
        if (savehistory === true) {
            active_undo_state();
            myjson = JSON.stringify(main_Editarea);
            state.push(myjson);
        }
    }

    // the undo function
    //============================

    function undo() {

        if (mods < state.length) {
            main_Editarea.clear().renderAll();
            main_Editarea.loadFromJSON(state[state.length - 1 - mods - 1]);
            main_Editarea.renderAll();
            //console.log("geladen " + (state.length-1-mods-1));
            //console.log("state " + state.length);
            mods += 1;
            //console.log("mods " + mods);

        }
        if ((mods) == state.length) {
            unactive_undo_state();
            //alert();
        }
        if (mods >= 1) {
            active_redo_state();
        }
        console.log('state: ' + state.length + ' mods: ' + mods);

    }

    function active_zoom() {
        jQuery('.for_zoom_in').addClass('active');
        jQuery('.for_zoom_out').addClass('active');
    }

    function active_undo_state() {
        jQuery('.undo_obj').addClass('active');
    }

    function unactive_undo_state() {
        jQuery('.undo_obj').removeClass('active');
    }

    function active_redo_state() {
        jQuery('.redo_obj').addClass('active');
    }

    function unactive_redo_state() {
        jQuery('.redo_obj').removeClass('active');
    }

    // add layer

    function add_layer(id) {

        var obj = main_Editarea.item(id);

        $(".layerItems").prepend('<li id="' + id + '" class="layerItem"><img src="' + obj._element.src + '" > item ' + id + '</li>');
        jQuery('.layerItems li').each(function() { jQuery(this).removeClass('active'); });
        jQuery('.layerItems li#' + id).addClass('active');
    }

    // Active current layer

    function active_current_layer(ids) {

        main_Editarea.deactivateAll();
        main_Editarea.renderAll();
        var obj = main_Editarea.item(ids);
        main_Editarea.setActiveObject(obj);  
        main_Editarea.getActiveObject().bringToFront();
        main_Editarea.renderAll();

    }

    // Delete item

    function delete_item(itemId) {

        var obj = main_Editarea.item(itemId);
        main_Editarea.remove(obj);
        $(".layerItems li#" + itemId).remove();

    }


    // color picker

    function show_colorPicker(argument) {

        jQuery('.color_picker_box').fadeIn();

        var picker = new CP(document.getElementById('for_color_picker'));
        picker.on("change", function(color) {
            var c = '#' + color;
            this.target.value = c;
            changeColor(c);

        });
    }

    function changeColor(color) {
        jQuery('.abs_canvas').removeClass('resetColor');
        jQuery('.abs_canvas').css({ 'background': color });

        jQuery('.d_sides.top').css({'background':color});
        jQuery('.d_sides.left').css({'background':color});
        jQuery('.d_sides.right').css({'background':color});
        jQuery('.d_sides.bottom').css({'background':color});

        jQuery('.d_sides.top img').attr('src','');
        jQuery('.d_sides.left img').attr('src','');
        jQuery('.d_sides.right img').attr('src','');
        jQuery('.d_sides.bottom img').attr('src','');

        var setMain = main_Editarea.toDataURL('image/png');       
        
        jQuery(".d_sides.front img").attr('src',setMain);//.append("<img src='"+setMain+"'  />");
    }

    function resetColor() {
        jQuery('.abs_canvas').addClass('resetColor');

    }

    // change additional canvas width and position

    function change_canvas() {



        allMirrorCanvas[0].width = (main_Editarea.width);
        allMirrorCanvas[1].height = (main_Editarea.height);
        allMirrorCanvas[2].width = (main_Editarea.width);
        allMirrorCanvas[3].height = (main_Editarea.height);

        jQuery('#topCanvas').css({ 'top': '-' + frame_width + 'px', 'left': '0' });
        jQuery('#rightCanvas').css({ 'right': '-' + frame_width + 'px', 'top': '0' });
        jQuery('#leftCanvas').css({ 'left': '-' + frame_width + 'px', 'top': '0' });
        jQuery('#bottomCanvas').css({ 'bottom': '-' + frame_width + 'px', 'left': '0' });
    }

    // color wrap change

    function color_wrap_change(argument) {

        change_canvas();

        show_colorPicker();

    }

    //  main reset style

    function resetStyle(styleName) {

        if (styleName == 'color_wrap') {

            color_wrap_change();
        } else if (styleName == 'mirror_image') {
            resizeCanvas(user_custom);
            resetColor();
            jQuery('.color_picker_box').fadeOut();
            mirror_image_change();
        } else if( styleName == 'photo_wrap'){
            alert();
        }else {
            resizeCanvas(user_custom);
            resetColor();
            jQuery('.color_picker_box').fadeOut();
        }

    }

    function mirror_image_change(argument) {

        change_canvas();

        change_mirrors();
   

    }

    function make_image() {

        var image_src = main_Editarea.toDataURL('image');
        jQuery('#canvas_image').attr('src', image_src);

    }

    function change_mirrors() {
        for (var i = 0; i < allMirrorCanvas.length; i++) {

            var canvas22 = allMirrorCanvas[i],
                width11 = jQuery("#mainCanvas").width(),
                height = jQuery("#mainCanvas").height(),
                posX = 0,
                posY = 0,
                tmcContext = canvas22.getContext("2d"),
                img11 = new Image();
            
            img11.src = jQuery('#canvas_image').attr('src');
            tmcContext.save(); // Save the current state

            switch (i) {
                case 0:
                    canvas22.width = width11;
                    canvas22.height = frame_width;
                    tmcContext.scale(1, -1); // Set scale to flip the image
                    posY = frame_width * -1;
                    tmcContext.drawImage(img11, 0, 0, width11, frame_width, 0, posY, width11, frame_width); // draw the image
                    break;
                case 2:
                    canvas22.width = width11;
                    canvas22.height = frame_width;
                    tmcContext.scale(1, -1); // Set scale to flip the image
                    posY = frame_width * -1;
                    tmcContext.drawImage(img11, 0, height - frame_width, width11, frame_width, 0, posY, width11, frame_width); // draw the image
                    break;
                case 3:
                    canvas22.width = frame_width;
                    canvas22.height = height;
                    tmcContext.scale(-1, 1); // Set scale to flip the image
                    posX = frame_width * -1;
                    tmcContext.drawImage(img11, 0, 0, frame_width, height, posX, 0, frame_width, height); // draw the image
                    break;
                case 1:
                    canvas22.width = frame_width;
                    canvas22.height = height;
                    tmcContext.scale(-1, 1); // Set scale to flip the image
                    posX = frame_width * -1;
                    tmcContext.drawImage(img11, width11 - frame_width, 0, frame_width, height, posX, 0, frame_width, height); // draw the image
                    break;
            }
            tmcContext.restore(); // Restore the last saved state
        }

         main_Editarea.renderAll();
         var topM = document.getElementById('topCanvas');
         var rightM = document.getElementById('rightCanvas');
         var bottomM = document.getElementById('bottomCanvas');
         var leftM = document.getElementById('leftCanvas');
         var setMain = main_Editarea.toDataURL('image/png');         
         var dataTop = topM.toDataURL('image/png');
         var dataright= rightM.toDataURL('image/png');
         var dataBottom = bottomM.toDataURL('image/png');
         var dataLeft = leftM.toDataURL('image/png');
        
        jQuery(".d_sides.top img").attr('src',dataTop);//("<img src='"+dataTop+"'  />");
        jQuery(".d_sides.right img").attr('src',dataright);//.append("<img src='"+dataright+"'  />");
        jQuery(".d_sides.bottom img").attr('src',dataBottom);//.append("<img src='"+dataBottom+"'  />");
        jQuery(".d_sides.left img").attr('src',dataLeft);//.append("<img src='"+dataLeft+"'  />"); 
        jQuery(".d_sides.front img").attr('src',setMain);//.append("<img src='"+setMain+"'  />");

    }

    function frameStyle(styleName, current_frame_width) {
        hideCanvases();   
        jQuery('#mainCanvas').css({'transition':'all .3s ease','border': current_frame_width+'px solid', 'border-image' : 'url('+styleName+')'+current_frame_width+' round round'})
    }
    function hideCanvases(argument) {
       jQuery('#topCanvas').addClass('hide_canvas');
       jQuery('#rightCanvas').addClass('hide_canvas');
       jQuery('#bottomCanvas').addClass('hide_canvas');
       jQuery('#leftCanvas').addClass('hide_canvas');
    }
    function showCanvases(argument) {
       jQuery('#topCanvas').removeClass('hide_canvas');
       jQuery('#rightCanvas').removeClass('hide_canvas');
       jQuery('#bottomCanvas').removeClass('hide_canvas');
       jQuery('#leftCanvas').removeClass('hide_canvas');
    }
    function removeFrames(){
        jQuery('#Frames li').each(function (argument) {
           jQuery(this).removeClass('selected')
           jQuery(this).removeClass('active')
        });
        jQuery('#mainCanvas').css({'border':'none'});
    }

    function setDefaultS(user_custom, selectedValue) {
        jQuery('#Thin-Gallery ul li').each(function (argument) {

            var width_from_page = parseInt(jQuery(this).find('> input').attr('data-w'));
            var height_from_page = parseInt(jQuery(this).find('> input').attr('data-h'));
            if(width_from_page == parseInt(user_custom.w) && height_from_page == parseInt(user_custom.h)){
                jQuery(this).find('> input').attr('checked',true);
            }else{
                
            }
        });

        jQuery('.sidebar-content.size-prize > ul > li').each(function (argument) {            
            var c_type = jQuery(this).attr('data-canvas-type');            
            if(c_type == selectedValue.canvas_type){
                jQuery(this).addClass('active');
            }
        });

    }



    /* 7-8-2017 ranit */

    jQuery('.fontName').on('click',function (argument) {
        jQuery('.allFontsArea').toggleClass('hideFonts');
    });

        jQuery('.textColors').on('click',function (argument) {
        jQuery('.colorPickerArea').toggleClass('hideFonts');
        if(jQuery('.colorPickerArea').hasClass('hideFonts') == true){
             jQuery('.colorPickerArea input').focusout();
        }else{
             jQuery('.colorPickerArea input').focus();
             jQuery('.colorPickerArea input').click();
             jQuery('.colorPickerArea input').mousedown();
             triggerMouseEvent('.colorPickerArea input', 'mousedown');
        }
    });

    function triggerMouseEvent (node, eventType) {
        var clickEvent = document.createEvent ('MouseEvents');
        clickEvent.initEvent (eventType, true, true);
        node.dispatchEvent (clickEvent);
    }

    jQuery('.text-styles div.toolbar-button').on('click',function (argument) {
        jQuery(this).toggleClass('selected');
    });

    jQuery('.font-list .tool-select-option.font-option').on('click',function (argument) {
        jQuery(this).addClass('selected').siblings().removeClass('selected');
        changeTheFont(jQuery(this).data('font-family-name'));
        jQuery('.fontsArea .fontName .font-family-display-name').text(jQuery(this).data('font-family-name'));
       jQuery('.fontsArea .fontName .font-family-display-name').css({'font-family': jQuery(this).data('font-family-name')});
    });

    jQuery('.font-categories .tool-category-header.font-category').on('click',function (argument) {
        jQuery(this).addClass('selected').siblings().removeClass('selected');
    });

    for(i=1;i<=100;i++){
        if(i == 30){
            jQuery('.fontSizeArea ul').append('<li class="selected" data-font-size="'+ i +'">'+ i +'</li>')
        }else{
            jQuery('.fontSizeArea ul').append('<li data-font-size="'+ i +'">'+ i +'</li>')
        }
    }

     jQuery(document).on('click', '.fontSizeArea ul li', function (argument) {
        jQuery(this).addClass('selected').siblings().removeClass('selected');
        jQuery('.fontSize .font-size-display').text( jQuery(this).data('font-size'));
        jQuery('.fontSizeArea').addClass('hideFontSizePanel');

        changeFontsize(jQuery(this).data('font-size'));
    });

    jQuery('.fontSize').on('click',function (argument) {
        jQuery('.fontSizeArea').toggleClass('hideFontSizePanel');
    });

        function changeTheFont(fontNames) {
            main_Editarea.getActiveObject().setFontFamily(fontNames);
            main_Editarea.renderAll();
        }



    jQuery('.text-styles div.toolbar-button.bold').on('click',function (argument) {
        if(jQuery(this).hasClass('selected') === true ){
            main_Editarea.getActiveObject().set("fontWeight", "bold");;
            main_Editarea.renderAll();
        }else{
            main_Editarea.getActiveObject().set("fontWeight", "normal");;
            main_Editarea.renderAll();
        }
    });

    jQuery('.text-styles div.toolbar-button.italic').on('click',function (argument) {
        if(jQuery(this).hasClass('selected') === true ){
            main_Editarea.getActiveObject().set("fontStyle", "italic");;
            main_Editarea.renderAll();
        }else{
            main_Editarea.getActiveObject().set("fontStyle", "normal");;
            main_Editarea.renderAll();
        }
    });

    jQuery('.text-styles div.toolbar-button.underline').on('click',function (argument) {
        if(jQuery(this).hasClass('selected') === true ){
            main_Editarea.getActiveObject().set("textDecoration", "underline");;
            main_Editarea.renderAll();
        }else{
            main_Editarea.getActiveObject().set("textDecoration", "normal");;
            main_Editarea.renderAll();
        }
    });

    function changeFontsize(fontSize) {
        main_Editarea.getActiveObject().setFontSize(fontSize);
        main_Editarea.renderAll();
    }


    jQuery('.editroPlace .editedText').keyup(function(event) {
       
        main_Editarea.getActiveObject().set("text", jQuery(this).val());
        main_Editarea.renderAll();
    });


    jQuery('.font-list div.font-option').each(function(index, el) {
        jQuery(this).text(jQuery(this).data('font-family-name'));
        jQuery(this).css({'font-family': jQuery(this).data('font-family-name')});
    });

    main_Editarea.on('object:selected', onObjectSelected);

    

        function onObjectSelected(e) {



            jQuery('.editroPlace .editedText').val(e.target.get('text'));

                if(e.target.get('type') == 'image'){                  
                    jQuery('#contextualEditNav').addClass('showEditor').fadeIn();
                    e.target.transparentCorners = false;
                    e.target.borderColor = '#000000';
                    e.target.cornerColor = '#000000';
                    e.target.minScaleLimit = 2;
                    e.target.cornerStrokeColor = '#000000';  
                    e.target.cornerStyle = 'circle';
                    e.target.minScaleLimit = 0;
                    e.target.lockScalingFlip = true;
                    e.target.padding = 0;
                    e.target.selectionDashArray = [5, 5];
                    e.target.borderDashArray = [5, 5];
                    e.target.cornerDashArray = [5, 5];
                    fabric.Object.prototype.drawControls = function (ctx) {
                          
                          if (!this.hasControls) {
                            return this;
                          }

                          var wh = this._calculateCurrentDimensions(),
                              width = wh.x,
                              height = wh.y,
                              scaleOffset = this.cornerSize,
                              left = -(width + scaleOffset) / 2,
                              top = -(height + scaleOffset) / 2,
                              methodName = this.transparentCorners ? 'stroke' : 'fill';

                          ctx.save();
                          ctx.strokeStyle = ctx.fillStyle = this.cornerColor;
                          if (!this.transparentCorners) {
                            ctx.strokeStyle = this.cornerStrokeColor;
                          }
                          this._setLineDash(ctx, this.cornerDashArray, null);

                          // top-left
                          this._drawControl('tl', ctx, methodName,
                            left,
                            top);

                          // top-right
                          this._drawControl('tr', ctx, methodName,
                            left + width,
                            top);

                          // bottom-left
                          this._drawControl('bl', ctx, methodName,
                            left,
                            top + height);

                          // bottom-right
                          this._drawControl('br', ctx, methodName,
                            left + width,
                            top + height);

                          if (!this.get('lockUniScaling')) {

                            // middle-top
                            this._drawControl('mt', ctx, methodName,
                              left + width / 2,
                              top);

                            // middle-bottom
                            this._drawControl('mb', ctx, methodName,
                              left + width / 2,
                              top + height);

                            // middle-right
                            this._drawControl('mr', ctx, methodName,
                              left + width,
                              top + height / 2);

                            // middle-left
                            this._drawControl('ml', ctx, methodName,
                              left,
                              top + height / 2);
                          }

                          // middle-top-rotate
                          if (this.hasRotatingPoint) {
                            var rotate = new Image(), rotateLeft, rotateTop;
                            rotate.src = 'http://www.navifun.net/files/pins/standard/Arrow-Rotate-Clockwise.png';
                            rotateLeft = -10;
                            rotateTop = top - this.rotatingPointOffset;
                            ctx.drawImage(rotate, rotateLeft, rotateTop, 30, 30);
                          }

                          ctx.restore();

                          return this;
                    }
                    // end

                }else{
                    jQuery('#contextualEditNav').removeClass('showEditor').fadeOut();
                }
          
              if(e.target.get('type') == 'i-text'){
                jQuery('#textEditorArea').addClass('showEditor').fadeIn();
              }else{
                jQuery('#textEditorArea').removeClass('showEditor').fadeOut();
              }
        }
        main_Editarea.on('mouse:up', function (e) {
          //check if user clicked an object
          if (e.target) {            
            //alert('clicked on object');
          }else{
            jQuery('#textEditorArea').removeClass('showEditor').fadeOut();
            jQuery('#contextualEditNav').removeClass('showEditor').fadeOut();
          }
        });

        jQuery('#cp7').colorpicker({
            color: '#ffaa00',
            container: true,
            inline: true
        });


        var picker = new CP(document.querySelector('.colorSliders input[type="text"]'));
        picker.on("change", function(color) {
            this.target.value = '#' + color;
        });
        
           

});


