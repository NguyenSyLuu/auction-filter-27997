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

class Magestore_Auction_Model_Watcher extends Mage_Core_Model_Abstract
{
	public function _construct()
    {
        parent::_construct();
        $this->_init('auction/watcher');
    }
	
	public function getListByCustomerId($customer_id)
	{
		$auctionIds = array(0);
		$watchers = $this->getCollection()
						->addFieldToFilter('customer_id',$customer_id)
						->addFieldToFilter('status',1)
						;
		if(count($watchers)){
			foreach($watchers as $watcher){
				$auctionIds[] = $watcher->getProductauctionId();
			}
		}
		$collection = Mage::getResourceModel('auction/productauction_collection')
							->addFieldToFilter('productauction_id',array('in'=>$auctionIds))
							->addFieldToFilter('status',array('neq'=>2))
						;
		return $collection;
	}
}