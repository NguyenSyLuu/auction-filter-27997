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

class Magestore_Auction_Block_Customer_Email extends Mage_Core_Block_Template {

    /**
     * @return mixed
     */
    public function getCustomer() {
        if (!$this->hasData('customer')) {
            $customer = Mage::getSingleton('customer/session')->getCustomer();
            $this->setData('customer', $customer);
        }
        return $this->getData('customer');
    }

    /**
     * @param $customer
     * @return mixed
     */
    public function getEmailInfor($customer){
        $model = Mage::getModel('auction/email')->getCollection()->addFieldToFilter('customer_id', $customer->getId())->getFirstItem();
        return $model->getData();
    }

}
