<?php

/**
 * Adminhtml grid block
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 */
class Magjah_Dash_Block_Adminhtml_Dash_Dashmain_Gridproduct_Item extends Mage_Core_Block_Template
{
    /**
     * Current item instance
     *
     */
    protected $_item;

    function __construct()
    {
        parent::__construct();
        $this->setTemplate('dash/dashmain/gridproduct/item.phtml');
    }

    public function _beforeToHtml()
    {
        $this->setChild('gridproduct_media', $this->getLayout()->createBlock('magjah_dash/adminhtml_dash_dashmain_gridproduct_media', 'dash.gridproduct_media'));

        return $this;
    }

    /**
     * Retrieve current order model instance
     *
     * @return Mage_Catalog_Model_Product
     */
    public function getProduct()
    {
        return Mage::registry('current_product');
    }

    public function getSource()
    {
        return $this->getCostumer();
    }

    public function getCategories($product = null)
    {
        if (!$product) {
            $product = $this->getProduct();
        }
        $cats = $product->getCategoryIds();
        $catText = array();
        foreach ($cats as $category_id) {
            $_cat = Mage::getModel('catalog/category')->load($category_id);
            $catText[] = $_cat->getName();
        }
        return implode(', ', $catText);
    }

}

