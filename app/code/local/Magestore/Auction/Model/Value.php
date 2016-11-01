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

class Magestore_Auction_Model_Value extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('auction/value');
    }
	
	public function loadByAuctionStore($auction_id,$store_id)
	{
		$collection = $this->getCollection()
							->addFieldToFilter('productauction_id',$auction_id)
							->addFieldToFilter('store_id',$store_id)
							;
		$item = $collection->getFirstItem();
		$this->setData($item->getData());
		
		return $this;
	}
}