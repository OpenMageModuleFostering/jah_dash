<?php

/**
 * Created by PhpStorm.
 * User: jhernandez
 * Date: 10/20/14
 * Time: 11:20 AM
 */
class Magjah_Customship_Adminhtml_ShipController extends Mage_Adminhtml_Controller_Action
{

/*
index - Shows the grid.
edit - Shows the edit/new form.
save - Saves the form data.
delete - Deletes the model.
new - Forwards on to the edit action*/


    public function indexAction()
    {
        $this->_title($this->__('Shipping Rules'))
            ->_title($this->__('Admin Shipping Rules'));
        $this->loadLayout();
        $this->_setActiveMenu('magjah/ship');
        $this->_addContent(
            $this->getLayout()->createBlock('magjah_customship/adminhtml_ship_shipmain')
        );
        $this->renderLayout();
    }



}