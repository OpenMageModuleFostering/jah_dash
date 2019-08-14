<?php

class Magjah_Dash_Block_Adminhtml_Dash_Dashmain_Gridcustomer_Render_Orders extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{

    public function render(Varien_Object $row)
    {
        $_orders = Mage::getModel('sales/order')->getCollection()->addFieldToFilter('customer_id',$row->getId());
        $_orderCnt = $_orders->count();
        return "<button title='Show Orders' onclick=\"showUrlDetails('". $this->getUrl('*/*/customerOrders', array('_current'=> true,'id'=>$row->getId() ))."');\">" . $_orderCnt. "</button>";

    }

}

?>