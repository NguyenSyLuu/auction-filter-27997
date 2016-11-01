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

class Magestore_Auction_Block_Adminhtml_Sales_Tab_Auction
	extends Mage_Adminhtml_Block_Widget_Form
	implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    /**
     * Magestore_Auction_Block_Adminhtml_Sales_Tab_Auction constructor.
     */
    public function __construct()
	{
		parent::__construct();
		$this->setTemplate('auction/auction.phtml');
	}

    /**
     * @return mixed
     */
    public function getTabLabel()	{
		return Mage::helper('auction')->__('AuctionBid');
	}

    /**
     * @return mixed
     */
    public function getTabTitle() {
		return Mage::helper('sales')->__('AuctionBid');
	}

    /**
     * @return bool
     */
    public function canShowTab()	{
		if($this->getAuctionbid())	
			return true;
		else
			return false;
	}

    /**
     * @return bool
     */
    public function isHidden()	{
		if($this->getAuctionbid())
			return false;
		else
			return true;
	}

    /**
     * @return mixed
     */
    public function getAuctionbid()
	{
		if(!$this->hasData('auction'))
		{
			$auction = null;
			
			$order = $this->getOrder();
			
			if (!$order) 
			{
				$this->setData('auction',null);
				return $this->getData('auction');
			}
			
			$order_id = $order->getId();
			
			// $entity_type = Mage::getSingleton("eav/entity_type")->loadByCode("order");
			
			// $entity_type_id = $entity_type->getId();
			
			// $attribute = Mage::getModel("eav/entity_attribute")->load("order_bid_id","attribute_code");

			// $attribute_id = $attribute->getId();
				
			// $pretable =  Mage::helper('auction')->getTablePrefix();
			
			// $resource = Mage::getSingleton('core/resource');			
			
			// $read = $resource->getConnection('core_read');
			
			// $select = $read->select()
						   // ->from( $pretable ."sales_order_entity_int",array('value'))
						   // ->where("entity_type_id=?",$entity_type_id)
						   // ->where("attribute_id=?",$attribute_id)
						   // ->where("entity_id=?",$order_id);
			
			// $attribute = $read->fetchRow($select);		
			
			// if(isset($attribute['value']))
				
				$auction = Mage::getModel('auction/auction')->load($order_id, "order_id");	
				// var_dump($auction->getData()); die();
			$this->setData('auction',$auction);
		}
		
		return 	$this->getData('auction');
		
	}

    /**
     * @return mixed
     */
    public function getOrder()
    {       
        if (Mage::registry('current_order')) {
            return Mage::registry('current_order');
        }
        if (Mage::registry('order')) {
            return Mage::registry('order');
        } 
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

    /**
     * @param $customer_id
     * @return mixed
     */
    public function getCustomerUrl($customer_id)
	{
		return $this->getUrl('adminhtml/customer/edit',array('id'=>$customer_id));
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

    /**
     * @return mixed
     */
    public function getCustomer(){
            return Mage::getModel('customer/customer')->load($this->getOrder()->getCustomerId());
        }

}