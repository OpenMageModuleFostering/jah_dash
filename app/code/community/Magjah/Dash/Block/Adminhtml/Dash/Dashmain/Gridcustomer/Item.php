<?php

/**
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 */
class Magjah_Dash_Block_Adminhtml_Dash_Dashmain_Gridcustomer_Item extends Mage_Core_Block_Template
{
    /**
     * Current item instance
     *
     */
    protected $_item;

    function __construct()
    {
        parent::__construct();
        $this->setTemplate('dash/dashmain/gridcustomer/item.phtml');
    }

    public function _beforeToHtml()
    {
        $this->setChild('customer_edit_tab_view', $this->getLayout()->createBlock('adminhtml/customer_edit_tab_view', 'dash.customer_edit_tab_view')->setTemplate('customer/tab/view.phtml'));
        $this->setChild('customer_edit_tab_view_sales', $this->getLayout()->createBlock('adminhtml/customer_edit_tab_view_sales', 'dash.customer_edit_tab_view_sales')->setTemplate('customer/tab/view/sales.phtml'));
        $this->setChild('dash_dashmain_gridcustomer_accordion', $this->getLayout()->createBlock('magjah_dash/adminhtml_dash_dashmain_gridcustomer_accordion', 'dash.dash_dashmain_gridcustomer_accordion'));

        return $this;
    }

    /**
     * Retrieve current order model instance
     *
     * @return Mage_Customer_Model_Customer
     */
    public function getCustomer()
    {
        return Mage::registry('current_customer');
    }

    public function getSource()
    {
        return $this->getCostumer();
    }
}

