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

class Magestore_Auction_Block_Adminhtml_Auction_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Magestore_Auction_Block_Adminhtml_Auction_Edit constructor.
     */
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'auction';
        $this->_controller = 'adminhtml_auction';
        
        $this->_removeButton('save');
        $this->_removeButton('reset');
        $this->_removeButton('delete');
        $this->_removeButton('back');
       // $this->_updateButton('delete', 'label', Mage::helper('auction')->__('Delete Item'));
		
		$bid = Mage::registry('auction_data');
		
		$this->_addButton('_back', array(
				'label'     => Mage::helper('adminhtml')->__('Back'),
				'onclick'   => 'location.href=\''. $this->getUrl('*/adminhtml_productauction/edit',array('id'=>$bid->getProductauctionId())) .'\'',
				'class'     => 'back',
			), 1);			   
	   
        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('auction_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'auction_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'auction_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    /**
     * @return mixed
     */
    public function getHeaderText()
    {
         return Mage::helper('auction')->__('Bid Information');
    }
}