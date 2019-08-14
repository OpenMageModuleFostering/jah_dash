<?php

class Magjah_Dash_Block_Adminhtml_Dash_Dashmain_Gridproduct_Grid extends Mage_Adminhtml_Block_Catalog_Product_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('productGrid');
        $this->setDefaultSort('increment_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    protected function _prepareColumns()
    {
        $this->addColumn('entity_id',
            array(
                'header' => Mage::helper('catalog')->__('ID'),
                'width' => '50px',
                'type' => 'number',
                'index' => 'entity_id',
                'filter' => false
            ));
        $this->addColumn('name',
            array(
                'header' => Mage::helper('catalog')->__('Name'),
                'index' => 'name',
            ));

        $store = $this->_getStore();
        if ($store->getId()) {
            $this->addColumn('custom_name',
                array(
                    'header' => Mage::helper('catalog')->__('Name in %s', $store->getName()),
                    'index' => 'custom_name',
                ));
        }

        $this->addColumn('sku',
            array(
                'header' => Mage::helper('catalog')->__('SKU'),
                'width' => '80px',
                'index' => 'sku',
            ));

        $store = $this->_getStore();
        $this->addColumn('price',
            array(
                'header' => Mage::helper('catalog')->__('Price'),
                'type' => 'price',
                'currency_code' => $store->getBaseCurrency()->getCode(),
                'index' => 'price',
            ));

        if (Mage::helper('catalog')->isModuleEnabled('Mage_CatalogInventory')) {
            $this->addColumn('qty',
                array(
                    'header' => Mage::helper('catalog')->__('Qty'),
                    'width' => '100px',
                    'type' => 'number',
                    'index' => 'qty',
                ));
        }


        $this->addColumn('status',
            array(
                'header' => Mage::helper('catalog')->__('Status'),
                'width' => '70px',
                'index' => 'status',
                'type' => 'options',
                'options' => Mage::getSingleton('catalog/product_status')->getOptionArray(),
            ));

        $this->addColumn('Show button', array(
            'width' => '8%',
            'align' => 'center',
            'header' => Mage::helper('catalog')->__('Show'),
            'getter' => 'getId',
            'renderer' => 'Magjah_Dash_Block_Adminhtml_Dash_Dashmain_Gridproduct_Render_Showbutton',
            'type' => 'action',
            'filter' => false,
            'sortable' => false,
            'index' => 'stores',
            'is_system' => true,

        ));

        $this->sortColumnsByOrder();
        return $this;
    }

    /**
     * Prepare grid massaction actions
     *
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareMassaction()
    {
        return $this;
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/gridproduct', array('_current' => true));
    }

    /**
     * Return row url for js event handlers
     *
     * @param Mage_Catalog_Model_Product|Varien_Object
     * @return string
     */
    public function getRowUrl($item)
    {
        return '#';
    }
}