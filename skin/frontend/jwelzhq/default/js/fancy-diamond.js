jQuery(document).ready(function() {

    const myFirstPromise = new Promise((resolve, reject) => {

        var product_Data = jQuery('#json_encode').val();

        resolve(product_Data); // fulfilled

        // or

        reject("Unable to load JSON"); // rejected

    });

    myFirstPromise.then((jsonData) => {
        var wid_wrap = jQuery('#wizard_accordion-wrapper');
        var obj = JSON.parse(jsonData);

        // removing default
        jQuery('.panel.sku_pane .panel-body .pane-content ul').html('');

        obj.forEach(function(data) {

             if(data.class == 'default'){

                var matal_item = '<li' +
                    ' data-title="' + data.default_title + '"' +
                    ' data-description=""' +
                    ' data-price="329"' +
                    ' class="wizard-option metal-item metal_type selected-item">' +
                    '<img' +
                    ' height="40"' +
                    ' width="40"' +
                    ' alt="14K Rose Gold"' +
                    ' title="14K Rose Gold"' +
                    ' class="lazyautosizes lazyloaded"' + 'data-srcset=""' +
                    ' data-sizes="auto"' +
                    ' src="http://jewelzhq.com/media/' + data.image + '"' +
                    ' sizes="40px"' +
                    ' srcset=""' +
                    ' data-sku="' + data.sku + '"' +
                    ' data-default-sku="fancy-halo-flip-ring"' +
                    ' data-default-name="' + data.default_title + '">' +
                    '<div id="data-size" style="display:none;">' + JSON.stringify(data.size) + '</div>' +
                    '<div id="data-style" style="display:none;">' + JSON.stringify(data.style) + '</div>' +
                    '<p><small>' + data.default_title + '</small></p>' +
                    '<p> ' + data.default_price + ' </p>' +
                    '</li>';               

                }else{

                     var matal_item = '<li' +
                    ' data-title="' + data.default_title + '"' +
                    ' data-description=""' +
                    ' data-price="329"' +
                    ' class="wizard-option metal-item metal_type">' +
                    '<img' +
                    ' height="40"' +
                    ' width="40"' +
                    ' alt="14K Rose Gold"' +
                    ' title="14K Rose Gold"' +
                    ' class="lazyautosizes lazyloaded"' + 'data-srcset=""' +
                    ' data-sizes="auto"' +
                    ' src="http://jewelzhq.com/media/' + data.image + '"' +
                    ' sizes="40px"' +
                    ' srcset=""' +
                    ' data-sku="' + data.sku + '"' +
                    ' data-default-sku="fancy-halo-flip-ring"' +
                    ' data-default-name="' + data.default_title + '">' +
                    '<div id="data-size" style="display:none;">' + JSON.stringify(data.size) + '</div>' +
                    '<div id="data-style" style="display:none;">' + JSON.stringify(data.style) + '</div>' +
                    '<p><small>' + data.default_title + '</small></p>' +
                    '<p> ' + data.default_price + ' </p>' +
                    '</li>'; 
                }

            jQuery('.panel.sku_pane .panel-body .pane-content ul').append(matal_item);
        });

    });




    // clicking on the metal

    jQuery(document).on('click', '.panel.sku_pane .panel-body .pane-content ul li', function() {

        jQuery(this).addClass('selected-item').siblings().removeClass('selected-item');

        jQuery('.panel .panel-body .pane-content select.size-wizard-option')

        .html('<option value="" data-title="" data-filter="" data-value="" data-sia="0">Please select your size</option>');

        jQuery('.panel .panel-body.styles_panel ul').html('');

        let size_json = JSON.parse(jQuery(this).find('#data-size').html());
        let style_json = JSON.parse(jQuery(this).find('#data-style').html());

        size_json.forEach(function(data) {

            var size_item = '<option class="sz-item" value="+ data.price +">' + data.name + '</option>';
            jQuery('.panel .panel-body .pane-content select.size-wizard-option').append(size_item);

        });

        style_json.forEach(function(data) {
            if(data.default == 'default'){

                var style_item = '<li data-title="' + data.name + '"' +
                    ' data-price="' + data.price + '"' +
                    ' data-description="' + data.description + '"' +
                    ' data-sku="' + data.sku + '"' +
                    ' class="wizard-option face-option selected-item">' +
                    ' <img width="50"' + 'height="50"' + 'alt="" title="" class="extimage"' +
                    ' src="http://jewelzhq.com/media/' + data.image + '">' +
                    ' <p>' + data.name + '<br></p>' +
                    '<div id="data-style-items" style="display:none;">' + JSON.stringify(data.item) + '</div>' +
                    '</li>';                

                }else{

                var style_item = '<li data-title="' + data.name + '"' +
                    ' data-price="' + data.price + '"' +
                    ' data-description="' + data.description + '"' +
                    ' data-sku="' + data.sku + '"' +
                    ' class="wizard-option face-option">' +
                    ' <img width="50"' + 'height="50"' + 'alt="" title="" class="extimage"' +
                    ' src="http://jewelzhq.com/media/' + data.image + '">' +
                    ' <p>' + data.name + '<br></p>' +
                    '<div id="data-style-items" style="display:none;">' + JSON.stringify(data.item) + '</div>' +
                    '</li>';
                }

            jQuery('.panel .panel-body.styles_panel ul').append(style_item);

        });

    });


    jQuery(document).on('click', '.panel .panel-body.styles_panel .pane-content ul li', function() {
        jQuery(this).addClass('selected-item').siblings().removeClass('selected-item');

        let size_style_item = JSON.parse(jQuery(this).find('#data-style-items').html());
        jQuery(document).find('.filteredItems').remove();
        jQuery(document).find('.filtered').slideUp();
        size_style_item.forEach(function(data, index) {
            var styleEachItem = '<div class="panel panel-default filteredItems stones_pane s1_pane">' +
                '<!-- Stone 1 Pane Header -->' +
                '<div class="panel-heading clearfix item_itm" data-toggle="collapse" data-parent="" href=".gem1Collapse' + index + '">' +
                '<div class="eachItm" style="display:none;">' + JSON.stringify(data.details) + '</div>' +
                '<div class="mw-thumb mw-thumb-stone1"> ' +
                '<img width="40" height="40" class="gem1_thumb summary_thumb lazyloaded" '+
                'src="http://jewelzhq.com/media/jewlr-4a34acfad1ff8388b748c3eb253a6fbb5b3e4fbe9a34cbeaf169de003c69853b.gif" alt="Jewlr" srcset="https://j4-assets-jewlr.netdna-ssl.com/assets/product/stones/40px/1x/side/S01GARN_RD-6eac1d083687b764929bcfb1052d635998d037f7cec26a551c132cfc8d1c2fc3.png 1x, https://j4-assets-jewlr.netdna-ssl.com/assets/product/stones/40px/2x/side/S01GARN_RD-2974eb64e6107c5e069230999b08a99334c4c95e5efef81b4171e568b489dda4.png 2x"> ' +
                '</div>' +
                '<div class="mw-desc-stone1"> ' +
                '<div class="mw-desc">' +
                '<h4>' + data.name + '</h4>' +
                '<span class="gem1_description">Garnet (Simulated) - January</span> </div>' +
                '<div class="mw-chevron"> <span class="fa fa-angle-right"></span> </div>' +
                '<div class="mw-price"> <span class="gem1_price">$0</span> </div>' +
                '</div>' +
                ' </div>' +
                ' <!-- End Stone 1 Pane Header -->' +
                ' <!-- Stone 1 Pane Body -->' +
                '<div class="panel-collapse collapse gem1Collapse' + index + '">' +
                '<div class="panel-body">' +
                '<div class="wizard-pane s1_pane item" data-maparea="gem1" '+
                'data-summary-field="gem1" data-pref="s1" data-hashid="s1" data-label="Stone 1">' +
                '<div class="pane-content">' +
                ' <div class="option-description option-description-org">' +
                '<h3 class="option-item-description1">Garnet (Simulated) - $0</h3>' +
                '<span class="option-item-stone-size">Stone Size: 4mm x 2mm Baguette Cut Stone</span>' +
                '<br>' +
                '<div class="option-item-description2">Birthmonth: January' +
                '<br><span class="stone_attributes">Attributes: Leadership, Truth, Creativity</span></div>' +
                '</div>' +
                '<div class="option-description2 option-description" style="display: none;">' +
                ' </div>' +
                ' <h4>Genuine Stones<i data-container="body" data-placement="right" class="fa fa-question-circle tooltip-w"></i> </h4>' +
                ' <div class="wizard-option-category stone-option-category">' +
                ' <ul class="thumbnails stone_thumbnails list-unstyled list-inline row ranitul-' + index + '">' +

                '</ul>' +
                ' </div>' +
                '<h4>Simulated Stones<i data-container="body" data-placement="right" class="fa fa-question-circle tooltip-w"></i> </h4>' +
                '<div class="wizard-option-category stone-option-category">' +
                '<ul class="thumbnails stone_thumbnails list-unstyled list-inline row">' +
                '</ul>' +
                ' </div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<!-- End Stone 1 Pane Body -->' +
                '</div>';
            if (data.details != undefined) {
                jQuery(styleEachItem).insertAfter('.panel.panel-default.stylePanel');
            }

        });


    });

// click on each items

jQuery(document).on('click','.panel-heading.item_itm',function (argument) {
    var eachItmJson = JSON.parse(jQuery(this).find('.eachItm').html());
    jQuery(this).parent().find('.pane-content .stone-option-category ul').html('');

    for(let i=0; i<eachItmJson.length;i++){

    var li = '<li data-category="'+eachItmJson[i].category+
            '" data-title="'+eachItmJson[i].paneltype+
            '" data-description="'+eachItmJson[i].decsription+'" data-panelsize="'+eachItmJson[i].panelsize+'" data-panelType="'+eachItmJson[i].paneltype+'" data-price="'+eachItmJson[i].price+'" data-rgb="102,204,255" class="wizard-option stone-option">'+
            '<img width="40" height="40" alt="" class="lazyautosizes lazyloaded" src="http://jewelzhq.com/media/'+ eachItmJson[i].image +'">'+
            '<p class="stone-option-info"> Blue Topaz<span class="subnote">December</span><span class="stone_price">$12</span> </p>'+
            '</li>';

        if(eachItmJson[i].category == 'Genuine Stones'){

            jQuery(this).parent().find('.pane-content .stone-option-category').eq(0).find('ul').append(li)

        }else if(eachItmJson[i].category == 'Simulated Stones'){

            jQuery(this).parent().find('.pane-content .stone-option-category').eq(1).find('ul').append(li)

        }else{

        }
        
    }



});




// =============================================================
// ==============================================================

// MOUSE-ENTER EVENTS

jQuery(document).on('mouseenter','.panel.sku_pane .panel-body .pane-content ul li',function (argument) {
   
    var title = jQuery(this).data('title');

    jQuery('.panel.panel-default.sku_pane .panel-heading span.sku_description.sku_description_metal').text(title);

});



jQuery(document).on('mouseenter','.panel.stylePanel .panel-body .pane-content ul li',function (argument) {
   
    var title = jQuery(this).data('title');
    var price = parseFloat(jQuery(this).attr('data-price')).toFixed(2);
    var desc = jQuery(this).attr('data-description');

    jQuery('.panel.stylePanel .panel-heading span.faces_description').text(title);
    jQuery('.panel.stylePanel .option-description .option-item-description1').text(title+' - $'+price);
    jQuery('.panel.stylePanel .option-description .option-item-description2').text(desc);

});

jQuery(document).on('click','.panel.stylePanel .panel-body .pane-content ul li',function (argument) {
   
    var img = jQuery(this).find('img').attr('src');
    jQuery('.panel.stylePanel .panel-heading .mw-thumb img').attr('src',img);

});






















});
