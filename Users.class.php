<?php
class Users
{
    public function createUser($login, $pass)
    {
        $sql = "INSERT INTO users SET user='$login', pass='$pass'";
        Db::query($sql);
        return Db::insert_last_id();
    }

    public function getUserById($user_id)
    {
        $sql = "SELECT user, role FROM users WHERE id='$user_id'";
        $res = Db::query($sql);
        return mysqli_fetch_assoc($res);
    }

}