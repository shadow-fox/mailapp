<?php

return array(
	'invokables' => array(
        'Patient\Form\Filter\Patient'     => 'Patient\Form\Filter\Patient',
        'Patient\Form\Filter\MailForm'    => 'Patient\Form\Filter\MailForm',
	 ),
	'factories' => array(
        'Patient\Form\Patient' =>  function($sm) {
            $obj = new Patient\Form\Patient();
            return $obj;
        },
        'Patient\Form\MailForm' =>  function($sm) {
            $obj = new Patient\Form\MailForm();
            return $obj;
        },
        'Patient\Controller\Helpers\Patient' =>  function($sm) {
			return new Patient\Controller\Helpers\Patient($sm);
		},
        'Patient\Controller\Helpers\Mail' =>  function($sm) {
            return new Patient\Controller\Helpers\Mail($sm);
        },
	),   
);