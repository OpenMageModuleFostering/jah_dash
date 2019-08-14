<?php

class Magjah_Customship_Model_Resource_Shiprules_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('magjah_customship/shiprules');
    }
}