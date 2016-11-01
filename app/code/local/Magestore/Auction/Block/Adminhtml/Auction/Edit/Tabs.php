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

class Magestore_Auction_Block_Adminhtml_Auction_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    /**
     * Magestore_Auction_Block_Adminhtml_Auction_Edit_Tabs constructor.
     */
    public function __construct()
  {
      parent::__construct();
      $this->setId('auction_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('auction')->__('Bid Information'));
  }

    /**
     * @return mixed
     */
    protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('auction')->__('General Information'),
          'title'     => Mage::helper('auction')->__('General Information'),
          'content'   => $this->getLayout()->createBlock('auction/adminhtml_auction_edit_tab_form')->toHtml(),
      ));
	  
      $this->addTab('form_auction', array(
          'label'     => Mage::helper('auction')->__('Auction Information'),
          'title'     => Mage::helper('auction')->__('Auction Information'),
          'content'   => $this->getLayout()->createBlock('auction/adminhtml_auction_edit_tab_auctionform')->toHtml(),
      ));	

      $this->addTab('form_product', array(
          'label'     => Mage::helper('auction')->__('Product Information'),
          'title'     => Mage::helper('auction')->__('Product Information'),
          'content'   => $this->getLayout()->createBlock('auction/adminhtml_auction_edit_tab_productform')->toHtml(),
      ));	  
	  
      $this->addTab('form_customer', array(
          'label'     => Mage::helper('auction')->__('Customer Information'),
          'title'     => Mage::helper('auction')->__('Customer Information'),
          'content'   => $this->getLayout()->createBlock('auction/adminhtml_auction_edit_tab_customerform')->toHtml(),
      ));		  
     
      return parent::_beforeToHtml();
  }
}