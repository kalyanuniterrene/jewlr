<?php
class Magebase_AttributeSetHandle_Model_Observer
{
    public function addAttributeSetHandle(Varien_Event_Observer $observer)
    {
        $product = Mage::registry('current_product');
		
        /**
         * Return if it is not product page
         */
        if (!($product instanceof Mage_Catalog_Model_Product)) {
            return;
        }
 
        $attributeSet = Mage::getModel('eav/entity_attribute_set')->load($product->getAttributeSetId());
        /**
         * Convert attribute set name to alphanumeric + underscore string
         */
         $niceName = str_replace('-', '_', $product->formatUrlKey($attributeSet->getAttributeSetName()));
 
        /* @var $update Mage_Core_Model_Layout_Update */
        $update = $observer->getEvent()->getLayout()->getUpdate();
        $update->addHandle('PRODUCT_ATTRIBUTE_SET_' . $niceName);
		
    }
}