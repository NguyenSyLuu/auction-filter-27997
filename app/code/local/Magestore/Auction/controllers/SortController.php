<?php

class Magestore_Auction_SortController extends Mage_Core_Controller_Front_Action {

    public function testAction(){
        echo "Lerric";
    }

    public function lowtohighAction(){

        if (Mage::getStoreConfig('auction/general/bidder_status') != 1) {
            $this->_redirect('', array());
            return;
        }
        if (!Mage::registry('current_category')) {
            $category = Mage::getModel('catalog/category')->load(Mage::app()->getStore()->getRootCategoryId())
                ->setIsAnchor(1)
                ->setName(Mage::helper('core')->__('Auction'))
                ->setDisplayMode('PRODUCTS');
            Mage::register('current_category', $category);
        }
        Mage::helper('auction')->updateAuctionStatus();
        $this->loadLayout();
        $this->getLayout()
            ->getBlock('head')
            ->setTitle(Mage::helper('core')->__('Low To High Auctions'));
        $this->renderLayout();
    }

    public function hightolowAction(){

        if (Mage::getStoreConfig('auction/general/bidder_status') != 1) {
            $this->_redirect('', array());
            return;
        }
        if (!Mage::registry('current_category')) {
            $category = Mage::getModel('catalog/category')->load(Mage::app()->getStore()->getRootCategoryId())
                ->setIsAnchor(1)
                ->setName(Mage::helper('core')->__('Auction'))
                ->setDisplayMode('PRODUCTS');
            Mage::register('current_category', $category);
        }
        Mage::helper('auction')->updateAuctionStatus();
        $this->loadLayout();
        $this->getLayout()
            ->getBlock('head')
            ->setTitle(Mage::helper('core')->__('High to Low Auctions'));
        $this->renderLayout();
    }

    public function endingsoonAction(){

        if (Mage::getStoreConfig('auction/general/bidder_status') != 1) {
            $this->_redirect('', array());
            return;
        }
        if (!Mage::registry('current_category')) {
            $category = Mage::getModel('catalog/category')->load(Mage::app()->getStore()->getRootCategoryId())
                ->setIsAnchor(1)
                ->setName(Mage::helper('core')->__('Auction'))
                ->setDisplayMode('PRODUCTS');
            Mage::register('current_category', $category);
        }
        Mage::helper('auction')->updateAuctionStatus();
        $this->loadLayout();
        $this->getLayout()
            ->getBlock('head')
            ->setTitle(Mage::helper('core')->__('Ending Soon Auctions'));
        $this->renderLayout();
    }

    public function hotauctionAction(){

        if (Mage::getStoreConfig('auction/general/bidder_status') != 1) {
            $this->_redirect('', array());
            return;
        }
        if (!Mage::registry('current_category')) {
            $category = Mage::getModel('catalog/category')->load(Mage::app()->getStore()->getRootCategoryId())
                ->setIsAnchor(1)
                ->setName(Mage::helper('core')->__('Auction'))
                ->setDisplayMode('PRODUCTS');
            Mage::register('current_category', $category);
        }
        Mage::helper('auction')->updateAuctionStatus();
        $this->loadLayout();
        $this->getLayout()
            ->getBlock('head')
            ->setTitle(Mage::helper('core')->__('Hot Auctions'));
        $this->renderLayout();
    }

    protected function _getAuctionInfo($auction, $lastBid = null, $tmpl = null) {
        $lastBid = $lastBid ? $lastBid : $auction->getLastBid();
        $tmpl = $tmpl ? $tmpl : 'auctioninfo';
        $auction->setLastBid($lastBid);
        $block = $this->getLayout()->createBlock('auction/auction');
        $block->setTemplate('auction/' . $tmpl . '.phtml');
        $block->setData('auction', $auction);

        return $block->toHtml();
    }

    protected function _getPriceAuction($auction, $lastBid = null) {
        $auction->setCurrentPrice(null)
                ->setMinNextPrice(null)
                ->setMaxNextPrice(null);

        $min_next_price = $auction->getMinNextPrice();
        $max_next_price = $auction->getMaxNextPrice();
        $max_condition = $max_next_price ? ' ' . Mage::helper('core')->__('to') . ' ' . Mage::helper('core')->currency($max_next_price) : '';
        if ($max_condition)
            $html = '(' . Mage::helper('core')->__('Enter an amount from') . ' ' . Mage::helper('core')->currency($min_next_price) . $max_condition . ')';
        else
            $html = '(' . Mage::helper('core')->__('Enter %s or more',Mage::helper('core')->currency($min_next_price)) . ')';

        return $html;
    }
}
