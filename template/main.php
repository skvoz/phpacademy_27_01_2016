<!DOCTYPE html >
<html>
<?php include_once 'head.php' ?>
<body>
<div class="container">
    <div>
        <div class="col-md-6"><p class="logined"><span class="logined">Вы вошли как : <?= $_SESSION['login']
                    ?></span></p></div>
        <div class="col-md-6" style="text-align: right;"><a href="?logout=logout"  class="myBtn btn
        btn-danger">Выйти</a></div>
    </div>
    <div class="clearfix" style="border-bottom: 1px dotted crimson; margin-bottom: 10px;"></div>
    <div class="col-lg-3" id="filter">
        <?php display_filter($user_priv, $db); ?>
    </div>
    <div class="col-lg-9">
        <?php
        $items = get_item($db);

        ?>
        <div class="clearfix"></div>
        <?= display_form($items, $user_priv); ?>
        <div class='clearfix'></div>
    </div>
</div>
</body>
</html>