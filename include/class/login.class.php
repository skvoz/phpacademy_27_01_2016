<?php
class login{
    private $login;
    private $pass;
    public function __construct(db $db)
    {
        /*$this->login = $this->validate($login);
        $this->pass = $this->validate($pass);*/
        $this->db = $db;
        //$this->getPass($this->login,$this->pass);
    }
    public function getPass($login,$pass)
    {
        $this->login = $this->validate($login);
        $this->pass = $this->validate($pass);
        $result = $this->db->query("SELECT password FROM users WHERE login='{$this->login}'");
        if (password_verify($this->pass, $result[0]['password'])) {
            return true;
        } else {
            return false;
        }
    }

    public function priv($login){
        $result = $this->db->query("SELECT admin FROM users WHERE login='{$login}'");
        return $result[0]['admin'];
    }

    private function validate($str){
        return stripslashes(strip_tags(trim($str)));
    }
}