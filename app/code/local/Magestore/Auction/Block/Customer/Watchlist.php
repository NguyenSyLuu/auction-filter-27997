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

class Magestore_Auction_Block_Customer_Watchlist extends Mage_Core_Block_Template
{	
	public function getCustomer()
	{
		if(! $this->hasData('customer'))
		{
			$customer = Mage::getSingleton('customer/session')->getCustomer();
			$this->setData('customer',$customer);
		}
		return $this->getData('customer');
	}
    
    public function getAuctionCollection()     
     { 
        if (!$this->hasData('watchlist')) 
		{
			$customerId  = $this->getCustomer()->getId();
			$collection = Mage::getModel('auction/watcher')->getListByCustomerId($customerId);		
			$this->setData('watchlist',$collection);
		}
        return $this->getData('watchlist');
    }
	
	public function getProduct($product_id)
	{
		if(!$this->hasData('product_'.$product_id)){
			$product = Mage::getModel('catalog/product')->load($product_id);
			$this->setData('product_'.$product_id,$product);
		}
		return $this->getData('product_'.$product_id);
	}
	
	public function getHistoryUrl($auction)
	{
		return $this->getUrl('auction/index/viewbids',array('id'=>$auction->getId()));
	}
}