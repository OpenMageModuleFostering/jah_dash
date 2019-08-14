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
 * Adminhtml dashboard orders diagram
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author     Magento Core Team <core@magentocommerce.com>
 */
class Magjah_Dash_Block_Adminhtml_Dash_Dashmain_Tab_Summary extends Mage_Adminhtml_Block_Template
{
    /**
     * Initialize object
     *
     */

    public function __construct()
    {
        $this->setHtmlId('summary');
        parent::__construct();
        $this->setTemplate('dash/dashmain/summary.phtml');
    }

    public function getResumeCustomer()
    {
        $dataTotal = Mage::getResourceSingleton('magjah_dash/customer')->getTotalsByRange();
        $dateStart =  date("Y-m-d H:i:s",strtotime('6 days ago'));
        $dataWeek = Mage::getResourceSingleton('magjah_dash/customer')->getTotalsByRange($dateStart);
        $result['total'] = $dataTotal;
        $result['week'] = $dataWeek;
        $result['porcent'] = round($dataWeek * 100 / $dataTotal);
        return $result;
    }

    public function getResumeProduct()
    {
        $dataTotal = Mage::getResourceSingleton('magjah_dash/product')->getTotalsByRange();
        $dateStart =  date("Y-m-d H:i:s",strtotime('6 days ago'));
        $dataWeek = Mage::getResourceSingleton('magjah_dash/product')->getTotalsByRange($dateStart);
        $result['total'] = $dataTotal;
        $result['week'] = $dataWeek;
        $result['porcent'] = round($dataWeek * 100 / $dataTotal);
        return $result;
    }

    public function getResumeOrder()
    {
        $dataTotal = Mage::getResourceSingleton('magjah_dash/order')->getTotalsByRange();
        $dateStart =  date("Y-m-d H:i:s",strtotime('6 days ago'));
        $dataWeek = Mage::getResourceSingleton('magjah_dash/order')->getTotalsByRange($dateStart);
        $result['total'] = $dataTotal;
        $result['week'] = $dataWeek;
        $result['porcent'] = round($dataWeek * 100 / $dataTotal);
        return $result;
    }
}
