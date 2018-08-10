<?php
namespace CheckList\Model;

class TaskEntity
{
    protected $id;
    protected $title;
    protected $completed = 0;
    protected $created;
    
    public function __construct()
    {
        $this->created = date('Y-m-d H:i:s');
    }
    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return the $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return the $created
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param field_type $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param field_type $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param string $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }
    /**
     * @return the $completed
     */
    public function getCompleted()
    {
        return $this->completed;
    }

    /**
     * @param field_type $completed
     */
    public function setCompleted($completed)
    {
        $this->completed = $completed;
    }


}