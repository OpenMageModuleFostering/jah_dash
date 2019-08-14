<?php

class Magjah_Dash_Block_Adminhtml_Dash_Dashmain_Gridcustomer_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('customerGrid');
        $this->setUseAjax(true);
        $this->setDefaultSort('entity_id');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel('customer/customer_collection')
            ->addNameToSelect()
            ->addAttributeToSelect('is_active')
            ->addAttributeToSelect('email')
            ->addAttributeToSelect('created_at')
            ->addAttributeToSelect('group_id')
            ->joinAttribute('billing_telephone', 'customer_address/telephone', 'default_billing', null, 'left')
        ;


        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $helper = Mage::helper('magjah_dash');
        $this->addColumn('entity_id', array(
            'header' => $helper->__('ID'),
            'width' => '5%',
            'index' => 'entity_id',
            'type' => 'number',
            'filter' => false
        ));
        $this->addColumn('name', array(
            'header' => $helper->__('Name'),
            'index' => 'name'
        ));
        $this->addColumn('email', array(
            'header' => $helper->__('Email'),
            'width' => '150',
            'index' => 'email'
        ));

        $this->addColumn('Telephone', array(
            'header' => $helper->__('Telephone'),
            'width' => '100',
            'index' => 'billing_telephone'
        ));


        $this->addColumn('Show button', array(
            'width' => '8%',
            'align' => 'center',
            'header' => $helper->__('Show'),
            'getter' => 'getId',
            'renderer' => 'Magjah_Dash_Block_Adminhtml_Dash_Dashmain_Gridcustomer_Render_Showbutton',
            'type' => 'action',
            'filter' => false,
            'sortable' => false,
            'index' => 'stores',
            'is_system' => true,

        ));
        $this->addColumn('Orders', array(
            'width' => '8%',
            'align' => 'center',
            'header' => $helper->__('Order'),
            'getter' => 'getId',
            'renderer' => 'Magjah_Dash_Block_Adminhtml_Dash_Dashmain_Gridcustomer_Render_Orders',
            'type' => 'action',
            'filter' => false,
            'sortable' => false,
            'index' => 'stores',
            'is_system' => true,

        ));
        return parent::_prepareColumns();
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/gridcustomer', array('_current' => true));
    }


}