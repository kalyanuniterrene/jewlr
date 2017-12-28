<?php

/*
 * Author: Shourya-Uniterrene
* Description: Added the code for the size section for custom-canvas-print products
* Date: 10-8-17
* Version: 3.0
*/
?>
<?php $skin_url =  Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN);?>
 

                        <a href="#" class="link">
                            <img src="<?php echo $skin_url?>frontend/rwd/default/images/canvas_live_editor/images/size.png" alt="Editor Icon">
                            <span>Size</span>
                        </a>

<?php 
$sku = "custom-canvas-print";
$opt_title = "Canvas Type";
$product_data = $this->getLayout()->getBlockSingleton('Canvassignages_Liveeditor_Block_Monblock')->customCanvasPrint($sku,$opt_title);
//print_r($product_data);
?>


                        <div class="sidebar-content size-prize ">                        
                            <ul class="nav nav-tabs" role="tablist">
                                 <?php 
                                
                                
                                foreach($product_data as $canvas_data)

                                {
                                    $media_url = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA);
                                    $img_url = $canvas_data['img_url'];
                                    
                                    if($canvas_data['default']=="default")
                                    {
										$active = $canvas_data['option_label'];
									}
                                            ?>
                                            
                                            <li role="presentation" data-canvas-type="<?php echo $canvas_data['data_canvas_type']; ?>" class="<?php if($active == $canvas_data['option_label']) {?>
									<?php echo "active";?>
								<?php }?>">
                                                <a href="#<?php echo $canvas_data['canvas_type_redirect']; ?>" role="tab" data-toggle="tab" aria-expanded="true">
                                                    <img src="<?php echo $media_url.$img_url?>" alt="Size">
                                                    <img src="<?php echo $skin_url?>frontend/rwd/default/images/canvas_live_editor/images/select-check.png" class="select-image" alt="Select Image">
                                                    <span><?php echo $canvas_data['option_label']; ?></span>
                                                </a>
                                            </li>   
                                                
                                         <?php
                                      
                                }   
        
                                ?>
                            </ul>
                            
                            <?php //echo "active is".$active;?>
                            
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane <?php if(substr_count($active,"Rolled")>0) {?>
									<?php echo "active";?>
								<?php }?>" id="Rolled-Cannvas">
									 <?php echo $this->getLayout()->createBlock('core/template')->setTemplate('canvassignages_liveeditor/custom-canvas-print/rolled_cannvas/rolled-canvas-size.phtml')->toHtml(); ?>
                                    
                                </div>
                                <div role="tabpanel" class="tab-pane <?php if(substr_count($active,"Thin")>0) {?>
									<?php echo "active";?>
								<?php }?>" id="Thin-Gallery" 
                                
                                
                                >
                                <?php echo $this->getLayout()->createBlock('core/template')->setTemplate('canvassignages_liveeditor/custom-canvas-print/thin_canvas/thin-canvas-size.phtml')->toHtml(); ?>
                                   
                                </div>
                                <div role="tabpanel" class="tab-pane <?php if(substr_count($active,"Thick")>0) {?>
									<?php echo "active";?>
								<?php }?>" id="Thick-Gallery">
                                    <?php echo $this->getLayout()->createBlock('core/template')->setTemplate('canvassignages_liveeditor/custom-canvas-print/thick_canvas/thick-canvas-size.phtml')->toHtml(); ?>
                            </div>
                        </div>
                    
