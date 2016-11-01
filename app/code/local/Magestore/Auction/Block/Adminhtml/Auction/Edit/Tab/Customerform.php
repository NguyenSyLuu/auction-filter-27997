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

class Magestore_Auction_Block_Adminhtml_Auction_Edit_Tab_Customerform extends Mage_Adminhtml_Block_Widget_Form {

    public function __construct() {
        $this->setTemplate('auction/viewcustomer.phtml');
    }

    public function getAuctionbid() {
        if (!$this->hasData('auction_data')) {
            $this->setData('auction_data', Mage::registry('auction_data'));
        }
        return $this->getData('auction_data');
    }

    public function getCustomer() {
        $auction = $this->getAuctionbid();

        $customer_id = $auction->getCustomerId();

        if ($customer_id) {
            return Mage::getModel('customer/customer')->load($customer_id);
           
        }

        return;
    }

    public function getCustomerUrl($customer_id) {
        return $this->getUrl('adminhtml/customer/edit', array('id' => $customer_id));
    }

}
