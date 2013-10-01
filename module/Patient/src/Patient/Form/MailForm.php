<?php

namespace Patient\Form;

use Zend\Form\Factory AS FormFactory;


class MailForm {
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
                        'type'	  => 'Zend\Form\Element\Text',
                        'name'	  => 'to',
                        'options' => array(),
                        'attributes' => array(
                        ),
                    ),
                ),
                array(
                    'spec' => array(
                        'type'	  => 'Zend\Form\Element\Text',
                        'name'	  => 'subject',
                        'options' => array(),
                        'attributes' => array(
                        ),
                    ),
                ),
                array(
                    'spec' => array(
                        'type'	  => 'Zend\Form\Element\Textarea',
                        'name'	  => 'body',
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
