<?php

namespace Patient\Controller;


use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\ViewModel;
use Zend\Json\Json;

use Application\Controller\Helpers\MessageConstants AS MC;

class IndexController extends AbstractRestfulController
{
    public function getList()
    {
        $allList = $this->getServiceLocator()->get('Patient\Controller\Helpers\Patient');
        $patientForm = $this->getServiceLocator()->get('Patient\Form\Patient');
        $patientForm->form->setAttribute('action',$this->url()->fromRoute('email'));
        $result = $allList->getAllList();
        if($result){
            $view = new ViewModel(array('patientList' => json_decode($result, TRUE), 'patientForm' => $patientForm->form));
            $view->setTemplate('patient/index/get-list');
            return $view;
        }
    }

    public function get($id)
    {
        $allList = $this->getServiceLocator()->get('Patient\Controller\Helpers\Patient');
        $result = $allList->getPatientId($id);
        if($result){
            var_dump($result);exit;
        }
    }

    public function create($data)
    {

    }

    public function update($id, $data)
    {
        # code...
    }

    public function delete($id)
    {
        # code...
    }

}
