<?php

/**
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 */
class Magjah_Dash_Block_Adminhtml_Dash_Dashmain_Gridorder_Item extends Mage_Core_Block_Template
{
    /**
     * Current item instance
     *
     */
    protected $_item;

    function __construct()
    {
        parent::__construct();
        $this->setTemplate('dash/dashmain/gridorder/item.phtml');
    }
    public function _beforeToHtml()
    {
        $this->setChild('order_totals', $this->getLayout()->createBlock('adminhtml/sales_order_totals', 'dash.order_totals')->setTemplate('sales/order/totals.phtml'));

        return $this;
    }
    /**
     * Retrieve current order model instance
     *
     * @return Mage_Sales_Model_Order
     */
    public function getOrder()
    {
        return Mage::registry('current_order');
    }
    public function getPaymentHtml($order)
    {
        $this->setData('order', $order);

        return $this->getChildHtml('payment_info');
    }
    public function getViewUrl($orderId)
    {
        return $this->getUrl('adminhtml/sales_order/view', array('_current'=>true, 'order_id' => $orderId));
    }
    public function getProccedUrl()
    {
        return $this->getUrl('adminhtml/sales_orderfraud/proceed', array('_current'=>true));
    }
    public function getItemsHtml()
    {
        return $this->getChildHtml('order_items');
    }

    public function displayPriceAttribute($code, $order) {
        $this->setData('order', $order);
        return $this->displayPrices(
            $this->getPriceDataObject()->getData('base_'.$code),
            $this->getPriceDataObject()->getData($code)
        );

    }
    public function displayPrices($basePrice, $price, $strong = false, $separator = '<br/>')
    {
        if ($this->getOrder()->isCurrencyDifferent()) {
            $res = '<strong>';
            $res.= $this->getOrder()->formatBasePrice($basePrice);
            $res.= '</strong>'.$separator;
            $res.= '['.$this->getOrder()->formatPrice($price).']';
        }
        else {
            $res = $this->getOrder()->formatPrice($price);
            if ($strong) {
                $res = '<strong>'.$res.'</strong>';
            }
        }
        return $res;
    }

    public function getTotalBLock($order)
    {
        $this->setData('order', $order);
        $totalsBlock = $this->getLayout()->getBlock('dash.order_totals');
        $totalsBlock->setCacheKey(time().$order->getId());
        $totalsBlock->setOrder($order);
        $totalsBlock->setPriceDataObject($this->getSource());
        $totalsBlock->_beforeToHtml();
        $totalsBlock->setParentBlock($this);
        return $totalsBlock;
    }
    public function getSource()
    {
        return $this->getOrder();
    }
}

