$(function() {



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

    var canvas_background = { image: 'http://beta.canvassignages.com/skin/frontend/rwd/default/images/canvas_live_editor/images/bg.jpg', text: 'DRAG PHOTO HERE', opacity: 1 };

    var dragged_Src = undefined;

    var minimum_image_resolution = { w: 400, h: 400 };

    var SCALE_FACTOR = 1.02;

    var state = [];

    var mods = 0;

    var rotateAngle = 30;

    var saveData = { url: undefined, data: undefined };

    var imagePath = undefined;

    var selectedValue = {

        canvas_type: undefined,

        canvas_price: undefined,

        canvasName: undefined,

        canvas_w: undefined,

        canvas_h: undefined,

        is_custom: false,

        canvas_style_options: undefined,

        canvas_style: undefined,

        canvas_style_details: undefined,

        hardware: undefined,

        hardware_price: undefined,

        filter: undefined,

        filter_price: undefined,

        photo_retouching: undefined,

        photo_retouching_price: undefined,

        major_retouching_text: undefined,

        lamination_option: true,

        lamination_price: undefined,

        canvas_text_options: {

            canvas_text: undefined,

            fontFamily: undefined,

            font_color: undefined,

            font_size: undefined,

            is_bold: undefined,

            is_italic: undefined,

            is_underlined: undefined,

        }



    }





    jQuery('.wall_display_main').parent().css({'background':'transparent'});



    // Golbal Variables

    //==============================



     var panel_infos = {

            panel_name: undefined,

            panel_items: undefined,

            panel_price: undefined,

            panel_items_sizes: undefined,

            panel_template: undefined

    };

    var canvases = [];

    var current_on_canvas = undefined;

    var need_to_drop = undefined;



    // asigning the default values to the variables

    //============================================



    panel_infos.panel_name = jQuery('.inputSets #panel_type').data('canvas-name');

    panel_infos.panel_items = parseInt(jQuery('.inputSets #panel_type').val());

    panel_infos.panel_price = jQuery('.inputSets #cpr').val();

    panel_infos.panel_items_sizes = jQuery('.inputSets #canvas_sizes').val();

    panel_infos.panel_template = jQuery('.inputSets #canvas_template').val();



    var sizes = panel_infos.panel_name.split('x');

    sizes[0] = parseInt(jQuery.trim(sizes[0]));

    sizes[1] = parseInt(jQuery.trim(sizes[1]));

    









   





    var sizesArray = [],

        panel_details_holder = [];    

        sizesArray = split_it(panel_infos.panel_items_sizes);



    for(i=0;i<sizesArray.length;i++){

        each_panel_info = split_it_again(sizesArray[i]);

        panel_details_holder.push(each_panel_info);        

    }







    var edit_screen = jQuery('.edit-screen'),

        margin_right = 100;

    var mayb_w = edit_screen.width() - margin_right,

        mayb_h = edit_screen.height() - 140,

        main_area_details = {w: mayb_w, h:mayb_h },

        main_area = jQuery('.edit-screen-outer .image');   



    var panel_details_inch = {w: sizes[0], h: sizes[1]},

        panel_details_px = {w:undefined, h:undefined},

        convert_ration = 72, 

        plus_value = 0;



    var returned_data = inch_to_px(panel_details_inch, convert_ration);



    panel_details_px.w = returned_data.w;

    panel_details_px.h = returned_data.h;



    var c_w = parseInt(panel_details_px.w);

    var c_h = parseInt(panel_details_px.h);

    

    if (c_w >= c_h) {

        x = (c_w / c_h) * main_area_details.h;

       if(x > main_area_details.w){

        m = x - main_area_details.w;

       //x = main_area_details.w - m/2;

       x = x - m;

       }

        //jQuery('.wall_display_main').width(x+plus_value); 

        jQuery('.wall_type_1').width(x+plus_value);      

        jQuery('.wall_display_main').css({ 'min-width': (x + plus_value) + 'px' });

        jQuery('.wall_display_main').height(main_area_details.h);

        jQuery('.wall_type_1').height(main_area_details.h);

    } else if (c_w < c_h) {        

        xy = (c_w / c_h) * main_area_details.w;

        //jQuery('.wall_display_main').width(xy+plus_value);

         //jQuery('.wall_type_1').width(xy+plus_value);    

         jQuery('.wall_type_1').width(main_area_details.h);    

        jQuery('.wall_display_main').css({ 'min-width': main_area_details.h + 'px' });

        jQuery('.wall_display_main').height(main_area_details.h);

        jQuery('.wall_type_1').height(main_area_details.h);

    }



    main_area.css({'width': mayb_w+'px', 'height': mayb_h+'px', 'margin':'0 0 0 2px'});

    jQuery('.wall_display_main').css({'margin':'auto'});











          // on click adding changing the canvas

    //======================================





    jQuery('.sidebar-content.addon .panel-body ul li').on('click',function (argument) {


        jQuery(this).addClass('selected active').siblings().removeClass('selected active');
        jQuery(this).parent().parent().parent().parent().siblings().find('li').removeClass('selected active');



        panel_infos.panel_name = jQuery(this).data('canvas-name');

        panel_infos.panel_items = parseInt(jQuery(this).data('panel-type'));

        panel_infos.panel_price = jQuery(this).data('price');

        panel_infos.panel_items_sizes = jQuery(this).data('size');

        panel_infos.panel_template = jQuery(this).data('template');

        update_invoice_name();

        var sizesz = panel_infos.panel_name.split('x');

        panel_details_inch.w = sizes[0] = parseInt(jQuery.trim(sizesz[0]));

        panel_details_inch.h = sizes[1] = parseInt(jQuery.trim(sizesz[1]));



            sizesArray = [];

            panel_details_holder = [];    

            sizesArray = split_it(panel_infos.panel_items_sizes);



        for(i=0;i<sizesArray.length;i++){

            each_panel_info = split_it_again(sizesArray[i]);

            panel_details_holder.push(each_panel_info);        

        }





        var returned_data = inch_to_px(panel_details_inch, convert_ration);



        panel_details_px.w = returned_data.w;

        panel_details_px.h = returned_data.h;





        var c_w = parseInt(panel_details_px.w);

        var c_h = parseInt(panel_details_px.h);

        

        if (c_w >= c_h) {

            x = (c_w / c_h) * main_area_details.h;

           if(x > main_area_details.w){

            m = x - main_area_details.w;

           //x = main_area_details.w - m/2;

           x = x - m;

           }

            //jQuery('.wall_display_main').width(x+plus_value); 

            jQuery('.wall_type_1').width(x+plus_value);      

            jQuery('.wall_display_main').css({ 'min-width': (x + plus_value) + 'px' });

            jQuery('.wall_display_main').height(main_area_details.h);

            jQuery('.wall_type_1').height(main_area_details.h);

        } else if (c_w < c_h) {        

            xy = (c_w / c_h) * main_area_details.w;

            //jQuery('.wall_display_main').width(xy+plus_value);

             //jQuery('.wall_type_1').width(xy+plus_value);    

             jQuery('.wall_type_1').width(main_area_details.h);    

            jQuery('.wall_display_main').css({ 'min-width': main_area_details.h + 'px' });

            jQuery('.wall_display_main').height(main_area_details.h);

            jQuery('.wall_type_1').height(main_area_details.h);

        }



        main_area.css({'width': mayb_w+'px', 'height': mayb_h+'px', 'margin':'0 0 0 2px'});

        jQuery('.wall_display_main').css({'margin':'auto'});



            
           



          change_pannel(panel_infos);



              jQuery('.items canvas:first-child').droppable({

       

                hoverClass: 'hoverOnDrop',



                drop: function(argument) {
                    
                    need_to_drop = jQuery(this).attr('id');    
                    console.log('sdfsdfds: '+need_to_drop);
                    console.log('drop :'+dragged_Src);

                   add_image(dragged_Src,need_to_drop);



                }

            });



              make_continious_image();



        

    });





















      

      change_pannel(panel_infos);

       function change_pannel(panel_infos){



        switch(panel_infos.panel_template) {

                    case 'template1':

                        choosed_template(1);

                        break;

                    case 'template2':

                        choosed_template(2);

                        break;

                     case 'template3':

                        choosed_template(3);

                        break;

                     case 'template4':

                       choosed_template(4);

                        break;

                     case 'template5':

                        choosed_template(5);

                        break;

                     case 'template6':

                        choosed_template(6);

                        break;

                     case 'template7':

                       choosed_template(7);

                        break;

                     case 'template8':

                        choosed_template(8);

                        break;

                     case 'template9':

                        choosed_template(9);

                        break;

                     case 'template10':

                        choosed_template(10);

                        break;

                     case 'template11':

                        choosed_template(11);

                        break;

                     case 'template12':

                        choosed_template(12);

                        break;

                     case 'template13':

                        choosed_template(13);

                        break;

                     case 'template14':

                        choosed_template(14);

                        break;

                     case 'template15':

                        choosed_template(15);

                        break;

                     case 'template16':

                        choosed_template(16);

                        break;

                     case 'template17':

                        choosed_template(17);

                        break;

                     case 'template18':

                        choosed_template(18);

                        break;

                     case 'template19':

                        choosed_template(19);

                        break;

                     case 'template20':

                        choosed_template(20);

                        break;           

                    default:

                        break;

                }

            }





        function choosed_template(template_no) {



            if(template_no == 1){

                go_for_tempplate1();

            } else if(template_no == 2){

                go_for_tempplate2();

            }else if(template_no == 3){

                go_for_tempplate3();

            }else if(template_no == 4){

                go_for_tempplate4();

            }else if(template_no == 5){

                go_for_tempplate5();

            }else if(template_no == 6){

                go_for_tempplate6();

            }else if(template_no == 7){

                go_for_tempplate7();

            }else if(template_no == 8){

                go_for_tempplate8();

            }else if(template_no == 9){

                go_for_tempplate9();

            }else if(template_no == 10){

                go_for_tempplate10();

            }else if(template_no == 11){

                go_for_tempplate11();

            }else if(template_no == 12){

                go_for_tempplate12();

            }else if(template_no == 13){

                go_for_tempplate13();

            }else if(template_no == 14){

                go_for_tempplate14();

            }else if(template_no == 15){

                go_for_tempplate15();

            }else if(template_no == 16){

                go_for_tempplate16();

            }else if(template_no == 17){

                go_for_tempplate17();

            }else if(template_no == 18){

                go_for_tempplate18();

            }else if(template_no == 19){

                go_for_tempplate19();

            }else if(template_no == 20){

                go_for_tempplate20();

            }



        }























































        // TEMPLATE 1





        function go_for_tempplate1(argument) {



            jQuery('.wall_display_main .wall_type_1').text(''); 

            jQuery('.wall_images').html('');



            //

           for(i=0;i<panel_details_holder.length;i++){

            var append_div = '<div class="items wall_canvas_item_'+ (i+1) +'"><span class="pannel_sizes">20x16</span><canvas id="canvas_'+ (i+1) +'"></canvas></div>';

            var append_img = '<img id="image_'+(i+1)+'" src="" />'; 

            jQuery('.wall_display_main .wall_type_1').append(append_div);

            jQuery('.wall_images').append(append_img);

           }



            for(j=0; j<jQuery('.items').length;j++){

                var curren_panel = jQuery('.items').eq(j);   

               // alert(panel_details_holder[j][0]);   

               var size_txt =   panel_details_holder[j][0]+'x'+panel_details_holder[j][1];

                curren_panel.find('.pannel_sizes').text(size_txt);

                curren_panel.width((jQuery('.wall_type_1').width() * panel_details_holder[j][0])/panel_details_inch.w  );

                curren_panel.height((jQuery('.wall_type_1').height() * panel_details_holder[j][1])/panel_details_inch.h  );

                if(j == 0){

                    curren_panel.css({'left':'0', 'top':'0'});

                }else if(j == 1){

                    var left_pos = jQuery('.items').eq(0).width() - curren_panel.width();

                    curren_panel.css({'bottom':'0', 'left':left_pos+'px'});

                }else if(j == 2){

                    curren_panel.css({'right':'0', 'top':'0'});

                }

               

            }

            //assigning the fabric js



            canvases = [];

             for(i=0; i<jQuery('.items').length;i++){

                var canvas_id = jQuery('.items').eq(i).find('canvas').attr('id'),

                    can_w = jQuery('.items').eq(i).width(),

                    can_h = jQuery('.items').eq(i).height();



                var main_Editarea = new fabric.Canvas(canvas_id, {

                    preserveObjectStacking: true,

                    width: can_w,

                    height: can_h

                });

                canvases.push(main_Editarea);

            }

            for(k=0; k<canvases.length;k++){

                var texts = new fabric.Text('DRAG PHOTO HERE', {

                    fontFamily: 'Open Sans',

                    fontSize: 15,

                    fontWeight: '600',

                    left: canvases[k].width / 2,

                    top: canvases[k].height / 2,

                    selectable: false,

                    fill: '#4d4d4d',

                });

                    canvases[k].add(texts);
                    canvases[k].centerObject(texts);

                   // canvases[k].setBackgroundImage(canvas_background.image, canvases[k].renderAll.bind(canvases[k]));                 

            }

            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[0].getHeight());
                canvases[0].setBackgroundImage(imgs);
                canvases[0].backgroundImage.opacity = canvas_background.opacity;
                canvases[0].renderAll();

            });
            
            
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[1].getHeight());
                canvases[1].setBackgroundImage(imgs);
                canvases[1].backgroundImage.opacity = canvas_background.opacity;
                canvases[1].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[2].getHeight());
                canvases[2].setBackgroundImage(imgs);
                canvases[2].backgroundImage.opacity = canvas_background.opacity;
                canvases[2].renderAll();

            });


            // for image editor

                canvases[0].on('object:selected', onObjectSelected);

                canvases[1].on('object:selected', onObjectSelected);

                canvases[2].on('object:selected', onObjectSelected);

                canvases[1].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                });
                 canvases[0].on('mouse:up',function (argument) {
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                });
                 canvases[2].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                });










        }









        // TEMPLATE 2





        function go_for_tempplate2(argument) {



            jQuery('.wall_display_main .wall_type_1').html('');

            jQuery('.wall_images').html('');

            //

           for(i=0;i<panel_details_holder.length;i++){

            var append_div = '<div class="items wall_canvas_item_'+ (i+1) +'"><span class="pannel_sizes">20x16</span><canvas id="canvas_'+ (i+1) +'"></canvas></div>';

             var append_img = '<img id="image_'+(i+1)+'" src="" />'; 

            jQuery('.wall_display_main .wall_type_1').append(append_div);

             jQuery('.wall_images').append(append_img);

           }



            for(j=0; j<jQuery('.items').length;j++){

                var curren_panel = jQuery('.items').eq(j);        

                var size_txt =   panel_details_holder[j][0]+'x'+panel_details_holder[j][1];

                curren_panel.find('.pannel_sizes').text(size_txt);

                curren_panel.width((jQuery('.wall_type_1').width() * panel_details_holder[j][0])/panel_details_inch.w  );

                curren_panel.height((jQuery('.wall_type_1').height() * panel_details_holder[j][1])/panel_details_inch.h  );

                if(j == 0){

                    curren_panel.css({'left':'0', 'top':'0'});

                }else if(j == 1){

                    var left_pos = jQuery('.items').eq(0).width() - curren_panel.width();

                    curren_panel.css({'bottom':'0', 'right':'0px'});

                }else if(j == 2){

                    curren_panel.css({'right':'0', 'top':'0'});

                }

               

            }

            //assigning the fabric js

            canvases = [];



             for(i=0; i<jQuery('.items').length;i++){

                var canvas_id = jQuery('.items').eq(i).find('canvas').attr('id'),

                    can_w = jQuery('.items').eq(i).width(),

                    can_h = jQuery('.items').eq(i).height();



                var main_Editarea = new fabric.Canvas(canvas_id, {

                    preserveObjectStacking: true,

                    width: can_w,

                    height: can_h

                });

                //main_Editarea.width = parseInt(can_w);

               // main_Editarea.height = 900;

                canvases.push(main_Editarea);

            }

            for(k=0; k<canvases.length;k++){

                var texts = new fabric.Text('DRAG PHOTO HERE', {

                    fontFamily: 'Open Sans',

                    fontSize: 15,

                    fontWeight: '600',

                    left: canvases[k].width / 2,

                    top: canvases[k].height / 2,

                    selectable: false,

                    fill: '#4d4d4d',

                });

                    canvases[k].add(texts);
                    canvases[k].centerObject(texts);

            }

            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[0].getHeight());
                canvases[0].setBackgroundImage(imgs);
                canvases[0].backgroundImage.opacity = canvas_background.opacity;
                canvases[0].renderAll();

            });
            
            
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[1].getHeight());
                canvases[1].setBackgroundImage(imgs);
                canvases[1].backgroundImage.opacity = canvas_background.opacity;
                canvases[1].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[2].getHeight());
                canvases[2].setBackgroundImage(imgs);
                canvases[2].backgroundImage.opacity = canvas_background.opacity;
                canvases[2].renderAll();

            });




                canvases[0].on('object:selected', onObjectSelected);
                canvases[1].on('object:selected', onObjectSelected);
                canvases[2].on('object:selected', onObjectSelected);

                canvases[1].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                });
                 canvases[0].on('mouse:up',function (argument) {
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                });
                 canvases[2].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                });



        }



        // TEMPLATE 3





        function go_for_tempplate3(argument) {



            jQuery('.wall_display_main .wall_type_1').html('');

            jQuery('.wall_images').html('');

            //

           for(i=0;i<panel_details_holder.length;i++){

            var append_div = '<div class="items wall_canvas_item_'+ (i+1) +'"><span class="pannel_sizes">20x16</span><canvas id="canvas_'+ (i+1) +'"></canvas></div>';

            jQuery('.wall_display_main .wall_type_1').append(append_div);

             var append_img = '<img id="image_'+(i+1)+'" src="" />'; 

            jQuery('.wall_images').append(append_img);

           }



            for(j=0; j<jQuery('.items').length;j++){

                var curren_panel = jQuery('.items').eq(j);  

                var size_txt =   panel_details_holder[j][0]+'x'+panel_details_holder[j][1];

                curren_panel.find('.pannel_sizes').text(size_txt);       

                

                curren_panel.width((jQuery('.wall_type_1').width() * panel_details_holder[j][0])/panel_details_inch.w  );

               

                curren_panel.height((jQuery('.wall_type_1').height() )/2  );

               

                if(j == 0){

                    curren_panel.css({'left':'0', 'top':'50%', 'transform':'translateY(-50%)'});

                }else if(j == 1){

                    var left_pos = jQuery('.items').eq(0).width();

                    curren_panel.css({'top':'50%', 'left':'0px', 'right':'0px', 'margin':'0 auto', 'transform':'translateY(-50%)'});

                }else if(j == 2){

                    curren_panel.css({'right':'0', 'top':'50%', 'transform':'translateY(-50%)'});

                }

               

            }

            //assigning the fabric js

            canvases = [];



             for(i=0; i<jQuery('.items').length;i++){

                var canvas_id = jQuery('.items').eq(i).find('canvas').attr('id'),

                    can_w = jQuery('.items').eq(i).width(),

                    can_h = jQuery('.items').eq(i).height();



                var main_Editarea = new fabric.Canvas(canvas_id, {

                    preserveObjectStacking: true,

                    width: can_w,

                    height: can_h

                });

                //main_Editarea.width = parseInt(can_w);

                //main_Editarea.height = 900;

                canvases.push(main_Editarea);

            }

            for(k=0; k<canvases.length;k++){

                var texts = new fabric.Text('DRAG PHOTO HERE', {

                    fontFamily: 'Open Sans',

                    fontSize: 15,

                    fontWeight: '600',

                    left: canvases[k].width / 2,

                    top: canvases[k].height / 2,

                    selectable: false,

                    fill: '#4d4d4d',

                });

                    canvases[k].add(texts);
                    canvases[k].centerObject(texts);

            }

            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[0].getHeight());
                canvases[0].setBackgroundImage(imgs);
                canvases[0].backgroundImage.opacity = canvas_background.opacity;
                canvases[0].renderAll();

            });
            
            
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[1].getHeight());
                canvases[1].setBackgroundImage(imgs);
                canvases[1].backgroundImage.opacity = canvas_background.opacity;
                canvases[1].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[2].getHeight());
                canvases[2].setBackgroundImage(imgs);
                canvases[2].backgroundImage.opacity = canvas_background.opacity;
                canvases[2].renderAll();

            });





                canvases[0].on('object:selected', onObjectSelected);
                canvases[1].on('object:selected', onObjectSelected);
                canvases[2].on('object:selected', onObjectSelected);

                canvases[1].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                });
                 canvases[0].on('mouse:up',function (argument) {
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                });
                 canvases[2].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                });


        }



        // TEMPLATE 4





        function go_for_tempplate4(argument) {



           // jQuery('.wall_display_main .wall_type_1').html('').css({'transform':'scale(.7)'});

            jQuery('.wall_display_main .wall_type_1').html('');

            jQuery('.wall_images').html('');



            //

           for(i=0;i<panel_details_holder.length;i++){

            var append_div = '<div class="items wall_canvas_item_'+ (i+1) +'"><span class="pannel_sizes">20x16</span><canvas id="canvas_'+ (i+1) +'"></canvas></div>';

            jQuery('.wall_display_main .wall_type_1').append(append_div);

             var append_img = '<img id="image_'+(i+1)+'" src="" />'; 

 jQuery('.wall_images').append(append_img);

           }



            for(j=0; j<jQuery('.items').length;j++){

                var curren_panel = jQuery('.items').eq(j);        

                var size_txt =   panel_details_holder[j][0]+'x'+panel_details_holder[j][1];

                curren_panel.find('.pannel_sizes').text(size_txt);

                curren_panel.width((jQuery('.wall_type_1').width() * panel_details_holder[j][0])/panel_details_inch.w  );

               

                curren_panel.height((jQuery('.wall_type_1').width() * panel_details_holder[j][0])/panel_details_inch.w   );

               

                if(j == 0){

                    curren_panel.css({'left':'0', 'top':'50%', 'transform':'translateY(-50%)'});

                }else if(j == 1){

                    var left_pos = jQuery('.items').eq(0).width();

                    curren_panel.css({'top':'50%', 'left':'0px', 'right':'0px', 'margin':'0 auto', 'transform':'translateY(-50%)'});

                }else if(j == 2){

                    curren_panel.css({'right':'0', 'top':'50%', 'transform':'translateY(-50%)'});

                }

               

            }

            //assigning the fabric js

            canvases = [];



             for(i=0; i<jQuery('.items').length;i++){

                var canvas_id = jQuery('.items').eq(i).find('canvas').attr('id'),

                    can_w = jQuery('.items').eq(i).width(),

                    can_h = jQuery('.items').eq(i).height();



                var main_Editarea = new fabric.Canvas(canvas_id, {

                    preserveObjectStacking: true,

                    width: can_w,

                    height: can_h

                });

                //main_Editarea.width = parseInt(can_w);

                //main_Editarea.height = 900;

                canvases.push(main_Editarea);

            }

            for(k=0; k<canvases.length;k++){

                var texts = new fabric.Text('DRAG PHOTO HERE', {

                    fontFamily: 'Open Sans',

                    fontSize: 15,

                    fontWeight: '600',

                    left: canvases[k].width / 2,

                    top: canvases[k].height / 2,

                    selectable: false,

                    fill: '#4d4d4d',

                });

                    canvases[k].add(texts);
                    canvases[k].centerObject(texts);

            }
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[0].getHeight());
                canvases[0].setBackgroundImage(imgs);
                canvases[0].backgroundImage.opacity = canvas_background.opacity;
                canvases[0].renderAll();

            });
            
            
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[1].getHeight());
                canvases[1].setBackgroundImage(imgs);
                canvases[1].backgroundImage.opacity = canvas_background.opacity;
                canvases[1].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[2].getHeight());
                canvases[2].setBackgroundImage(imgs);
                canvases[2].backgroundImage.opacity = canvas_background.opacity;
                canvases[2].renderAll();

            });

                canvases[0].on('object:selected', onObjectSelected);
                canvases[1].on('object:selected', onObjectSelected);
                canvases[2].on('object:selected', onObjectSelected);


                canvases[1].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                });
                 canvases[0].on('mouse:up',function (argument) {
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                });
                 canvases[2].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                });





        }





        // TEMPLATE 5





        function go_for_tempplate5(argument) {



            jQuery('.wall_display_main .wall_type_1').html('');

            jQuery('.wall_images').html('');



           

           for(i=0;i<panel_details_holder.length;i++){

            var append_div = '<div class="items wall_canvas_item_'+ (i+1) +'"><span class="pannel_sizes">20x16</span><canvas id="canvas_'+ (i+1) +'"></canvas></div>';

            jQuery('.wall_display_main .wall_type_1').append(append_div);

             var append_img = '<img id="image_'+(i+1)+'" src="" />'; 

 jQuery('.wall_images').append(append_img);

           }



            for(j=0; j<jQuery('.items').length;j++){

                var curren_panel = jQuery('.items').eq(j);        

                var size_txt =   panel_details_holder[j][0]+'x'+panel_details_holder[j][1];

                curren_panel.find('.pannel_sizes').text(size_txt);

                curren_panel.width((jQuery('.wall_type_1').width() * panel_details_holder[j][0])/panel_details_inch.w  );

                curren_panel.height((jQuery('.wall_type_1').height() * panel_details_holder[j][1])/panel_details_inch.h  );

                if(j == 0){

                    curren_panel.css({'left':'0', 'top':'0'});

                }else if(j == 1){

                    var left_pos = jQuery('.items').eq(0).width() - curren_panel.width();

                    curren_panel.css({'bottom':'0', 'left':left_pos+'px'});

                }else if(j == 2){

                    curren_panel.css({'right':'0', 'bottom':'0'});

                }else if(j == 3){

                    curren_panel.css({'right':'0', 'top':'0'});

                }

               

            }

            //assigning the fabric js

            canvases = [];



             for(i=0; i<jQuery('.items').length;i++){

                var canvas_id = jQuery('.items').eq(i).find('canvas').attr('id'),

                    can_w = jQuery('.items').eq(i).width(),

                    can_h = jQuery('.items').eq(i).height();



                var main_Editarea = new fabric.Canvas(canvas_id, {

                    preserveObjectStacking: true,

                    width: can_w,

                    height: can_h

                });

                //main_Editarea.width = parseInt(can_w);

                //main_Editarea.height = 900;

                canvases.push(main_Editarea);

            }

            for(k=0; k<canvases.length;k++){

                var texts = new fabric.Text('DRAG PHOTO HERE', {

                    fontFamily: 'Open Sans',

                    fontSize: 15,

                    fontWeight: '600',

                    left: canvases[k].width / 2,

                    top: canvases[k].height / 2,

                    selectable: false,

                    fill: '#4d4d4d',

                });

                    canvases[k].add(texts);
                    canvases[k].centerObject(texts);

            }
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[0].getHeight());
                canvases[0].setBackgroundImage(imgs);
                canvases[0].backgroundImage.opacity = canvas_background.opacity;
                canvases[0].renderAll();

            });
            
            
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[1].getHeight());
                canvases[1].setBackgroundImage(imgs);
                canvases[1].backgroundImage.opacity = canvas_background.opacity;
                canvases[1].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[2].getHeight());
                canvases[2].setBackgroundImage(imgs);
                canvases[2].backgroundImage.opacity = canvas_background.opacity;
                canvases[2].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[3].getHeight());
                canvases[3].setBackgroundImage(imgs);
                canvases[3].backgroundImage.opacity = canvas_background.opacity;
                canvases[3].renderAll();

            });
            // fabric.Image.fromURL(canvas_background.image, function(imgs) {
            //     imgs.resizeFilter = new fabric.Image.filters.Resize({
            //         resizeType: 'hermite',
            //         scaleX: 1 / 6,
            //         scaleY: 1 / 6,
            //     });

            //     imgs.applyFilters();
            //     imgs.scaleToHeight(canvases[3].getHeight());
            //     canvases[4].setBackgroundImage(imgs);
            //     canvases[4].backgroundImage.opacity = canvas_background.opacity;
            //     canvases[4].renderAll();

            // });


                canvases[0].on('object:selected', onObjectSelected);
                canvases[1].on('object:selected', onObjectSelected);
                canvases[2].on('object:selected', onObjectSelected);
                canvases[3].on('object:selected', onObjectSelected);
                // canvases[4].on('object:selected', onObjectSelected);

                 canvases[0].on('mouse:up',function (argument) {
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                   // canvases[4].deactivateAll().renderAll();
                });

                canvases[1].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    //canvases[4].deactivateAll().renderAll();
                });
                
                canvases[2].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    //canvases[4].deactivateAll().renderAll();
                });
                canvases[3].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    //canvases[4].deactivateAll().renderAll();
                });
                // canvases[4].on('mouse:up',function (argument) {
                //     canvases[0].deactivateAll().renderAll();
                //     canvases[1].deactivateAll().renderAll();
                //     canvases[3].deactivateAll().renderAll();
                //     canvases[2].deactivateAll().renderAll();
                // });





        }



        // TEMPLATE 6





        function go_for_tempplate6(argument) {



            jQuery('.wall_display_main .wall_type_1').html('');

            jQuery('.wall_images').html('');



            //

           for(i=0;i<panel_details_holder.length;i++){

            var append_div = '<div class="items wall_canvas_item_'+ (i+1) +'"><span class="pannel_sizes">20x16</span><canvas id="canvas_'+ (i+1) +'"></canvas></div>';

            jQuery('.wall_display_main .wall_type_1').append(append_div);

             var append_img = '<img id="image_'+(i+1)+'" src="" />'; 

 jQuery('.wall_images').append(append_img);

           }



            for(j=0; j<jQuery('.items').length;j++){

                var curren_panel = jQuery('.items').eq(j);        

                var size_txt =   panel_details_holder[j][0]+'x'+panel_details_holder[j][1];

                curren_panel.find('.pannel_sizes').text(size_txt);

                curren_panel.width((jQuery('.wall_type_1').width() * panel_details_holder[j][0])/panel_details_inch.w  );

                curren_panel.height((jQuery('.wall_type_1').height() * panel_details_holder[j][1])/panel_details_inch.h  );

                if(j == 0){

                    curren_panel.css({'left':'0', 'top':'0'});

                }else if(j == 1){

                    var left_pos = jQuery('.items').eq(0).width() - curren_panel.width();

                    curren_panel.css({'bottom':'50%','right':'0', 'transform':'translateY(50%)'});

                }else if(j == 2){

                    curren_panel.css({'right':'0', 'bottom':'0'});

                }else if(j == 3){

                    curren_panel.css({'right':'0', 'top':'0'});

                }

               

            }

            //assigning the fabric js

            canvases = [];



             for(i=0; i<jQuery('.items').length;i++){

                var canvas_id = jQuery('.items').eq(i).find('canvas').attr('id'),

                    can_w = jQuery('.items').eq(i).width(),

                    can_h = jQuery('.items').eq(i).height();



                var main_Editarea = new fabric.Canvas(canvas_id, {

                    preserveObjectStacking: true,

                    width: can_w,

                    height: can_h

                });

                ////main_Editarea.width = parseInt(can_w);

               // main_Editarea.height = 900;

                canvases.push(main_Editarea);

            }


            for(k=0; k<canvases.length;k++){

                var texts = new fabric.Text('DRAG PHOTO HERE', {

                    fontFamily: 'Open Sans',

                    fontSize: 15,

                    fontWeight: '600',

                    left: canvases[k].width / 2,

                    top: canvases[k].height / 2,

                    selectable: false,

                    fill: '#4d4d4d',

                });

                    canvases[k].add(texts);
                    canvases[k].centerObject(texts);

            }

            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[0].getHeight());
                canvases[0].setBackgroundImage(imgs);
                canvases[0].backgroundImage.opacity = canvas_background.opacity;
                canvases[0].renderAll();

            });
            
            
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[1].getHeight());
                canvases[1].setBackgroundImage(imgs);
                canvases[1].backgroundImage.opacity = canvas_background.opacity;
                canvases[1].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[2].getHeight());
                canvases[2].setBackgroundImage(imgs);
                canvases[2].backgroundImage.opacity = canvas_background.opacity;
                canvases[2].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[3].getHeight());
                canvases[3].setBackgroundImage(imgs);
                canvases[3].backgroundImage.opacity = canvas_background.opacity;
                canvases[3].renderAll();

            });
           


                canvases[0].on('object:selected', onObjectSelected);
                canvases[1].on('object:selected', onObjectSelected);
                canvases[2].on('object:selected', onObjectSelected);
                canvases[3].on('object:selected', onObjectSelected);

                canvases[0].on('mouse:up',function (argument) {
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                });

                canvases[1].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                });
                
                canvases[2].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                });
                canvases[3].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                });
                





        }



        // TEMPLATE 7





        function go_for_tempplate7(argument) {



            jQuery('.wall_display_main .wall_type_1').html('');

            jQuery('.wall_images').html('');



            //

           for(i=0;i<panel_details_holder.length;i++){

            var append_div = '<div class="items wall_canvas_item_'+ (i+1) +'"><span class="pannel_sizes">20x16</span><canvas id="canvas_'+ (i+1) +'"></canvas></div>';

            jQuery('.wall_display_main .wall_type_1').append(append_div);

             var append_img = '<img id="image_'+(i+1)+'" src="" />'; 

 jQuery('.wall_images').append(append_img);

           }



            for(j=0; j<jQuery('.items').length;j++){

                var curren_panel = jQuery('.items').eq(j);        

                var size_txt =   panel_details_holder[j][0]+'x'+panel_details_holder[j][1];

                curren_panel.find('.pannel_sizes').text(size_txt);

                curren_panel.width((jQuery('.wall_type_1').width() * panel_details_holder[j][0])/panel_details_inch.w  );

                curren_panel.height((jQuery('.wall_type_1').height() * panel_details_holder[j][1])/panel_details_inch.h  );

                if(j == 0){

                    curren_panel.css({'left':'0', 'top':'0'});

                }else if(j == 1){

                    var left_pos = jQuery('.items').eq(0).width() - curren_panel.width();

                    curren_panel.css({'bottom':'0%','left':'0'});

                }else if(j == 2){

                    curren_panel.css({'right':'0', 'bottom':'0'});

                }else if(j == 3){

                    curren_panel.css({'right':'0', 'top':'0'});

                }

               

            }

            //assigning the fabric js

            canvases = [];



             for(i=0; i<jQuery('.items').length;i++){

                var canvas_id = jQuery('.items').eq(i).find('canvas').attr('id'),

                    can_w = jQuery('.items').eq(i).width(),

                    can_h = jQuery('.items').eq(i).height();



                var main_Editarea = new fabric.Canvas(canvas_id, {

                    preserveObjectStacking: true,

                    width: can_w,

                    height: can_h

                });

               // main_Editarea.width = parseInt(can_w);

                //main_Editarea.height = 900;

                canvases.push(main_Editarea);

            }


            for(k=0; k<canvases.length;k++){

                var texts = new fabric.Text('DRAG PHOTO HERE', {

                    fontFamily: 'Open Sans',

                    fontSize: 12,

                    fontWeight: '600',

                    left: canvases[k].width / 2,

                    top: canvases[k].height / 2,

                    selectable: false,

                    fill: '#4d4d4d',

                });

                    canvases[k].add(texts);
                    canvases[k].centerObject(texts);

            }
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[0].getHeight());
                canvases[0].setBackgroundImage(imgs);
                canvases[0].backgroundImage.opacity = canvas_background.opacity;
                canvases[0].renderAll();

            });
            
            
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[1].getHeight());
                canvases[1].setBackgroundImage(imgs);
                canvases[1].backgroundImage.opacity = canvas_background.opacity;
                canvases[1].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[2].getHeight());
                canvases[2].setBackgroundImage(imgs);
                canvases[2].backgroundImage.opacity = canvas_background.opacity;
                canvases[2].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[3].getHeight());
                canvases[3].setBackgroundImage(imgs);
                canvases[3].backgroundImage.opacity = canvas_background.opacity;
                canvases[3].renderAll();

            });
            


                canvases[0].on('object:selected', onObjectSelected);
                canvases[1].on('object:selected', onObjectSelected);
                canvases[2].on('object:selected', onObjectSelected);
                canvases[3].on('object:selected', onObjectSelected);

canvases[0].on('mouse:up',function (argument) {
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                });

                canvases[1].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                });
                
                canvases[2].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                });
                canvases[3].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                });
               





        }





         // TEMPLATE 8





        function go_for_tempplate8(argument) {



            jQuery('.wall_display_main .wall_type_1').html('');

            jQuery('.wall_images').html('');



            //

           for(i=0;i<panel_details_holder.length;i++){

            var append_div = '<div class="items wall_canvas_item_'+ (i+1) +'"><span class="pannel_sizes">20x16</span><canvas id="canvas_'+ (i+1) +'"></canvas></div>';

            jQuery('.wall_display_main .wall_type_1').append(append_div);

             var append_img = '<img id="image_'+(i+1)+'" src="" />'; 

 jQuery('.wall_images').append(append_img);

           }



            for(j=0; j<jQuery('.items').length;j++){

                var curren_panel = jQuery('.items').eq(j);        

                var size_txt =   panel_details_holder[j][0]+'x'+panel_details_holder[j][1];

                curren_panel.find('.pannel_sizes').text(size_txt);

                curren_panel.width((jQuery('.wall_type_1').width() * panel_details_holder[j][0])/panel_details_inch.w  );

                curren_panel.height((jQuery('.wall_type_1').height() * panel_details_holder[j][1])/panel_details_inch.h  );

                if(j == 0){

                    curren_panel.css({'left':'0', 'top':'0'});

                }else if(j == 1){

                    var left_pos = jQuery('.items').eq(0).width() - curren_panel.width();

                    curren_panel.css({'bottom':'50%','right':'0', 'transform':'translateY(50%)'});

                }else if(j == 2){

                    curren_panel.css({'right':'0', 'bottom':'0'});

                }else if(j == 3){

                    curren_panel.css({'right':'0', 'top':'0'});

                }

               

            }

            //assigning the fabric js

            canvases = [];



             for(i=0; i<jQuery('.items').length;i++){

                var canvas_id = jQuery('.items').eq(i).find('canvas').attr('id'),

                    can_w = jQuery('.items').eq(i).width(),

                    can_h = jQuery('.items').eq(i).height();



                var main_Editarea = new fabric.Canvas(canvas_id, {

                    preserveObjectStacking: true,

                    width: can_w,

                    height: can_h

                });

               // main_Editarea.width = parseInt(can_w);

                //main_Editarea.height = 900;

                canvases.push(main_Editarea);

            }

            for(k=0; k<canvases.length;k++){

                var texts = new fabric.Text('DRAG PHOTO HERE', {

                    fontFamily: 'Open Sans',

                    fontSize: 15,

                    fontWeight: '600',

                    left: canvases[k].width / 2,

                    top: canvases[k].height / 2,

                    selectable: false,

                    fill: '#4d4d4d',

                });

                    canvases[k].add(texts);
                    canvases[k].centerObject(texts);

            }


            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[0].getHeight());
                canvases[0].setBackgroundImage(imgs);
                canvases[0].backgroundImage.opacity = canvas_background.opacity;
                canvases[0].renderAll();

            });
            
            
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[1].getHeight());
                canvases[1].setBackgroundImage(imgs);
                canvases[1].backgroundImage.opacity = canvas_background.opacity;
                canvases[1].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[2].getHeight());
                canvases[2].setBackgroundImage(imgs);
                canvases[2].backgroundImage.opacity = canvas_background.opacity;
                canvases[2].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[3].getHeight());
                canvases[3].setBackgroundImage(imgs);
                canvases[3].backgroundImage.opacity = canvas_background.opacity;
                canvases[3].renderAll();

            });           


                canvases[0].on('object:selected', onObjectSelected);
                canvases[1].on('object:selected', onObjectSelected);
                canvases[2].on('object:selected', onObjectSelected);
                canvases[3].on('object:selected', onObjectSelected);



                canvases[0].on('mouse:up',function (argument) {
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                });

                canvases[1].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                });
                
                canvases[2].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                });
                canvases[3].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                });
              



        }



        // TEMPLATE 9





        function go_for_tempplate9(argument) {





            jQuery('.wall_display_main .wall_type_1').html('');

            jQuery('.wall_images').html('');



            //

           for(i=0;i<panel_details_holder.length;i++){

            var append_div = '<div class="items wall_canvas_item_'+ (i+1) +'"><span class="pannel_sizes">20x16</span><canvas id="canvas_'+ (i+1) +'"></canvas></div>';

            jQuery('.wall_display_main .wall_type_1').append(append_div);

             var append_img = '<img id="image_'+(i+1)+'" src="" />'; 

            jQuery('.wall_images').append(append_img);

           }



            for(j=0; j<jQuery('.items').length;j++){

                var curren_panel = jQuery('.items').eq(j);        

                var size_txt =   panel_details_holder[j][0]+'x'+panel_details_holder[j][1];

                curren_panel.find('.pannel_sizes').text(size_txt);

                curren_panel.width((jQuery('.wall_type_1').width() * panel_details_holder[j][0])/panel_details_inch.w  );

                curren_panel.height((jQuery('.wall_type_1').height() * panel_details_holder[j][1])/panel_details_inch.h  );

                if(j == 0){

                    curren_panel.css({'left':'0', 'top':'0'});

                }else if(j == 1){

                    var left_pos = jQuery('.items').eq(0).width() - curren_panel.width();

                    curren_panel.css({'top':'0%','right':'0','left':'0','margin':'auto' });

                }else if(j == 2){

                    curren_panel.css({'right':'0', 'bottom':'0'});

                }else if(j == 3){

                    curren_panel.css({'bottom':'0%','right':'0','left':'0','margin':'auto' });

                }

               

            }

            //assigning the fabric js

            canvases = [];



             for(i=0; i<jQuery('.items').length;i++){

                var canvas_id = jQuery('.items').eq(i).find('canvas').attr('id'),

                    can_w = jQuery('.items').eq(i).width(),

                    can_h = jQuery('.items').eq(i).height();



                var main_Editarea = new fabric.Canvas(canvas_id, {

                    preserveObjectStacking: true,

                    width: can_w,

                    height: can_h

                });

                //main_Editarea.width = parseInt(can_w);

                //main_Editarea.height = 900;

                canvases.push(main_Editarea);

            }

            for(k=0; k<canvases.length;k++){

                var texts = new fabric.Text('DRAG PHOTO HERE', {

                    fontFamily: 'Open Sans',

                    fontSize: 15,

                    fontWeight: '600',

                    left: canvases[k].width / 2,

                    top: canvases[k].height / 2,

                    selectable: false,

                    fill: '#4d4d4d',

                });

                    canvases[k].add(texts);
                    canvases[k].centerObject(texts);

            }

         


            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[0].getHeight());
                canvases[0].setBackgroundImage(imgs);
                canvases[0].backgroundImage.opacity = canvas_background.opacity;
                canvases[0].renderAll();

            });
            
            
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[1].getHeight());
                canvases[1].setBackgroundImage(imgs);
                canvases[1].backgroundImage.opacity = canvas_background.opacity;
                canvases[1].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[2].getHeight());
                canvases[2].setBackgroundImage(imgs);
                canvases[2].backgroundImage.opacity = canvas_background.opacity;
                canvases[2].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[3].getHeight());
                canvases[3].setBackgroundImage(imgs);
                canvases[3].backgroundImage.opacity = canvas_background.opacity;
                canvases[3].renderAll();

            });            

         


                canvases[0].on('object:selected', onObjectSelected);
                canvases[1].on('object:selected', onObjectSelected);
                canvases[2].on('object:selected', onObjectSelected);
                canvases[3].on('object:selected', onObjectSelected);
               

                canvases[0].on('mouse:up',function (argument) {
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                   // canvases[4].deactivateAll().renderAll();
                });

                canvases[1].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                   // canvases[4].deactivateAll().renderAll();
                });
                
                canvases[2].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                  // canvases[4].deactivateAll().renderAll();
                });
                canvases[3].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                   // canvases[4].deactivateAll().renderAll();
                });
               



        }



        // TEMPLATE 10





        function go_for_tempplate10(argument) {



            jQuery('.wall_display_main .wall_type_1').html('');

            jQuery('.wall_images').html('');



            //

           for(i=0;i<panel_details_holder.length;i++){

            var append_div = '<div class="items wall_canvas_item_'+ (i+1) +'"><span class="pannel_sizes">20x16</span><canvas id="canvas_'+ (i+1) +'"></canvas></div>';

            jQuery('.wall_display_main .wall_type_1').append(append_div);

             var append_img = '<img id="image_'+(i+1)+'" src="" />'; 

 jQuery('.wall_images').append(append_img);

           }



            for(j=0; j<jQuery('.items').length;j++){

                var curren_panel = jQuery('.items').eq(j);        

                var size_txt =   panel_details_holder[j][0]+'x'+panel_details_holder[j][1];

                curren_panel.find('.pannel_sizes').text(size_txt);

                curren_panel.width((jQuery('.wall_type_1').width() * panel_details_holder[j][0])/panel_details_inch.w  );

                curren_panel.height((jQuery('.wall_type_1').height() * panel_details_holder[j][1])/panel_details_inch.h  );

                if(j == 0){

                    curren_panel.css({'left':'0', 'top':'0'});

                }else if(j == 1){

                    var left_pos = jQuery('.items').eq(0).width() - curren_panel.width();

                    curren_panel.css({'top':'0%','right':'0', });

                }else if(j == 2){

                    curren_panel.css({'right':'0', 'bottom':'0'});

                }else if(j == 3){

                    curren_panel.css({'bottom':'0%','left':'0' });

                }

               

            }

            //assigning the fabric js

            canvases = [];



             for(i=0; i<jQuery('.items').length;i++){

                var canvas_id = jQuery('.items').eq(i).find('canvas').attr('id'),

                    can_w = jQuery('.items').eq(i).width(),

                    can_h = jQuery('.items').eq(i).height();



                var main_Editarea = new fabric.Canvas(canvas_id, {

                    preserveObjectStacking: true,

                    width: can_w,

                    height: can_h

                });

                //main_Editarea.width = parseInt(can_w);

                //main_Editarea.height = 900;

                canvases.push(main_Editarea);

            }


            for(k=0; k<canvases.length;k++){

                var texts = new fabric.Text('DRAG PHOTO HERE', {

                    fontFamily: 'Open Sans',

                    fontSize: 15,

                    fontWeight: '600',

                    left: canvases[k].width / 2,

                    top: canvases[k].height / 2,

                    selectable: false,

                    fill: '#4d4d4d',

                });

                    canvases[k].add(texts);
                    canvases[k].centerObject(texts);

            }

            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[0].getHeight());
                canvases[0].setBackgroundImage(imgs);
                canvases[0].backgroundImage.opacity = canvas_background.opacity;
                canvases[0].renderAll();

            });
            
            
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[1].getHeight());
                canvases[1].setBackgroundImage(imgs);
                canvases[1].backgroundImage.opacity = canvas_background.opacity;
                canvases[1].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[2].getHeight());
                canvases[2].setBackgroundImage(imgs);
                canvases[2].backgroundImage.opacity = canvas_background.opacity;
                canvases[2].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[3].getHeight());
                canvases[3].setBackgroundImage(imgs);
                canvases[3].backgroundImage.opacity = canvas_background.opacity;
                canvases[3].renderAll();

            });
            // fabric.Image.fromURL(canvas_background.image, function(imgs) {
            //     imgs.resizeFilter = new fabric.Image.filters.Resize({
            //         resizeType: 'hermite',
            //         scaleX: 1 / 6,
            //         scaleY: 1 / 6,
            //     });

            //     imgs.applyFilters();
            //     imgs.scaleToHeight(canvases[4].getHeight());
            //     canvases[4].setBackgroundImage(imgs);
            //     canvases[4].backgroundImage.opacity = canvas_background.opacity;
            //     canvases[4].renderAll();

            // });


                canvases[0].on('object:selected', onObjectSelected);
                canvases[1].on('object:selected', onObjectSelected);
                canvases[2].on('object:selected', onObjectSelected);
                canvases[3].on('object:selected', onObjectSelected);
               // canvases[4].on('object:selected', onObjectSelected);


                canvases[0].on('mouse:up',function (argument) {
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    //canvases[4].deactivateAll().renderAll();
                });

                canvases[1].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    //canvases[4].deactivateAll().renderAll();
                });
                
                canvases[2].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    //canvases[4].deactivateAll().renderAll();
                });
                canvases[3].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    //canvases[4].deactivateAll().renderAll();
                });
                //  canvases[4].on('mouse:up',function (argument) {
                //     canvases[0].deactivateAll().renderAll();
                //     canvases[1].deactivateAll().renderAll();
                //     canvases[2].deactivateAll().renderAll();
                //     canvases[3].deactivateAll().renderAll();
                // });



        }







        // TEMPLATE 11





        function go_for_tempplate11(argument) {



            jQuery('.wall_display_main .wall_type_1').html('');

            jQuery('.wall_images').html('');



            //

           for(i=0;i<panel_details_holder.length;i++){

            var append_div = '<div class="items wall_canvas_item_'+ (i+1) +'"><span class="pannel_sizes">20x16</span><canvas id="canvas_'+ (i+1) +'"></canvas></div>';

            jQuery('.wall_display_main .wall_type_1').append(append_div);

             var append_img = '<img id="image_'+(i+1)+'" src="" />'; 

 jQuery('.wall_images').append(append_img);

           }



            for(j=0; j<jQuery('.items').length;j++){

                var curren_panel = jQuery('.items').eq(j);        

                var size_txt =   panel_details_holder[j][0]+'x'+panel_details_holder[j][1];

                curren_panel.find('.pannel_sizes').text(size_txt);

                curren_panel.width((jQuery('.wall_type_1').width() * panel_details_holder[j][0])/panel_details_inch.w  );

                curren_panel.height((jQuery('.wall_type_1').height() * panel_details_holder[j][1])/panel_details_inch.h  );

                if(j == 0){

                    curren_panel.css({'left':'0', 'top':'0'});

                }else if(j == 1){

                    var left_pos = jQuery('.items').eq(0).width() - curren_panel.width();

                    curren_panel.css({'top':'0%','right':'0', });

                }else if(j == 2){

                    curren_panel.css({'right':'0', 'bottom':'0'});

                }else if(j == 3){

                    curren_panel.css({'bottom':'0%','left':'0' });

                }else if(j == 4){

                    curren_panel.css({'left':'0%','right':'0', 'margin':'auto','top':'50%','transform':'translateY(-50%)' });

                }

               

            }

            //assigning the fabric js

            canvases = [];



             for(i=0; i<jQuery('.items').length;i++){

                var canvas_id = jQuery('.items').eq(i).find('canvas').attr('id'),

                    can_w = jQuery('.items').eq(i).width(),

                    can_h = jQuery('.items').eq(i).height();



                var main_Editarea = new fabric.Canvas(canvas_id, {

                    preserveObjectStacking: true,

                    width: can_w,

                    height: can_h

                });

                //main_Editarea.width = parseInt(can_w);

                //main_Editarea.height = 900;

                canvases.push(main_Editarea);

            }


            for(k=0; k<canvases.length;k++){

                var texts = new fabric.Text('DRAG PHOTO HERE', {

                    fontFamily: 'Open Sans',

                    fontSize: 12,

                    fontWeight: '600',

                    left: canvases[k].width / 2,

                    top: canvases[k].height / 2,

                    selectable: false,

                    fill: '#4d4d4d',

                });

                    canvases[k].add(texts);
                    canvases[k].centerObject(texts);

            }
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[0].getHeight());
                canvases[0].setBackgroundImage(imgs);
                canvases[0].backgroundImage.opacity = canvas_background.opacity;
                canvases[0].renderAll();

            });
            
            
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[1].getHeight());
                canvases[1].setBackgroundImage(imgs);
                canvases[1].backgroundImage.opacity = canvas_background.opacity;
                canvases[1].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[2].getHeight());
                canvases[2].setBackgroundImage(imgs);
                canvases[2].backgroundImage.opacity = canvas_background.opacity;
                canvases[2].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[3].getHeight());
                canvases[3].setBackgroundImage(imgs);
                canvases[3].backgroundImage.opacity = canvas_background.opacity;
                canvases[3].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[4].getHeight());
                canvases[4].setBackgroundImage(imgs);
                canvases[4].backgroundImage.opacity = canvas_background.opacity;
                canvases[4].renderAll();

            });
             


                canvases[0].on('object:selected', onObjectSelected);
                canvases[1].on('object:selected', onObjectSelected);
                canvases[2].on('object:selected', onObjectSelected);
                canvases[3].on('object:selected', onObjectSelected);
                canvases[4].on('object:selected', onObjectSelected);


                canvases[0].on('mouse:up',function (argument) {
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                });

                canvases[1].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                });
                
                canvases[2].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                });
                canvases[3].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                });
                 canvases[4].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                });



        }







        // TEMPLATE 12





        function go_for_tempplate12(argument) {



           // jQuery('.wall_display_main .wall_type_1').html('').css({'transform':'scale(.7)'});

            jQuery('.wall_display_main .wall_type_1').html('');

            jQuery('.wall_images').html('');



            //

           for(i=0;i<panel_details_holder.length;i++){

            var append_div = '<div class="items wall_canvas_item_'+ (i+1) +'"><span class="pannel_sizes">20x16</span><canvas id="canvas_'+ (i+1) +'"></canvas></div>';

            jQuery('.wall_display_main .wall_type_1').append(append_div);

             var append_img = '<img id="image_'+(i+1)+'" src="" />'; 

 jQuery('.wall_images').append(append_img);

           }

            jQuery('.wall_display_main .wall_type_1 .items').css({'float':'none', 'position':'inherit', 'display':'inline-block','margin':'0 9px','vertical-align':'middle' });

            jQuery('.wall_display_main .wall_type_1 .items:first-child').css({'margin-left':'0px'});

            jQuery('.wall_display_main .wall_type_1 .items:last-child').css({'margin-right':'0px'});

            for(j=0; j<jQuery('.items').length;j++){

                var curren_panel = jQuery('.items').eq(j);        

                var size_txt =   panel_details_holder[j][0]+'x'+panel_details_holder[j][1];

                curren_panel.find('.pannel_sizes').text(size_txt);

                curren_panel.width((jQuery('.wall_type_1').width() * panel_details_holder[j][0])/panel_details_inch.w  );

                curren_panel.height((jQuery('.wall_type_1').height() * panel_details_holder[j][1])/panel_details_inch.h  );

                

               

               

            }

            //assigning the fabric js

            canvases = [];



             for(i=0; i<jQuery('.items').length;i++){

                var canvas_id = jQuery('.items').eq(i).find('canvas').attr('id'),

                    can_w = jQuery('.items').eq(i).width(),

                    can_h = jQuery('.items').eq(i).height();



                var main_Editarea = new fabric.Canvas(canvas_id, {

                    preserveObjectStacking: true,

                    width: can_w,

                    height: can_h

                });

               // main_Editarea.width = parseInt(can_w);

               // main_Editarea.height = 900;

                canvases.push(main_Editarea);

            }

            for(k=0; k<canvases.length;k++){

                var texts = new fabric.Text('DRAG PHOTO HERE', {

                    fontFamily: 'Open Sans',

                    fontSize: 12,

                    fontWeight: '600',

                    left: canvases[k].width / 2,

                    top: canvases[k].height / 2,

                    selectable: false,

                    fill: '#4d4d4d',

                });

                    canvases[k].add(texts);
                    canvases[k].centerObject(texts);

            }
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[0].getHeight());
                canvases[0].setBackgroundImage(imgs);
                canvases[0].backgroundImage.opacity = canvas_background.opacity;
                canvases[0].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[1].getHeight());
                canvases[1].setBackgroundImage(imgs);
                canvases[1].backgroundImage.opacity = canvas_background.opacity;
                canvases[1].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[2].getHeight());
                canvases[2].setBackgroundImage(imgs);
                canvases[2].backgroundImage.opacity = canvas_background.opacity;
                canvases[2].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[3].getHeight());
                canvases[3].setBackgroundImage(imgs);
                canvases[3].backgroundImage.opacity = canvas_background.opacity;
                canvases[3].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[4].getHeight());
                canvases[4].setBackgroundImage(imgs);
                canvases[4].backgroundImage.opacity = canvas_background.opacity;
                canvases[4].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[5].getHeight());
                canvases[5].setBackgroundImage(imgs);
                canvases[5].backgroundImage.opacity = canvas_background.opacity;
                canvases[5].renderAll();

            });


                canvases[0].on('object:selected', onObjectSelected);
                canvases[1].on('object:selected', onObjectSelected);
                canvases[2].on('object:selected', onObjectSelected);
                canvases[3].on('object:selected', onObjectSelected);
                canvases[4].on('object:selected', onObjectSelected);
                canvases[5].on('object:selected', onObjectSelected);


                canvases[0].on('mouse:up',function (argument) {
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                });

                canvases[1].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                });
                
                canvases[2].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                });
                canvases[3].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                });
                 canvases[4].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                });
                 canvases[5].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                });





        }





        // TEMPLATE 13





        function go_for_tempplate13(argument) {



            jQuery('.wall_display_main .wall_type_1').html('');

            jQuery('.wall_images').html('');



            //

           for(i=0;i<panel_details_holder.length;i++){

            var append_div = '<div class="items wall_canvas_item_'+ (i+1) +'"><span class="pannel_sizes">20x16</span><canvas id="canvas_'+ (i+1) +'"></canvas></div>';

            jQuery('.wall_display_main .wall_type_1').append(append_div);

             var append_img = '<img id="image_'+(i+1)+'" src="" />'; 

 jQuery('.wall_images').append(append_img);

           }



            for(j=0; j<jQuery('.items').length;j++){

                var curren_panel = jQuery('.items').eq(j);        

                var size_txt =   panel_details_holder[j][0]+'x'+panel_details_holder[j][1];

                curren_panel.find('.pannel_sizes').text(size_txt);

                curren_panel.width((jQuery('.wall_type_1').width() * panel_details_holder[j][0])/panel_details_inch.w  );

                curren_panel.height((jQuery('.wall_type_1').height() * panel_details_holder[j][1])/panel_details_inch.h  );

                if(j == 0){

                    curren_panel.css({'left':'0', 'top':'0'});

                }else if(j == 1){

                    var left_pos = jQuery('.items').eq(0).width() - curren_panel.width();

                    curren_panel.css({'top':'50%','left':'0','transform':'translateY(-50%)' });

                }else if(j == 2){

                    curren_panel.css({'left':'0', 'bottom':'0'});

                }else if(j == 3){

                    curren_panel.css({'bottom':'0%','right':'0' });

                }else if(j == 4){

                    var left_pos = jQuery('.items').eq(0).width() - curren_panel.width();

                    curren_panel.css({'top':'50%','right':'0','transform':'translateY(-50%)' });



                }else if(j == 5){

                    curren_panel.css({'top':'0%','right':'0' });

                }

               

            }

            //assigning the fabric js

            canvases = [];



             for(i=0; i<jQuery('.items').length;i++){

                var canvas_id = jQuery('.items').eq(i).find('canvas').attr('id'),

                    can_w = jQuery('.items').eq(i).width(),

                    can_h = jQuery('.items').eq(i).height();



                var main_Editarea = new fabric.Canvas(canvas_id, {

                    preserveObjectStacking: true,

                    width: can_w,

                    height: can_h

                });

                //main_Editarea.width = parseInt(can_w);

                //main_Editarea.height = 900;

                canvases.push(main_Editarea);

            }

            for(k=0; k<canvases.length;k++){

                var texts = new fabric.Text('DRAG PHOTO HERE', {

                    fontFamily: 'Open Sans',

                    fontSize: 15,

                    fontWeight: '600',

                    left: canvases[k].width / 2,

                    top: canvases[k].height / 2,

                    selectable: false,

                    fill: '#4d4d4d',

                });

                    canvases[k].add(texts);
                    canvases[k].centerObject(texts);

            }


            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToWidth(canvases[0].getWidth());
                canvases[0].setBackgroundImage(imgs);
                canvases[0].backgroundImage.opacity = canvas_background.opacity;
                canvases[0].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[1].getHeight());
                canvases[1].setBackgroundImage(imgs);
                canvases[1].backgroundImage.opacity = canvas_background.opacity;
                canvases[1].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToWidth(canvases[2].getWidth());
                canvases[2].setBackgroundImage(imgs);
                canvases[2].backgroundImage.opacity = canvas_background.opacity;
                canvases[2].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[3].getHeight());
                canvases[3].setBackgroundImage(imgs);
                canvases[3].backgroundImage.opacity = canvas_background.opacity;
                canvases[3].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToWidth(canvases[4].getWidth());
                canvases[4].setBackgroundImage(imgs);
                canvases[4].backgroundImage.opacity = canvas_background.opacity;
                canvases[4].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[5].getHeight());
                canvases[5].setBackgroundImage(imgs);
                canvases[5].backgroundImage.opacity = canvas_background.opacity;
                canvases[5].renderAll();

            });


                canvases[0].on('object:selected', onObjectSelected);
                canvases[1].on('object:selected', onObjectSelected);
                canvases[2].on('object:selected', onObjectSelected);
                canvases[3].on('object:selected', onObjectSelected);
                canvases[4].on('object:selected', onObjectSelected);
                canvases[5].on('object:selected', onObjectSelected);

                canvases[0].on('mouse:up',function (argument) {
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                });

                canvases[1].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                });
                
                canvases[2].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                });
                canvases[3].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                });
                 canvases[4].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                });
                 canvases[5].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                });


        }











         // TEMPLATE 14





        function go_for_tempplate14(argument) {



            jQuery('.wall_display_main .wall_type_1').html('');

            jQuery('.wall_images').html('');



            //

           for(i=0;i<panel_details_holder.length;i++){

            var append_div = '<div class="items wall_canvas_item_'+ (i+1) +'"><span class="pannel_sizes">20x16</span><canvas id="canvas_'+ (i+1) +'"></canvas></div>';

            jQuery('.wall_display_main .wall_type_1').append(append_div);

             var append_img = '<img id="image_'+(i+1)+'" src="" />'; 

 jQuery('.wall_images').append(append_img);

           }



            for(j=0; j<jQuery('.items').length;j++){

                var curren_panel = jQuery('.items').eq(j);        

                var size_txt =   panel_details_holder[j][0]+'x'+panel_details_holder[j][1];

                curren_panel.find('.pannel_sizes').text(size_txt);

                curren_panel.width((jQuery('.wall_type_1').width() * panel_details_holder[j][0])/panel_details_inch.w  );

                curren_panel.height((jQuery('.wall_type_1').height() * panel_details_holder[j][1])/panel_details_inch.h  );

                if(j == 0){

                    curren_panel.css({'left':'0', 'top':'0'});

                }else if(j == 1){

                    var top_pos =  jQuery('.items').eq(0).height() + parseInt(jQuery('.wall_type_1').width() - (jQuery('.items').eq(0).width() + jQuery('.items').eq(0).width()) );

                    

                    curren_panel.css({'top': top_pos+'px','left':'0', });

                }else if(j == 2){

                    var top_pos =  jQuery('.items').eq(0).height() + parseInt(jQuery('.wall_type_1').width() - (jQuery('.items').eq(0).width() + jQuery('.items').eq(0).width()) );

                    var left_pos = jQuery('.items').eq(1).width() + parseInt(jQuery('.wall_type_1').width() - (jQuery('.items').eq(0).width() + jQuery('.items').eq(0).width()) );

                    curren_panel.css({'left':left_pos+'px', 'top':top_pos+'px'});

                }else if(j == 3){

                    var top_pos =  jQuery('.items').eq(0).height() + parseInt(jQuery('.wall_type_1').width() - (jQuery('.items').eq(0).width() + jQuery('.items').eq(0).width()) );

                    var left_pos = jQuery('.items').eq(1).width() + jQuery('.items').eq(2).width() + parseInt(jQuery('.wall_type_1').width() - (jQuery('.items').eq(0).width() + jQuery('.items').eq(0).width()) ) + parseInt(jQuery('.wall_type_1').width() - (jQuery('.items').eq(0).width() + jQuery('.items').eq(0).width()) );;

                    curren_panel.css({'top':top_pos+'px','left':left_pos+'px' });

                }else if(j == 4){

                    curren_panel.css({'bottom':'0%','right':'0' });

                }else if(j == 5){

                    curren_panel.css({'top':'0%','right':'0' });

                }

               

            }

            //assigning the fabric js

            canvases = [];



             for(i=0; i<jQuery('.items').length;i++){

                var canvas_id = jQuery('.items').eq(i).find('canvas').attr('id'),

                    can_w = jQuery('.items').eq(i).width(),

                    can_h = jQuery('.items').eq(i).height();



                var main_Editarea = new fabric.Canvas(canvas_id, {

                    preserveObjectStacking: true,

                    width: can_w,

                    height: can_h

                });

               // main_Editarea.width = parseInt(can_w);

                //main_Editarea.height = 900;

                canvases.push(main_Editarea);

            }

            for(k=0; k<canvases.length;k++){

                var texts = new fabric.Text('DRAG PHOTO HERE', {

                    fontFamily: 'Open Sans',

                    fontSize: 12,

                    fontWeight: '600',

                    left: canvases[k].width / 2,

                    top: canvases[k].height / 2,

                    selectable: false,

                    fill: '#4d4d4d',

                });

                    canvases[k].add(texts);
                    canvases[k].centerObject(texts);

            }

            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[0].getHeight());
                canvases[0].setBackgroundImage(imgs);
                canvases[0].backgroundImage.opacity = canvas_background.opacity;
                canvases[0].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[1].getHeight());
                canvases[1].setBackgroundImage(imgs);
                canvases[1].backgroundImage.opacity = canvas_background.opacity;
                canvases[1].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[2].getHeight());
                canvases[2].setBackgroundImage(imgs);
                canvases[2].backgroundImage.opacity = canvas_background.opacity;
                canvases[2].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[3].getHeight());
                canvases[3].setBackgroundImage(imgs);
                canvases[3].backgroundImage.opacity = canvas_background.opacity;
                canvases[3].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[4].getHeight());
                canvases[4].setBackgroundImage(imgs);
                canvases[4].backgroundImage.opacity = canvas_background.opacity;
                canvases[4].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[5].getHeight());
                canvases[5].setBackgroundImage(imgs);
                canvases[5].backgroundImage.opacity = canvas_background.opacity;
                canvases[5].renderAll();

            });



                canvases[0].on('object:selected', onObjectSelected);
                canvases[1].on('object:selected', onObjectSelected);
                canvases[2].on('object:selected', onObjectSelected);
                canvases[3].on('object:selected', onObjectSelected);
                canvases[4].on('object:selected', onObjectSelected);
                canvases[5].on('object:selected', onObjectSelected);


                canvases[0].on('mouse:up',function (argument) {
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                });

                canvases[1].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                });
                
                canvases[2].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                });
                canvases[3].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                });
                 canvases[4].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                });
                 canvases[5].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                });

        }























        // TEMPLATE 15





        function go_for_tempplate15(argument) {



            jQuery('.wall_display_main .wall_type_1').html('');

            jQuery('.wall_images').html('');



            //

           for(i=0;i<panel_details_holder.length;i++){

            var append_div = '<div class="items wall_canvas_item_'+ (i+1) +'"><span class="pannel_sizes">20x16</span><canvas id="canvas_'+ (i+1) +'"></canvas></div>';

            jQuery('.wall_display_main .wall_type_1').append(append_div);

             var append_img = '<img id="image_'+(i+1)+'" src="" />'; 

 jQuery('.wall_images').append(append_img);

           }



            for(j=0; j<jQuery('.items').length;j++){

                var curren_panel = jQuery('.items').eq(j);        

                var size_txt =   panel_details_holder[j][0]+'x'+panel_details_holder[j][1];

                curren_panel.find('.pannel_sizes').text(size_txt);

                curren_panel.width((jQuery('.wall_type_1').width() * panel_details_holder[j][0])/panel_details_inch.w  );

                curren_panel.height((jQuery('.wall_type_1').height() * panel_details_holder[j][1])/panel_details_inch.h  );

                if(j == 0){

                    curren_panel.css({'left':'0', 'top':'0'});

                }else if(j == 1){                    

                    curren_panel.css({'bottom': '0px','left':'0', });

                }else if(j == 2){                    

                   curren_panel.css({'bottom':'0px','right':'0px' });

                }else if(j == 3){                   

                    curren_panel.css({'bottom':'50%','right':'0px' ,'transform':'translateY(50%)'});

                }else if(j == 4){

                    curren_panel.css({'top':'0%','right':'0' });

                }else if(j == 5){

                    curren_panel.css({'top':'0%','right':'0', 'left':'0', 'margin':'auto'});

                }

               

            }

            //assigning the fabric js

            canvases = [];



             for(i=0; i<jQuery('.items').length;i++){

                var canvas_id = jQuery('.items').eq(i).find('canvas').attr('id'),

                    can_w = jQuery('.items').eq(i).width(),

                    can_h = jQuery('.items').eq(i).height();



                var main_Editarea = new fabric.Canvas(canvas_id, {

                    preserveObjectStacking: true,

                    width: can_w,

                    height: can_h

                });

               // main_Editarea.width = parseInt(can_w);

               // main_Editarea.height = 900;

                canvases.push(main_Editarea);

            }

            for(k=0; k<canvases.length;k++){

                var texts = new fabric.Text('DRAG PHOTO HERE', {

                    fontFamily: 'Open Sans',

                    fontSize: 10,

                    fontWeight: '600',

                    left: canvases[k].width / 2,

                    top: canvases[k].height / 2,

                    selectable: false,

                    fill: '#4d4d4d',

                });

                    canvases[k].add(texts);
                    canvases[k].centerObject(texts);

            }

            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[0].getHeight());
                canvases[0].setBackgroundImage(imgs);
                canvases[0].backgroundImage.opacity = canvas_background.opacity;
                canvases[0].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[1].getHeight());
                canvases[1].setBackgroundImage(imgs);
                canvases[1].backgroundImage.opacity = canvas_background.opacity;
                canvases[1].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[2].getHeight());
                canvases[2].setBackgroundImage(imgs);
                canvases[2].backgroundImage.opacity = canvas_background.opacity;
                canvases[2].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[3].getHeight());
                canvases[3].setBackgroundImage(imgs);
                canvases[3].backgroundImage.opacity = canvas_background.opacity;
                canvases[3].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[4].getHeight());
                canvases[4].setBackgroundImage(imgs);
                canvases[4].backgroundImage.opacity = canvas_background.opacity;
                canvases[4].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[5].getHeight());
                canvases[5].setBackgroundImage(imgs);
                canvases[5].backgroundImage.opacity = canvas_background.opacity;
                canvases[5].renderAll();

            });
            // fabric.Image.fromURL(canvas_background.image, function(imgs) {
            //     imgs.resizeFilter = new fabric.Image.filters.Resize({
            //         resizeType: 'hermite',
            //         scaleX: 1 / 6,
            //         scaleY: 1 / 6,
            //     });

            //     imgs.applyFilters();
            //     imgs.scaleToHeight(canvases[6].getHeight());
            //     canvases[6].setBackgroundImage(imgs);
            //     canvases[6].backgroundImage.opacity = canvas_background.opacity;
            //     canvases[6].renderAll();

            // });




                canvases[0].on('object:selected', onObjectSelected);
                canvases[1].on('object:selected', onObjectSelected);
                canvases[2].on('object:selected', onObjectSelected);
                canvases[3].on('object:selected', onObjectSelected);
                canvases[4].on('object:selected', onObjectSelected);
                canvases[5].on('object:selected', onObjectSelected);
                //canvases[6].on('object:selected', onObjectSelected);


                canvases[0].on('mouse:up',function (argument) {
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                    //canvases[6].deactivateAll().renderAll();
                });

                canvases[1].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                     //canvases[6].deactivateAll().renderAll();
                });
                
                canvases[2].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                     //canvases[6].deactivateAll().renderAll();
                });
                canvases[3].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                     //canvases[6].deactivateAll().renderAll();
                });
                 canvases[4].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                     //canvases[6].deactivateAll().renderAll();
                });
                 canvases[5].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                     //canvases[6].deactivateAll().renderAll();
                });
                //  canvases[6].on('mouse:up',function (argument) {
                //     canvases[0].deactivateAll().renderAll();
                //     canvases[1].deactivateAll().renderAll();
                //     canvases[2].deactivateAll().renderAll();
                //     canvases[3].deactivateAll().renderAll();
                //     canvases[4].deactivateAll().renderAll();
                //      canvases[5].deactivateAll().renderAll();
                // });


        }













        // TEMPLATE 16





        function go_for_tempplate16(argument) {



           jQuery('.wall_display_main .wall_type_1').html('').css({'transform':'scale(.7)'});

           jQuery('.wall_images').html('');

            ///jQuery('.wall_display_main .wall_type_1').html('');



            //

           for(i=0;i<panel_details_holder.length;i++){

            var append_div = '<div class="items wall_canvas_item_'+ (i+1) +'"><span class="pannel_sizes">20x16</span><canvas id="canvas_'+ (i+1) +'"></canvas></div>';

            jQuery('.wall_display_main .wall_type_1').append(append_div);

             var append_img = '<img id="image_'+(i+1)+'" src="" />'; 

 jQuery('.wall_images').append(append_img);

           }

            jQuery('.wall_display_main .wall_type_1 .items').css({'float':'none', 'position':'inherit', 'display':'inline-block','margin':'0 9px','vertical-align':'middle' });

            jQuery('.wall_display_main .wall_type_1 .items:first-child').css({'margin-left':'0px'});

            jQuery('.wall_display_main .wall_type_1 .items:last-child').css({'margin-right':'0px'});

            for(j=0; j<jQuery('.items').length;j++){

                var curren_panel = jQuery('.items').eq(j);        

                var size_txt =   panel_details_holder[j][0]+'x'+panel_details_holder[j][1];

                curren_panel.find('.pannel_sizes').text(size_txt);

                curren_panel.width((jQuery('.wall_type_1').width() * panel_details_holder[j][0])/panel_details_inch.w  );

                curren_panel.height((jQuery('.wall_type_1').height() * panel_details_holder[j][1])/panel_details_inch.h  );

               

               

            }

            //assigning the fabric js



            canvases = [];



             for(i=0; i<jQuery('.items').length;i++){

                var canvas_id = jQuery('.items').eq(i).find('canvas').attr('id'),

                    can_w = jQuery('.items').eq(i).width(),

                    can_h = jQuery('.items').eq(i).height();



                var main_Editarea = new fabric.Canvas(canvas_id, {

                    preserveObjectStacking: true,

                    width: can_w,

                    height: can_h

                });

                //main_Editarea.width = parseInt(can_w);

                //main_Editarea.height = parseInt(can_h);

                canvases.push(main_Editarea);

            }

            for(k=0; k<canvases.length;k++){

                var texts = new fabric.Text('DRAG PHOTO HERE', {

                    fontFamily: 'Open Sans',

                    fontSize: 12,

                    fontWeight: '600',

                    left: canvases[k].width / 2,

                    top: canvases[k].height / 2,

                    selectable: false,

                    fill: '#4d4d4d',

                });

                    canvases[k].add(texts);
                    canvases[k].centerObject(texts);

            }

            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[0].getHeight());
                canvases[0].setBackgroundImage(imgs);
                canvases[0].backgroundImage.opacity = canvas_background.opacity;
                canvases[0].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[1].getHeight());
                canvases[1].setBackgroundImage(imgs);
                canvases[1].backgroundImage.opacity = canvas_background.opacity;
                canvases[1].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[2].getHeight());
                canvases[2].setBackgroundImage(imgs);
                canvases[2].backgroundImage.opacity = canvas_background.opacity;
                canvases[2].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[3].getHeight());
                canvases[3].setBackgroundImage(imgs);
                canvases[3].backgroundImage.opacity = canvas_background.opacity;
                canvases[3].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[4].getHeight());
                canvases[4].setBackgroundImage(imgs);
                canvases[4].backgroundImage.opacity = canvas_background.opacity;
                canvases[4].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[5].getHeight());
                canvases[5].setBackgroundImage(imgs);
                canvases[5].backgroundImage.opacity = canvas_background.opacity;
                canvases[5].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[6].getHeight());
                canvases[6].setBackgroundImage(imgs);
                canvases[6].backgroundImage.opacity = canvas_background.opacity;
                canvases[6].renderAll();

            });


                canvases[0].on('object:selected', onObjectSelected);
                canvases[1].on('object:selected', onObjectSelected);
                canvases[2].on('object:selected', onObjectSelected);
                canvases[3].on('object:selected', onObjectSelected);
                canvases[4].on('object:selected', onObjectSelected);
                canvases[5].on('object:selected', onObjectSelected);
                canvases[6].on('object:selected', onObjectSelected);

                canvases[0].on('mouse:up',function (argument) {
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                    canvases[6].deactivateAll().renderAll();
                });

                canvases[1].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                     canvases[6].deactivateAll().renderAll();
                });
                
                canvases[2].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                     canvases[6].deactivateAll().renderAll();
                });
                canvases[3].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                     canvases[6].deactivateAll().renderAll();
                });
                 canvases[4].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                     canvases[6].deactivateAll().renderAll();
                });
                 canvases[5].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                     canvases[6].deactivateAll().renderAll();
                });
                 canvases[6].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                     canvases[5].deactivateAll().renderAll();
                });





        }











        // TEMPLATE 17





        function go_for_tempplate17(argument) {



            jQuery('.wall_display_main .wall_type_1').html('');

            jQuery('.wall_images').html('');



            //

           for(i=0;i<panel_details_holder.length;i++){

            var append_div = '<div class="items wall_canvas_item_'+ (i+1) +'"><span class="pannel_sizes">20x16</span><canvas id="canvas_'+ (i+1) +'"></canvas></div>';

            jQuery('.wall_display_main .wall_type_1').append(append_div);

             var append_img = '<img id="image_'+(i+1)+'" src="" />'; 

 jQuery('.wall_images').append(append_img);

           }



            for(j=0; j<jQuery('.items').length;j++){

                var curren_panel = jQuery('.items').eq(j);        

                var size_txt =   panel_details_holder[j][0]+'x'+panel_details_holder[j][1];

                curren_panel.find('.pannel_sizes').text(size_txt);

                curren_panel.width((jQuery('.wall_type_1').width() * panel_details_holder[j][0])/panel_details_inch.w  );

                curren_panel.height((jQuery('.wall_type_1').height() * panel_details_holder[j][1])/panel_details_inch.h  );

                if(j == 0){

                    curren_panel.css({'left':'0', 'top':'0'});

                }else if(j == 1){                    

                    curren_panel.css({'top': '50%','left':'0','transform':'translateY(-50%)' });

                }else if(j == 2){                    

                   curren_panel.css({'bottom':'0px','left':'0px' });

                }else if(j == 3){                   

                    curren_panel.css({'bottom':'0%','right':'0px' ,'left':'0', 'margin':'auto'});

                }else if(j == 4){

                    curren_panel.css({'bottom':'0%','right':'0' });

                }else if(j == 5){

                   curren_panel.css({'top': '50%','right':'0','transform':'translateY(-50%)' });

                }else if(j == 6){

                    curren_panel.css({'top':'0%','right':'0'});

                }else if(j == 7){

                    curren_panel.css({'top':'0%','right':'0', 'left':'0', 'margin':'auto'});

                }

               

            }

            //assigning the fabric js

             canvases = [];



             for(i=0; i<jQuery('.items').length;i++){

                var canvas_id = jQuery('.items').eq(i).find('canvas').attr('id'),

                    can_w = jQuery('.items').eq(i).width(),

                    can_h = jQuery('.items').eq(i).height();



                var main_Editarea = new fabric.Canvas(canvas_id, {

                    preserveObjectStacking: true,

                    width: can_w,

                    height: can_h

                });

               // main_Editarea.width = parseInt(can_w);

               // main_Editarea.height = 900;

                canvases.push(main_Editarea);

            }


            for(k=0; k<canvases.length;k++){

                var texts = new fabric.Text('DRAG PHOTO HERE', {

                    fontFamily: 'Open Sans',

                    fontSize: 12,

                    fontWeight: '600',

                    left: canvases[k].width / 2,

                    top: canvases[k].height / 2,

                    selectable: false,

                    fill: '#4d4d4d',

                });

                    canvases[k].add(texts);
                    canvases[k].centerObject(texts);

            }
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[0].getHeight());
                canvases[0].setBackgroundImage(imgs);
                canvases[0].backgroundImage.opacity = canvas_background.opacity;
                canvases[0].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[1].getHeight());
                canvases[1].setBackgroundImage(imgs);
                canvases[1].backgroundImage.opacity = canvas_background.opacity;
                canvases[1].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[2].getHeight());
                canvases[2].setBackgroundImage(imgs);
                canvases[2].backgroundImage.opacity = canvas_background.opacity;
                canvases[2].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[3].getHeight());
                canvases[3].setBackgroundImage(imgs);
                canvases[3].backgroundImage.opacity = canvas_background.opacity;
                canvases[3].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[4].getHeight());
                canvases[4].setBackgroundImage(imgs);
                canvases[4].backgroundImage.opacity = canvas_background.opacity;
                canvases[4].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[5].getHeight());
                canvases[5].setBackgroundImage(imgs);
                canvases[5].backgroundImage.opacity = canvas_background.opacity;
                canvases[5].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[6].getHeight());
                canvases[6].setBackgroundImage(imgs);
                canvases[6].backgroundImage.opacity = canvas_background.opacity;
                canvases[6].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[7].getHeight());
                canvases[7].setBackgroundImage(imgs);
                canvases[7].backgroundImage.opacity = canvas_background.opacity;
                canvases[7].renderAll();

            });


                canvases[0].on('object:selected', onObjectSelected);
                canvases[1].on('object:selected', onObjectSelected);
                canvases[2].on('object:selected', onObjectSelected);
                canvases[3].on('object:selected', onObjectSelected);
                canvases[4].on('object:selected', onObjectSelected);
                canvases[5].on('object:selected', onObjectSelected);
                canvases[6].on('object:selected', onObjectSelected);
                canvases[7].on('object:selected', onObjectSelected);

                canvases[0].on('mouse:up',function (argument) {
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                    canvases[6].deactivateAll().renderAll();
                    canvases[7].deactivateAll().renderAll();
                });

                canvases[1].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                     canvases[6].deactivateAll().renderAll();
                     canvases[7].deactivateAll().renderAll();
                });
                
                canvases[2].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                     canvases[6].deactivateAll().renderAll();
                     canvases[7].deactivateAll().renderAll();
                });
                canvases[3].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                     canvases[6].deactivateAll().renderAll();
                     canvases[7].deactivateAll().renderAll();
                });
                 canvases[4].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                     canvases[6].deactivateAll().renderAll();
                     canvases[7].deactivateAll().renderAll();
                });
                 canvases[5].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                     canvases[6].deactivateAll().renderAll();
                     canvases[7].deactivateAll().renderAll();
                });
                 canvases[6].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                     canvases[5].deactivateAll().renderAll();
                     canvases[7].deactivateAll().renderAll();
                });
                 canvases[7].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                     canvases[5].deactivateAll().renderAll();
                     canvases[6].deactivateAll().renderAll();
                });





        }







        // TEMPLATE 18





        function go_for_tempplate18(argument) {



            jQuery('.wall_display_main .wall_type_1').html('');

            jQuery('.wall_images').html('');



            //

           for(i=0;i<panel_details_holder.length;i++){

            var append_div = '<div class="items wall_canvas_item_'+ (i+1) +'"><span class="pannel_sizes">20x16</span><canvas id="canvas_'+ (i+1) +'"></canvas></div>';

            jQuery('.wall_display_main .wall_type_1').append(append_div);

             var append_img = '<img id="image_'+(i+1)+'" src="" />'; 

 jQuery('.wall_images').append(append_img);

           }



            for(j=0; j<jQuery('.items').length;j++){

                var curren_panel = jQuery('.items').eq(j);        

                var size_txt =   panel_details_holder[j][0]+'x'+panel_details_holder[j][1];

                curren_panel.find('.pannel_sizes').text(size_txt);

                curren_panel.width((jQuery('.wall_type_1').width() * panel_details_holder[j][0])/panel_details_inch.w  );

                curren_panel.height((jQuery('.wall_type_1').height() * panel_details_holder[j][1])/panel_details_inch.h  );

                if(j == 0){

                    curren_panel.css({'left':'0', 'top':'0'});

                }else if(j == 1){                    

                    curren_panel.css({'top': '50%','left':'0','transform':'translateY(-50%)' });

                }else if(j == 2){                    

                   curren_panel.css({'bottom':'0px','left':'0px' });

                }else if(j == 3){                   

                    curren_panel.css({'bottom':'0%','right':'0px' ,'left':'0', 'margin':'auto'});

                }else if(j == 4){

                    curren_panel.css({'bottom':'0%','right':'0' });

                }else if(j == 5){

                   curren_panel.css({'top': '50%','right':'0','transform':'translateY(-50%)' });

                }else if(j == 6){

                    curren_panel.css({'top':'0%','right':'0'});

                }else if(j == 7){

                    curren_panel.css({'top':'0%','right':'0', 'left':'0', 'margin':'auto'});

                }else if(j == 8){

                    curren_panel.css({'top':'50%','right':'0', 'left':'0', 'margin':'auto','transform':'translateY(-50%)'});

                }

               

            }

            //assigning the fabric js

             canvases = [];



             for(i=0; i<jQuery('.items').length;i++){

                var canvas_id = jQuery('.items').eq(i).find('canvas').attr('id'),

                    can_w = jQuery('.items').eq(i).width(),

                    can_h = jQuery('.items').eq(i).height();



                var main_Editarea = new fabric.Canvas(canvas_id, {

                    preserveObjectStacking: true,

                    width: can_w,

                    height: can_h

                });

               // main_Editarea.width = parseInt(can_w);

               // main_Editarea.height = 900;

                canvases.push(main_Editarea);

            }


            for(k=0; k<canvases.length;k++){

                var texts = new fabric.Text('DRAG PHOTO HERE', {

                    fontFamily: 'Open Sans',

                    fontSize: 12,

                    fontWeight: '600',

                    left: canvases[k].width / 2,

                    top: canvases[k].height / 2,

                    selectable: false,

                    fill: '#4d4d4d',

                });

                    canvases[k].add(texts);
                    canvases[k].centerObject(texts);

            }

            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[0].getHeight());
                canvases[0].setBackgroundImage(imgs);
                canvases[0].backgroundImage.opacity = canvas_background.opacity;
                canvases[0].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[1].getHeight());
                canvases[1].setBackgroundImage(imgs);
                canvases[1].backgroundImage.opacity = canvas_background.opacity;
                canvases[1].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[2].getHeight());
                canvases[2].setBackgroundImage(imgs);
                canvases[2].backgroundImage.opacity = canvas_background.opacity;
                canvases[2].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[3].getHeight());
                canvases[3].setBackgroundImage(imgs);
                canvases[3].backgroundImage.opacity = canvas_background.opacity;
                canvases[3].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[4].getHeight());
                canvases[4].setBackgroundImage(imgs);
                canvases[4].backgroundImage.opacity = canvas_background.opacity;
                canvases[4].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[5].getHeight());
                canvases[5].setBackgroundImage(imgs);
                canvases[5].backgroundImage.opacity = canvas_background.opacity;
                canvases[5].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[6].getHeight());
                canvases[6].setBackgroundImage(imgs);
                canvases[6].backgroundImage.opacity = canvas_background.opacity;
                canvases[6].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[7].getHeight());
                canvases[7].setBackgroundImage(imgs);
                canvases[7].backgroundImage.opacity = canvas_background.opacity;
                canvases[7].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[8].getHeight());
                canvases[8].setBackgroundImage(imgs);
                canvases[8].backgroundImage.opacity = canvas_background.opacity;
                canvases[8].renderAll();

            });



                canvases[0].on('object:selected', onObjectSelected);
                canvases[1].on('object:selected', onObjectSelected);
                canvases[2].on('object:selected', onObjectSelected);
                canvases[3].on('object:selected', onObjectSelected);
                canvases[4].on('object:selected', onObjectSelected);
                canvases[5].on('object:selected', onObjectSelected);
                canvases[6].on('object:selected', onObjectSelected);
                canvases[8].on('object:selected', onObjectSelected);

                canvases[0].on('mouse:up',function (argument) {
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                    canvases[6].deactivateAll().renderAll();
                    canvases[7].deactivateAll().renderAll();
                    canvases[8].deactivateAll().renderAll();
                });

                canvases[1].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                     canvases[6].deactivateAll().renderAll();
                     canvases[7].deactivateAll().renderAll();
                     canvases[8].deactivateAll().renderAll();
                });
                
                canvases[2].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                     canvases[6].deactivateAll().renderAll();
                     canvases[7].deactivateAll().renderAll();
                     canvases[8].deactivateAll().renderAll();
                });
                canvases[3].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                     canvases[6].deactivateAll().renderAll();
                     canvases[7].deactivateAll().renderAll();
                     canvases[8].deactivateAll().renderAll();
                });
                 canvases[4].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                     canvases[6].deactivateAll().renderAll();
                     canvases[7].deactivateAll().renderAll();
                     canvases[8].deactivateAll().renderAll();
                });
                 canvases[5].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                     canvases[6].deactivateAll().renderAll();
                     canvases[7].deactivateAll().renderAll();
                     canvases[8].deactivateAll().renderAll();
                });
                 canvases[6].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                     canvases[5].deactivateAll().renderAll();
                     canvases[7].deactivateAll().renderAll();
                     canvases[8].deactivateAll().renderAll();
                });
                 canvases[7].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                     canvases[5].deactivateAll().renderAll();
                     canvases[6].deactivateAll().renderAll();
                     canvases[8].deactivateAll().renderAll();
                });
                 canvases[8].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                     canvases[5].deactivateAll().renderAll();
                     canvases[6].deactivateAll().renderAll();
                     canvases[7].deactivateAll().renderAll();
                });




        }



        // TEMPLATE 19





        function go_for_tempplate19(argument) {



            jQuery('.wall_display_main .wall_type_1').html('');

            jQuery('.wall_images').html('');



            //.css({'transform':'scale(.7)'});



           for(i=0;i<panel_details_holder.length;i++){

            var append_div = '<div class="items wall_canvas_item_'+ (i+1) +'"><span class="pannel_sizes">20x16</span><canvas id="canvas_'+ (i+1) +'"></canvas></div>';

            jQuery('.wall_display_main .wall_type_1').append(append_div);

             var append_img = '<img id="image_'+(i+1)+'" src="" />'; 

 jQuery('.wall_images').append(append_img);

           }



            for(j=0; j<jQuery('.items').length;j++){

                var curren_panel = jQuery('.items').eq(j);        

                var size_txt =   panel_details_holder[j][0]+'x'+panel_details_holder[j][1];

                curren_panel.find('.pannel_sizes').text(size_txt);

                curren_panel.width((jQuery('.wall_type_1').width() * panel_details_holder[j][0])/panel_details_inch.w  );

                curren_panel.height((jQuery('.wall_type_1').height() * panel_details_holder[j][1])/panel_details_inch.h  );

                var padding = parseInt((jQuery('.wall_type_1').width() - (jQuery('.items').eq(0).height() * 4))/3);

               

                if(j == 0){

                    curren_panel.css({'left':'0', 'top':'0'});

                }else if(j == 1){    

                    var bottom_pos =  jQuery('.items').eq(0).height() + padding;        

                    curren_panel.css({'top': bottom_pos+'px','left':'0'});

                }else if(j == 2){                    

                    var bottom_pos =  jQuery('.items').eq(0).height() + padding;    

                   curren_panel.css({'bottom':bottom_pos+'px','left':'0px' });

                }else if(j == 3){                   

                    curren_panel.css({'bottom':'0%','left':'0'});

                }else if(j == 4){

                    curren_panel.css({'bottom':'0%','right':'0','left':'0', 'margin':'auto' });

                }else if(j == 5){

                   curren_panel.css({'bottom': '0%','right':'0' });

                }else if(j == 6){

                    var bottom_pos =  jQuery('.items').eq(0).height() + padding;  

                    curren_panel.css({'bottom':bottom_pos+'px','right':'0'});

                }else if(j == 7){

                    var bottom_pos =  jQuery('.items').eq(0).height() + padding;        

                    curren_panel.css({'top': bottom_pos+'px','right':'0'});

                }else if(j == 8){

                    curren_panel.css({'top':'0%','right':'0', });

                }else if(j == 9){

                    curren_panel.css({'top':'0%','right':'0', 'left':'0', 'margin':'auto'});

                }

               

            }

            //assigning the fabric js

             canvases = [];



             for(i=0; i<jQuery('.items').length;i++){

                var canvas_id = jQuery('.items').eq(i).find('canvas').attr('id'),

                    can_w = jQuery('.items').eq(i).width(),

                    can_h = jQuery('.items').eq(i).height();



                var main_Editarea = new fabric.Canvas(canvas_id, {

                    preserveObjectStacking: true,

                    width: can_w,

                    height: can_h

                });

               // main_Editarea.width = parseInt(can_w);

               // main_Editarea.height = 900;

                canvases.push(main_Editarea);

            }


            for(k=0; k<canvases.length;k++){

                var texts = new fabric.Text('DRAG PHOTO HERE', {

                    fontFamily: 'Open Sans',

                    fontSize: 11,

                    fontWeight: '600',

                    left: canvases[k].width / 2,

                    top: canvases[k].height / 2,

                    selectable: false,

                    fill: '#4d4d4d',

                });

                    canvases[k].add(texts);
                    canvases[k].centerObject(texts);

            }
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[0].getHeight());
                canvases[0].setBackgroundImage(imgs);
                canvases[0].backgroundImage.opacity = canvas_background.opacity;
                canvases[0].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[1].getHeight());
                canvases[1].setBackgroundImage(imgs);
                canvases[1].backgroundImage.opacity = canvas_background.opacity;
                canvases[1].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[2].getHeight());
                canvases[2].setBackgroundImage(imgs);
                canvases[2].backgroundImage.opacity = canvas_background.opacity;
                canvases[2].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[3].getHeight());
                canvases[3].setBackgroundImage(imgs);
                canvases[3].backgroundImage.opacity = canvas_background.opacity;
                canvases[3].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[4].getHeight());
                canvases[4].setBackgroundImage(imgs);
                canvases[4].backgroundImage.opacity = canvas_background.opacity;
                canvases[4].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[5].getHeight());
                canvases[5].setBackgroundImage(imgs);
                canvases[5].backgroundImage.opacity = canvas_background.opacity;
                canvases[5].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[6].getHeight());
                canvases[6].setBackgroundImage(imgs);
                canvases[6].backgroundImage.opacity = canvas_background.opacity;
                canvases[6].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[7].getHeight());
                canvases[7].setBackgroundImage(imgs);
                canvases[7].backgroundImage.opacity = canvas_background.opacity;
                canvases[7].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[8].getHeight());
                canvases[8].setBackgroundImage(imgs);
                canvases[8].backgroundImage.opacity = canvas_background.opacity;
                canvases[8].renderAll();

            });
             fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[9].getHeight());
                canvases[9].setBackgroundImage(imgs);
                canvases[9].backgroundImage.opacity = canvas_background.opacity;
                canvases[9].renderAll();

            });



                canvases[0].on('object:selected', onObjectSelected);
                canvases[1].on('object:selected', onObjectSelected);
                canvases[2].on('object:selected', onObjectSelected);
                canvases[3].on('object:selected', onObjectSelected);
                canvases[4].on('object:selected', onObjectSelected);
                canvases[5].on('object:selected', onObjectSelected);
                canvases[6].on('object:selected', onObjectSelected);
                canvases[8].on('object:selected', onObjectSelected);
                canvases[9].on('object:selected', onObjectSelected);

                canvases[0].on('mouse:up',function (argument) {
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                    canvases[6].deactivateAll().renderAll();
                    canvases[7].deactivateAll().renderAll();
                    canvases[8].deactivateAll().renderAll();
                    canvases[9].deactivateAll().renderAll();
                });

                canvases[1].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                     canvases[6].deactivateAll().renderAll();
                     canvases[7].deactivateAll().renderAll();
                     canvases[8].deactivateAll().renderAll();
                     canvases[9].deactivateAll().renderAll();
                });
                
                canvases[2].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                     canvases[6].deactivateAll().renderAll();
                     canvases[7].deactivateAll().renderAll();
                     canvases[8].deactivateAll().renderAll();
                     canvases[9].deactivateAll().renderAll();
                });
                canvases[3].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                     canvases[6].deactivateAll().renderAll();
                     canvases[7].deactivateAll().renderAll();
                     canvases[8].deactivateAll().renderAll();
                     canvases[9].deactivateAll().renderAll();
                });
                 canvases[4].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                     canvases[6].deactivateAll().renderAll();
                     canvases[7].deactivateAll().renderAll();
                     canvases[8].deactivateAll().renderAll();
                     canvases[9].deactivateAll().renderAll();
                });
                 canvases[5].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                     canvases[6].deactivateAll().renderAll();
                     canvases[7].deactivateAll().renderAll();
                     canvases[8].deactivateAll().renderAll();
                     canvases[9].deactivateAll().renderAll();
                });
                 canvases[6].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                     canvases[5].deactivateAll().renderAll();
                     canvases[7].deactivateAll().renderAll();
                     canvases[8].deactivateAll().renderAll();
                     canvases[9].deactivateAll().renderAll();
                });
                 canvases[7].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                     canvases[5].deactivateAll().renderAll();
                     canvases[6].deactivateAll().renderAll();
                     canvases[8].deactivateAll().renderAll();
                     canvases[9].deactivateAll().renderAll();
                });
                 canvases[8].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                     canvases[5].deactivateAll().renderAll();
                     canvases[6].deactivateAll().renderAll();
                     canvases[7].deactivateAll().renderAll();
                     canvases[9].deactivateAll().renderAll();
                });
                 canvases[9].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                     canvases[5].deactivateAll().renderAll();
                     canvases[6].deactivateAll().renderAll();
                     canvases[7].deactivateAll().renderAll();
                     canvases[8].deactivateAll().renderAll();
                });




        }





        // TEMPLATE 20





        function go_for_tempplate20(argument) {



            jQuery('.wall_display_main .wall_type_1').html('');

            jQuery('.wall_images').html('');



            //

           for(i=0;i<panel_details_holder.length;i++){

            var append_div = '<div class="items wall_canvas_item_'+ (i+1) +'"><span class="pannel_sizes">20x16</span><canvas id="canvas_'+ (i+1) +'"></canvas></div>';

            jQuery('.wall_display_main .wall_type_1').append(append_div);

             var append_img = '<img id="image_'+(i+1)+'" src="" />'; 

            jQuery('.wall_images').append(append_img);

           }



            for(j=0; j<jQuery('.items').length;j++){

                var curren_panel = jQuery('.items').eq(j);        

                var size_txt =   panel_details_holder[j][0]+'x'+panel_details_holder[j][1];

                curren_panel.find('.pannel_sizes').text(size_txt);

                curren_panel.width((jQuery('.wall_type_1').width() * panel_details_holder[j][0])/panel_details_inch.w  );

                curren_panel.height((jQuery('.wall_type_1').height() * panel_details_holder[j][1])/panel_details_inch.h  );

                if(j == 0){

                    curren_panel.css({'left':'0', 'top':'0'});

                }else if(j == 1){                    

                    curren_panel.css({'top': '50%','left':'0','transform':'translateY(-50%)' });

                }else if(j == 2){                    

                   curren_panel.css({'bottom':'0px','left':'0px' });

                }else if(j == 3){                   

                    curren_panel.css({'bottom':'0%','right':'0px' ,'left':'0', 'margin':'auto'});

                }else if(j == 4){

                    curren_panel.css({'bottom':'0%','right':'0' });

                }else if(j == 5){

                   curren_panel.css({'top': '0%','right':'0', });

                }else if(j == 6){

                    curren_panel.css({'top':'0%','right':'0','left':'0', 'margin':'auto'});

                }

               

            }

            //assigning the fabric js

             canvases = [];



             for(i=0; i<jQuery('.items').length;i++){

                var canvas_id = jQuery('.items').eq(i).find('canvas').attr('id'),

                    can_w = jQuery('.items').eq(i).width(),

                    can_h = jQuery('.items').eq(i).height();



                var main_Editarea = new fabric.Canvas(canvas_id, {

                    preserveObjectStacking: true,

                    width: can_w,

                    height: can_h

                });

                //main_Editarea.width = parseInt(can_w);

                //main_Editarea.height = 900;

                canvases.push(main_Editarea);

            }

            for(k=0; k<canvases.length;k++){

                var texts = new fabric.Text('DRAG PHOTO HERE', {

                    fontFamily: 'Open Sans',

                    fontSize: 12,

                    fontWeight: '600',

                    left: canvases[k].width / 2,

                    top: canvases[k].height / 2,

                    selectable: false,

                    fill: '#4d4d4d',

                });

                    canvases[k].add(texts);
                    canvases[k].centerObject(texts);

            }

            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[0].getHeight());
                canvases[0].setBackgroundImage(imgs);
                canvases[0].backgroundImage.opacity = canvas_background.opacity;
                canvases[0].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToWidth(canvases[1].getWidth());
                canvases[1].setBackgroundImage(imgs);
                canvases[1].backgroundImage.opacity = canvas_background.opacity;
                canvases[1].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[2].getHeight());
                canvases[2].setBackgroundImage(imgs);
                canvases[2].backgroundImage.opacity = canvas_background.opacity;
                canvases[2].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[3].getHeight());
                canvases[3].setBackgroundImage(imgs);
                canvases[3].backgroundImage.opacity = canvas_background.opacity;
                canvases[3].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[4].getHeight());
                canvases[4].setBackgroundImage(imgs);
                canvases[4].backgroundImage.opacity = canvas_background.opacity;
                canvases[4].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[5].getHeight());
                canvases[5].setBackgroundImage(imgs);
                canvases[5].backgroundImage.opacity = canvas_background.opacity;
                canvases[5].renderAll();

            });
            fabric.Image.fromURL(canvas_background.image, function(imgs) {
                imgs.resizeFilter = new fabric.Image.filters.Resize({
                    resizeType: 'hermite',
                    scaleX: 1 / 6,
                    scaleY: 1 / 6,
                });

                imgs.applyFilters();
                imgs.scaleToHeight(canvases[6].getHeight());
                canvases[6].setBackgroundImage(imgs);
                canvases[6].backgroundImage.opacity = canvas_background.opacity;
                canvases[6].renderAll();

            });


                canvases[0].on('object:selected', onObjectSelected);
                canvases[1].on('object:selected', onObjectSelected);
                canvases[2].on('object:selected', onObjectSelected);
                canvases[3].on('object:selected', onObjectSelected);
                canvases[4].on('object:selected', onObjectSelected);
                canvases[5].on('object:selected', onObjectSelected);
                canvases[6].on('object:selected', onObjectSelected);

                canvases[0].on('mouse:up',function (argument) {
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                    canvases[6].deactivateAll().renderAll();

                });

                canvases[1].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                     canvases[6].deactivateAll().renderAll();

                });
                
                canvases[2].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                     canvases[6].deactivateAll().renderAll();

                });
                canvases[3].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                     canvases[6].deactivateAll().renderAll();

                });
                 canvases[4].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[5].deactivateAll().renderAll();
                     canvases[6].deactivateAll().renderAll();

                });
                 canvases[5].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                     canvases[6].deactivateAll().renderAll();

                });
                 canvases[6].on('mouse:up',function (argument) {
                    canvases[0].deactivateAll().renderAll();
                    canvases[1].deactivateAll().renderAll();
                    canvases[2].deactivateAll().renderAll();
                    canvases[3].deactivateAll().renderAll();
                    canvases[4].deactivateAll().renderAll();
                     canvases[5].deactivateAll().renderAll();        
                });
                 




        }



           // json data url

    //=================

    saveData.url = jQuery('#savedJSONdata').data('url');



    imagePath = jQuery('#imageurl').val();





    var invoice_div = jQuery('.editor-middle-text');

    var subTotal = selectedValue.canvas_price;

    invoice_div.find('> a').html('(' + panel_infos.panel_name + '+ $' + panel_infos.panel_price + ') <i class="fa fa-angle-down" aria-hidden="true"></i> ');



    var rightOne = '<div class="pull-right">' +

        '<a href="#">$<p>' + panel_infos.panel_price + '</p></a>' +

        '<a href="#" class="icon"><img src="' + imagePath + 'edit.png" alt="Edit"></a>' +

        '</div>';

    invoice_div.find('ul >li#canvastype').html('<span>' +  panel_infos.panel_name + '</span>' + rightOne);

    invoice_div.find('ul li.subtotal span.price').text('$' + subTotal);   



    function update_invoice_name(argument) {

       invoice_div.find('> a').html('(' + panel_infos.panel_name + '+ $' + panel_infos.panel_price + ') <i class="fa fa-angle-down" aria-hidden="true"></i> ');



    var rightOne = '<div class="pull-right">' +

        '<a href="#">$<p>' + panel_infos.panel_price + '</p></a>' +

        '<a href="#" class="icon"><img src="' + imagePath + 'edit.png" alt="Edit"></a>' +

        '</div>';

    invoice_div.find('ul >li#canvastype').html('<span>' +  panel_infos.panel_name + '</span>' + rightOne);

    invoice_div.find('ul li.subtotal span.price').text('$' + subTotal);   

       

    }



    // window on load 

    //=====================

jQuery(document).on('click', '.openCanvas', function(argument) {

        var returndJSON = [];
        var inputset = jQuery('.inputSets'),
            ip = jQuery('.json_array_wall'),
            l = ip.length;

            jQuery( ".inputSets" ).find('.json_array_wall').each(function() {

                returndJSON.push(jQuery(this).attr('data-json-array'));
             });   

            // ip.each(e => {

            //     var JSON = jQuery(this).attr('data-json-array');      
            //     //alert(JSON);        
            //     returndJSON.push(JSON);
            // });

            for(i=0; i< returndJSON.length; i++){
               // console.log( canvases[i] +': jsno: '+returndJSON[i]);
               // console.log( canvases[i]);
               //canvases[i].loadFromJSON()
               canvases[i].loadFromJSON(returndJSON[i], canvases[i].renderAll.bind(canvases[i]), function(o, object) {
                    fabric.log(o, object);
                });
               // console.log( 'J :' + returndJSON[i]);
            }



       // var obj = JSON.parse(jQuery('#savedJSONdata').val());

       // main_Editarea.loadFromJSON(JSON.parse(jQuery('#savedJSONdata').val()));

        jQuery('.modal.openSaveMOdal').fadeOut();

        localStorage.setItem("isOpened", "true");

    });



    jQuery(window).on('load',function (argument) {

        make_continious_image();



        // fabric.Image.fromURL(canvas_background.image, function(imgs) {



        //     imgs.resizeFilter = new fabric.Image.filters.Resize({

        //         resizeType: 'hermite',

        //         scaleX: 1 / 6,

        //         scaleY: 1 / 6,

        //     });

        //     imgs.applyFilters();

        //     imgs.scaleToHeight(canvases[0].getHeight() - (frame_width + 1));

        //     canvases[0].setBackgroundImage(imgs);

        //     canvases[0].backgroundImage.opacity = canvas_background.opacity;

        //     canvases[0].renderAll();



        // });



    });





     jQuery(document).on('click', '.save_it', function(e) {



        jQuery('.saveMOdal').fadeIn();

        return false;      



    });



     jQuery(document).on('click', '.saveMOdal .close_low_res_popup', function() {

            jQuery('.saveMOdal').fadeOut();

        });





     jQuery('.design-view').on('click', function(argument) {

        var s = 'http://beta.canvassignages.com/skin/frontend/rwd/default/images/canvas_live_editor/images/loading.gif';
        jQuery('.roomCanvasImg img').attr('src', s);
         make_continious_image();

         setTimeout(function (argument) {
             jQuery('.roomCanvasImg img').attr('src', jQuery('#canvas_image').attr('src'));

            jQuery('#contextualEditNav.contextualMenu ').hide();
         },2000)

         


     });

      jQuery('.room-view').on('click', function(argument) {

         jQuery('#contextualEditNav.contextualMenu ').show();


     });

     



         // added code for Order Now

    jQuery(document).on('click', '#order_now', function(argument) {



        jQuery('.pleaseWait').fadeIn();



        var svg = [];

        for(i=0; i< canvases.length; i++){

     svg.push(canvases[i].toDataURLWithMultiplier('svg', 1));

        }



        var orderData_url = jQuery('#orderData').attr('data-url');

        var order_img_src = svg;



        var canvas_image = jQuery('#canvas_image').attr('src');

        //console.log(svg);



        $.ajax({

            url: orderData_url,

            data: { svg: svg, selectedValue: panel_infos,canvas_image:canvas_image },

            type: "POST",

            success: function(response) {



                jQuery('.pleaseWait').fadeOut();



                console.log(response);



                jQuery('.afterOrder').fadeIn();



            }

        });



    });

  var scale_ammount = 1;



    jQuery(document).on('click', '.for_zoom_out', function(argument) {

         jQuery('.for_zoom_in').addClass('active'); 

        scale_ammount = scale_ammount - .1;    



         if(scale_ammount <= .4){

            scale_ammount = .4;

            jQuery('.for_zoom_out').removeClass('active');             

        }    



        jQuery('.image .wall_type_1 ').css({'transform':'scale('+ scale_ammount +')'});



        //zoomOut();

    });





    jQuery(document).on('click', '.for_zoom_in', function(argument) {        

        jQuery('.for_zoom_out').addClass('active');

        scale_ammount = scale_ammount + .1;

        if(scale_ammount >= 1){

            scale_ammount = 1;

            jQuery('.for_zoom_in').removeClass('active');

        }

        //alert(scale_ammount);

         jQuery('.image .wall_type_1 ').css({'transform':'scale('+ scale_ammount +')'});

       //zoomIn();

    });



var canvases_json = [];


jQuery(document).on('click', '.saveCanvas', function(e) {



    console.table(canvases);

    for(i=0; i<canvases.length;i++){

        var c = canvases[i];
        var savedArea = c.toJSON();
        var savedArea2 = JSON.stringify(savedArea);

        canvases_json.push(savedArea2);
    }

    console.log(canvases_json);


        var saved_name = jQuery('#saveName').val();

        // savedArea = main_Editarea.toJSON();

        // savedArea = JSON.stringify(savedArea);

        jQuery('#savedJSONdata').val(canvases_json);

        jQuery(this).text('Saving.....');





        $.ajax({

            url: saveData.url,

            data: { savedJSONdata: canvases_json, name: saved_name, saved_status: panel_infos },

            type: "POST",

            success: function(response) {

                canvases_json = [];

                jQuery('#savedJSONdata').val(response);

                console.log(response);

                jQuery('#saveName').val('');

                jQuery('.saveCanvas').text('Saved');

                jQuery('.modal.saveMOdal').fadeOut();

            }

        });



    });































        

    jQuery(document).on('mouseenter','.items', function (argument) {

       current_on_canvas = jQuery(this).find('canvas').eq(0).attr('id'); 

       check_canvas(current_on_canvas);       

    });



        jQuery('.uploaded-photo-box img:last-child').draggable({

            helper: "clone",

            appendTo: 'body',

            zIndex: 9999,

            revert: true,

            start: function() {

                dragged_Src = jQuery(this).attr('src');

                //jQuery(this).addClass('Dragging');

                console.log(dragged_Src);

            },

            stop: function(argument) {

                //jQuery(this).removeClass('Dragging')

            }

        });






 jQuery('.add_selected_button').on('click', function(argument) {


        var url_to_send = jQuery(this).data('send-url');


        if ($('.my-photos-image-box.select').length > 0) {} else {
            alert('Please Select a picture!');
            return false;
        }

        $('.my-photos-image-box.select').each(function() {

            var url = url_to_send;
            var original_url = $(this).find('.resized_remove').attr('data-original-src');
            var resized_url = $(this).find('.main_img').attr('src');

            //check_image_exixtance(image_name(original_url));


            $.ajax({
                url: url,
                data: { original_url: original_url, resized_url: resized_url },
                type: "POST",
                success: function(response) {

                    jQuery('.sidebar-content.image .upload-photo-icon img').hide();

                    jQuery('#my-photo .button-group button.button.medium.border:first-child').text('Select All');
                    jQuery('.my-photos .my-photos-image-box').removeClass('select');
                    $('.uploaded-image').append(response);

                    $('#photo-uplopad').modal('hide');
                    $('.editor-sidebar > ul li:nth-of-type(2)').addClass('selected');

                    var uploaded_img_area = jQuery('.uploaded-image');

                    uploaded_img_area.find('.uploaded-photo-box').each(function() {
                        jQuery(this).children('img').addClass('enable_dragging');
                    });



                    jQuery('.enable_dragging').draggable({
                        helper: "clone",
                        appendTo: 'body',
                        zIndex: 9999,
                        revert: true,
                        start: function() {
                            dragged_Src = jQuery(this).attr('src');
                            console.log(dragged_Src);
                            jQuery(this).addClass('Dragging');
                            jQuery('.editor-sidebar ul li.selected').addClass('remo').removeClass('selected');
                        },
                        stop: function(argument) {
                            jQuery(this).removeClass('Dragging');
                           // jQuery('.editor-sidebar ul li.remo').addClass('selected').removeClass('remo');
                        }
                    });


                }
            });


        });

    });

























    // check canvas

    function check_canvas(current_on_canvas){       
      // c.on('object:selected', onObjectSelected);
    }

    function onObjectSelected(e) {



        jQuery('.editroPlace .editedText').val(e.target.get('text'));

        if (e.target.get('type') == 'image') {


            jQuery('#contextualEditNav').addClass('showEditor').fadeIn();

            e.target.transparentCorners = false;

            e.target.borderColor = '#66eeff';

            e.target.cornerColor = '#66eeff';

            e.target.minScaleLimit = 2;

            e.target.cornerStrokeColor = '#66eeff';

            e.target.cornerStyle = 'square';

            e.target.minScaleLimit = 0;

            e.target.lockScalingFlip = true;

            e.target.rotatingPointOffset = 25;

            e.target.padding = 0;

            e.target.selectionDashArray = [5, 5];

            e.target.borderDashArray = [5, 5];

            e.target.cornerDashArray = [5, 5];   


        } else {

            jQuery('#contextualEditNav').removeClass('showEditor').fadeOut();

        }



        if (e.target.get('type') == 'i-text') {

            

            jQuery('#textEditorArea').addClass('showEditor').fadeIn();

        } else {

            jQuery('#textEditorArea').removeClass('showEditor').fadeOut();

        }

    }






// main  editing functions
// ===============================


    jQuery('.zoomMinus').on('click', function(argument) {

        zoomOut();

    });

    jQuery('.zoomPlud').on('click', function(argument) {

       zoomIn();

    });


    function zoomIn() {

        if(canvases[0]){
                var activeObject0 = canvases[0].getActiveObject();
                if(activeObject0){  
                   var scaleX = activeObject0.scaleX;
                    var scaleY = activeObject0.scaleY;
                    var left = activeObject0.left;
                    var top = activeObject0.top;
                    var tempScaleX = scaleX * SCALE_FACTOR;
                    var tempScaleY = scaleY * SCALE_FACTOR;
                    var tempLeft = left * SCALE_FACTOR;
                    var tempTop = top * SCALE_FACTOR;
                    activeObject0.scaleX = tempScaleX;
                    activeObject0.scaleY = tempScaleY;
                    activeObject0.left = tempLeft;
                    activeObject0.top = tempTop;
                    activeObject0.setCoords();
                    canvases[0].renderAll();
                }
        }
        if(canvases[1]){
                var activeObject1 = canvases[1].getActiveObject();
                if(activeObject1){  
                   var scaleX = activeObject1.scaleX;
                    var scaleY = activeObject1.scaleY;
                    var left = activeObject1.left;
                    var top = activeObject1.top;
                    var tempScaleX = scaleX * SCALE_FACTOR;
                    var tempScaleY = scaleY * SCALE_FACTOR;
                    var tempLeft = left * SCALE_FACTOR;
                    var tempTop = top * SCALE_FACTOR;
                    activeObject1.scaleX = tempScaleX;
                    activeObject1.scaleY = tempScaleY;
                    activeObject1.left = tempLeft;
                    activeObject1.top = tempTop;
                    activeObject1.setCoords();
                    canvases[1].renderAll();
                }
        }
        if(canvases[2]){
                var activeObject2 = canvases[2].getActiveObject();
                if(activeObject2){  
                   var scaleX = activeObject2.scaleX;
                    var scaleY = activeObject2.scaleY;
                    var left = activeObject2.left;
                    var top = activeObject2.top;
                    var tempScaleX = scaleX * SCALE_FACTOR;
                    var tempScaleY = scaleY * SCALE_FACTOR;
                    var tempLeft = left * SCALE_FACTOR;
                    var tempTop = top * SCALE_FACTOR;
                    activeObject2.scaleX = tempScaleX;
                    activeObject2.scaleY = tempScaleY;
                    activeObject2.left = tempLeft;
                    activeObject2.top = tempTop;
                    activeObject2.setCoords();
                    canvases[2].renderAll();
                }
        }
        if(canvases[3]){
                var activeObject3 = canvases[3].getActiveObject();
                if(activeObject3){  
                   var scaleX = activeObject3.scaleX;
                    var scaleY = activeObject3.scaleY;
                    var left = activeObject3.left;
                    var top = activeObject3.top;
                    var tempScaleX = scaleX * SCALE_FACTOR;
                    var tempScaleY = scaleY * SCALE_FACTOR;
                    var tempLeft = left * SCALE_FACTOR;
                    var tempTop = top * SCALE_FACTOR;
                    activeObject3.scaleX = tempScaleX;
                    activeObject3.scaleY = tempScaleY;
                    activeObject3.left = tempLeft;
                    activeObject3.top = tempTop;
                    activeObject3.setCoords();
                    canvases[3].renderAll();
                }
        }
        if(canvases[4]){
                var activeObject4 = canvases[4].getActiveObject();
                if(activeObject4){  
                   var scaleX = activeObject4.scaleX;
                    var scaleY = activeObject4.scaleY;
                    var left = activeObject4.left;
                    var top = activeObject4.top;
                    var tempScaleX = scaleX * SCALE_FACTOR;
                    var tempScaleY = scaleY * SCALE_FACTOR;
                    var tempLeft = left * SCALE_FACTOR;
                    var tempTop = top * SCALE_FACTOR;
                    activeObject4.scaleX = tempScaleX;
                    activeObject4.scaleY = tempScaleY;
                    activeObject4.left = tempLeft;
                    activeObject4.top = tempTop;
                    activeObject4.setCoords();
                    canvases[4].renderAll();
                }
        }
        if(canvases[5]){
                var activeObject5 = canvases[5].getActiveObject();
                if(activeObject5){  
                   var scaleX = activeObject5.scaleX;
                    var scaleY = activeObject5.scaleY;
                    var left = activeObject5.left;
                    var top = activeObject5.top;
                    var tempScaleX = scaleX * SCALE_FACTOR;
                    var tempScaleY = scaleY * SCALE_FACTOR;
                    var tempLeft = left * SCALE_FACTOR;
                    var tempTop = top * SCALE_FACTOR;
                    activeObject5.scaleX = tempScaleX;
                    activeObject5.scaleY = tempScaleY;
                    activeObject5.left = tempLeft;
                    activeObject5.top = tempTop;
                    activeObject5.setCoords();
                    canvases[5].renderAll();
                }
        }
        if(canvases[6]){
                var activeObject6 = canvases[6].getActiveObject();
                if(activeObject6){  
                   var scaleX = activeObject6.scaleX;
                    var scaleY = activeObject6.scaleY;
                    var left = activeObject6.left;
                    var top = activeObject6.top;
                    var tempScaleX = scaleX * SCALE_FACTOR;
                    var tempScaleY = scaleY * SCALE_FACTOR;
                    var tempLeft = left * SCALE_FACTOR;
                    var tempTop = top * SCALE_FACTOR;
                    activeObject6.scaleX = tempScaleX;
                    activeObject6.scaleY = tempScaleY;
                    activeObject6.left = tempLeft;
                    activeObject6.top = tempTop;
                    activeObject6.setCoords();
                    canvases[6].renderAll();
                }
        }
        if(canvases[7]){
                var activeObject7 = canvases[7].getActiveObject();
                if(activeObject7){  
                   var scaleX = activeObject7.scaleX;
                    var scaleY = activeObject7.scaleY;
                    var left = activeObject7.left;
                    var top = activeObject7.top;
                    var tempScaleX = scaleX * SCALE_FACTOR;
                    var tempScaleY = scaleY * SCALE_FACTOR;
                    var tempLeft = left * SCALE_FACTOR;
                    var tempTop = top * SCALE_FACTOR;
                    activeObject7.scaleX = tempScaleX;
                    activeObject7.scaleY = tempScaleY;
                    activeObject7.left = tempLeft;
                    activeObject7.top = tempTop;
                    activeObject7.setCoords();
                    canvases[7].renderAll();
                }
        }
        if(canvases[8]){
                var activeObject8 = canvases[8].getActiveObject();
                if(activeObject8){  
                   var scaleX = activeObject8.scaleX;
                    var scaleY = activeObject8.scaleY;
                    var left = activeObject8.left;
                    var top = activeObject8.top;
                    var tempScaleX = scaleX * SCALE_FACTOR;
                    var tempScaleY = scaleY * SCALE_FACTOR;
                    var tempLeft = left * SCALE_FACTOR;
                    var tempTop = top * SCALE_FACTOR;
                    activeObject8.scaleX = tempScaleX;
                    activeObject8.scaleY = tempScaleY;
                    activeObject8.left = tempLeft;
                    activeObject8.top = tempTop;
                    activeObject8.setCoords();
                    canvases[8].renderAll();
                }
        }
        if(canvases[9]){
                var activeObject9 = canvases[9].getActiveObject();
                if(activeObject9){  
                   var scaleX = activeObject9.scaleX;
                    var scaleY = activeObject9.scaleY;
                    var left = activeObject9.left;
                    var top = activeObject9.top;
                    var tempScaleX = scaleX * SCALE_FACTOR;
                    var tempScaleY = scaleY * SCALE_FACTOR;
                    var tempLeft = left * SCALE_FACTOR;
                    var tempTop = top * SCALE_FACTOR;
                    activeObject9.scaleX = tempScaleX;
                    activeObject9.scaleY = tempScaleY;
                    activeObject9.left = tempLeft;
                    activeObject9.top = tempTop;
                    activeObject9.setCoords();
                    canvases[9].renderAll();
                }
        }




        





    }










    function zoomOut() {

        if(canvases[0]){
                var activeObject0 = canvases[0].getActiveObject();
                if(activeObject0){    

                        var scaleX = activeObject0.scaleX;
                        var scaleY = activeObject0.scaleY;
                        var left = activeObject0.left;
                        var top = activeObject0.top;
                        var tempScaleX = scaleX * (1 / SCALE_FACTOR);
                        var tempScaleY = scaleY * (1 / SCALE_FACTOR);
                        var tempLeft = left * (1 / SCALE_FACTOR);
                        var tempTop = top * (1 / SCALE_FACTOR);
                        activeObject0.scaleX = tempScaleX;
                        activeObject0.scaleY = tempScaleY;
                        activeObject0.left = tempLeft;
                        activeObject0.top = tempTop;
                        activeObject0.setCoords();
                        canvases[0].renderAll();

                }
            }
            if(canvases[1]){
                var activeObject1 = canvases[1].getActiveObject();
                if(activeObject1){    

                        var scaleX = activeObject1.scaleX;
                        var scaleY = activeObject1.scaleY;
                        var left = activeObject1.left;
                        var top = activeObject1.top;
                        var tempScaleX = scaleX * (1 / SCALE_FACTOR);
                        var tempScaleY = scaleY * (1 / SCALE_FACTOR);
                        var tempLeft = left * (1 / SCALE_FACTOR);
                        var tempTop = top * (1 / SCALE_FACTOR);
                        activeObject1.scaleX = tempScaleX;
                        activeObject1.scaleY = tempScaleY;
                        activeObject1.left = tempLeft;
                        activeObject1.top = tempTop;
                        activeObject1.setCoords();
                        canvases[1].renderAll();

                }
            }
            if(canvases[2]){
                var activeObject2 = canvases[2].getActiveObject();
                if(activeObject2){    

                        var scaleX = activeObject2.scaleX;
                        var scaleY = activeObject2.scaleY;
                        var left = activeObject2.left;
                        var top = activeObject2.top;
                        var tempScaleX = scaleX * (1 / SCALE_FACTOR);
                        var tempScaleY = scaleY * (1 / SCALE_FACTOR);
                        var tempLeft = left * (1 / SCALE_FACTOR);
                        var tempTop = top * (1 / SCALE_FACTOR);
                        activeObject2.scaleX = tempScaleX;
                        activeObject2.scaleY = tempScaleY;
                        activeObject2.left = tempLeft;
                        activeObject2.top = tempTop;
                        activeObject2.setCoords();
                        canvases[2].renderAll();

                }
            }
            if(canvases[3]){
                var activeObject3 = canvases[3].getActiveObject();
                if(activeObject3){    

                        var scaleX = activeObject3.scaleX;
                        var scaleY = activeObject3.scaleY;
                        var left = activeObject3.left;
                        var top = activeObject3.top;
                        var tempScaleX = scaleX * (1 / SCALE_FACTOR);
                        var tempScaleY = scaleY * (1 / SCALE_FACTOR);
                        var tempLeft = left * (1 / SCALE_FACTOR);
                        var tempTop = top * (1 / SCALE_FACTOR);
                        activeObject3.scaleX = tempScaleX;
                        activeObject3.scaleY = tempScaleY;
                        activeObject3.left = tempLeft;
                        activeObject3.top = tempTop;
                        activeObject3.setCoords();
                        canvases[3].renderAll();

                }
            }
            if(canvases[4]){
                var activeObject4 = canvases[4].getActiveObject();
                if(activeObject4){    

                        var scaleX = activeObject4.scaleX;
                        var scaleY = activeObject4.scaleY;
                        var left = activeObject4.left;
                        var top = activeObject4.top;
                        var tempScaleX = scaleX * (1 / SCALE_FACTOR);
                        var tempScaleY = scaleY * (1 / SCALE_FACTOR);
                        var tempLeft = left * (1 / SCALE_FACTOR);
                        var tempTop = top * (1 / SCALE_FACTOR);
                        activeObject4.scaleX = tempScaleX;
                        activeObject4.scaleY = tempScaleY;
                        activeObject4.left = tempLeft;
                        activeObject4.top = tempTop;
                        activeObject4.setCoords();
                        canvases[4].renderAll();

                }
            }
            if(canvases[5]){
                var activeObject5 = canvases[5].getActiveObject();
                if(activeObject5){    

                        var scaleX = activeObject5.scaleX;
                        var scaleY = activeObject5.scaleY;
                        var left = activeObject5.left;
                        var top = activeObject5.top;
                        var tempScaleX = scaleX * (1 / SCALE_FACTOR);
                        var tempScaleY = scaleY * (1 / SCALE_FACTOR);
                        var tempLeft = left * (1 / SCALE_FACTOR);
                        var tempTop = top * (1 / SCALE_FACTOR);
                        activeObject5.scaleX = tempScaleX;
                        activeObject5.scaleY = tempScaleY;
                        activeObject5.left = tempLeft;
                        activeObject5.top = tempTop;
                        activeObject5.setCoords();
                        canvases[5].renderAll();

                }
            }
            if(canvases[6]){
                var activeObject6 = canvases[6].getActiveObject();
                if(activeObject6){    

                        var scaleX = activeObject6.scaleX;
                        var scaleY = activeObject6.scaleY;
                        var left = activeObject6.left;
                        var top = activeObject6.top;
                        var tempScaleX = scaleX * (1 / SCALE_FACTOR);
                        var tempScaleY = scaleY * (1 / SCALE_FACTOR);
                        var tempLeft = left * (1 / SCALE_FACTOR);
                        var tempTop = top * (1 / SCALE_FACTOR);
                        activeObject6.scaleX = tempScaleX;
                        activeObject6.scaleY = tempScaleY;
                        activeObject6.left = tempLeft;
                        activeObject6.top = tempTop;
                        activeObject6.setCoords();
                        canvases[6].renderAll();

                }
            }
            if(canvases[7]){
                var activeObject7 = canvases[7].getActiveObject();
                if(activeObject7){    

                        var scaleX = activeObject7.scaleX;
                        var scaleY = activeObject7.scaleY;
                        var left = activeObject7.left;
                        var top = activeObject7.top;
                        var tempScaleX = scaleX * (1 / SCALE_FACTOR);
                        var tempScaleY = scaleY * (1 / SCALE_FACTOR);
                        var tempLeft = left * (1 / SCALE_FACTOR);
                        var tempTop = top * (1 / SCALE_FACTOR);
                        activeObject7.scaleX = tempScaleX;
                        activeObject7.scaleY = tempScaleY;
                        activeObject7.left = tempLeft;
                        activeObject7.top = tempTop;
                        activeObject7.setCoords();
                        canvases[7].renderAll();

                }
            }
            if(canvases[8]){
                var activeObject8 = canvases[8].getActiveObject();
                if(activeObject8){    

                        var scaleX = activeObject8.scaleX;
                        var scaleY = activeObject8.scaleY;
                        var left = activeObject8.left;
                        var top = activeObject8.top;
                        var tempScaleX = scaleX * (1 / SCALE_FACTOR);
                        var tempScaleY = scaleY * (1 / SCALE_FACTOR);
                        var tempLeft = left * (1 / SCALE_FACTOR);
                        var tempTop = top * (1 / SCALE_FACTOR);
                        activeObject8.scaleX = tempScaleX;
                        activeObject8.scaleY = tempScaleY;
                        activeObject8.left = tempLeft;
                        activeObject8.top = tempTop;
                        activeObject8.setCoords();
                        canvases[8].renderAll();

                }
            }
            if(canvases[9]){
                var activeObject9 = canvases[9].getActiveObject();
                if(activeObject9){    

                        var scaleX = activeObject9.scaleX;
                        var scaleY = activeObject9.scaleY;
                        var left = activeObject9.left;
                        var top = activeObject9.top;
                        var tempScaleX = scaleX * (1 / SCALE_FACTOR);
                        var tempScaleY = scaleY * (1 / SCALE_FACTOR);
                        var tempLeft = left * (1 / SCALE_FACTOR);
                        var tempTop = top * (1 / SCALE_FACTOR);
                        activeObject9.scaleX = tempScaleX;
                        activeObject9.scaleY = tempScaleY;
                        activeObject9.left = tempLeft;
                        activeObject9.top = tempTop;
                        activeObject9.setCoords();
                        canvases[9].renderAll();

                }
            }

      





        

    }











    // delete image from image editor

    //====================================



    jQuery('#canvasImageDelete').on('click', function(argument) {

        delete_the_selected_obj();

    });



    // rotate image from editor

    //================================



    $("#photoRotation").click(function() {

        rotate_current_image();

    });



    jQuery('#photoMaximize').on('click', function(argument) {

        jQuery(this).toggleClass('actives');



        if (jQuery(this).hasClass('actives') == true) {

            jQuery(this).find('.m_fullphoto').text('maximize');

            photosize_changes(true);

        } else {

            jQuery(this).find('.m_fullphoto').text('minimize');

            photosize_changes(false);

        }



    });





    jQuery('#layer-up').on('click', function(argument) {

        bringForwordLayer();

    });



    jQuery('#layer-down').on('click', function(argument) {

        sendbackLayer();

    });





    // delete the seleted item on canvas



    function delete_the_selected_obj() {

        var activeObject0 = canvases[0].getActiveObject(),
            activeObject1 = canvases[1].getActiveObject(),
            activeObject2 = canvases[2].getActiveObject();

        if(canvases[3]){
            var activeObject3 = canvases[3].getActiveObject();
        }
        if(canvases[4]){
            var activeObject4 = canvases[4].getActiveObject();
        }
        if(canvases[5]){
            var activeObject4 = canvases[4].getActiveObject();
        }
         if(canvases[6]){
            var activeObject6 = canvases[6].getActiveObject();
        }
         if(canvases[7]){
            var activeObject7 = canvases[7].getActiveObject();
        }
        if(canvases[8]){
            var activeObject8 = canvases[8].getActiveObject();
        }
        if(canvases[9]){
            var activeObject9 = canvases[9].getActiveObject();
        }


    

        if (activeObject0 || activeObject1 || activeObject2 || activeObject3 || activeObject4 || activeObject5 || activeObject6 || activeObject7 || activeObject8 || activeObject9) {


            if (confirm('Are you sure?')) {

                canvases[0].remove(activeObject0);
                canvases[1].remove(activeObject1);
                canvases[2].remove(activeObject2);
                canvases[3].remove(activeObject3);
                canvases[4].remove(activeObject4);
                canvases[5].remove(activeObject5);
                canvases[6].remove(activeObject6);
                canvases[7].remove(activeObject7);
                canvases[8].remove(activeObject8);
                canvases[9].remove(activeObject9);

                jQuery('#contextualEditNav').fadeOut();

                jQuery('#textEditorArea').removeClass('showEditor').fadeOut();

            }

        }

    }



jQuery(document).on('click',function(){
    jQuery('.wall_type_1 .items ').on('click',function (argument) {
       //jQuery(this).siblings().find('canvas').eq(0).attr
    })
});



        // rotate function



    function rotate_current_image() {
     

            if(canvases[0]){
                var activeObject0 = canvases[0].getActiveObject();
                if(activeObject0){                                          

                    var curAngle0 = activeObject0.getAngle();
                     activeObject0.setAngle(curAngle0 + rotateAngle);
                     activeObject0.setCoords();
                     canvases[0].renderAll();
                }
            }

            if(canvases[1]){
                var activeObject1 = canvases[1].getActiveObject();
                if(activeObject1){  
                 var curAngle1 = activeObject1.getAngle();
                 activeObject1.setAngle(curAngle1 + rotateAngle);
                     activeObject1.setCoords();
                     canvases[1].renderAll();
                }
            }

            if(canvases[2]){
                var activeObject2 = canvases[2].getActiveObject();
                if(activeObject2){              
                 var curAngle2 = activeObject2.getAngle();
                     activeObject2.setAngle(curAngle2 + rotateAngle);
                     activeObject2.setCoords();
                     canvases[2].renderAll();
                }
            }
            if(canvases[3]){
                var activeObject3 = canvases[3].getActiveObject();
                if(activeObject3){
                 var curAngle3 = activeObject3.getAngle();
                  activeObject3.setAngle(curAngle3 + rotateAngle);
                     activeObject3.setCoords();
                     canvases[3].renderAll();
                }
            }
            if(canvases[4]){
                var activeObject4 = canvases[4].getActiveObject();
                if(activeObject4){
                 var curAngle4 = activeObject4.getAngle();
                  activeObject4.setAngle(curAngle4 + rotateAngle);
                     activeObject4.setCoords();
                     canvases[4].renderAll();
                }
            }
            if(canvases[5]){
                var activeObject5 = canvases[5].getActiveObject();
                if(activeObject5){
                 var curAngle5 = activeObject5.getAngle();
                  activeObject5.setAngle(curAngle5 + rotateAngle);
                     activeObject5.setCoords();
                     canvases[5].renderAll();
                }
            }
             if(canvases[6]){
                var activeObject6 = canvases[6].getActiveObject();
                 if(activeObject6){
                 var curAngle6 = activeObject6.getAngle();
                  activeObject6.setAngle(curAngle6 + rotateAngle);
                     activeObject6.setCoords();
                     canvases[6].renderAll();
                }
            }
             if(canvases[7]){
                var activeObject7 = canvases[7].getActiveObject();
                if(activeObject7){
                 var curAngle7 = activeObject7.getAngle();
                  activeObject7.setAngle(curAngle7 + rotateAngle);
                     activeObject7.setCoords();
                     canvases[7].renderAll();
                }
            }
            if(canvases[8]){
                var activeObject8 = canvases[8].getActiveObject();
                if(activeObject8){
                 var curAngle8 = activeObject8.getAngle();
                    activeObject8.setAngle(curAngle8 + rotateAngle);
                     activeObject8.setCoords();
                     canvases[8].renderAll();
                }
            }
            if(canvases[9]){
                var activeObject9 = canvases[9].getActiveObject();
                 if(activeObject9){
                 var curAngle9 = activeObject9.getAngle();
                  activeObject9.setAngle(curAngle9 + rotateAngle);
                     activeObject9.setCoords();
                     canvases[9].renderAll();
                }
            }

           

      

    

        

    }






    // maiking the image editor tool draggable

    //=============================================





    jQuery('#contextualEditNav').draggable({

        appendTo: 'body',

        start: function( event, ui ) {

           //do nothing

        }

    });



   jQuery('.zoomSlider input').on('change', function(argument) {



        if (this.getAttribute('value') === this.value) {

            // setting the original 'lastvalue' data property

            $(this).data('lastvalue', this.value);

        } else {

            console.log(this.value < $(this).data('lastvalue') ? decrement(this.value) : increment(this.value));

            $(this).data('lastvalue', this.value);

        }



    });


   function decrement(argument) {

        console.log('decrement' + argument);

        if(canvases[0]){
                var activeObject0 = canvases[0].getActiveObject();
                 if(activeObject0){
                    var aO = canvases[0].getActiveObject().getWidth();
                    var activeObject = canvases[0].getActiveObject();
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
                    canvases[0].renderAll();
                }
            }
             if(canvases[1]){
                var activeObject1 = canvases[1].getActiveObject();
                 if(activeObject1){
                    var aO = canvases[1].getActiveObject().getWidth();
                    var activeObject = canvases[1].getActiveObject();
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
                    canvases[1].renderAll();
                }
            }
             if(canvases[2]){
                var activeObject2 = canvases[2].getActiveObject();
                 if(activeObject2){
                    var aO = canvases[2].getActiveObject().getWidth();
                    var activeObject = canvases[2].getActiveObject();
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
                    canvases[2].renderAll();
                }
            }
             if(canvases[3]){
                var activeObject3 = canvases[3].getActiveObject();
                 if(activeObject3){
                    var aO = canvases[3].getActiveObject().getWidth();
                    var activeObject = canvases[3].getActiveObject();
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
                    canvases[3].renderAll();
                }
            }
             if(canvases[4]){
                var activeObject4 = canvases[4].getActiveObject();
                 if(activeObject4){
                    var aO = canvases[4].getActiveObject().getWidth();
                    var activeObject = canvases[4].getActiveObject();
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
                    canvases[4].renderAll();
                }
            }
             if(canvases[5]){
                var activeObject5 = canvases[5].getActiveObject();
                 if(activeObject5){
                    var aO = canvases[5].getActiveObject().getWidth();
                    var activeObject = canvases[5].getActiveObject();
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
                    canvases[5].renderAll();
                }
            }
             if(canvases[6]){
                var activeObject6 = canvases[6].getActiveObject();
                 if(activeObject6){
                    var aO = canvases[6].getActiveObject().getWidth();
                    var activeObject = canvases[6].getActiveObject();
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
                    canvases[6].renderAll();
                }
            }
             if(canvases[7]){
                var activeObject7 = canvases[7].getActiveObject();
                 if(activeObject7){
                    var aO = canvases[7].getActiveObject().getWidth();
                    var activeObject = canvases[7].getActiveObject();
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
                    canvases[7].renderAll();
                }
            }
             if(canvases[8]){
                var activeObject8 = canvases[8].getActiveObject();
                 if(activeObject8){
                    var aO = canvases[8].getActiveObject().getWidth();
                    var activeObject = canvases[8].getActiveObject();
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
                    canvases[8].renderAll();
                }
            }
             if(canvases[9]){
                var activeObject9 = canvases[9].getActiveObject();
                 if(activeObject9){
                    var aO = canvases[9].getActiveObject().getWidth();
                    var activeObject = canvases[9].getActiveObject();
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
                    canvases[9].renderAll();
                }
            }


        



    }


    function increment(argument) {

        console.log('increment' + argument);

         if(canvases[0]){
                var activeObject0 = canvases[0].getActiveObject();
                 if(activeObject0){

                    var aO = canvases[0].getActiveObject().getWidth();
                    var current_width = parseFloat(aO) + parseFloat(argument);        
                    var activeObject = canvases[0].getActiveObject();
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
                    canvases[0].renderAll();
                   
                }

            }
            if(canvases[1]){
                var activeObject1 = canvases[1].getActiveObject();
                 if(activeObject1){

                    var aO = canvases[1].getActiveObject().getWidth();
                    var current_width = parseFloat(aO) + parseFloat(argument);        
                    var activeObject = canvases[1].getActiveObject();
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
                    canvases[1].renderAll();
                   
                }
                
            }
            if(canvases[2]){
                var activeObject2 = canvases[2].getActiveObject();
                 if(activeObject2){

                    var aO = canvases[2].getActiveObject().getWidth();
                    var current_width = parseFloat(aO) + parseFloat(argument);        
                    var activeObject = canvases[2].getActiveObject();
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
                    canvases[2].renderAll();
                   
                }
                
            }
            if(canvases[3]){
                var activeObject3 = canvases[3].getActiveObject();
                 if(activeObject3){

                    var aO = canvases[3].getActiveObject().getWidth();
                    var current_width = parseFloat(aO) + parseFloat(argument);        
                    var activeObject = canvases[3].getActiveObject();
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
                    canvases[3].renderAll();
                   
                }
                
            }
            if(canvases[4]){
                var activeObject4 = canvases[4].getActiveObject();
                 if(activeObject4){

                    var aO = canvases[4].getActiveObject().getWidth();
                    var current_width = parseFloat(aO) + parseFloat(argument);        
                    var activeObject = canvases[4].getActiveObject();
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
                    canvases[4].renderAll();
                   
                }
                
            }
            if(canvases[5]){
                var activeObject5 = canvases[5].getActiveObject();
                 if(activeObject5){

                    var aO = canvases[5].getActiveObject().getWidth();
                    var current_width = parseFloat(aO) + parseFloat(argument);        
                    var activeObject = canvases[5].getActiveObject();
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
                    canvases[5].renderAll();
                   
                }
                
            }
            if(canvases[6]){
                var activeObject6 = canvases[6].getActiveObject();
                 if(activeObject6){

                    var aO = canvases[6].getActiveObject().getWidth();
                    var current_width = parseFloat(aO) + parseFloat(argument);        
                    var activeObject = canvases[6].getActiveObject();
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
                    canvases[6].renderAll();
                   
                }
                
            }
            if(canvases[7]){
                var activeObject7 = canvases[7].getActiveObject();
                 if(activeObject7){

                    var aO = canvases[7].getActiveObject().getWidth();
                    var current_width = parseFloat(aO) + parseFloat(argument);        
                    var activeObject = canvases[7].getActiveObject();
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
                    canvases[7].renderAll();
                   
                }
                
            }
            if(canvases[8]){
                var activeObject8 = canvases[8].getActiveObject();
                 if(activeObject8){

                    var aO = canvases[8].getActiveObject().getWidth();
                    var current_width = parseFloat(aO) + parseFloat(argument);        
                    var activeObject = canvases[8].getActiveObject();
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
                    canvases[8].renderAll();
                   
                }
                
            }
            if(canvases[9]){
                var activeObject9 = canvases[9].getActiveObject();
                 if(activeObject9){

                    var aO = canvases[9].getActiveObject().getWidth();
                    var current_width = parseFloat(aO) + parseFloat(argument);        
                    var activeObject = canvases[9].getActiveObject();
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
                    canvases[9].renderAll();
                   
                }
                
            }
        

    }


    function photosize_changes(argument) {

        if (argument) {

            if(canvases[0]){
                var activeObject0 = canvases[0].getActiveObject();
                 if(activeObject0){

                    var activeObject = canvases[0].getActiveObject();

                    activeObject.scaleToHeight((canvases[0].getHeight()) / 2);

                    canvases[0].renderAll();                
                       
                   
                }
                
            }
            if(canvases[1]){
                var activeObject1 = canvases[1].getActiveObject();
                 if(activeObject1){

                    var activeObject = canvases[1].getActiveObject();

                    activeObject.scaleToHeight((canvases[1].getHeight()) / 2);

                    canvases[1].renderAll();                
                       
                   
                }
                
            }
            if(canvases[2]){
                var activeObject2 = canvases[2].getActiveObject();
                 if(activeObject2){

                    var activeObject = canvases[2].getActiveObject();

                    activeObject.scaleToHeight((canvases[2].getHeight()) / 2);

                    canvases[2].renderAll();                
                       
                   
                }
                
            }
            if(canvases[3]){
                var activeObject3 = canvases[3].getActiveObject();
                 if(activeObject3){

                    var activeObject = canvases[3].getActiveObject();

                    activeObject.scaleToHeight((canvases[3].getHeight()) / 2);

                    canvases[3].renderAll();                
                       
                   
                }
                
            }
            if(canvases[4]){
                var activeObject4 = canvases[4].getActiveObject();
                 if(activeObject4){

                    var activeObject = canvases[4].getActiveObject();

                    activeObject.scaleToHeight((canvases[4].getHeight()) / 2);

                    canvases[4].renderAll();                
                       
                   
                }
                
            }
            if(canvases[5]){
                var activeObject5 = canvases[5].getActiveObject();
                 if(activeObject5){

                    var activeObject = canvases[5].getActiveObject();

                    activeObject.scaleToHeight((canvases[5].getHeight()) / 2);

                    canvases[5].renderAll();                
                       
                   
                }
                
            }
            if(canvases[6]){
                var activeObject6 = canvases[6].getActiveObject();
                 if(activeObject6){

                    var activeObject = canvases[6].getActiveObject();

                    activeObject.scaleToHeight((canvases[6].getHeight()) / 2);

                    canvases[6].renderAll();                
                       
                   
                }
                
            }
            if(canvases[7]){
                var activeObject7 = canvases[7].getActiveObject();
                 if(activeObject7){

                    var activeObject = canvases[7].getActiveObject();

                    activeObject.scaleToHeight((canvases[7].getHeight()) / 2);

                    canvases[7].renderAll();                
                       
                   
                }
                
            }
            if(canvases[8]){
                var activeObject8 = canvases[8].getActiveObject();
                 if(activeObject8){

                    var activeObject = canvases[8].getActiveObject();

                    activeObject.scaleToHeight((canvases[8].getHeight()) / 2);

                    canvases[8].renderAll();                
                       
                   
                }
                
            }
            if(canvases[9]){
                var activeObject9 = canvases[9].getActiveObject();
                 if(activeObject9){

                    var activeObject = canvases[9].getActiveObject();

                    activeObject.scaleToHeight((canvases[9].getHeight()) / 2);

                    canvases[9].renderAll();                
                       
                   
                }
                
            }

            

        } else {

            if(canvases[0]){
                var activeObject0 = canvases[0].getActiveObject();
                 if(activeObject0){

                    var activeObject = canvases[0].getActiveObject();
                    activeObject.scaleToHeight(canvases[0].getWidth());
                    canvases[0].renderAll();                                 
                       
                   
                }
                
            }
            if(canvases[1]){
                var activeObject1 = canvases[1].getActiveObject();
                 if(activeObject1){

                    var activeObject = canvases[1].getActiveObject();
                    activeObject.scaleToHeight(canvases[1].getWidth());
                    canvases[1].renderAll();                                 
                       
                   
                }
                
            }
            if(canvases[2]){
                var activeObject2 = canvases[2].getActiveObject();
                 if(activeObject2){

                    var activeObject = canvases[2].getActiveObject();
                    activeObject.scaleToHeight(canvases[2].getWidth());
                    canvases[2].renderAll();                                 
                       
                   
                }
                
            }
            if(canvases[3]){
                var activeObject3 = canvases[3].getActiveObject();
                 if(activeObject3){

                    var activeObject = canvases[3].getActiveObject();
                    activeObject.scaleToHeight(canvases[3].getWidth());
                    canvases[3].renderAll();                                 
                       
                   
                }
                
            }
            if(canvases[4]){
                var activeObject4 = canvases[4].getActiveObject();
                 if(activeObject4){

                    var activeObject = canvases[4].getActiveObject();
                    activeObject.scaleToHeight(canvases[4].getWidth());
                    canvases[4].renderAll();                                 
                       
                   
                }
                
            }
            if(canvases[5]){
                var activeObject5 = canvases[5].getActiveObject();
                 if(activeObject5){

                    var activeObject = canvases[5].getActiveObject();
                    activeObject.scaleToHeight(canvases[5].getWidth());
                    canvases[5].renderAll();
                   
                }
                
            }
            if(canvases[6]){
                var activeObject6 = canvases[6].getActiveObject();
                 if(activeObject6){

                    var activeObject = canvases[6].getActiveObject();
                    activeObject.scaleToHeight(canvases[6].getWidth());
                    canvases[6].renderAll();                                 
                       
                   
                }
                
            }
            if(canvases[7]){
                var activeObject7 = canvases[7].getActiveObject();
                 if(activeObject7){

                    var activeObject = canvases[7].getActiveObject();
                    activeObject.scaleToHeight(canvases[7].getWidth());
                    canvases[7].renderAll();                                 
                       
                   
                }
                
            }
            if(canvases[8]){
                var activeObject8 = canvases[8].getActiveObject();
                 if(activeObject8){

                    var activeObject = canvases[8].getActiveObject();
                    activeObject.scaleToHeight(canvases[8].getWidth());
                    canvases[8].renderAll();                                 
                       
                   
                }
                
            }
            if(canvases[9]){
                var activeObject9 = canvases[9].getActiveObject();
                 if(activeObject9){

                    var activeObject = canvases[9].getActiveObject();
                    activeObject.scaleToHeight(canvases[9].getWidth());
                    canvases[9].renderAll();                                 
                       
                   
                }
                
            }




            

        }



    }







    // jQuery.getJSON( "https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyBp05auwQZh4XOgkRvpPUpZ_TGeHR4E1IA", function( data ) {
    //   var items = [];
    //   jQuery.each( data, function( key, val ) {
    //     items.push( "<li id='" + key + "'>" + val + "</li>" );
    //   });
     
    //   jQuery( "<ul/>", {
    //     "class": "my-new-list",
    //     html: items.join( "" )
    //   }).appendTo( "body" );
    // });

    $.ajax({

            url: 'https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyBp05auwQZh4XOgkRvpPUpZ_TGeHR4E1IA',          

            type: "GET",
            success: function(response) {  

                    

                var fonts = [];
                for(let i=0;i<response.items.length;i++){
                    fonts.push({family: response.items[i].family, url: response.items[i].files.regular});
                }

                console.log(fonts);

                var newStyle = document.createElement('style'),
                    head = document.head || document.getElementsByTagName('head')[0];
                for(var f= 0; f< fonts.length; f++){                    
                        newStyle.appendChild(document.createTextNode('@font-face {\n'+
                            'font-family: "'+ fonts[f].family + '";\n'+
                            'src: url("' + fonts[f].url +'");\n }'));                        

                }
                head.appendChild(newStyle);
        
            }

        });






























    jQuery('.items canvas:first-child').droppable({

       

        hoverClass: 'hoverOnDrop',



        drop: function(argument) {

            

            need_to_drop = jQuery(this).attr('id');    

            console.log(need_to_drop);

           add_image(dragged_Src,need_to_drop);



        }

    });



    function add_image(dragged_Src, need_to_drop) {


         console.log('dragged_Src'+dragged_Src);


        var main_canvas_height = jQuery('#'+need_to_drop).height(),

            main_canvas_width = jQuery('#'+need_to_drop).width();

            



        var aaaa = need_to_drop.replace('canvas_','');

        array_no = (parseInt(aaaa) - 1);

       //alert(canvases.length)

        canvases[array_no];

        for (m = 0; m < canvases[array_no].getObjects().length; m++) {

            if (canvases[array_no].item(m).get('type') == 'image') {

                canvases[array_no].item(m).remove();

            }
        }



        var imgElement = new Image();

        imgElement.src = dragged_Src;

        imgElement.crossOrigin = "anonymous";



        imgInstance = new fabric.Image(imgElement, {

            left: 0,

            top: 0,

        });

        var scaling = main_canvas_height / imgElement.height;

        imgInstance.resizeFilter = new fabric.Image.filters.Resize({

            resizeType: 'hermite',

            scaleX: 1 / 6,

            scaleY: 1 / 6

        });

        imgInstance.applyFilters();

        if(main_canvas_width >= main_canvas_height){

            imgInstance.scaleToWidth(main_canvas_width);

        }else{

            imgInstance.scaleToHeight(main_canvas_height);

        }

        

        //imgInstance.scaleToWidth(main_Editarea.getWidth());       

        canvases[array_no].add(imgInstance);



        //canvases[array_no].setActiveObject(imgInstance);

        if (canvases[array_no].renderAll()) {            

            jQuery('.wall_images #image_'+(array_no+1) ).attr('src',canvases[array_no].toDataURL('png'));

            make_continious_image();

           

        }





         make_continious_image();        





    }















    function inch_to_px(inchVal, ratio) {



        var converted_data = {w:undefined, h:undefined};

        var p_w = inchVal.w * ratio,

           p_h = inchVal.h * ratio;

           converted_data.w = p_w;

           converted_data.h = p_h;

           return converted_data;

    }



     function split_it(str, which){

        var splited_data = [];

        splited_data = str.split(',');

        return splited_data;

    }

    function split_it_again(str){

        var splited_data = [];

        splited_data = str.split('x');

        return splited_data;

    }





    function make_continious_image(){

         

        html2canvas(jQuery('.wall_type_1'), {

          onrendered: function(canvas) {

            document.body.appendChild(canvas);

            console.log(jQuery('body > canvas').attr('id','main_img_canvas'));           

            var imagCan = document.getElementById('main_img_canvas');            

            var d=imagCan.toDataURL("image/png");           

             jQuery('body #canvas_image').attr('src',d);

             jQuery('#main_img_canvas').remove()

          }

        });

    }


    jQuery('#upload-photo .upload-photo-box:first-child').on('click', function(argument) {



        jQuery('.my_computer').removeClass('hides');
        jQuery('.fileuploader .fileuploader-input').click();



    });



    // 1-11-17








})

