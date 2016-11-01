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

class Magestore_Auction_Model_Mysql4_Email_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('auction/email');
    }
    
    public function getAllCustomerIds(){
    	   $idsSelect = clone $this->getSelect();
     	   $idsSelect->reset(Zend_Db_Select::ORDER);
    	   $idsSelect->reset(Zend_Db_Select::LIMIT_COUNT);
    	   $idsSelect->reset(Zend_Db_Select::LIMIT_OFFSET);
   	   $idsSelect->reset(Zend_Db_Select::COLUMNS);
    	   $idsSelect->columns('main_table.customer_id');
   	   $idsSelect->resetJoinLeft();
     	   return $this->getConnection()->fetchCol($idsSelect);
	}
}