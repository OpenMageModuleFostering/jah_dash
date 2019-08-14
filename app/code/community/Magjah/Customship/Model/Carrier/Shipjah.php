<?php

class Magjah_Customship_Model_Carrier_Shipjah extends Mage_Shipping_Model_Carrier_Abstract
    implements Mage_Shipping_Model_Carrier_Interface
{
    protected $_code = 'magjah_customship';

    public function getAllowedMethods()
    {
        return array(
            'free'        =>  'Free delivery',
            'standard'    =>  'Standard delivery',
            'special'     =>  'Special delivery',
        );
    }

    public function collectRates(Mage_Shipping_Model_Rate_Request $request)
    {
        if (!$this->getConfigData('active')) {
            Mage::log('The '.$this->_code.' shipping method is not active.');
            return false;
        }
        $result = Mage::getModel('shipping/rate_result');

       // $items = Mage::getModel('checkout/session')->getQuote()->getAllItems();
        $items = $request->getAllItems();
        $totals = 0;
        foreach ($items as $item) {
            $totals += $item->getQty();
        }

        if($this->getConfigData('free_shipping_enable') && $request->getPackageValue() >= $this->getConfigData('free_shipping_subtotal')){
            $result->append($this->_getFreeShip());
        }

       /* if ($totals >= $this->getConfigData('minimum_item_limit'))
            $result->append($this->_getSpecialRate());
        else
            $result->append($this->_getStandardRate());
        return $result;*/
    }



    protected  function _getFreeShip(){
        $method = Mage::getModel('shipping/rate_result_method');
        $code = 'free';
        $method->setCarrier($this->_code);
        $method->setCarrierTitle($this->getConfigData('title'));
        $method->setMethod($code);
        $method->setMethodTitle('Free Shipping');
        $method->setPrice(0.00);
        return $method;

    }

    protected function _getSpecialRate(){

        $method = Mage::getModel('shipping/rate_result_method');
        $code = 'special';
        $title = $this->getConfigData('over_minimum_title');
        $price = $this->getConfigData('over_minimum_price');
        $method->setCarrier($this->_code);
        $method->setCarrierTitle($this->getConfigData('title'));
        $method->setMethod($code);
        $method->setMethodTitle($title);
        $method->setPrice($price + $this->getConfigData('handling'));

        return $method;

    }


    protected function _getStandardRate(){

        $method = Mage::getModel('shipping/rate_result_method');
        $code = 'standard';
        $title = $this->getConfigData('under_minimum_title');
        $price = $this->getConfigData('under_minimum_price');
        $method->setCarrier($this->_code);
        $method->setCarrierTitle($this->getConfigData('title'));
        $method->setMethod($code);
        $method->setMethodTitle($title);
        $method->setPrice($price + $this->getConfigData('handling'));

        return $method;

    }

}