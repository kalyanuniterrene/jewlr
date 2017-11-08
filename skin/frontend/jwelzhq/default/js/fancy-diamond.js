jQuery(document).ready(function(){

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
	  	var matal_item = '<li'+ 
	  					' data-title="'+ data.default_title +'"'+
	 					' data-description=""'+
	 					' data-price="329"'+
	 					' class="wizard-option metal-item metal_type">'+
	                    '<img'+ 
	                    ' height="40"'+ 
	                    ' width="40"'+ 
	                    ' alt="14K Rose Gold"'+ 
	                    ' title="14K Rose Gold"'+
	                    ' class="lazyautosizes lazyloaded"'+ 'data-srcset=""'+ 
	                    ' data-sizes="auto"'+ 
	                    ' src="http://localhost/public_sc/jewlr/media/'+ data.image +'"'+
	                    ' sizes="40px"'+ 
	                    ' srcset=""'+
	                    ' data-sku="'+data.sku+'"'+ 
	                    ' data-default-sku="fancy-halo-flip-ring"'+ 
	                    ' data-default-name="'+ data.default_title +'">'+
	                    '<div id="data-size" style="display:none;">'+JSON.stringify(data.size)  +'</div>'+
	                    '<div id="data-style" style="display:none;">'+JSON.stringify(data.style)  +'</div>'+
                        '<p><small>'+ data.default_title +'</small></p>'+
                        '<p> '+ data.default_price +' </p>'+
                       '</li>';
		jQuery('.panel.sku_pane .panel-body .pane-content ul').append(matal_item);
	  });
	  
	});




	// clicking on the metal

	jQuery(document).on('click','.panel.sku_pane .panel-body .pane-content ul li',function(){

		jQuery(this).addClass('selected-item').siblings().removeClass('selected-item');

		jQuery('.panel .panel-body .pane-content select.size-wizard-option')

		.html('<option value="" data-title="" data-filter="" data-value="" data-sia="0">Please select your size</option>');

		jQuery('.panel .panel-body.styles_panel ul').html('');

		let size_json = JSON.parse(jQuery(this).find('#data-size').html());
		let style_json = JSON.parse(jQuery(this).find('#data-style').html());

		size_json.forEach(function(data) {

			var size_item ='<option class="sz-item" value="+ data.price +">'+data.name+'</option>';
			jQuery('.panel .panel-body .pane-content select.size-wizard-option').append(size_item);

		});
		
		style_json.forEach(function(data) {

			var style_item ='<li data-title="'+data.name+'"'+
							' data-price="'+data.price+'"'+
							' class="wizard-option face-option">'+
							' <img width="50"'+ 'height="50"'+ 'alt="" title="" class="extimage"'+
							' src="http://localhost/public_sc/jewlr/media/'+data.image+'">'+  
							' <p>'+data.name+'<br></p>'+
							'</li>';

			jQuery('.panel .panel-body.styles_panel ul').append(style_item);

		});

	});




});
