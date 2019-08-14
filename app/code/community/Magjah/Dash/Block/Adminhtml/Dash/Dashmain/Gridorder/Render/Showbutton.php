<?php

class Magjah_Dash_Block_Adminhtml_Dash_Dashmain_Gridorder_Render_Showbutton extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render(Varien_Object $row) {
        $html = "<button title='Show' onclick=\"showUrlDetails('". $this->getUrl('*/*/order', array('_current'=> true,'id'=>$row->getId() ))."');\">" . Mage::helper('magjah_dash')->__('Show') . "</button>";
        return $html;
    }

}