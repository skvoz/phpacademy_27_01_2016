<?php
class users{
    use filter;
    public function __construct(db $db)
    {
        $this->db = $db;
    }
    
    public function get_user($login,$pass){
        $login = $this->valid($login);
        $pass = $this->valid($pass);
        $sql = "SELECT id FROM users WHERE name = '{$login}' AND pass = '{$pass}'";
        return $this->db->query($sql);
    }
}