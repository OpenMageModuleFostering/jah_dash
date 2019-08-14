<?php
class Magjah_Customship_Model_Resource_Shiprules extends Mage_Core_Model_Resource_Db_Abstract
{
    public function _construct()
    {
        $this->_init('magjah_customship/customship', 'id');
    }
}