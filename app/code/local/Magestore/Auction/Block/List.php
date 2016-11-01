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

class Magestore_Auction_Block_List extends Mage_Core_Block_Template {

    /**
     * @return mixed
     */
    protected function getListAuction() {
        $store_id = Mage::app()->getStore()->getId();
        $Ids = Mage::helper('auction')->getProductAuctionIds($store_id, true);
        $collection = Mage::getModel('catalog/product')->getCollection()
                ->addAttributeToSelect('small_image')
                ->addFieldToFilter('entity_id', array('in' => $Ids));
        Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($collection);
        Mage::getSingleton('catalog/product_visibility')->addVisibleInSearchFilterToCollection($collection);
        return $collection;
    }

}
