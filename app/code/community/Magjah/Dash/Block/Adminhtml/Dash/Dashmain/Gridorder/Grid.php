<?php

class Magjah_Dash_Block_Adminhtml_Dash_Dashmain_Gridorder_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('orderGrid');
        $this->setDefaultSort('increment_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel('sales/order_collection')
            ->addExpressionFieldToSelect(
                'fullname',
                'CONCAT({{customer_firstname}}, \' \', {{customer_lastname}})',
                array('customer_firstname' => 'main_table.customer_firstname', 'customer_lastname' => 'main_table.customer_lastname'))
            ->addExpressionFieldToSelect(
                'products',
                '(SELECT GROUP_CONCAT(\' \', x.name)
                    FROM sales_flat_order_item x
                    WHERE {{entity_id}} = x.order_id
                        AND x.product_type != \'configurable\')',
                array('entity_id' => 'main_table.entity_id')
            );

        $this->setCollection($collection);
        parent::_prepareCollection();
        return $this;
    }

    protected function _prepareColumns()
    {
        $helper = Mage::helper('magjah_dash');
        $currency = (string)Mage::getStoreConfig(Mage_Directory_Model_Currency::XML_PATH_CURRENCY_BASE);

        $this->addColumn('increment_id', array(
            'header' => $helper->__('Order #'),
            'index' => 'increment_id'
        ));

        $this->addColumn('products', array(
            'header' => $helper->__('Products Purchased'),
            'index' => 'products',
            'filter_index' => '(SELECT GROUP_CONCAT(\' \', x.name) FROM sales_flat_order_item x WHERE main_table.entity_id = x.order_id AND x.product_type != \'configurable\')'
        ));

        $this->addColumn('fullname', array(
            'header' => $helper->__('Name'),
            'index' => 'fullname',
            'filter_index' => 'CONCAT(customer_firstname, \' \', customer_lastname)'
        ));


        $this->addColumn('grand_total', array(
            'header' => $helper->__('Grand Total'),
            'index' => 'grand_total',
            'type' => 'currency',
            'currency_code' => $currency
        ));

        $this->addColumn('order_status', array(
            'header' => $helper->__('Status'),
            'index' => 'status',
            'type' => 'options',
            'options' => Mage::getSingleton('sales/order_config')->getStatuses(),
        ));
        $this->addColumn('Show button', array(
            'width'     => '8%',
            'align'     => 'center',
            'header'    => $helper->__('Show'),
            'getter'    => 'getId',
            'renderer'  => 'Magjah_Dash_Block_Adminhtml_Dash_Dashmain_Gridorder_Render_Showbutton',
            'type'      => 'action',
            'filter'    => false,
            'sortable'  => false,
            'index'     => 'stores',
            'is_system' => true,

        ));

        return parent::_prepareColumns();
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/gridorder', array('_current'=> true));
    }
}