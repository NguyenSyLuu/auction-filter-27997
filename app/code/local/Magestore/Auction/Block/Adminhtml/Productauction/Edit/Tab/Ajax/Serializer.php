<?php
/**
 * Magestore
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Magestore.com license that is
 * available through the world-wide-web at this URL:
 * http://www.magestore.com/license-agreement.html
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Magestore
 * @package     Magestore_Auction
 * @module     Auction
 * @author      Magestore Developer
 *
 * @copyright   Copyright (c) 2016 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 *
 */

class Magestore_Auction_Block_Adminhtml_Productauction_Edit_Tab_Ajax_Serializer
	extends Mage_Core_Block_Template
{
    public function _construct()
    {
        parent::_construct();
        $this->setTemplate('auction/serializer.phtml');
        return $this;
    }
	
    public function getObjectsJSON()
    {
        $result = array();
        if (count($this->getObjects())) {
            foreach ($this->getObjects() as $object) {
                $id = $object->getId();
                $result[$id] = 0;
            }
        }
		
		if (count($result)) {
            return Zend_Json::encode($result);
        }
		
        return '{}';
    }

}