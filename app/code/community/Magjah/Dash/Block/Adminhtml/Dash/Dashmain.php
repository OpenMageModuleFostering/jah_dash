<?php

class Magjah_Dash_Block_Adminhtml_Dash_Dashmain extends Mage_Adminhtml_Block_Template
{
    const XML_PATH_ENABLE_CHARTS = 'admin/dashboard/enable_charts';
    public function __construct()
    {
        $this->_headerText = Mage::helper('magjah_dash')->__('Customer, Orders, Products');
        parent::__construct();
        $this->setTemplate('dash/dashmain.phtml');
    }

    public function _beforeToHtml()
    {
        $this->setChild('gridcustomer', $this->getLayout()->createBlock('magjah_dash/adminhtml_dash_dashmain_gridcustomer', 'dash.gridcustomer'));
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
        return $this;
    }

    function bestSellers()
    {
        $storeId = (int) Mage::app()->getStore()->getId();
        // Date
        $date = new Zend_Date();
        $toDate = $date->setDay(1)->getDate()->get('Y-MM-dd');
        $fromDate = $date->subMonth(24)->getDate()->get('Y-MM-dd');

        $collection = Mage::getResourceModel('catalog/product_collection')
            ->addAttributeToSelect(Mage::getSingleton('catalog/config')->getProductAttributes())
            ->addStoreFilter()
            ->addUrlRewrite()
            ->setPageSize(5);

        $collection->getSelect()
            ->joinLeft(
                array('aggregation' => $collection->getResource()->getTable('sales/bestsellers_aggregated_monthly')),
                "e.entity_id = aggregation.product_id AND aggregation.store_id={$storeId} AND aggregation.period BETWEEN '{$fromDate}' AND '{$toDate}'",
                array('SUM(aggregation.qty_ordered) AS sold_quantity')
            )
            ->group('e.entity_id')
            ->order(array('sold_quantity DESC', 'e.created_at'));
        return $collection;
    }

    function bestCustomersOrder()
    {
        $collection = Mage::getResourceModel('reports/report_collection');

        $date = new Zend_Date(mktime(0, 0, 0, 1, 1, 2001));
        $data['report_from'] = $date->toString($this->getLocale()->getDateFormat('short'));
        $date = new Zend_Date();
        $data['report_to'] = $date->toString($this->getLocale()->getDateFormat('short'));
        $collection->setPeriod($this->getFilter('report_period'));
        $from = $this->getLocale()->date($data['report_from'], Zend_Date::DATE_SHORT, null, false);
        $to = $this->getLocale()->date($data['report_to'], Zend_Date::DATE_SHORT, null, false);
        $collection->setInterval($from, $to);

        $storeIds = array_values(array_keys(Mage::app()->getStores()));
        $collection->setStoreIds($storeIds);

        $collection->setPageSize(4);
        $collection->initReport('reports/customer_orders_collection');
        return $collection;
    }
    /**
     * Retrieve locale
     *
     * @return Mage_Core_Model_Locale
     */
    public function getLocale()
    {
        if (!$this->_locale) {
            $this->_locale = Mage::app()->getLocale();
        }
        return $this->_locale;
    }
}
