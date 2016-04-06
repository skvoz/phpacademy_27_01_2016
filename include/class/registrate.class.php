<?php
class registrate{
    public function __construct(db $db)
    {
        $this->db = $db;
    }
    public function check($name){
        $sql = "SELECT login FROM users WHERE login = '{$name}'";
        if($this->db->query($sql)){
            return false;
        }else{
            return true;
        }
    }

    public function add_user($login,$pass){
        $pass = $this->gen_hash($pass);
        $sql = "INSERT INTO users (login, password) VALUE ('{$login}','{$pass}')";
        if($this->db->query($sql)){
            return true;
        }else{
            return false;
        }
    }

    public function gen_hash($pass){
        $options = [
            'cost' => 11,
            'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
        ];
        $hash = password_hash($pass, PASSWORD_DEFAULT, $options);
        return $hash;
    }

}