<?php

namespace Patient\Form\Filter;

use Zend\InputFilter\Factory AS InputFilterFactory;
use Zend\Validator\NotEmpty;
use Zend\Validator\Regex;
use Zend\Validator\InArray;

class MailForm {
    public $inputFilter;

    public function __construct() {
        $factory = new InputFilterFactory();
        $this->inputFilter = $factory->createInputFilter($this->_getConfig());
    }

    private function _getConfig() {
        return array(
            array(
                'name' => 'to',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'Regex',
                        'options' => array(
                            'pattern' => '/^[a-z0-9\`\~\@\#\%\^\&\*\(\)\-\_\=\+\[\]\{\}\\\|\;\:\'\"\,\.\<\>\/\?]{3,50}$/i',
                            'message' => array(
                                Regex::INVALID => 'Invalid !!!',
                                Regex::NOT_MATCH => '',
                                Regex::ERROROUS => ''
                            )
                        )
                    )
                )
            ),
            array(
                'name' => 'subject',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'Regex',
                        'options' => array(
                            'pattern' => '/^[a-z0-9\`\~\@\#\%\^\&\*\(\)\-\_\=\+\[\]\{\}\\\|\;\:\'\"\,\.\<\>\/\?]{3,50}$/i',
                            'message' => array(
                                Regex::INVALID => 'Invalid !!!',
                                Regex::NOT_MATCH => '',
                                Regex::ERROROUS => ''
                            )
                        )
                    )
                )
            ),
            array(
                'name' => 'body',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'Regex',
                        'options' => array(
                            'pattern' => '/^[a-z0-9\`\~\@\#\%\^\&\*\(\)\-\_\=\+\[\]\{\}\\\|\;\:\'\"\,\.\<\>\/\?]{3,50}$/i',
                            'message' => array(
                                Regex::INVALID => 'Invalid !!!',
                                Regex::NOT_MATCH => '',
                                Regex::ERROROUS => ''
                            )
                        )
                    )
                )
            )
        );
    }
}
