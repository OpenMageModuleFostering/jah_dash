<?php

class Magjah_Dash_Block_Adminhtml_Dash_Dashmain_Gridproduct extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'magjah_dash';
        $this->_controller = 'adminhtml_dash_dashmain_gridproduct';
        $this->_headerText = Mage::helper('magjah_dash')->__('Product');

        parent::__construct();
        $this->_removeButton('add');

    }
    /**
     * Get header HTML
     *
     * @return string
     */
    public function getHeaderHtml()
    {
        return '';
    }
}