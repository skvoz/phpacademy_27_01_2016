<?php

function db_start(){
    return mysqli_connect(DBHOST, DBUSER, DBPASS, DBBASE);
}

function db_fetch($sql){
    $link = db_start();
    $res = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($res);
    return $row;
}

function db_try_login($post){
    $sql = "SELECT * FROM users WHERE login = '{$post['login']}'";
    $row = db_fetch($sql);
    return $row;
}

function db_get_user_role($post){
    $sql = "SELECT role FROM users WHERE login = '{$post['login']}'";
    $row = db_fetch($sql);
    $row = $row['role'];
    return $row;
}

function db_try_logopass($post){
    $sql = "SELECT salt, password FROM users WHERE login = '{$post['login']}'";    
    $row = db_fetch($sql);

    if ($row['password'] === md5(md5($row['salt']).$post['password'])){
        return true;
    } else {
        return false;
    }
}

function db_change_users($post){
    $link = db_start();
    $salt = db_salt_generator();
    $password = md5(md5($salt).$post['password']);
    $role = 'guest'; // потом допишу про присвоение ролей
    $sql = "INSERT INTO users SET login ='{$post['login']}', password ='{$password}', salt ='{$salt}', role = '{$role}'";
    mysqli_query($link, $sql);
}

function db_salt_generator(){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $res = '';
    $count = rand(10,20);
    for ($i=1; $i <= $count; $i++){
        $res .= $characters[rand(0, strlen($characters)-1)];
    }
    return $res;
}

function db_data_validation($post){
    if (isset($post['id'])){
        $post['id'] = db_data_validation_id($post['id']);
        if (!($post['id'])){
            unset($post['id']);
        }
    }
    $rows = ['name', 'description', 'vendor', 'image'];
    foreach ($rows as $row){
        if (isset($post[$row])){
            $post[$row] = db_data_validation_rows($post[$row]);
        }
    }
    if (!isset($post['is_active']) || ($post['is_active'] != 1)){
        $post['is_active'] = 0;
    }
    if (isset($post['price'])){
        $post['price'] = db_data_validation_price($post['price']);
    } else {
        $post['price'] = 0;
    }
    return $post;
}

function db_data_validation_id($id){
    $id = (int)$id;
    if ($id > 0){
        $sql = "SELECT id FROM products WHERE id = '{$id}'";
        $row = db_fetch($sql);
        if ((!is_array($row)) || (!in_array($id, $row))){
            return false;
        } else {
            return $id;
        }
    } else {
        return false;
    }
}

function db_data_validation_rows($value){
    $value = mysqli_real_escape_string(db_start(), $value);
    return $value;
}

function db_data_validation_price($value){
    $value = (float)$value;
    if ($value < 0){
        $value = 0;
    }
    return $value;
}

function db_change_products($post){
    $link = db_start();
    $post = db_data_validation($post);
    if (isset($post['id'])){
        $sql = update_products_query($post);
    } else {
        $sql = insert_products_query($post);
    }
    mysqli_query($link, $sql);
}

function db_in_array(){
    $db_data = select_products_query();
    $db_array = [];
    while ($db_row = mysqli_fetch_assoc($db_data)){
        $db_array[] = $db_row;
    }
    return $db_array;
}

function select_products_query(){
    $link = db_start();
    $sql = "SELECT * FROM products ORDER BY id DESC";
    return mysqli_query($link, $sql);
}

function update_products_query($post){
    return "UPDATE products SET" . short_products_query($post) . "WHERE id = '{$post['id']}'";
}

function insert_products_query($post){
    return "INSERT INTO products SET" . short_products_query($post) . ", date_added = CURDATE()";
}

function short_products_query($post){
    return
        "`name` = '{$post['name']}',
        description = '{$post['description']}',
        price = '{$post['price']}',
        image = '{$post['image']}',
        is_active = '{$post['is_active']}',
        vendor = '{$post['vendor']}',
        date_modified = CURDATE()
        ";
}