<?php

namespace Application\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Expression;
use Zend\Db\TableGateway\AbstractTableGateway;
use Application\Model\Mapper\Mail AS MailMapper;

class MailTable{
	protected $table = 'mail';
    protected $sql;      
	
	public function	__construct(Adapter $adapter) {
		$this->adapter = $adapter;
        $this->sql = new Sql($this->adapter);
	}
    
    public function insertMail(MailMapper $mail) {
        $insert = $this->sql->insert($this->table);
        $insert->values($mail->getNotNullArrayCopy());
        //echo $this->sql->getSqlStringForSqlObject($insert);exit;
        try {
            return  $this->adapter->query($this->sql->getSqlStringForSqlObject($insert),Adapter::QUERY_MODE_EXECUTE);
        } catch(\Exception $e) {
            var_dump($e->getMessage());exit;
            return NULL;
        }
    }

    public function getMail() {
        $mailMapper = new MailMapper();
        $select = $this->sql->select(array('mail' => $this->table))
                            ->columns($mailMapper->getArrayCopy(TRUE))
                            ->where($where);
        //echo $this->sql->getSqlStringForSqlObject($select);exit;
        try{
            $result = $this->adapter->query($this->sql->getSqlStringForSqlObject($select),Adapter::QUERY_MODE_EXECUTE);
            $result->setArrayObjectPrototype($mailMapper);
            if($result->count() != 0){
                return $result;  
            }
            return array();
        } catch(\Exception $e) {
            return NULL;
        }
    }

}
