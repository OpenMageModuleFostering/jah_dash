<?php

class Magjah_Customship_Block_Adminhtml_Ship_Shipmain extends Mage_Adminhtml_Block_Template
{
    public function __construct()
    {
        $this->_headerText = Mage::helper('magjah_customship')->__('Rules');
        parent::__construct();
        $this->setTemplate('magjah/ship/shipmain.phtml');
    }

    public function _beforeToHtml()
    {
      /*  $this->setChild('gridcustomer', $this->getLayout()->createBlock('magjah_dash/adminhtml_dash_dashmain_gridcustomer', 'dash.gridcustomer'));
        $this->setChild('gridorder', $this->getLayout()->createBlock('magjah_dash/adminhtml_dash_dashmain_gridorder', 'dash.gridorder'));
        $this->setChild('gridproduct', $this->getLayout()->createBlock('magjah_dash/adminhtml_dash_dashmain_gridproduct', 'dash.gridproduct'));
        if (Mage::getStoreConfig(self::XML_PATH_ENABLE_CHARTS)) {
            $block = $this->getLayout()->createBlock('magjah_dash/adminhtml_dash_dashmain_diagrams');
        } else {
            $block = $this->getLayout()->createBlock('adminhtml/template')
                ->setTemplate('dashboard/graph/disabled.phtml')
                ->setConfigUrl($this->getUrl('adminhtml/system_config/edit', array('section'=>'admin')));
        }
        $this->setChild('diagrams', $block);
        return $this;*/
    }

    public function getTotal(){
        $collection = Mage::getSingleton('magjah_customship/shiprules')->getCollection();
        return $collection->count();
    }
}
