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

class Magestore_Auction_Model_Notice extends Varien_Object
{

    /**
     * @param null $msg
     * @return string
     */
    public function getNoticeSuccess($msg=null)
	{
		$msg = $msg ? $msg : Mage::helper('auction')->__('You have placed a bid successfully.') ;
		
		return '<input type="hidden" id="notice_success" value="'.$msg.'"/>';
	}

    /**
     * @param null $msg
     * @return string
     */
    public function getNoticeError($msg=null)
	{
		$msg = $msg ? $msg : Mage::helper('auction')->__('An error occur, try bid again please') ;
		
		return '<input type="hidden" id="notice_error" value="'.$msg.'"/>';
	}
}