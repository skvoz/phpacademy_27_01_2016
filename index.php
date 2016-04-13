<?php
session_start();
$_SESSION['user_id'] = 2;
define('DS',DIRECTORY_SEPARATOR);
 function __autoload($name){
     require_once __DIR__.DS.'include'.DS.'class'.DS.$name.'.php';
 }
$connect_data = new connect_data;
$db = new db(
    $connect_data->host,
    $connect_data->user,
    $connect_data->pass,
    $connect_data->db_name
);
$msg = new msg($db);
$liked_txt = null;
if(isset($_POST['submit_msg'])){
    $msg->add_msg($_POST['add_msg'],$_SESSION['user_id']);
}
if(isset($_POST['like'])){
   $liked_txt = $msg->add_like($_POST['id'],$_SESSION['user_id']);
}elseif(isset($_POST['dislike'])){
    $liked_txt = $msg->add_dilike($_POST['id'],$_SESSION['user_id']);
}
include './template/main_tmp.php';
