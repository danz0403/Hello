<?php
namespace CheckList\Model;

use Zend\Db\Adapter\Adapter;
use CheckList\Model\TaskEntity;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\ResultSet\HydratingResultSet;

class TaskMapper
{
    protected $tablename = 'task_item';
    protected $dbAdapter;
    protected $sql;
    
    public function __construct(Adapter $dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;
        $this->sql = new Sql($dbAdapter);
        $this->sql->setTable($this->tablename);
    }
    
    public function fetchAll()
    {
        $select = $this->sql->select();
        $select->order(array('completed ASC', 'created ASC'));
        
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();
        
        $entityPrototype = new TaskEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($result);
        
        return $resultset;
    }
}

?>