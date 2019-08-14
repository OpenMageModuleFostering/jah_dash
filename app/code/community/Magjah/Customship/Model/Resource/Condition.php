<?php
class Magjah_Customship_Model_Resource_Condition extends Mage_Core_Model_Abstract
{

    public function toOptionArray()
    {
        return array(
            array('value'=>0, 'label'=>Mage::helper('magjah_customship')->__('Weight vs. Destination')),
            array('value'=>1, 'label'=>Mage::helper('magjah_customship')->__('Price vs. Destination')),
            array('value'=>2, 'label'=>Mage::helper('magjah_customship')->__('Price and Weight vs. Destination')),
            array('value'=>3, 'label'=>Mage::helper('magjah_customship')->__('Number of Items vs. Destination')),
        );
    }

}