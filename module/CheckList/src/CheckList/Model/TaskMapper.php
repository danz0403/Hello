<?php
namespace CheckList\Model;

use CheckList\Model\TaskEntity;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Stdlib\Hydrator\ClassMethods;

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
    
    public function saveTask(TaskEntity $task)
    {
        $hydrator = new ClassMethods();
        $data = $hydrator->extract($task);
        
        if ($task->getId()) {
            // update action
            $action = $this->sql->update();
            $action->set($data);
            $action->where(array('id' => $task->getId()));
        } else {
            // insert action
            $action = $this->sql->insert();
            unset($data['id']);
            $action->values($data);            
        }
        
        $statement = $this->sql->prepareStatementForSqlObject($action);
        $result = $statement->execute();
        
        if (! $task->getId()) {
            $task->setId($result->getGeneratedValue());
        }
        
        return $result;
    }
}

?>