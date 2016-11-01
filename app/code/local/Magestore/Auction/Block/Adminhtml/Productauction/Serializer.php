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

class Magestore_Auction_Block_Adminhtml_Productauction_Serializer
		extends Mage_Core_Block_Template
{
    /**
     * Magestore_Auction_Block_Adminhtml_Productauction_Serializer constructor.
     */
    public function __construct()
	{
		parent::__construct();
		$this->setTemplate('auction/serializer.phtml');
		return $this;
	}

    /**
     * @param $gridName
     * @param $hiddenInputName
     */
    public function initSerializerBlock($gridName, $hiddenInputName)
	{
		$grid = $this->getLayout()->getBlock($gridName);
        $this->setGridBlock($grid)
                 ->setInputElementName($hiddenInputName);
	}
}