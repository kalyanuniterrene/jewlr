<?php
/**
 * @category    Herve
 * @package     Herve_ProductEditButton
 * @copyright   Copyright (c) 2013 Hervé Guétin (http://www.herveguetin.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Herve_ProductEditButton_Adminhtml_ButtonController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Behavior of our new button when it is clicked
     */
    public function myButtonAction()
    {
        // Retrieve product id from which the button has been clicked
        $productId = $this->getRequest()->getParam('id');

        /**
         *
         * All custom controller logic goes here
         *
         */

        $this->_getSession()->addSuccess($this->__('Congratulations, you clicked on a button!'));

        // Redirect to product edit page
        $this->_redirect('*/catalog_product/edit', array(
            'id'    => $productId,
            '_current'=>true
        ));
    }
}