<?php

namespace Patient\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Json\Json;

use Application\Controller\Helpers\MessageConstants AS MC;

class EmailController extends AbstractActionController
{
    public function indexAction() {
        if ($this->getServiceLocator()->get('request')->isPost())
        {
            $data = $this->getServiceLocator()->get('request')->getPost();
            //var_dump($data['check']);exit;
            if($data['check'] === NULL) {
                return $this->redirect()->toRoute('patient');exit;
            } else {
                $mailForm = $this->getServiceLocator()->get('Patient\Form\MailForm');
                $mailForm->form->setAttribute('action',$this->url()->fromRoute('send'));
                $allList = $this->getServiceLocator()->get('Patient\Controller\Helpers\Patient');
                $patientList = $allList->getAllList();
                $list = json_decode($patientList, TRUE);
                //var_dump($list['items']);exit;
                foreach ($data['check'] as $check){
                    foreach ($list['items'] as $ls){
                        if($check[0] === $ls['id']){
                            $value = $ls['email'];
                            //echo rtrim($value, ",");
                            $emails[] = $ls['email'];
                        }
                    }
                }
                $mailingList =  implode(',', $emails);

                $view = new ViewModel(array());
                $view->setTemplate('patient/mail/index');
                    $viewMailForm = new ViewModel(array('mailForm' => $mailForm->form,'mailingList' => $mailingList));
                    $viewMailForm->setTemplate('patient/mail/mailform');
                $view->addChild($viewMailForm, 'viewMailForm');
                return $view;
            }
        }
    }

    public function sendAction() {
        if ($this->getServiceLocator()->get('request')->isPost())
        {
            //var_dump($this->getServiceLocator()->get('request')->getPost());exit;
            $data = $this->getServiceLocator()->get('request')->getPost();
            $mailHelper = $this->getServiceLocator()->get('Patient\Controller\Helpers\Mail');
            $resultValidation = $mailHelper->validateMailForm();
            if($resultValidation === TRUE) {
                $result = $mailHelper->sendForm();

                if($result != FALSE) {
                    echo "Mail Sent";
                }exit;
            } else {
                return $this->redirect()->toRoute('patient');exit;
            }
        }
    }

    public function listAction() {
        $mailHelper = $this->getServiceLocator()->get('Patient\Controller\Helpers\Mail');

        $result = $mailHelper->getAllList();
        foreach ($result as $r) {
            $value[] = $r->to."|".$r->subject."|".$r->body;
        }
        //echo implode(',',$value);exit;
        if($result != FALSE) {
            $view = new ViewModel(array('value' => $value));
            $view->setTemplate('mail/list');
            return $view;
        }
    }
}