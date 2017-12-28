<?php

class Folio3_Feedback_Model_Feedback extends Mage_Core_Model_Abstract {

	public function _construct()
    {
        parent::_construct();
        $this->_init('folio3_feedback/feedback');
    }
	
	/**
     * This method is used in the grid and form for populating the dropdown.
     */
    public function getAvailableVisibilies()
    {
        return array(
            self::VISIBILITY_HIDDEN
                => Mage::helper('folio3_feedback')
                       ->__('Hidden'),
            self::VISIBILITY_DIRECTORY
                => Mage::helper('folio3_feedback')
                       ->__('Visible in Directory'),
        );
    }
    protected function _beforeSave()
    {
        parent::_beforeSave();
        /**
         * Perform some actions just before a brand is saved.
         */
        $this->_updateTimestamps();
        $this->_prepareUrlKey();
        return $this;
    }
    protected function _updateTimestamps()
    {
        $timestamp = now();
        /**
         * Set the last updated timestamp.
         */
        $this->setUpdatedAt($timestamp);
        /**
         * If we have a brand new object, set the created timestamp.
         */
        if ($this->isObjectNew()) {
            $this->setCreatedAt($timestamp);
        }
        return $this;
    }
    protected function _prepareUrlKey()
    {
        /**
         * In this method, you might consider ensuring
         * that the URL Key entered is unique and
         * contains only alphanumeric characters.
         */
        return $this;
    }
	
}
