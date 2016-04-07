<?php
require_once __DIR__ . '/autoload.php';

if (Auth::isAuthorized() === true) {
    header('LOCATION: ./index.php');
}

if (isset($_POST['go'])) {
    if (isset($_POST['login']) && isset($_POST['pass'])) {

        Db::connect();

        $login = Db::escape_string($_POST['login']);
        $pass = Db::escape_string($_POST['pass']);
        $pass = md5($pass . md5('solt'));

        $sql = "SELECT id, user, pass FROM users WHERE user='$login'";
        $wasInBase = ($res = Db::query($sql)) ? mysqli_fetch_assoc($res) : false ;
        if ($wasInBase == false) {
            $user_id = $db->createUser($login, $pass);
            Auth::login($user_id);
        } elseif (isset($wasInBase['pass']) && $wasInBase['pass'] == $pass) {
            Auth::login($wasInBase['id']);
        } else {
            $message = 'Неправильный пароль или пользователь с таким логином уже существует.';
        }
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <div id="registration">
        <form action="<?= $_SERVER['PHP_SELF']?>" method="post">
            <h2>Sign In / Registrate</h2>
            <input type="text" name="login" required placeholder="login">
            <input type="password" name="pass" required placeholder="password">
            <input type="submit" value="login / registrate" name="go"><br>
            (Login: admin | pass: admin - Administrator)<br>
            (Login: Litter | pass: 123 - User)<br>
            (Login: guest | pass: guest - Guest)<br>
            (New user will be guest)
            <label for=""><?= isset($message) ? $message : '';?></label>
        </form>
    </div>
</body>
</html>

