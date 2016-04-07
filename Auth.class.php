<?php
class Auth
{
    public static function login($user_id) {
        $_SESSION['auth'] = 'ok';
        $_SESSION['user_id'] = $user_id;

        $user = New Users();
        $user_info = $user->getUserById($user_id);
        $_SESSION['user'] = $user_info['user'];
        $_SESSION['role'] = $user_info['role'];

        header('LOCATION: ./index.php');
    }

    public function isAuthorized() {
        if (isset($_SESSION['auth']) && $_SESSION['auth'] === 'ok') {
            return true;
        }
        return false;
    }
}

