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

class Magestore_Auction_Model_Mysql4_Auction extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the auction_id refers to the key field in your database table.
        $this->_init('auction/auction', 'auctionbid_id');
    }
	
	public function getTotalBidder($auction_id)
	{
		$select = $this->_getReadAdapter()->select()
			->distinct()
			->from(array('a'=>$this->getTable('auction')),'customer_id')
			->where('productauction_id=?',$auction_id);
		
		return count($this->_getReadAdapter()->fetchAll($select));
	}
}