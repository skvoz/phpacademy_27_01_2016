<?php
class db
{
    protected $connection;

    public function __construct($host, $login, $pass, $db)
    {
        $this->connection = new mysqli($host, $login, $pass, $db);
        if (!$this->connection) {
            throw new Exception("Could not connect to BD");
        }
        $this->query("SET NAMES utf8");
    }
    public function __destruct()
    {
        $this->connection->close();
    }

    public function query($sql)
    {
        if (!$this->connection) {
            return false;
        }

        $result = $this->connection->query($sql);
        if ( mysqli_error($this->connection) ){
            throw new Exception(mysqli_error($this->connection));
        }

        if (is_bool($result)){ // ??
            return $result;
        }
        $data = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    public function escape($str)
    {
        return $this->connection->escape_string($str);
    }
}
