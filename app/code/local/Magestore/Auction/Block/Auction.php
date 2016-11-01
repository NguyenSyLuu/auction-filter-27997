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

class Magestore_Auction_Block_Auction extends Mage_Core_Block_Template {

    /**
     * Magestore_Auction_Block_Auction constructor.
     */
    public function __construct() {
        $product = $this->getProduct();

        $auction = Mage::getModel('auction/productauction')
                ->loadAuctionByProductId($product->getId())
        ;

        if ($auction) {
            $lastBid = $auction->getLastBid();

            $this->setData('lastbid', $lastBid);

            $this->setData('auction', $auction);
        }

        return parent::__construct();
    }

    /**
     * @return mixed
     */
    public function _prepareLayout() {
        return parent::_prepareLayout();
    }

    /**
     * @return mixed
     */
    public function getProduct() {
        if (!$this->hasData('product')) {
            $this->setData('product', Mage::getModel('catalog/product')->load($this->getRequest()->getParam('id')));
        }
        return $this->getData('product');
    }

    /**
     * @return mixed
     */
    public function getAuction() {
        $product = $this->getProduct();
        if (!$this->hasData('auction')) {
            $auction = Mage::getModel('auction/productauction')->loadAuctionByProductId($product->getId());
            if ($auction) {
                $auction->setStoreId(Mage::app()->getStore()->getId())
                        ->loadByStore();
                if ($auction->getData('is_applied') == '2')
                    $auction = null;
            }
            $this->setData('auction', $auction);
        }

        return $this->getData('auction');
    }

    /**
     * @return mixed
     */
    public function getLastbid() {
        $auction = $this->getAuction();

        if (!$this->hasData('lastbid')) {
            $this->setData('lastbid', $auction->getLastBid());
        }

        return $this->getData('lastbid');
    }

    /**
     * @return mixed
     */
    public function getTotalBid() {
        $auction = $this->getAuction();

        return $auction->getTotalBid();
    }

    /**
     * @param $customer_id
     * @return mixed
     */
    public function getCustomerUrl($customer_id) {
        return $this->getUrl('auction/index/customer', array('id' => $customer_id));
    }

    /**
     * @return mixed
     */
    public function getCustomerBidUrl() {
        return $this->getUrl('auction/index/customerbid', array());
    }

    /**
     * @return mixed
     */
    public function getBidUrl() {
        return $this->getUrl('auction/index/bid', array());
    }

    /**
     * @return mixed
     */
    public function getHistoryUrl() {
        $auction_id = $this->getAuction()->getId();

        return $this->getUrl('auction/index/viewbids', array('id' => $auction_id));
    }

    /**
     * @return mixed
     */
    public function getUpdateAuctionUrl() {
        return $this->getUrl('auction/index/updateauctioninfo', array('id' => $this->getAuction()->getId(), 'tmpl' => 'auctioninfo'));
    }

    /**
     * @return mixed
     */
    public function getUpdatePriceUrl() {
        return $this->getUrl('auction/index/updatepricecondition', array('id' => $this->getAuction()->getId()));
    }

    /**
     * @return mixed
     */
    public function getChangeWatcherUrl() {
        if ($this->isWatcher())
            return $this->getUrl('auction/index/changewatcher', array());
        else
            return $this->getUrl('auction/index/changewatcher', array());
    }

    /**
     * @return mixed
     */
    public function isLoggedIn() {
        Mage::getSingleton('core/session')
                ->setData('auction_backurl', $this->getProduct()->getProductUrl());
        return Mage::getSingleton('customer/session')->isLoggedIn();
    }

    /**
     * @return bool|void
     */
    public function requiredBidderName() {
        $biddertype = (int) Mage::getStoreConfig('auction/general/bidder_name_type');
        if ($biddertype == 2 || $biddertype == 3) {
            $customer = Mage::getSingleton('customer/session')->getCustomer();
            if (!$customer->getBidderName()) {
                if($biddertype==3){
                    if ($biddertype == 3) {
                    try {
                        $customer->setBidderName($customer->getName())
                                ->save();
                        return false;
                    } catch (Exception $e) {
                        return;
                    }
                }
                }
                Mage::getSingleton('core/session')
                        ->setData('auction_backurl', $this->getProduct()->getProductUrl());
                return true;
            }
        } elseif ((int) Mage::getStoreConfig('auction/general/bidder_name_type') == 3) {
            //$customer = Mage::getSingleton('customer/session')->getCustomer();
        }
        return false;
    }

    public function addToTopLink() {
        if (Mage::helper('auction')->getBidderStatus()) {
            $topBlock = $this->getParentBlock();
            if ($topBlock) {
                $topBlock->addLink($this->__('Auction'), 'auction/index', 'auctionsystem', true, array(), 10
                );
            }
        }
    }

    public function addAuctionJs() {
        if (Mage::helper('auction')->getBidderStatus()) {
            $headBlock = $this->getParentBlock();
            if ($headBlock) {
                $headBlock->addJs('magestore/auction.js');
                $headBlock->addJs('magestore/auction210.js');
            }
        }
    }

    public function addAuctionCss() {
        if (Mage::helper('auction')->getBidderStatus()) {
            $headBlock = $this->getParentBlock();
            if ($headBlock) {
                $headBlock->addCss('css/magestore/auction.css');
                $headBlock->addCss('css/magestore/custom.css');
            }
        }
    }

    /**
     * @return bool
     */
    public function isWatcher() {
        $customerId = Mage::getSingleton('customer/session')->getCustomerId();
        $auction = $this->getAuction();
        $watcher = Mage::getModel('auction/watcher')->getCollection()
                ->addFieldToFilter('customer_id', $customerId)
                ->addFieldToFilter('productauction_id', $auction->getProductauctionId())
                ->addFieldToFilter('status', 1);
        if (count($watcher))
            return true;
        else
            return false;
    }

    /**
     * @return mixed
     */
    public function getWinners() {
        if (!$this->hasData('winners')) {
            $winners = Mage::helper('auction')->getWinnerBids($this->getAuction()->getId());
            $this->setData('winners', $winners);
        }
        return $this->getData('winners');
    }

    /**
     * @param $auctionId
     * @return string
     */
    public function getWinnerList($auctionId) {
        $listWinner = '';
        $winnerBids = $this->getWinners();
        if (count($winnerBids)) {
            $i = 0;
            foreach ($winnerBids as $winnerBid) {
                $i++;
                $listWinner .= $winnerBid->getBidderName();
                if ($i != count($winnerBids))
                    $listWinner .= ', ';
            }
        }else {
            $listWinner = 'None';
        }
        return $listWinner;
    }

    /**
     * @return bool
     */
    public function isWinner() {
        if (Mage::getSingleton('customer/session')->isLoggedIn()) {
            $customer = Mage::getSingleton('customer/session')->getCustomer();
            $winners = $this->getWinners();
            if (count($winners)) {
                foreach ($winners as $winner) {
                    if ($customer->getId() == $winner->getCustomerId())
                        return true;
                }
            }
        }
        return false;
    }

    /**
     * @return mixed
     */
    public function getWonMessage() {
        return Mage::getStoreConfig('auction/general/won_message', Mage::app()->getStore()->getId());
    }

    /**
     * @return mixed
     */
    public function getWatchUrl() {
        return $this->getUrl('auction/index/changewatcher', array('product_id' => $this->getProduct()->getId(), 'is_watcher' => 1));
    }

    /**
     * @return mixed
     */
    public function getUnWatchUrl() {
        return $this->getUrl('auction/index/changewatcher', array('product_id' => $this->getProduct()->getId(), 'is_watcher' => 2));
    }

    /**
     * @return mixed
     */
    public function getLoginUrl() {
        return $this->getUrl('customer/account/login');
    }

    /**
     * @return mixed
     */
    public function getCheckoutUrl() {
        $lastBid = Mage::getResourceModel('auction/auction_collection')
                ->addFieldToFilter('productauction_id', $this->getAuction()->getId())
                ->addFieldToFilter('customer_id', Mage::getSingleton('customer/session')->getCustomerId())
                ->addFieldToFilter('status', 5)
                ->setOrder('auctionbid_id', 'DESC')
                ->getFirstItem();
        return $this->getUrl('auction/index/checkout', array('id' => $lastBid->getId()));
    }

}
