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

class Magestore_Auction_Block_Adminhtml_Transaction_View extends Mage_Adminhtml_Block_Template {

    public function __construct() {
        parent::_construct();
       
        $this->setTemplate('auction/transaction/view.phtml');

        return $this;
    }

    public function getTransaction() {
        $id = $this->getRequest()->getParam('id');

        $auction_product_table = Mage::getModel('core/resource')
                ->getTableName('auction_product');

        $order_table = Mage::getModel('core/resource')
                ->getTableName('sales/order');

        $collection = Mage::getModel('auction/transaction')->getCollection();
        $collection->getSelect()
                ->join($auction_product_table, "$auction_product_table.productauction_id = main_table.productauction_id", array(
                    'product_name' => 'product_name',
                        )
                )
                ->join(
                        $order_table, "$order_table.entity_id = main_table.order_id", array(
                    'order_number' => 'increment_id',
                    'created_date' => 'created_at',
                    'total_amount' => 'grand_total',
                        )
                )
                ->where("main_table.transaction_id = '$id'")
        ;
        return $collection;
    }

}
