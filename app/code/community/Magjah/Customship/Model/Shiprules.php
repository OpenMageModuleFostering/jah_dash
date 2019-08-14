<?php
class Magjah_Customship_Model_Shiprules extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('magjah_customship/shiprules');
    }

}