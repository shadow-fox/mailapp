<?php

namespace Patient\Controller\Helpers;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Application\Controller\Helpers\MessageConstants AS MC;
use Patient\Controller\Helpers\SendMail AS SM;

class Mail implements ServiceLocatorAwareInterface {
    protected $services;
    private $inputFilter;

    public function __construct($sm)
    {
        $this->setServiceLocator($sm);
    }

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->services = $serviceLocator;
    }

    public function getServiceLocator()
    {
        return $this->services;
    }

    public function validate()
    {
        $data = $this->services->get('request')->getPost();
        $this->inputFilter = $this->services->get('Patient\Form\Filter\Patient');
        $this->inputFilter->inputFilter->setData($data);
        $this->inputFilter->inputFilter->isValid();

        return $this->inputFilter->inputFilter->getMessages();
    }

    public function validateMailForm()
    {
        $data = $this->services->get('request')->getPost();
        $this->inputFilter = $this->services->get('Patient\Form\Filter\MailForm');
        $this->inputFilter->inputFilter->setData($data);
        $this->inputFilter->inputFilter->isValid();
        return $this->inputFilter->inputFilter->getMessages();
    }

    public function sendForm() {
        $mailTable = $this->services->get('Model:MailTable');
        $mailMapper = $this->services->get('Mapper:Mail');
        $data = $this->services->get('request')->getPost();
        $mailMapper->to = $data['to'];
        $mailMapper->subject = $data['subject'];
        $mailMapper->body = $data['body'];
        $mailMapper->status = "100"; // Added
        $mailMapper->created_at = $this->services->get('Date\Now\AsiaKolkata')->format('Y/m/d H:i:s');
        $mailMapper->modified_at = $mailMapper->created_at;

        $insert = $mailTable->insertMail($mailMapper);
        if($insert != NULL) {
            // SM::send($mailMapper->to, $mailMapper->subject, $mailMapper->body);
            return $insert->getGeneratedValue();
        } else {
            return FALSE;
        }
    }

    public function getAllList() {
        $mailTable = $this->services->get('Model:MailTable');
        $mailMapper = $this->services->get('Mapper:Mail');

        $getResult = $mailTable->getMail($mailMapper);

        if($getResult != NULL) {
            return $getResult;
            //return $getResult->current();
        } else {
            return FALSE;
        }
    }

}