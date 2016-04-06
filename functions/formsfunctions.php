<?php

function print_doctype($title){
    ?>
    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title><?=$title?></title>
        <link rel="stylesheet" href="stylesheet.css">
    </head>
    <body>
    <?php
}


function print_login(){
    ?>
    <form id="login" method="post" action="">
        <input type="text" name="login">
        <input type="password" name="password">
        <input type="submit" value="Login">
    </form>
    <p>
    <a href="registrate.php"><input type="button" name="registrate" value="Зарегестироваться"></inputbutton></a>
    </p>
    <?php
}

function print_form_header($new = 0){
    if ($_SESSION['role'] != 'admin'){
        $button = '';
    } else {
        $button = "<th></th>";
    }
    ?>
    <table>
        <form>
            <tr>
                <?php
                    if (!$new){
                        echo '<th>id</th>';
                    }
                ?>
                <th>is_active</th>
                <th>vendor</th>
                <th>name</th>
                <th>price</th>
                <th>image</th>
                <th>description</th>
                <?php
                if (!$new){
                    echo '<th>date_added</th>';
                    echo '<th>date_modified</th>';
                }
                $button;
                ?>
            </tr>
        </form>
    <?php
}

function print_DB(){
    $db_array = db_in_array();
    if ($_SESSION['role'] != 'admin'){
        $readonly = '';
        $disabled = 'disabled="disabled"';
        $button = '';
    } else {
        $readonly = 'readonly';
        $disabled = '';
        $button = "<td id=\"edit\"><input type=\"submit\" value=\"Edit\"></td>";
    }
    print_form_header();
    foreach($db_array as $row){
        ?>
        <form method="post" action="">
            <tr>
                <td id="id"><input type="text" name="id" value="<?=$row['id']?>" <?=$disabled?><?=$readonly?>></td>
                <td id="is_active"><input type="text" name="is_active" value="<?=$row['is_active']?>" <?=$disabled?>></td>
                <td id="vendor"><textarea type="text" name="vendor" <?=$disabled?>><?=$row['vendor']?></textarea></td>
                <td id="name"><textarea name="name" <?=$disabled?>><?=$row['name']?></textarea></td>
                <td id="price"><input type="text" name="price" value="<?=$row['price']?>" <?=$disabled?>></td>
                <td id="image"><textarea type="text" name="image" <?=$disabled?>><?=$row['image']?></textarea></td>
                <td id="description"><textarea name="description" <?=$disabled?>><?=$row['description']?></textarea></td>
                <td id="date"><input type="text" name="date_added" value="<?=$row['date_added']?>" disabled="disabled"></td>
                <td id="date"><input type="text" name="date_modified" value="<?=$row['date_modified']?>" disabled="disabled"></td>
                <?=$button?>
            </tr>
        </form>
        <?php
    }
    echo '</table>';    
}

function print_registration(){
    ?>
    <form id="login" method="post" action="">
        <input type="text" name="login">
        <input type="password" name="password">
        <input type="submit" value="Registrate">
    </form>
    <?php
}

function add_product_form(){
    echo '<p>Add New product</p>';
    print_form_header('new');
    ?>
        <form method="post" action="">
            <tr>
                <td id="is_active"><input type="text" name="is_active"></td>
                <td id="vendor"><textarea type="text" name="vendor"></textarea></td>
                <td id="name"><textarea name="name"></textarea></td>
                <td id="price"><input type="text" name="price"></td>
                <td id="image"><textarea type="text" name="image"></textarea></td>
                <td id="description"><textarea name="description"></textarea></td>
                <td id="edit"><input type="submit" value="Edit"></td>
            </tr>
        </form>
    </table>
    <?php
}

function body_end(){
    ?>
    </body>
    <?php
}