<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Adminhtml
 * @copyright   Copyright (c) 2012 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Adminhtml dashboard diagram tabs
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Magjah_Dash_Block_Adminhtml_Dash_Dashmain_Diagrams extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('diagram_tab');
        $this->setDestElementId('diagram_tab_content');
        $this->setTemplate('widget/tabshoriz.phtml');
    }

    protected function _prepareLayout()
    {
        $this->addTab('summary', array(
            'label' => $this->__('Summary'),
            'content' => $this->getLayout()->createBlock('magjah_dash/adminhtml_dash_dashmain_tab_summary')->toHtml(),
            'active' => true
        ));
        $this->addTab('orders', array(
            'label' => $this->__('Orders'),
            'content' => $this->getLayout()->createBlock('magjah_dash/adminhtml_dash_dashmain_tab_orders')->toHtml()
        ));

        $this->addTab('products', array(
            'label' => $this->__('Products'),
            'content' => $this->getLayout()->createBlock('magjah_dash/adminhtml_dash_dashmain_tab_products')->toHtml(),
        ));
        $this->addTab('customers', array(
            'label' => $this->__('Customers'),
            'content' => $this->getLayout()->createBlock('magjah_dash/adminhtml_dash_dashmain_tab_customers')->toHtml(),
        ));
        $this->addTab('customersorders', array(
            'label' => $this->__('Customers by orders'),
            'content' => $this->getLayout()->createBlock('magjah_dash/adminhtml_dash_dashmain_tab_customersorders')->toHtml(),
        ));
        return parent::_prepareLayout();
    }
}
