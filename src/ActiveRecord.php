<?php


namespace testnamespace;
use PDO;

/**
 * Class ActiveRecord
 * @package testnamespace
 */
abstract class ActiveRecord implements IAR
{
    protected $table = null;
    /**
     * @var null|\PDO
     */
    protected $db;

    /**
     * ActiveRecord constructor.
     * @param \PDO|null $db
     * @throws \Exception
     */
    public function __construct(PDO $db = null)
    {
        if ($db == null) {
            $config = Config::params('db');
            $this->db = new PDO($config['driver'], $config['user'], $config['password']);
        } else {
            $this->db = $db;
        }

        if ($this->table == null) {
            throw new \Exception('Unknown table');
        }
    }

    function delete()
    {
        if (empty($this->id)) {
            throw new \Exception('Id empty');
        }

        $sql = sprintf('DELETE FROM `%s` WHERE id=%s', $this->table, $this->id);
        $this->db->exec($sql);

        return true;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    function update()
    {
        if (empty($this->id)) {
            throw new \Exception('Id empty');
        }

        $property = get_class_vars($this);

        if (is_array($property)) {
            $sql = "UPDATE `".$this->table."` ";
            foreach ($property as $name => $value) {
                $sql .= sprintf("%s='%s',", $name, $value);
            }
            $sql = substr($sql, 0, -1);
            $sql .= ' WHERE id=' . $this->id;
            $this->db->prepare($sql)->execute();
        }

        return true;
    }

    public function insert()
    {
        $property = get_class_vars($this);

        if (is_array($property)) {
            $fieldName = '';
            $values = null;
            foreach ($property as $name => $value) {
                $fieldName .='`'.$name.'`,';
                $values .='\''.$value.'\'';
            }
            $fieldName = substr($fieldName, 0, -1);
            $sql = "INSERT INTO `".$this->table."` ($fieldName) VALUES ($values)";
            $this->db->prepare($sql)->execute();
        }
        
        return true;
    }

    function save()
    {
        if ($this->id) {
            $this->insert();
        } else {
            $this->update();
        }
    }

    function find($array = null)
    {
        $sql = 'SELECT * FROM  `'.$this->table.'` ';
        if ($array) {
            $where = 'WHERE ';
            foreach ($array as $name => $value) {
                $where .= sprintf(' %s="%s" and ', $name, $value);
            }
            if ($where === 'WHERE ') {
                $where = '';
            } else {
                $where = substr($where, 0 , -4);
            }
            $sql .= $where;
        }

        $result = $this->db->query($sql);
        
        return $result->fetchAll();
        
    }

    function load($array)
    {
        $property = get_class_vars($this);
        if (is_array($property)) {
            foreach ($property as $name => $value) {
                if (isset($array[$name])) {
                    $this->$name = $value;
                }
            }
        }
        return true;
    }
    
    public static function generator($data) {
        foreach ($data as $item) {
            yield $item;
        }
    }
}