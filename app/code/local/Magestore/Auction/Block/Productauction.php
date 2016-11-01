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

class Magestore_Auction_Block_Productauction extends Mage_Core_Block_Template
{
    /**
     * @return mixed
     */
    public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }

    /**
     * @return mixed
     */
    public function getProductauction()
     { 
        if (!$this->hasData('productauction_data')) {
            $this->setData('productauction_data', Mage::registry('productauction_data'));
        }
        return $this->getData('productauction_data');
    }

    /**
     * @return mixed
     */
    public function getListProductBid()
	{
        if (!$this->hasData('listBid'))
		{
			$auction_id = $this->getRequest()->getParam('id');
			$curr_page = $this->getRequest()->getParam('page');
			$curr_page = $curr_page ? $curr_page : 1;
		
			$collection = Mage::getModel('auction/productauction')->setId($auction_id)
							->getListBid();
							
			$collection->setPageSize(10);
		
			$collection->setCurPage($curr_page);							
			
            $this->setData('listBid', $collection);
        }
        
		return $this->getData('listBid');		
	}

    /**
     * @return mixed
     */
    public function getTotalBid()
	{
		return $this->getProductauction()->getTotalBid();
	}

    /**
     * @return mixed
     */
    public function getTotalBidder()
	{			
		return $this->getProductauction()->getTotalBidder();
	}

    /**
     * @return mixed
     */
    public function getTimeleft()
	{
		$auction = $this->getProductauction();
		
		return $auction->getTimeleft();	
	}

    /**
     * @return mixed
     */
    public function getBackUrl()
	{
		$auction = $this->getProductauction();
		
		$url = Mage::getModel('catalog/product')->load($auction->getProductId())
				->getProductUrl();
		
		return $url;
	}

    /**
     * @return string
     */
    public function getNavHtml()
	{
		$auction_id = $this->getRequest()->getParam('id');
		$curr_page = $this->getRequest()->getParam('page');
		$curr_page = $curr_page ? $curr_page : 1;
		
		$collection = Mage::getModel('auction/productauction')->setId($auction_id)
							->getListBid();
		$collection->setPageSize(10);

		$last_page = $collection->getLastPageNumber();
		
		$html = '';
		
		if($last_page >1)
		{
			$html .= '<div class="auction-nav">'. $this->__('Pages') .' ';
					
			for($i=1;$i<= $last_page;$i++)
			{
				if($i != $curr_page)
					$html .= '<a href="'. $this->getUrl('auction/index/viewbids',array('id'=>$auction_id,'page'=>$i)) .'" >'. $i .'</a>';
				else
					$html .= '<span class="ative" >'. $i .'</span>';
			}
			
			$html .= '</div>';
		}
		
		
		return $html;
	}	
}