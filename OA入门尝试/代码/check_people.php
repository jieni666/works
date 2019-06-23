<?php
session_start();
$data = isset($_POST['name'])?$_POST['name']:'';

if($data===''){
    $a['flag'] = 0;
    $a['errCode'] = 0;
    echo json_encode($a);
    return ;
}

include_once './main.php';
$db = new database();
//判断查询信息是否存在
$is_exist = $db ->check_user_exist('admin_login','username',$data);
if($is_exist){
    $a['flag'] = 1;
//    $_SESSION['admin'] = 1;
    echo json_encode($a);
    return ;
}
$is_exist = $db ->check_user_exist('user_login','username',$data);
if($is_exist){
//    $_SESSION['admin'] = 0;
    $a['flag'] = 1;
}else{
//    $_SESSION['admin'] = 2;
    $a['flag'] = 0;
    $a['errCode'] = 1;
}
echo json_encode($a);