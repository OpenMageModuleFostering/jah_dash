<?php

/**
 * Created by PhpStorm.
 * User: jhernandez
 * Date: 8/25/14
 * Time: 6:22 PM
 */
class Magjah_Dash_Adminhtml_DashBoard_IndexController extends Mage_Adminhtml_Controller_Action
{
    protected $allcodes = array(
        '0' => 'sales/report_order',
        '1' => 'sales/report_bestsellers',
    );
    /* protected function _construct()
     {
         $this->setUsedModuleName('Magjah_Dash');
         parent
     }*/



    public function indexAction()
    {
        try {
            foreach ($this->allcodes as $collectionName) {
                Mage::getResourceModel($collectionName)->aggregate();
            }
        } catch (Mage_Core_Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Unable to refresh lifetime statistics.'));
            Mage::logException($e);
        }
        $this->_title($this->__('Dash'))
            ->_title($this->__('Customer Orders Product'));
        $this->loadLayout();
        $this->_setActiveMenu('magjah/dash');
        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true)
            ->setContainerCssClass('sales-orderfraud');

        $this->_addContent(
            $this->getLayout()->createBlock('magjah_dash/adminhtml_dash_dashmain')
        );
        $this->renderLayout();
    }

    public function gridcustomerAction()
    {
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('magjah_dash/adminhtml_dash_dashmain_gridcustomer_grid')->toHtml()
        );
    }

    public function orderAction()
    {
        $this->_initOrder();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('magjah_dash/adminhtml_dash_dashmain_gridorder_item')->toHtml()
        )->setHeader('Content-type', ' text/html')->setHttpResponseCode(200);
    }

    public function customerAction()
    {
        $this->_initCustomer();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('magjah_dash/adminhtml_dash_dashmain_gridcustomer_item')->toHtml()
        )->setHeader('Content-type', ' text/html')->setHttpResponseCode(200);
    }

    public function customerOrdersAction()
    {
        $this->_initCustomer();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('magjah_dash/adminhtml_dash_dashmain_gridcustomer_orders')->toHtml()
        )->setHeader('Content-type', ' text/html')->setHttpResponseCode(200);
    }

    public function productAction()
    {
        $this->_initProduct();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('magjah_dash/adminhtml_dash_dashmain_gridproduct_item')->toHtml()
        )->setHeader('Content-type', ' text/html')->setHttpResponseCode(200);
    }

    /**
     * Initialize order model instance
     *
     * @return Mage_Sales_Model_Order || false
     */
    protected function _initOrder()
    {
        $id = $this->getRequest()->getParam('id');
        $order = Mage::getModel('sales/order')->load($id);

        Mage::register('sales_order', $order);
        Mage::register('current_order', $order);
        return $order;
    }

    protected function _initCustomer($idFieldName = 'id')
    {

        $customerId = (int)$this->getRequest()->getParam($idFieldName);
        $customer = Mage::getModel('customer/customer');

        if ($customerId) {
            $customer->load($customerId);
        }

        Mage::register('current_customer', $customer);
        return $this;
    }

    protected function _initProduct($idFieldName = 'id')
    {
        $productId = (int)$this->getRequest()->getParam($idFieldName);
        $product = Mage::getModel('catalog/product');

        if ($productId) {
            $product->load($productId);
        }

        Mage::register('current_product', $product);
        Mage::register('product', $product);
        return $this;
    }

    public function ajaxBlockAction()
    {
        $output = '';
        $blockTab = $this->getRequest()->getParam('block');
        if (in_array($blockTab, array('tab_orders', 'tab_amounts', 'tab_products', 'tab_customers','tab_customersorders','tab_productsorders'))) {
            $output = $this->getLayout()->createBlock('magjah_dash/adminhtml_dash_dashmain_' . $blockTab)->toHtml();
        }
        $this->getResponse()->setBody($output);
        return;
    }

    public function gridorderAction()
    {
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('magjah_dash/adminhtml_dash_dashmain_gridorder_grid')->toHtml()
        );
    }

    public function gridproductAction()
    {
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('magjah_dash/adminhtml_dash_dashmain_gridproduct_grid')->toHtml()
        );
    }

    /**
     * Check the permission to run it
     *
     * @return boolean
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('magjah_dash/dash');
    }

}

?>