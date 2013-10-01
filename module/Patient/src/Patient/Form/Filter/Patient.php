<?php

namespace Patient\Form\Filter;

use Zend\InputFilter\Factory AS InputFilterFactory;
use Zend\Validator\NotEmpty;
use Zend\Validator\Regex;
use Zend\Validator\InArray;

class Patient {
    public $inputFilter;

    public function __construct() {
        $factory = new InputFilterFactory();
        $this->inputFilter = $factory->createInputFilter($this->_getConfig());
    }

    private function _getConfig() {
        return array(
            array(
                'name' => 'check',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                /*'validators' => array(
                    array(
                        'name' => 'InArray',
                        'options' => array(
                            'haystack' => array(),
                            'message' => array(
                                InArray::NOT_IN_ARRAY => 'Invalid !!!'
                            ),
                            'label' => 'A checkbox',
                            'use_hidden_element' => false,
                            'checked_value' => 'good',
                            'unchecked_value' => 'bad'
                        )
                    )
                )*/
            ),
            array(
                'name' => 'id',
                'required' => false,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'InArray',
                        'options' => array()
                    )
                )
            ),
            array(
                'name' => 'email',
                'required' => false,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'InArray',
                        'options' => array()
                    )
                )
            )
        );
    }
}
