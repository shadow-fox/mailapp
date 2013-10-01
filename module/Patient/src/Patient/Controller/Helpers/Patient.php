<?php

namespace Patient\Controller\Helpers;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Zend\Json\Json;

use Application\Controller\Helpers\MessageConstants AS MC;


class Patient implements  ServiceLocatorAwareInterface
{
	protected $services;
	
	private static $count = 1;
	
	public function __construct($sm) {
		 $this->setServiceLocator($sm);
	}
	
	public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
        $this->services = $serviceLocator;
    }
	
	public function getServiceLocator() {
        return $this->services;
    }

    public function getAllList(){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://patients.apiary.io/patients");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public function getPatientId($id) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://patients.apiary.io/patient/2");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}