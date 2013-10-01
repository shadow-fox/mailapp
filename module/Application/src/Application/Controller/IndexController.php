<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container AS SessionContainer;

class IndexController extends AbstractActionController {

	public function indexAction() {
        $this->redirect()->toRoute('patient');
    }
}