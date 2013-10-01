<?php

namespace Application\Model\Mapper;

use Application\Model\Helpers\MapperFunctions;

class Mail extends MapperFunctions {
    public $id;
    public $to;
    public $subject;
    public $body;
    public $status;
    public $created_at;
    public $modified_at;


    public function __construct($data = NULL) {
        if($data !== NULL && is_array($data)) {
            $this->exchangeArray($data); }
    }
}