<!DOCTYPE html >
<html>
<head>
    <title>Мини каталог</title>
    <!--Latest compiled and minified CSS-->
    <link rel="stylesheet" href="style/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/css/custom.css">

    <!--Latest compiled and minified JavaScript-->
    <script src="style/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div>
        <h4><?= $liked_txt ?></h4>
    </div>
    <?php
        $msg = new msg($db);
        $msg->display_msg();
        include __DIR__.DS.'add_form.html';
    ?>
</div>
</body>
</html>