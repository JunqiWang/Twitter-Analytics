<?php

class IndexController extends Zend_Controller_Action
{

    public function indexAction()
    {
        $this->_helper->layout()->disableLayout(); 
        $this->_helper->viewRenderer->setNoRender(true);
        echo "Dynamos,0000-0000-0000\n2000-00-00 00:00:00";
    }
}
