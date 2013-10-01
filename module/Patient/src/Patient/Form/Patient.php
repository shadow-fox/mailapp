<?php

namespace Patient\Form;

use Zend\Form\Factory AS FormFactory;


class Patient {
	public $form;
	
    public function __construct() {
        $factory = new FormFactory();
        $this->form = $factory->createForm($this->_getConfig());
    }
	
	private function _getConfig() {
		return array(
			'hydrator' => 'Zend\Stdlib\Hydrator\ArraySerializable',
			'elements' => array(
				array(
                    'spec' => array(
                        'type'	  => 'Zend\Form\Element\MultiCheckbox',
                        'name'	  => 'check',
                        'options' => array(),
                        'attributes' => array(
                        ),
                    ),
                ),
                array(
                    'spec' => array(
                        'type'  => 'Zend\Form\Element\Submit',
                        'name' => 'submit',
                        'options' => array(),
                        'attributes' => array(),
                    ),
                )
			)
        );
	}
}
 
	