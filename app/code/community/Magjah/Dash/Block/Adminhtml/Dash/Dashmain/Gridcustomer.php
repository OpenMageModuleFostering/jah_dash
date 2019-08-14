<?php
/**
 * Created by PhpStorm.
 * User: jhernandez
 * Date: 8/25/14
 * Time: 6:49 PM
 */

class Magjah_Dash_Block_Adminhtml_Dash_Dashmain_Gridcustomer extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_dash_dashmain_gridcustomer';
        $this->_blockGroup = 'magjah_dash';
        $this->_headerText = '';
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