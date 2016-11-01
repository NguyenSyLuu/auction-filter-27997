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

class Magestore_Auction_Model_Rewrite_TaxConfig extends Mage_Tax_Model_Config{

    public function priceIncludesTax($store=null)
    {
		$bid_id = Mage::getSingleton('core/session')->getData('bid_id');
		
		if(!$bid_id){
			return parent::priceIncludesTax($store);
		} else {
			if((int)Mage::getStoreConfig('auction/tax/is_included_tax')==1)
				return true;
			else
				return false;
		}		
    }	

}