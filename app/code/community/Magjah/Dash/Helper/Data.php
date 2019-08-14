<?php
/**
 * Created by PhpStorm.
 * User: jhernandez
 * Date: 8/25/14
 * Time: 6:29 PM
 */


class Magjah_Dash_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Prepare array with periods for dashboard graphs
     *
     * @return array
     */
    public function getDatePeriods()
    {
        return array(
            '7d'  => $this->__('Last 7 Days'),
            '1m'  => $this->__('Current Month'),
            '1y'  => $this->__('YTD'),
            '2y'  => $this->__('2YTD')
        );
    }
}