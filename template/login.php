<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<?php include_once 'head.php' ?>
<body class="container">
<div class="col-md-4" style="margin: 0px auto; float: none;">
    <h2 style="text-align: center">Войти</h2>
    <form method="post" action="">
        <input class="form-control" type="text" name="login" placeholder="Login" required>
        <input class="form-control" type="password" name="password" placeholder="Password" required>
        <input class="btn btn-success" type="submit" value="Login">
        <a href="/?registrate" class="btn btn-warning">Зарегистрироватся</a>
    </form>

</div>
</body>
</html>