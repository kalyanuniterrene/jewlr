<?php
/**
 * @category    Herve
 * @package     Herve_ProductEditButton
 * @copyright   Copyright (c) 2013 Hervé Guétin (http://www.herveguetin.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Herve_ProductEditButton_Model_Observer
{
    /**
     * Add a new button next to the existing "Save and Continue Edit" button
     *
     * @return void
     */
    public function addButton()
    {
        // Retrieve layout
        $layout = Mage::app()->getLayout();

        // Retrieve product_edit block
        $productEditBlock = $layout->getBlock('product_edit');

        // Create new button
        $myButton = $layout->createBlock('adminhtml/widget_button')
            ->setData(array(
                'label'     => Mage::helper('producteditbutton')->__('My Button Label'),
                'onclick'   => 'setLocation(\'' . $this->getButtonUrl() . '\')',
                'class'  => 'save'
            ));

        // Create a container that will gather existing "Save and Continue Edit" button and the new button
        $container = $layout->createBlock('core/text_list', 'button_container');

        // Retrieve original "Save and Continue Edit" button
        $saveAndContinueButton = $productEditBlock->getChild('save_and_edit_button');

        // Append existing "Save and Continue Edit" button and the new button to the container
        $container->append($saveAndContinueButton);
        $container->append($myButton);

        // Replace the existing "Save and Continue Edit" button with our container
        $productEditBlock->setChild('save_and_edit_button', $container);
    }

    /**
     * Retrieve the URL for button click
     *
     * @return string
     */
    public function getButtonUrl()
    {
        // The URL called fits to the controller of our module: Herve_ProductEditButton_Adminhtml_ButtonController
        return Mage::getModel('adminhtml/url')->getUrl('*/button/myButton', array(
            '_current'   => true,
            'back'       => 'edit',
            'tab'        => '{{tab_id}}',
            'active_tab' => null
        ));
    }
}