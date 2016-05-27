<?php


namespace testnamespace\models;


use MongoDB\Driver\Exception\ExecutionTimeoutException;
use PDO;
use testnamespace\Application;

abstract class BaseModel
{
    protected $table;

    /**
     * UserModel constructor.
     */
    public function __construct()
    {
    }

    public function find($condition = [])
    {
        $result = [];
        if ($condition) {
            $where = ' WHERE ';
            foreach ($condition as $key => $item) {
                $where .= sprintf("$key='$item' AND ");
            }
            $where = substr($where, 0, -5);

            $sql = sprintf('select * from %s %s order by id', $this->table, $where);
        } else {
            $sql = sprintf('select * from %s order by id', $this->table);

//            return $data;
//
        }

        $result = Application::db()->query($sql);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $item) {
                foreach ($item as $field => $value) {
//                    if (is_callable([$this, $field])) {
                        $this->$field = $value;
//                    } else {
//                        var_dump($field, $value);
//                        die;
//                        throw new \Exception('Unexsit field');
//                    }
                }
            }

//        var_dump($this);
//        die;

        return $result;
    }

    public function save()
    {
        if ($this->id != null) {
            $this->update();
        } else {
            $this->insert();
        }
    }

    private function insert()
    {
        $reflectionObject = new \ReflectionObject($this);
        $properties = $reflectionObject->getProperties();
        $fields = '';
        $values = '';
        foreach ($properties as $property) {
            if ($property->name == 'table' || $property->name == 'id') {
                continue;
            }

            $fields .= '`'.$property->name.'`,';
            $value = $this->{$property->name} ? $this->{$property->name} : "null";
            if (gettype($value) == 'string' && $value != "null") {
                $values .= '"' . $value . '",';
            } else {
                $values .= $value . ', ';
            }

        }

        $sql = sprintf('insert into %s (%s) values (%s) ', $this->table, substr($fields,0 , -1), substr($values,0 , -1));

        $db = Application::db();

        $result = $db->exec($sql);

        if ($result == false) {
            $arr = $db->errorInfo();
            throw new \Exception(sprintf("error bd %s", $arr['2']));
        }

    }

    private function update()
    {
        throw new Execution('Functional not realized');
    }

}