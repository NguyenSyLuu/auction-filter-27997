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

class Magestore_Auction_Block_Adminhtml_Auction_Edit_Tab_Productform extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Magestore_Auction_Block_Adminhtml_Auction_Edit_Tab_Productform constructor.
     */
    public function __construct()
	{
		$this->setTemplate('auction/viewproduct.phtml');
	}

    /**
     * @return mixed
     */
    public function getAuctionbid()
    { 
		if (!$this->hasData('auction_data')) {
            $this->setData('auction_data', Mage::registry('auction_data'));
		}
        return $this->getData('auction_data');
	}
	
	public function getProduct()
	{
		$auction = $this->getAuctionbid();
		
		$product_id = $auction->getProductId();
		
		if($product_id)
		{
			return Mage::getModel('catalog/product')->load($product_id);
		}
		
		return;
	}

    /**
     * @param $product_id
     * @return mixed
     */
    public function getProductUrl($product_id)
	{
		return $this->getUrl('adminhtml/catalog_product/edit',array('id'=>$product_id));
	}
}