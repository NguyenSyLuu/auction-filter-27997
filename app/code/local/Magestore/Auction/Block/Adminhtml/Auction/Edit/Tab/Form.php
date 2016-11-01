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

class Magestore_Auction_Block_Adminhtml_Auction_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form {

    /**
     * Magestore_Auction_Block_Adminhtml_Auction_Edit_Tab_Form constructor.
     */
    public function __construct() {
        $this->setTemplate('auction/auction.phtml');
    }

    public function getCustomer() {
        $auction = $this->getAuctionbid();

        $customer_id = $auction->getCustomerId();

        if ($customer_id) {
            return Mage::getModel('customer/customer')->load($customer_id);
        }
        return;
    }

    /**
     * @return mixed
     */
    public function getAuctionbid() {
        if (!$this->hasData('auction_data')) {
            $this->setData('auction_data', Mage::registry('auction_data'));
        }
        return $this->getData('auction_data');
    }

    public function getProduct() {
        $auction = $this->getAuctionbid();

        $product_id = $auction->getProductId();

        if ($product_id) {
            return Mage::getModel('catalog/product')->load($product_id);
        }

        return;
    }

    /**
     * @param $product_id
     * @return mixed
     */
    public function getProductUrl($product_id) {
        return $this->getUrl('adminhtml/catalog_product/edit', array('id' => $product_id));
    }

    /**
     * @param $customer_id
     * @return mixed
     */
    public function getCustomerUrl($customer_id) {
        return $this->getUrl('adminhtml/customer/edit', array('id' => $customer_id));
    }

    /**
     * @return mixed
     */
    public function getProductauction() {
        $productauctionId = $this->getAuctionbid()->getProductauctionId();

        if ($productauctionId) {
            return Mage::getModel('auction/productauction')->load($productauctionId);
        }
    }

    /**
     * @return mixed
     */
    protected function _prepareForm() {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('auction_form', array('legend' => Mage::helper('auction')->__('Item information')));

        $fieldset->addField('product_name', 'text', array(
            'label' => Mage::helper('auction')->__('Product'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'product_name',
            'readonly' => 'readonly',
        ));

        $fieldset->addField('customer_name', 'text', array(
            'label' => Mage::helper('auction')->__('Customer Name'),
            'required' => true,
            'name' => 'customer_name',
            'readonly' => 'readonly',
        ));

        $fieldset->addField('price', 'text', array(
            'label' => Mage::helper('auction')->__('Price'),
            'required' => true,
            'name' => 'price',
            'readonly' => 'readonly',
        ));

        $fieldset->addField('created_date', 'text', array(
            'label' => Mage::helper('auction')->__('Date'),
            'required' => true,
            'name' => 'created_date',
            'readonly' => 'readonly',
        ));

        $fieldset->addField('created_time', 'text', array(
            'label' => Mage::helper('auction')->__('Time'),
            'required' => true,
            'name' => 'created_time',
            'readonly' => 'readonly',
        ));
        $fieldset->addField('status', 'select', array(
            'label' => Mage::helper('auction')->__('Status'),
            'name' => 'status',
            'values' => array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('auction')->__('Enabled'),
                ),
                array(
                    'value' => 2,
                    'label' => Mage::helper('auction')->__('Disabled'),
                ),
            ),
        ));


        if (Mage::getSingleton('adminhtml/session')->getAuctionData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getAuctionData());
            Mage::getSingleton('adminhtml/session')->setAuctionData(null);
        } elseif (Mage::registry('auction_data')) {
            $form->setValues(Mage::registry('auction_data')->getData());
        }
        return parent::_prepareForm();
    }

}
