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
 * @package     Mage_Reports
 * @copyright   Copyright (c) 2012 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */


/**
 * Reports orders collection
 *
 * @category    Mage
 * @package     Mage_Reports
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Magjah_Dash_Model_Resource_Order_Collection extends Mage_Reports_Model_Resource_Order_Collection
{
    function groupByDay()
    {
        $rangeDay = 4;
        $rangeText = '';
        $cont = 0;
        $tmpV = null;

        foreach ($this->_items as $k => $v) {
            $date = DateTime::createFromFormat('Y-m-d', $v->getRange());
            if ($rangeDay >= $date->format('d')) {
                if ($rangeText == '')
                    $rangeText = $v->getRange();
                $cont += $v->getQuantity();
                unset($this->_items[$k]);
            } elseif ($rangeText) {
                if ($rangeText != $tmpV->getRange())
                    $rangeText .= ' to ' . $tmpV->getRange();
                $result = clone $v;
                $result->setQuantity($cont);
                $result->setRange($rangeText);
                $this->_items[$k] = $result;
                do {
                    $rangeDay += 4;
                } while ($rangeDay < $date->format('d'));
                $rangeText = $v->getRange();
                $cont = $v->getQuantity();
            } else {
                $rangeText = $v->getRange();
                $cont += $v->getQuantity();
                unset($this->_items[$k]);
            }

            $tmpV = $v;
        }
        if ($rangeText != $tmpV->getRange())
            $rangeText .= ' to ' . $tmpV->getRange();
        $result = clone $v;
        $result->setQuantity($cont);
        $result->setRange($rangeText);
        $this->_items[$k+1] = $result;
    }
}
