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

class Magestore_Auction_Block_Adminhtml_Auction_Edit_Tab_Auctionform extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Magestore_Auction_Block_Adminhtml_Auction_Edit_Tab_Auctionform constructor.
     */
    public function __construct()
	{
		$this->setTemplate('auction/productauction.phtml');
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

    /**
     * @return mixed
     */
    public function getProductauction()
	{
		$productauctionId = $this->getAuctionbid()->getProductauctionId();
		
		if($productauctionId)
		{
			return Mage::getModel('auction/productauction')->load($productauctionId);
		}
	}
}