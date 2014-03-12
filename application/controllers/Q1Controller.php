<?php

class Q1Controller extends Zend_Controller_Action
{

    public function indexAction()
    {
        $this->_helper->layout()->disableLayout(); 
        $this->_helper->viewRenderer->setNoRender(true);
        $date = (new Zend_Date())->toString("YYYY-MM-dd HH:mm:ss");
        echo "Dynamos,0000-0000-0000\n$date";
    }
}
